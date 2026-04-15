#!/usr/bin/env python3
"""Validate evidence gate reporting artifacts existence and basic integrity."""

from __future__ import annotations

import json
from pathlib import Path

ROOT = Path(__file__).resolve().parents[2]
REPORTS_DIR = ROOT / 'backend' / 'reports'
TREND_JSON = REPORTS_DIR / 'evidence_gate_trend.json'
TREND_MD = REPORTS_DIR / 'evidence_gate_trend.md'
HISTORY_JSONL = REPORTS_DIR / 'evidence_gate_history.jsonl'


def main() -> int:
    files = {
        'history_jsonl': HISTORY_JSONL,
        'trend_json': TREND_JSON,
        'trend_md': TREND_MD,
    }

    result = {'ok': True, 'files': {}}

    for key, path in files.items():
        exists = path.exists()
        size = path.stat().st_size if exists else 0
        result['files'][key] = {
            'path': str(path),
            'exists': exists,
            'size_bytes': size,
        }
        if not exists or size == 0:
            result['ok'] = False

    if TREND_JSON.exists() and TREND_JSON.stat().st_size > 0:
        try:
            payload = json.loads(TREND_JSON.read_text(encoding='utf-8'))
            result['trend_latest_decision'] = payload.get('latest_decision')
            result['trend_total_snapshots'] = payload.get('total_snapshots')
        except json.JSONDecodeError:
            result['ok'] = False
            result['trend_json_error'] = 'invalid_json'

    print(json.dumps(result, ensure_ascii=False, indent=2))
    return 0 if result['ok'] else 1


if __name__ == '__main__':
    raise SystemExit(main())
