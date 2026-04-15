#!/usr/bin/env python3
"""Create a single readiness snapshot from evidence gate artifacts."""

from __future__ import annotations

import json
import subprocess
import sys
from datetime import datetime, timezone
from pathlib import Path

ROOT = Path(__file__).resolve().parents[2]
SCRIPTS = ROOT / 'backend' / 'scripts'
REPORTS = ROOT / 'backend' / 'reports'
HEALTH_SCRIPT = SCRIPTS / 'evidence_gate_report_health.py'
DECISION_SCRIPT = SCRIPTS / 'evidence_gate_decision.py'
OUTPUT_PATH = REPORTS / 'evidence_gate_readiness_snapshot.json'


def _run_json(script: Path) -> tuple[int, dict]:
    proc = subprocess.run(
        [sys.executable, str(script)],
        cwd=str(ROOT),
        capture_output=True,
        text=True,
        check=False,
    )
    try:
        payload = json.loads(proc.stdout)
    except json.JSONDecodeError:
        payload = {'raw_output': (proc.stdout or '').strip()}
    return proc.returncode, payload


def main() -> int:
    health_rc, health = _run_json(HEALTH_SCRIPT)
    decision_rc, decision = _run_json(DECISION_SCRIPT)

    snapshot = {
        'timestamp_utc': datetime.now(timezone.utc).isoformat(),
        'health_ok': health_rc == 0,
        'gate_decision': decision.get('decision', 'hold'),
        'gate_reason': decision.get('reason', 'invalid_or_missing_evidence'),
        'health': health,
        'decision': decision,
    }

    # Readiness is strict: health must be OK and decision must be go.
    snapshot['ready_for_gate'] = snapshot['health_ok'] and snapshot['gate_decision'] == 'go'

    REPORTS.mkdir(parents=True, exist_ok=True)
    with OUTPUT_PATH.open('w', encoding='utf-8') as fh:
        json.dump(snapshot, fh, ensure_ascii=False, indent=2)

    print(json.dumps(snapshot, ensure_ascii=False, indent=2))
    return 0 if snapshot['ready_for_gate'] else 1


if __name__ == '__main__':
    raise SystemExit(main())
