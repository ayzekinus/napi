from __future__ import annotations

from dataclasses import dataclass
from typing import Any

from django.db import DatabaseError, connection


@dataclass
class QueryResult:
    items: list[dict[str, Any]]
    degraded: bool = False


def _safe_limit(limit: int, default: int = 50) -> int:
    if not isinstance(limit, int):
        return default

    return max(1, min(limit, 500))


def list_anakod(limit: int = 50) -> QueryResult:
    safe_limit = _safe_limit(limit)

    query = """
        SELECT anakod_id, anakod
        FROM anakod
        ORDER BY anakod_id DESC
        LIMIT %s
    """

    try:
        with connection.cursor() as cursor:
            cursor.execute(query, [safe_limit])
            rows = cursor.fetchall()
    except DatabaseError:
        return QueryResult(items=[], degraded=True)

    items = [
        {
            'anakod_id': row[0],
            'anakod': row[1],
        }
        for row in rows
    ]
    return QueryResult(items=items, degraded=False)


def list_buluntu(limit: int = 50) -> QueryResult:
    safe_limit = _safe_limit(limit)

    query = """
        SELECT bk_id, bk_anakod_id, buluntu_no, envanterlik
        FROM buluntu_karti
        ORDER BY bk_id DESC
        LIMIT %s
    """

    try:
        with connection.cursor() as cursor:
            cursor.execute(query, [safe_limit])
            rows = cursor.fetchall()
    except DatabaseError:
        return QueryResult(items=[], degraded=True)

    items = [
        {
            'bk_id': row[0],
            'bk_anakod_id': row[1],
            'buluntu_no': row[2],
            'envanterlik': bool(row[3]),
        }
        for row in rows
    ]
    return QueryResult(items=items, degraded=False)


def list_evrak(limit: int = 50) -> QueryResult:
    safe_limit = _safe_limit(limit)

    query = """
        SELECT evrak_id, evrak_tipi, evrak_no, evrak_tarihi
        FROM evrak_yonetimi
        ORDER BY evrak_id DESC
        LIMIT %s
    """

    try:
        with connection.cursor() as cursor:
            cursor.execute(query, [safe_limit])
            rows = cursor.fetchall()
    except DatabaseError:
        return QueryResult(items=[], degraded=True)

    items = [
        {
            'evrak_id': row[0],
            'evrak_tipi': row[1],
            'evrak_no': row[2],
            'evrak_tarihi': row[3].isoformat() if row[3] is not None else None,
        }
        for row in rows
    ]
    return QueryResult(items=items, degraded=False)


def list_acma_rapor(limit: int = 50) -> QueryResult:
    safe_limit = _safe_limit(limit)

    query = """
        SELECT acma_rapor_id, acma_rapor_no, sezon
        FROM acma_rapor
        ORDER BY acma_rapor_id DESC
        LIMIT %s
    """

    try:
        with connection.cursor() as cursor:
            cursor.execute(query, [safe_limit])
            rows = cursor.fetchall()
    except DatabaseError:
        return QueryResult(items=[], degraded=True)

    items = [
        {
            'acma_rapor_id': row[0],
            'acma_rapor_no': row[1],
            'sezon': row[2],
        }
        for row in rows
    ]
    return QueryResult(items=items, degraded=False)


def list_demirbas(limit: int = 50) -> QueryResult:
    safe_limit = _safe_limit(limit)

    query = """
        SELECT dl_id, buluntu_id, envanter_no, durum
        FROM demirbas_listesi
        ORDER BY dl_id DESC
        LIMIT %s
    """

    try:
        with connection.cursor() as cursor:
            cursor.execute(query, [safe_limit])
            rows = cursor.fetchall()
    except DatabaseError:
        return QueryResult(items=[], degraded=True)

    items = [
        {
            'dl_id': row[0],
            'buluntu_id': row[1],
            'envanter_no': row[2],
            'durum': row[3],
        }
        for row in rows
    ]
    return QueryResult(items=items, degraded=False)



def list_kullanicilar(limit: int = 50) -> QueryResult:
    safe_limit = _safe_limit(limit)

    query = """
        SELECT ID, adsoyad, _kullanici, yetki, durum
        FROM _kullanici
        ORDER BY ID DESC
        LIMIT %s
    """

    try:
        with connection.cursor() as cursor:
            cursor.execute(query, [safe_limit])
            rows = cursor.fetchall()
    except DatabaseError:
        return QueryResult(items=[], degraded=True)

    items = [
        {
            'ID': row[0],
            'adsoyad': row[1],
            'kullanici': row[2],
            'yetki': row[3],
            'durum': int(row[4]),
        }
        for row in rows
    ]
    return QueryResult(items=items, degraded=False)
