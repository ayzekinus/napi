#!/usr/bin/env python3
"""Create a live-evidence file from template and immediately validate it."""

from __future__ import annotations

import subprocess
import sys
from pathlib import Path

ROOT = Path(__file__).resolve().parents[2]
SCRIPTS_DIR = ROOT / 'backend' / 'scripts'
GEN_SCRIPT = SCRIPTS_DIR / 'generate_live_evidence_stub.py'
VALIDATE_SCRIPT = SCRIPTS_DIR / 'validate_live_evidence.py'


def _run(cmd: list[str]) -> subprocess.CompletedProcess[str]:
    return subprocess.run(cmd, cwd=str(ROOT), capture_output=True, text=True, check=False)


def main() -> int:
    gen = _run([sys.executable, str(GEN_SCRIPT)])
    if gen.returncode != 0:
        sys.stderr.write(gen.stderr or gen.stdout)
        return gen.returncode

    evidence_path = (gen.stdout or '').strip().splitlines()[-1].strip()
    if not evidence_path:
        sys.stderr.write('ERROR: evidence path not produced by generator\n')
        return 2

    print(f'generated: {evidence_path}')

    validate = _run([sys.executable, str(VALIDATE_SCRIPT), evidence_path])
    if validate.stdout:
        print(validate.stdout.strip())
    if validate.stderr:
        sys.stderr.write(validate.stderr)

    if validate.returncode == 0:
        return 0

    print('next_step: fill required fields in generated evidence file and rerun validator')
    return 1


if __name__ == '__main__':
    raise SystemExit(main())
