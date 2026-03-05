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
