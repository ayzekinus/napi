#!/usr/bin/env python3
"""Export evidence gate readiness snapshot JSON to markdown summary."""

from __future__ import annotations

import json
from pathlib import Path

ROOT = Path(__file__).resolve().parents[2]
REPORTS = ROOT / 'backend' / 'reports'
SNAPSHOT_JSON = REPORTS / 'evidence_gate_readiness_snapshot.json'
SNAPSHOT_MD = REPORTS / 'evidence_gate_readiness_snapshot.md'


def _load_snapshot() -> dict:
    if not SNAPSHOT_JSON.exists():
        return {
            'timestamp_utc': '-',
            'health_ok': False,
            'gate_decision': 'hold',
            'gate_reason': 'missing_snapshot',
            'ready_for_gate': False,
        }
    with SNAPSHOT_JSON.open('r', encoding='utf-8') as fh:
        return json.load(fh)


def _to_md(payload: dict) -> str:
    ready = bool(payload.get('ready_for_gate', False))
    status = 'READY ✅' if ready else 'NOT READY ⛔'

    return "\n".join(
        [
            '# Evidence Gate Readiness Snapshot',
            '',
            f'- Status: **{status}**',
            f"- Timestamp (UTC): **{payload.get('timestamp_utc', '-')}**",
            f"- Health OK: **{payload.get('health_ok', False)}**",
            f"- Gate Decision: **{payload.get('gate_decision', 'hold')}**",
            f"- Gate Reason: **{payload.get('gate_reason', 'unknown')}**",
            '',
            '## Notes',
            '',
            '- This report is generated from `evidence_gate_readiness_snapshot.py` output.',
            '',
        ]
    )


def main() -> int:
    payload = _load_snapshot()
    md = _to_md(payload)

    REPORTS.mkdir(parents=True, exist_ok=True)
    SNAPSHOT_MD.write_text(md, encoding='utf-8')

    print(str(SNAPSHOT_MD))
    return 0


if __name__ == '__main__':
    raise SystemExit(main())
