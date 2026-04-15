#!/usr/bin/env python3
"""Record evidence gate decisions into a historical JSONL log."""

from __future__ import annotations

import json
import subprocess
import sys
from datetime import datetime, timezone
from pathlib import Path

ROOT = Path(__file__).resolve().parents[2]
REPORTS_DIR = ROOT / 'backend' / 'reports'
GATE_SCRIPT = ROOT / 'backend' / 'scripts' / 'evidence_gate_decision.py'
HISTORY_PATH = REPORTS_DIR / 'evidence_gate_history.jsonl'


def _read_gate() -> dict:
    proc = subprocess.run(
        [sys.executable, str(GATE_SCRIPT)],
        cwd=str(ROOT),
        capture_output=True,
        text=True,
        check=False,
    )
    try:
        payload = json.loads(proc.stdout)
    except json.JSONDecodeError as exc:
        raise RuntimeError(f'invalid gate payload: {exc}') from exc
    return payload


def main() -> int:
    gate = _read_gate()

    REPORTS_DIR.mkdir(parents=True, exist_ok=True)

    snapshot = {
        'timestamp_utc': datetime.now(timezone.utc).isoformat(),
        'decision': gate.get('decision', 'hold'),
        'reason': gate.get('reason', 'invalid_or_missing_evidence'),
        'total': int(gate.get('total', 0)),
        'valid': int(gate.get('valid', 0)),
        'invalid': int(gate.get('invalid', 0)),
    }

    with HISTORY_PATH.open('a', encoding='utf-8') as fh:
        fh.write(json.dumps(snapshot, ensure_ascii=False) + '\n')

    print(json.dumps({'written_to': str(HISTORY_PATH), 'snapshot': snapshot}, ensure_ascii=False, indent=2))
    return 0 if snapshot['decision'] == 'go' else 1


if __name__ == '__main__':
    raise SystemExit(main())
