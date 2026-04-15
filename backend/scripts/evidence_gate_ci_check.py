#!/usr/bin/env python3
"""CI-friendly check for evidence gate reporting readiness."""

from __future__ import annotations

import subprocess
import sys
from pathlib import Path

ROOT = Path(__file__).resolve().parents[2]
SCRIPTS = ROOT / 'backend' / 'scripts'
RUN_REPORTING = SCRIPTS / 'run_evidence_gate_reporting.py'
HEALTH = SCRIPTS / 'evidence_gate_report_health.py'


def _run(script: Path) -> int:
    proc = subprocess.run([sys.executable, str(script)], cwd=str(ROOT), check=False)
    return proc.returncode


def main() -> int:
    rc_reporting = _run(RUN_REPORTING)
    rc_health = _run(HEALTH)

    # Reporting flow should normally pass; health is the strict readiness signal.
    if rc_health != 0:
        return rc_health
    return rc_reporting


if __name__ == '__main__':
    raise SystemExit(main())
