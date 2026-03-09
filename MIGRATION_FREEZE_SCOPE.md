# Migration Freeze Scope (Hafta 1)

Bu doküman, `MIGRATION_EXECUTION_PLAN.md` içindeki **Hafta 1 / Kontrat Dondurma** maddesinin somut kapsamını tanımlar.

## 1) Freeze Edilen API Sözleşmesi

## Core API

- `GET /api/health`
  - Method: sadece `GET`
  - Başarılı payload: `{ "ok": true, "service": "django-backend" }`
- `POST /api/auth/login`
  - Method: sadece `POST`
  - Başarılı payload: `{ "success": true, "user": { ... } }`
  - Hata payload (örnek): `{ "success": false, "reason": "..." }`
- `GET /api/auth/session`
  - Method: sadece `GET`
  - Başarılı payload: `{ "authenticated": true, "user": { ... } }`
- `GET /api/auth/permissions`
  - Method: sadece `GET`
  - Başarılı payload: `{ "authenticated": true, "is_supervisor": bool, "permissions": { ... } }`
- `GET /api/auth/bootstrap`
  - Method: sadece `GET`
  - Başarılı payload: `{ "authenticated": true, "user": { ... }, "is_supervisor": bool, "permissions": { ... } }`
- `POST /api/auth/logout`
  - Method: sadece `POST`
  - Başarılı payload: `{ "success": true }`

## Modules API (Read-Only)

Aşağıdaki endpointlerin tümü yalnızca `GET` kabul eder:

- `/api/modules/inventory`
- `/api/modules/anakod`
- `/api/modules/buluntu`
- `/api/modules/evrak`
- `/api/modules/acma-rapor`
- `/api/modules/demirbas`
- `/api/modules/kullanicilar`
- `/api/modules/dashboard-summary`
- `/api/modules/bootstrap`
- `/api/modules/bootstrap-full`

Ortak sözleşme ilkeleri:
- `limit` parametresi `1..500` clamp edilir.
- Liste endpointlerinde `count == len(items)` ve `degraded` alanı bulunur.
- `bootstrap-full` içinde `degraded_map` bulunur.

---

## 2) Freeze Dışında Bırakılanlar

Bu fazda aşağıdakiler freeze kapsamı dışındadır:
- CRUD endpointleri (write operasyonları)
- Gelişmiş caching/optimization detayları
- Frontend UI görsel düzenlemeleri

---

## 3) Haftalık Readiness Ölçütleri (Hafta 1)

- **API Contract Coverage**
  - Ölçüm: core + modules view testlerinin geçmesi.
- **Auth Akış Sağlığı**
  - Ölçüm: login/session/permissions/bootstrap/logout test seti geçiş oranı.
- **Read-only Güvenliği**
  - Ölçüm: method restriction (`POST -> 405`) testlerinin geçiş oranı.

Önerilen doğrulama komutu:

```bash
cd backend && DB_ENGINE=django.db.backends.sqlite3 DB_NAME=:memory: python3 manage.py test apps.core.tests apps.modules.tests
```

---

## 4) Hafta 1 Durum Notu

- Freeze kapsamı dokümante edildi.
- Bir sonraki adım: Hafta 2 kapsamında mapping matrisi ve doğrulama scriptlerinin repoya eklenmesi.
