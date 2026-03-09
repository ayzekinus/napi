#!/usr/bin/env python3
"""Run gate history + trend reporting flow in one command."""

from __future__ import annotations

import subprocess
import sys
from pathlib import Path

ROOT = Path(__file__).resolve().parents[2]
SCRIPTS_DIR = ROOT / 'backend' / 'scripts'
HISTORY = SCRIPTS_DIR / 'evidence_gate_history.py'
TREND = SCRIPTS_DIR / 'evidence_gate_trend.py'
EXPORT_MD = SCRIPTS_DIR / 'export_evidence_gate_trend_md.py'


def _run(script: Path, allow_fail: bool = False) -> int:
    proc = subprocess.run([sys.executable, str(script)], cwd=str(ROOT), check=False)
    if proc.returncode != 0 and not allow_fail:
        return proc.returncode
    return 0


def main() -> int:
    # history can return non-zero when decision is hold; still continue to report outputs
    _run(HISTORY, allow_fail=True)

    rc = _run(TREND)
    if rc != 0:
        return rc

    rc = _run(EXPORT_MD)
    if rc != 0:
        return rc

    return 0


if __name__ == '__main__':
    raise SystemExit(main())
