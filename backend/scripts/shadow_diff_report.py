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


def main() -> int:
    env = os.environ.copy()
    report_dir = ROOT / 'backend' / 'reports'
    report_dir.mkdir(parents=True, exist_ok=True)

    row_code, row_payload, row_err = _run_json_script(ROW_COUNT_SCRIPT, env)
    sample_code, sample_payload, sample_err = _run_json_script(SAMPLE_SCRIPT, env)

    report = {
        'generated_at_utc': datetime.now(timezone.utc).isoformat(),
        'status': {
            'row_count_compare': _status_from_exit_code(row_code),
            'sample_record_compare': _status_from_exit_code(sample_code),
        },
        'classification': {
            'row_count_compare': (
                'regresyon' if row_code == 1 else 'degraded_or_runtime_error' if row_code == 2 else 'beklenen'
            ),
            'sample_record_compare': (
                'regresyon' if sample_code == 1 else 'degraded_or_runtime_error' if sample_code == 2 else 'beklenen'
            ),
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

    print(json.dumps({'report_path': str(report_path), 'status': report['status']}, ensure_ascii=False, indent=2))

    if row_code in (0, 1) and sample_code in (0, 1):
        return 0
    return 2


if __name__ == '__main__':
    raise SystemExit(main())
