#!/usr/bin/env python3
"""Summarize go/hold trend from evidence gate history JSONL file."""

from __future__ import annotations

import json
from pathlib import Path

ROOT = Path(__file__).resolve().parents[2]
REPORTS_DIR = ROOT / 'backend' / 'reports'
HISTORY_PATH = REPORTS_DIR / 'evidence_gate_history.jsonl'
OUTPUT_PATH = REPORTS_DIR / 'evidence_gate_trend.json'


def _load_history() -> list[dict]:
    if not HISTORY_PATH.exists():
        return []

    entries: list[dict] = []
    with HISTORY_PATH.open('r', encoding='utf-8') as fh:
        for raw_line in fh:
            line = raw_line.strip()
            if not line:
                continue
            entries.append(json.loads(line))
    return entries


def main() -> int:
    entries = _load_history()
    total = len(entries)
    go_count = sum(1 for row in entries if row.get('decision') == 'go')
    hold_count = total - go_count

    latest = entries[-1] if entries else None
    trend = {
        'history_file': str(HISTORY_PATH),
        'total_snapshots': total,
        'go_count': go_count,
        'hold_count': hold_count,
        'go_ratio': (go_count / total) if total else 0.0,
        'latest_decision': latest.get('decision') if latest else None,
        'latest_reason': latest.get('reason') if latest else None,
        'latest_timestamp_utc': latest.get('timestamp_utc') if latest else None,
    }

    REPORTS_DIR.mkdir(parents=True, exist_ok=True)
    with OUTPUT_PATH.open('w', encoding='utf-8') as fh:
        json.dump(trend, fh, ensure_ascii=False, indent=2)

    print(json.dumps(trend, ensure_ascii=False, indent=2))
    return 0


if __name__ == '__main__':
    raise SystemExit(main())
