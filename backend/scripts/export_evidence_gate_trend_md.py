#!/usr/bin/env python3
"""Export evidence gate trend JSON into a markdown summary report."""

from __future__ import annotations

import json
from pathlib import Path

ROOT = Path(__file__).resolve().parents[2]
REPORTS_DIR = ROOT / 'backend' / 'reports'
TREND_SCRIPT_OUTPUT = REPORTS_DIR / 'evidence_gate_trend.json'
TREND_MD_OUTPUT = REPORTS_DIR / 'evidence_gate_trend.md'


def _load_trend() -> dict:
    if not TREND_SCRIPT_OUTPUT.exists():
        return {
            'total_snapshots': 0,
            'go_count': 0,
            'hold_count': 0,
            'go_ratio': 0.0,
            'latest_decision': None,
            'latest_reason': None,
            'latest_timestamp_utc': None,
        }

    with TREND_SCRIPT_OUTPUT.open('r', encoding='utf-8') as fh:
        return json.load(fh)


def _to_markdown(payload: dict) -> str:
    total = int(payload.get('total_snapshots', 0))
    go_count = int(payload.get('go_count', 0))
    hold_count = int(payload.get('hold_count', 0))
    go_ratio = float(payload.get('go_ratio', 0.0))

    latest_decision = payload.get('latest_decision') or '-'
    latest_reason = payload.get('latest_reason') or '-'
    latest_timestamp = payload.get('latest_timestamp_utc') or '-'

    return "\n".join(
        [
            '# Evidence Gate Trend Summary',
            '',
            f'- Total snapshots: **{total}**',
            f'- Go count: **{go_count}**',
            f'- Hold count: **{hold_count}**',
            f'- Go ratio: **{go_ratio:.2%}**',
            '',
            '## Latest decision',
            '',
            f'- Decision: **{latest_decision}**',
            f'- Reason: **{latest_reason}**',
            f'- Timestamp (UTC): **{latest_timestamp}**',
            '',
        ]
    )


def main() -> int:
    trend = _load_trend()
    markdown = _to_markdown(trend)

    REPORTS_DIR.mkdir(parents=True, exist_ok=True)
    TREND_MD_OUTPUT.write_text(markdown, encoding='utf-8')

    print(str(TREND_MD_OUTPUT))
    return 0


if __name__ == '__main__':
    raise SystemExit(main())
