# Migration Start: Django Backend + Next.js Frontend

Bu commit, mevcut PHP tabanlı sistemden yeni mimariye geçiş için başlangıç iskeletini ekler.

## Eklenenler
- `backend/` altında minimal Django + DRF iskeleti
- `frontend/` altında minimal Next.js (app router) iskeleti
- İlk doğrulama endpointleri:
  - `GET /api/health`
  - `GET /api/modules/inventory`

## Amaç
- Big-bang rewrite yerine modül bazlı taşıma için temel platformu hazırlamak.
- Eski sistemdeki modülleri aşamalı şekilde yeni backend servislerine taşımak.
