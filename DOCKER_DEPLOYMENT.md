# Docker ile Lokal Çalıştırma

Bu kurulum, backend (Django) ve frontend (Next.js) servislerini `docker-compose` ile ayağa kaldırır.

## Ön koşullar
- Docker
- Docker Compose (v2)

## Başlatma
```bash
docker compose up --build
```

## Erişim
- Frontend: http://localhost:3000
- Backend API: http://localhost:8000/api

## Durdurma
```bash
docker compose down
```

## Notlar
- Varsayılan kurulum SQLite ile çalışır (`DB_ENGINE=django.db.backends.sqlite3`).
- Backend başlangıçta `migrate` komutunu otomatik çalıştırır.
