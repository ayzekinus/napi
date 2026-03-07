#!/usr/bin/env python3
"""Run end-to-end evidence workflow and produce both JSON + markdown summaries."""

from __future__ import annotations

import subprocess
import sys
from pathlib import Path

ROOT = Path(__file__).resolve().parents[2]
SCRIPTS = ROOT / 'backend' / 'scripts'
OPEN_VALIDATE = SCRIPTS / 'open_and_validate_live_evidence.py'
STATUS = SCRIPTS / 'evidence_status_report.py'
EXPORT_MD = SCRIPTS / 'export_evidence_summary_md.py'


def _run(script: Path, allow_fail: bool = False) -> int:
    proc = subprocess.run([sys.executable, str(script)], cwd=str(ROOT), check=False)
    if proc.returncode != 0 and not allow_fail:
        return proc.returncode
    return 0


def main() -> int:
    # Step-1 can fail on first run if template fields are empty; that's expected.
    _run(OPEN_VALIDATE, allow_fail=True)

    rc = _run(STATUS)
    if rc != 0:
        # keep generating markdown summary even when invalid files exist
        _run(EXPORT_MD, allow_fail=True)
        return 1

    rc = _run(EXPORT_MD)
    if rc != 0:
        return rc

    return 0


if __name__ == '__main__':
    raise SystemExit(main())
