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

## Yeni adım (phase-2)
- Read-only `buluntu` listeleme endpointi eklendi:
  - `GET /api/modules/buluntu?limit=10`
- Next.js ana sayfasına buluntu önizleme tablosu eklendi.
- Backend tarafında `buluntu` modülü `in_progress` durumuna alındı.

## Yeni adım (phase-3)
- Read-only `evrak` listeleme endpointi eklendi:
  - `GET /api/modules/evrak?limit=10`
- Next.js ana sayfasına evrak önizleme tablosu eklendi.
- Backend tarafında `evrak_yonetimi` modülü `in_progress` durumuna alındı.


## Yeni adım (phase-4)
- Legacy parola hash mantığına uyumlu `POST /api/auth/login` endpointi eklendi.
- Session doğrulama için `GET /api/auth/session` endpointi eklendi.
- Next.js tarafında `/login` sayfası ile giriş akışı başlatıldı.


## Yeni adım (phase-5)
- Read-only `açma rapor` listeleme endpointi eklendi:
  - `GET /api/modules/acma-rapor?limit=10`
- Next.js ana sayfasına açma rapor önizleme tablosu eklendi.
- Backend tarafında `acma_rapor` modülü `in_progress` durumuna alındı.


## Yeni adım (phase-6)
- Read-only `demirbaş` listeleme endpointi eklendi:
  - `GET /api/modules/demirbas?limit=10`
- Next.js ana sayfasına demirbaş önizleme tablosu eklendi.
- Backend tarafında `demirbas` modülü `in_progress` durumuna alındı.


## Yeni adım (phase-7)
- Read-only `kullanıcılar` listeleme endpointi eklendi:
  - `GET /api/modules/kullanicilar?limit=10`
- Next.js ana sayfasına kullanıcılar önizleme tablosu eklendi.
- Backend tarafında `kullanicilar` modülü `in_progress` durumuna alındı.


## Yeni adım (phase-8)
- Session yaşam döngüsü için `POST /api/auth/logout` endpointi eklendi.
- Dashboard sayfasına aktif oturum bilgisi ve çıkış yapma aksiyonu eklendi.


## Yeni adım (phase-9)
- Dashboard için toplu sayaç endpointi eklendi:
  - `GET /api/modules/dashboard-summary`
- Next.js ana sayfasına modül toplamlarını gösteren özet kartları eklendi.


## Yeni adım (phase-10)
- Oturum bazlı yetki özeti için `GET /api/auth/permissions` endpointi eklendi.
- Dashboard oturum widget'ına aktif izin sayısı eklendi.


## Yeni adım (phase-11)
- Frontend API katmanına `safeFetchJson` eklendi; backend erişilemediğinde dashboard sayfası hata yerine güvenli fallback döner.
- Session widget'ına ağ hatası toleransı (try/catch) eklendi.


## Yeni adım (phase-12)
- Dashboard'a `degraded` durum görünürlüğü eklendi (`DashboardDegradedAlert`).
- `GET /api/modules/dashboard-summary` yanıtındaki degraded bayrağı UI'da kullanıcıya gösterilir hale getirildi.


## Yeni adım (phase-13)
- Auth tarafına `GET /api/auth/bootstrap` endpointi eklendi (session + permission tek çağrı).
- Session widget backend'e iki çağrı yerine tek bootstrap çağrısı yapacak şekilde optimize edildi.


## Yeni adım (phase-14)
- `GET /api/modules/bootstrap` endpointi eklendi (inventory + summary tek çağrı).
- Dashboard başlangıç yükü iki çağrı yerine tek bootstrap çağrısı ile optimize edildi.


## Yeni adım (phase-15)
- `GET /api/modules/bootstrap-full?limit=10` endpointi eklendi (inventory + summary + modül önizleme listeleri tek çağrı).
- Dashboard başlangıç veri yükü tek backend çağrısı ile tamamlanır hale getirildi.
