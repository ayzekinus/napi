from __future__ import annotations

from dataclasses import dataclass
from typing import Any

from django.db import DatabaseError, connection


@dataclass
class QueryResult:
    items: list[dict[str, Any]]
    degraded: bool = False


def list_anakod(limit: int = 50) -> QueryResult:
    safe_limit = max(1, min(limit, 500))

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
