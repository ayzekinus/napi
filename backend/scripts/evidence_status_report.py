#!/usr/bin/env python3
"""Scan migration-evidence files and report validation status summary."""

from __future__ import annotations

import json
import subprocess
import sys
from pathlib import Path

ROOT = Path(__file__).resolve().parents[2]
EVIDENCE_DIR = ROOT / 'migration-evidence'
VALIDATOR = ROOT / 'backend' / 'scripts' / 'validate_live_evidence.py'


def _validate(path: Path) -> tuple[bool, str]:
    proc = subprocess.run(
        [sys.executable, str(VALIDATOR), str(path)],
        cwd=str(ROOT),
        capture_output=True,
        text=True,
        check=False,
    )
    output = (proc.stdout or '').strip()
    status = 'valid' if proc.returncode == 0 else 'invalid'
    return proc.returncode == 0, output or status


def main() -> int:
    if not EVIDENCE_DIR.exists():
        print(json.dumps({'total': 0, 'valid': 0, 'invalid': 0, 'files': []}, ensure_ascii=False, indent=2))
        return 0

    files = sorted(EVIDENCE_DIR.glob('live-evidence-*.md'))
    summary = {
        'total': len(files),
        'valid': 0,
        'invalid': 0,
        'files': [],
    }

    for file_path in files:
        ok, detail = _validate(file_path)
        if ok:
            summary['valid'] += 1
        else:
            summary['invalid'] += 1

        summary['files'].append(
            {
                'path': str(file_path),
                'status': 'valid' if ok else 'invalid',
                'detail': detail,
            }
        )

    print(json.dumps(summary, ensure_ascii=False, indent=2))
    return 0 if summary['invalid'] == 0 else 1


if __name__ == '__main__':
    raise SystemExit(main())
