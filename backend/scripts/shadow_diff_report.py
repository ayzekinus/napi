#!/usr/bin/env python3
"""Generate a shadow-read diff report from existing parity scripts."""

from __future__ import annotations

import json
import os
import subprocess
import sys
from datetime import datetime, timezone
from pathlib import Path

ROOT = Path(__file__).resolve().parents[2]
SCRIPTS_DIR = ROOT / 'backend' / 'scripts'
ROW_COUNT_SCRIPT = SCRIPTS_DIR / 'row_count_compare.py'
SAMPLE_SCRIPT = SCRIPTS_DIR / 'sample_record_compare.py'


def _run_json_script(script: Path, env: dict[str, str]) -> tuple[int, dict | None, str]:
    proc = subprocess.run(
        [sys.executable, str(script)],
        cwd=str(ROOT),
        env=env,
        capture_output=True,
        text=True,
        check=False,
    )

    payload = None
    if proc.stdout.strip():
        try:
            payload = json.loads(proc.stdout)
        except json.JSONDecodeError:
            payload = None

    stderr = proc.stderr.strip()
    return proc.returncode, payload, stderr


def _status_from_exit_code(code: int) -> str:
    if code == 0:
        return 'ok'
    if code == 1:
        return 'diff_detected'
    return 'error'


def _is_count_only_mismatch(payload: dict | None) -> bool:
    if not isinstance(payload, dict):
        return False

    comparisons = payload.get('comparisons')
    if not isinstance(comparisons, dict):
        return False

    for item in comparisons.values():
        if not isinstance(item, dict):
            continue

        if item.get('matches') is True:
            continue

        if item.get('service_count') != item.get('legacy_count'):
            return True

    return False


def _classify_result(code: int, payload: dict | None) -> str:
    if code == 0:
        return 'beklenen'

    if code == 2:
        return 'degraded_or_runtime_error'

    if _is_count_only_mismatch(payload):
        return 'veri_kirliligi'

    return 'regresyon'


def _collect_degraded_sources(row_err: str, sample_err: str) -> list[str]:
    sources: list[str] = []

    if 'degraded' in row_err.lower():
        sources.append('row_count_compare')

    if 'degraded' in sample_err.lower():
        sources.append('sample_record_compare')

    return sources


def main() -> int:
    env = os.environ.copy()
    report_dir = ROOT / 'backend' / 'reports'
    report_dir.mkdir(parents=True, exist_ok=True)

    row_code, row_payload, row_err = _run_json_script(ROW_COUNT_SCRIPT, env)
    sample_code, sample_payload, sample_err = _run_json_script(SAMPLE_SCRIPT, env)

    classification = {
        'row_count_compare': _classify_result(row_code, row_payload),
        'sample_record_compare': _classify_result(sample_code, sample_payload),
    }

    degraded_sources = _collect_degraded_sources(row_err, sample_err)

    report = {
        'generated_at_utc': datetime.now(timezone.utc).isoformat(),
        'status': {
            'row_count_compare': _status_from_exit_code(row_code),
            'sample_record_compare': _status_from_exit_code(sample_code),
        },
        'classification': classification,
        'degraded_metrics': {
            'degraded_detected': len(degraded_sources) > 0,
            'degraded_sources': degraded_sources,
            'total_checks': 2,
            'error_checks': sum(1 for c in (row_code, sample_code) if c == 2),
        },
        'outputs': {
            'row_count_compare': row_payload,
            'sample_record_compare': sample_payload,
        },
        'errors': {
            'row_count_compare': row_err,
            'sample_record_compare': sample_err,
        },
    }

    report_path = report_dir / 'shadow_diff_report.json'
    report_path.write_text(json.dumps(report, ensure_ascii=False, indent=2) + '\n', encoding='utf-8')

    print(
        json.dumps(
            {
                'report_path': str(report_path),
                'status': report['status'],
                'classification': classification,
                'degraded_metrics': report['degraded_metrics'],
            },
            ensure_ascii=False,
            indent=2,
        )
    )

    if row_code in (0, 1) and sample_code in (0, 1):
        return 0
    return 2


if __name__ == '__main__':
    raise SystemExit(main())
