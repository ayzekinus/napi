#!/usr/bin/env python3
"""Compare deterministic sample records between legacy SQL and service outputs."""

from __future__ import annotations

import json
import os
import sys
from dataclasses import asdict, dataclass

os.environ.setdefault('DJANGO_SETTINGS_MODULE', 'config.settings')

import django  # noqa: E402
from django.db import connection  # noqa: E402


django.setup()

from apps.modules.services import (  # noqa: E402
    list_acma_rapor,
    list_anakod,
    list_buluntu,
    list_demirbas,
    list_evrak,
    list_kullanicilar,
)


@dataclass
class ModuleComparison:
    matches: bool
    service_count: int
    legacy_count: int
    first_mismatch_index: int | None


def _parse_sample_size() -> int:
    raw = os.getenv('SAMPLE_SIZE', '10')
    try:
        parsed = int(raw)
    except ValueError:
        return 10
    return max(1, min(parsed, 500))


def _query_rows(query: str, limit: int) -> list[tuple]:
    with connection.cursor() as cursor:
        cursor.execute(query, [limit])
        return list(cursor.fetchall())


def _legacy_anakod(limit: int) -> list[dict]:
    rows = _query_rows(
        """
        SELECT anakod_id, anakod
        FROM anakod
        ORDER BY anakod_id DESC
        LIMIT %s
        """,
        limit,
    )
    return [{'anakod_id': r[0], 'anakod': r[1]} for r in rows]


def _legacy_buluntu(limit: int) -> list[dict]:
    rows = _query_rows(
        """
        SELECT bk_id, bk_anakod_id, buluntu_no, envanterlik
        FROM buluntu_karti
        ORDER BY bk_id DESC
        LIMIT %s
        """,
        limit,
    )
    return [
        {
            'bk_id': r[0],
            'bk_anakod_id': r[1],
            'buluntu_no': r[2],
            'envanterlik': bool(r[3]),
        }
        for r in rows
    ]


def _legacy_evrak(limit: int) -> list[dict]:
    rows = _query_rows(
        """
        SELECT evrak_id, evrak_tipi, evrak_no, evrak_tarihi
        FROM evrak_yonetimi
        ORDER BY evrak_id DESC
        LIMIT %s
        """,
        limit,
    )
    return [
        {
            'evrak_id': r[0],
            'evrak_tipi': r[1],
            'evrak_no': r[2],
            'evrak_tarihi': r[3].isoformat() if r[3] is not None else None,
        }
        for r in rows
    ]


def _legacy_acma_rapor(limit: int) -> list[dict]:
    rows = _query_rows(
        """
        SELECT acma_rapor_id, acma_rapor_no, sezon
        FROM acma_rapor
        ORDER BY acma_rapor_id DESC
        LIMIT %s
        """,
        limit,
    )
    return [
        {'acma_rapor_id': r[0], 'acma_rapor_no': r[1], 'sezon': r[2]}
        for r in rows
    ]


def _legacy_demirbas(limit: int) -> list[dict]:
    rows = _query_rows(
        """
        SELECT dl_id, buluntu_id, envanter_no, durum
        FROM demirbas_listesi
        ORDER BY dl_id DESC
        LIMIT %s
        """,
        limit,
    )
    return [
        {'dl_id': r[0], 'buluntu_id': r[1], 'envanter_no': r[2], 'durum': r[3]}
        for r in rows
    ]


def _legacy_kullanicilar(limit: int) -> list[dict]:
    rows = _query_rows(
        """
        SELECT ID, adsoyad, _kullanici, yetki, durum
        FROM _kullanici
        ORDER BY ID DESC
        LIMIT %s
        """,
        limit,
    )
    return [
        {
            'ID': r[0],
            'adsoyad': r[1],
            'kullanici': r[2],
            'yetki': r[3],
            'durum': int(r[4]),
        }
        for r in rows
    ]


def _compare_lists(service_items: list[dict], legacy_items: list[dict]) -> ModuleComparison:
    mismatch_idx = None
    for idx, (svc, leg) in enumerate(zip(service_items, legacy_items)):
        if svc != leg:
            mismatch_idx = idx
            break

    matches = mismatch_idx is None and len(service_items) == len(legacy_items)
    return ModuleComparison(
        matches=matches,
        service_count=len(service_items),
        legacy_count=len(legacy_items),
        first_mismatch_index=mismatch_idx,
    )


def main() -> int:
    sample_size = _parse_sample_size()

    service_results = {
        'anakod': list_anakod(limit=sample_size),
        'buluntu': list_buluntu(limit=sample_size),
        'evrak': list_evrak(limit=sample_size),
        'acma_rapor': list_acma_rapor(limit=sample_size),
        'demirbas': list_demirbas(limit=sample_size),
        'kullanicilar': list_kullanicilar(limit=sample_size),
    }

    degraded_modules = [name for name, result in service_results.items() if result.degraded]
    if degraded_modules:
        print(
            json.dumps(
                {
                    'error': 'service_degraded',
                    'modules': degraded_modules,
                },
                ensure_ascii=False,
                indent=2,
            ),
            file=sys.stderr,
        )
        return 2

    legacy_fetchers = {
        'anakod': _legacy_anakod,
        'buluntu': _legacy_buluntu,
        'evrak': _legacy_evrak,
        'acma_rapor': _legacy_acma_rapor,
        'demirbas': _legacy_demirbas,
        'kullanicilar': _legacy_kullanicilar,
    }

    comparisons: dict[str, ModuleComparison] = {}
    for module, result in service_results.items():
        legacy_items = legacy_fetchers[module](sample_size)
        comparisons[module] = _compare_lists(result.items, legacy_items)

    payload = {
        'sample_size': sample_size,
        'all_match': all(item.matches for item in comparisons.values()),
        'comparisons': {name: asdict(value) for name, value in comparisons.items()},
    }

    print(json.dumps(payload, ensure_ascii=False, indent=2))
    return 0 if payload['all_match'] else 1


if __name__ == '__main__':
    raise SystemExit(main())
