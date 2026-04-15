#!/usr/bin/env python3
"""Generate markdown summary report from evidence status scan."""

from __future__ import annotations

import json
import subprocess
import sys
from datetime import datetime, timezone
from pathlib import Path

ROOT = Path(__file__).resolve().parents[2]
STATUS_SCRIPT = ROOT / 'backend' / 'scripts' / 'evidence_status_report.py'
REPORTS_DIR = ROOT / 'backend' / 'reports'


def _collect_status() -> dict:
    proc = subprocess.run(
        [sys.executable, str(STATUS_SCRIPT)],
        cwd=str(ROOT),
        capture_output=True,
        text=True,
        check=False,
    )

    try:
        payload = json.loads(proc.stdout)
    except json.JSONDecodeError as exc:
        raise RuntimeError(f'Invalid JSON from evidence_status_report.py: {exc}') from exc

    payload['_exit_code'] = proc.returncode
    return payload


def _render_markdown(summary: dict) -> str:
    lines: list[str] = []
    generated_at = datetime.now(timezone.utc).isoformat()

    lines.append('# Evidence Status Summary')
    lines.append('')
    lines.append(f'- generated_at_utc: `{generated_at}`')
    lines.append(f"- total: `{summary.get('total', 0)}`")
    lines.append(f"- valid: `{summary.get('valid', 0)}`")
    lines.append(f"- invalid: `{summary.get('invalid', 0)}`")
    lines.append('')

    files = summary.get('files', []) or []
    if not files:
        lines.append('_No evidence files found._')
        lines.append('')
        return '\n'.join(lines)

    lines.append('## Files')
    lines.append('')
    lines.append('| Path | Status | Detail |')
    lines.append('|---|---|---|')

    for item in files:
        path = str(item.get('path', '')).replace('|', '\\|')
        status = str(item.get('status', '')).replace('|', '\\|')
        detail = str(item.get('detail', '')).replace('\n', ' ').replace('|', '\\|')
        lines.append(f'| `{path}` | `{status}` | `{detail}` |')

    lines.append('')
    return '\n'.join(lines)


def main() -> int:
    summary = _collect_status()
    REPORTS_DIR.mkdir(parents=True, exist_ok=True)

    out_path = REPORTS_DIR / 'evidence_status_summary.md'
    out_path.write_text(_render_markdown(summary), encoding='utf-8')

    print(out_path)

    return 0


if __name__ == '__main__':
    raise SystemExit(main())
