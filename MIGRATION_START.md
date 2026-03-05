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

## Yeni adım (phase-1)
- İlk gerçek modül taşıma başlangıcı olarak read-only `anakod` listeleme endpointi eklendi:
  - `GET /api/modules/anakod?limit=10`
- Next.js ana sayfasında modül durumları ve anakod önizleme tablosu backend'den çekilir hale getirildi.
