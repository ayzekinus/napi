#!/usr/bin/env python3
"""Produce go/hold decision from evidence status summary JSON output."""

from __future__ import annotations

import json
import subprocess
import sys
from pathlib import Path

ROOT = Path(__file__).resolve().parents[2]
STATUS_SCRIPT = ROOT / 'backend' / 'scripts' / 'evidence_status_report.py'


def _load_status() -> dict:
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
        raise RuntimeError(f'invalid status payload: {exc}') from exc
    return payload


def main() -> int:
    status = _load_status()
    total = int(status.get('total', 0))
    invalid = int(status.get('invalid', 0))
    valid = int(status.get('valid', 0))

    decision = 'go' if total > 0 and invalid == 0 else 'hold'
    result = {
        'decision': decision,
        'reason': 'all_evidence_valid' if decision == 'go' else 'invalid_or_missing_evidence',
        'total': total,
        'valid': valid,
        'invalid': invalid,
    }

    print(json.dumps(result, ensure_ascii=False, indent=2))
    return 0 if decision == 'go' else 1


if __name__ == '__main__':
    raise SystemExit(main())
