#!/usr/bin/env python3
"""Compare legacy table row counts with dashboard summary counts."""

from __future__ import annotations

import json
import os
import sys
from dataclasses import asdict, dataclass


os.environ.setdefault('DJANGO_SETTINGS_MODULE', 'config.settings')

import django  # noqa: E402
from django.db import connection  # noqa: E402


django.setup()

from apps.modules.services import get_dashboard_summary  # noqa: E402


COUNT_QUERIES = {
    'anakod': 'SELECT COUNT(*) FROM anakod',
    'buluntu': 'SELECT COUNT(*) FROM buluntu_karti',
    'acma_rapor': 'SELECT COUNT(*) FROM acma_rapor',
    'evrak': 'SELECT COUNT(*) FROM evrak_yonetimi',
    'demirbas': 'SELECT COUNT(*) FROM demirbas_listesi',
    'kullanicilar': 'SELECT COUNT(*) FROM _kullanici',
}


@dataclass
class CountComparison:
    legacy_count: int
    summary_count: int
    matches: bool


def _fetch_legacy_counts() -> dict[str, int]:
    legacy_counts: dict[str, int] = {}
    with connection.cursor() as cursor:
        for key, query in COUNT_QUERIES.items():
            cursor.execute(query)
            legacy_counts[key] = int(cursor.fetchone()[0])
    return legacy_counts


def main() -> int:
    summary = get_dashboard_summary()

    if summary.degraded:
        print('ERROR: summary query degraded=true, comparison aborted.', file=sys.stderr)
        return 2

    legacy_counts = _fetch_legacy_counts()
    comparisons: dict[str, CountComparison] = {}

    for key, legacy_count in legacy_counts.items():
        summary_count = int(summary.data.get(key, 0))
        comparisons[key] = CountComparison(
            legacy_count=legacy_count,
            summary_count=summary_count,
            matches=legacy_count == summary_count,
        )

    payload = {
        'all_match': all(item.matches for item in comparisons.values()),
        'comparisons': {key: asdict(value) for key, value in comparisons.items()},
    }

    print(json.dumps(payload, ensure_ascii=False, indent=2))
    return 0 if payload['all_match'] else 1


if __name__ == '__main__':
    raise SystemExit(main())
