from __future__ import annotations

import hashlib
from dataclasses import dataclass
from typing import Any

from django.conf import settings
from django.db import DatabaseError, connection


@dataclass
class AuthResult:
    success: bool
    user: dict[str, Any] | None = None
    reason: str | None = None


def _legacy_password_hash(password: str) -> str:
    salted = f"{settings.LEGACY_HASH_SALT}{password}"
    return hashlib.md5(salted.encode('utf-8')).hexdigest()


def parse_legacy_permissions(raw_permissions: str | None) -> dict[str, bool]:
    tokens = {x.strip() for x in (raw_permissions or '').split(',') if x.strip()}
    return {
        'anakod_list': 'A0' in tokens,
        'anakod_write': 'A1' in tokens or 'A2' in tokens,
        'buluntu_list': 'B0' in tokens,
        'buluntu_write': 'B1' in tokens or 'B2' in tokens,
        'acma_rapor_list': 'AR0' in tokens,
        'acma_rapor_write': 'AR1' in tokens or 'AR2' in tokens,
        'evrak_list': 'EY0' in tokens,
        'evrak_write': 'EY1' in tokens or 'EY2' in tokens,
        'demirbas_list': 'DL0' in tokens,
        'demirbas_write': 'DL1' in tokens or 'DL2' in tokens,
        'kullanicilar_list': 'R0' in tokens,
        'kullanicilar_write': 'R1' in tokens or 'R2' in tokens,
    }


def verify_legacy_credentials(username: str, password: str) -> AuthResult:
    if not username or not password:
        return AuthResult(success=False, reason='missing_credentials')

    if (
        settings.LEGACY_SUPERVISOR_USERNAME
        and settings.LEGACY_SUPERVISOR_PASSWORD
        and username == settings.LEGACY_SUPERVISOR_USERNAME
        and password == settings.LEGACY_SUPERVISOR_PASSWORD
    ):
        return AuthResult(
            success=True,
            user={
                'ID': 0,
                'kullanici': username,
                'adsoyad': 'Supervisor',
                'yetki': 'S',
                'kisitlamalar': 'A0,A1,A2,A3,B0,AR0,EY0,DL0,PD0,E0,R0,R1,R2,R3',
            },
        )

    query = """
        SELECT ID, adsoyad, _kullanici, yetki, kisitlamalar, durum, _sifre
        FROM _kullanici
        WHERE _kullanici = %s
        LIMIT 1
    """

    try:
        with connection.cursor() as cursor:
            cursor.execute(query, [username])
            row = cursor.fetchone()
    except DatabaseError:
        return AuthResult(success=False, reason='db_error')

    if not row:
        return AuthResult(success=False, reason='not_found')

    is_active = int(row[5]) == 1
    if not is_active:
        return AuthResult(success=False, reason='inactive')

    provided_hash = _legacy_password_hash(password)
    stored_hash = row[6]
    if provided_hash != stored_hash:
        return AuthResult(success=False, reason='invalid_password')

    return AuthResult(
        success=True,
        user={
            'ID': row[0],
            'adsoyad': row[1],
            'kullanici': row[2],
            'yetki': row[3],
            'kisitlamalar': row[4],
        },
    )
