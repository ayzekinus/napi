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


## Yeni adım (phase-16)
- `bootstrap-full` yanıtına modül bazlı `degraded_map` eklendi.
- Dashboard'a degradasyon detaylarını gösteren açılır panel eklendi.


## Yeni adım (phase-17)
- `bootstrap-full` view testi `degraded_map` içeriğini ve aggregate `degraded` davranışını JSON seviyesinde doğrulayacak şekilde güçlendirildi.
- Dashboard `degraded` detay panelinde modül adları okunabilir etiketlere çevrildi ve sorunlu kaynak sayısı özet satırına eklendi.


## Yeni adım (phase-18)
- View katmanındaki `_parse_limit` iyileştirildi: limit değerleri `1..500` aralığına clamp edilir hale getirildi.
- `bootstrap-full` endpointi için minimum/maksimum limit davranışını doğrulayan ek testler eklendi.


## Yeni adım (phase-19)
- Modül envanterinde `evrak` anahtarı frontend endpoint ismiyle hizalandı (`evrak_yonetimi` yerine `evrak`).
- `module_inventory` ve `dashboard_bootstrap` testlerine envanter anahtar doğrulaması eklenerek bu sözleşme testle güvence altına alındı.


## Yeni adım (phase-20)
- Servis katmanındaki `_safe_limit` davranışı için ek birim testler eklendi.
- `list_anakod` için minimum/maksimum clamp (`1..500`) ve non-int girdide default (`50`) parametre ile query çağrısı doğrulandı.


## Yeni adım (phase-21)
- `anakod` liste view'ı için limit clamp davranışı test kapsamı genişletildi.
- `limit=0` için minimum `1`, aşırı büyük değerler için maksimum `500` gönderildiği view testleri ile doğrulandı.


## Yeni adım (phase-22)
- `buluntu` liste view'ı için limit clamp test kapsamı eklendi.
- View seviyesinde `limit=0 -> 1` ve büyük limit -> `500` davranışı doğrulandı.


## Yeni adım (phase-23)
- `evrak` liste view'ı için limit clamp sınır testleri eklendi.
- View seviyesinde `limit=0 -> 1` ve büyük limit -> `500` davranışı doğrulandı.


## Yeni adım (phase-24)
- `acma-rapor` liste view'ı için limit clamp sınır testleri eklendi.
- View seviyesinde `limit=0 -> 1` ve büyük limit -> `500` davranışı doğrulandı.


## Yeni adım (phase-25)
- `demirbas` ve `kullanicilar` liste view'ları için limit clamp sınır testleri eklendi.
- View seviyesinde her iki endpoint için de `limit=0 -> 1` ve büyük limit -> `500` davranışı doğrulandı.


## Yeni adım (phase-26)
- `bootstrap-full` view'ı için `limit` parametresi non-numeric olduğunda default `10` davranışı testle doğrulandı.
- Böylece `bootstrap-full` için default + min/max limit davranışlarının üçü de test kapsamına alındı.


## Yeni adım (phase-27)
- `_parse_limit` helper'ı için doğrudan birim testler eklendi.
- `None` girdisinde default dönüşü ve min/max clamp davranışları (`1..500`) testle güvence altına alındı.
