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


## Yeni adım (phase-28)
- Servis katmanındaki `_safe_limit` helper'ı için doğrudan birim testler eklendi.
- Non-int default dönüşü, min/max clamp (`1..500`) ve aralık içi değer davranışı testle doğrulandı.


## Yeni adım (phase-29)
- `_parse_limit` helper testlerine custom `minimum/maximum` parametre kapsamı eklendi.
- Custom üst sınır clamp ve aralık içi değer davranışı doğrudan testle doğrulandı.


## Yeni adım (phase-30)
- Geçişin read-only fazını netleştirmek için modül endpointlerine `GET` method kısıtı eklendi.
- `anakod`, `bootstrap` ve `bootstrap-full` için `POST -> 405` davranışı testlerle doğrulandı.
- Böylece CRUD geçişi başlamadan önce API sözleşmesinde read-only sınırı teknik olarak da güvenceye alındı.


## Yeni adım (phase-31)
- Read-only sözleşmesini tamamlamak için modül endpointlerinde method-kısıtı test kapsamı genişletildi.
- `inventory`, `buluntu`, `evrak`, `acma-rapor`, `demirbas`, `kullanicilar`, `dashboard-summary` endpointleri için `POST -> 405` davranışı doğrulandı.


## Yeni adım (phase-32)
- Core endpointlerde method sözleşmesi sıkılaştırıldı: `health`, `auth/session`, `auth/permissions`, `auth/bootstrap` sadece `GET` kabul eder hale getirildi.
- Bu endpointler için `POST -> 405` davranışları view testlerine eklendi.
- Böylece read-only ve bootstrap odaklı geçiş fazında method sınırları core + modules katmanında birlikte netleştirildi.


## Yeni adım (phase-33)
- `auth_login` view testleri genişletildi: `GET -> 405` method kısıtı ve bozuk JSON body senaryosu eklendi.
- Bozuk JSON geldiğinde endpoint'in güvenli şekilde fallback payload ile doğrulama yaptığı testle güvence altına alındı.


## Yeni adım (phase-34)
- `auth_login` için başarılı girişte session alanlarının set edildiği test kapsamı eklendi.
- `auth_session` endpointi için hem `401` (oturum yok) hem de `200` (oturum var) davranışı payload seviyesinde doğrulandı.


## Yeni adım (phase-35)
- `auth_permissions` ve `auth_bootstrap` için supervisor (`yetki='S'`) akışı test kapsamı genişletildi.
- Supervisor durumda parser bypass davranışı ve full izin haritasının döndüğü payload doğrulamaları eklendi.


## Yeni adım (phase-36)
- `health` endpointi için başarılı `GET` yanıt sözleşmesi (`ok` ve `service`) test kapsamına eklendi.
- Böylece core read-only endpointlerinde hem izinli method hem de payload doğrulaması birlikte güvence altına alındı.


## Yeni adım (phase-37)
- `auth_permissions` ve `auth_bootstrap` non-supervisor akışlarında payload sözleşmesi (`authenticated`, `is_supervisor`, `permissions`, `user`) daha detaylı testlerle doğrulandı.
- Böylece parser çağrısının yanında dönen JSON yapısının da migration kontratına uygunluğu güvenceye alındı.


## Yeni adım (phase-38)
- `auth_logout` view testleri response payload sözleşmesi açısından güçlendirildi.
- `GET` için `success=false/reason=method_not_allowed` ve `POST` için `success=true` yanıtları doğrulandı.


## Yeni adım (phase-39)
- `auth_login` başarılı senaryosunda response payload sözleşmesi de (`success` ve `user` alanları) test kapsamına eklendi.
- Böylece login endpointinde hem session seti hem response JSON kontratı birlikte doğrulanır hale getirildi.


## Yeni adım (phase-40)
- `auth_login` için username trim davranışı test kapsamına eklendi.
- Böylece doğrulama çağrısına boşluklardan arındırılmış kullanıcı adının geçtiği sözleşme güvence altına alındı.


## Yeni adım (phase-41)
- `auth_login` view testlerinde hata payload sözleşmesi güçlendirildi.
- `GET` method ihlalinde `success=false/reason=method_not_allowed` ve geçersiz kimlikte `reason=invalid_password` doğrulamaları eklendi.


## Yeni adım (phase-42)
- `auth_session` endpointinde `user` payload sözleşmesi tam alan setiyle doğrulanacak şekilde test güçlendirildi.
- Böylece session doğrulama akışında kısmi alan kontrolü yerine tam JSON kontratı güvence altına alındı.


## Yeni adım (phase-43)
- `auth_login` bozuk JSON body senaryosunda response payload sözleşmesi doğrulaması eklendi.
- Böylece `invalid_credentials` hatasında sadece status değil, `success/reason` alanları da testle güvence altına alındı.


## Yeni adım (phase-44)
- `auth_bootstrap` non-supervisor senaryosunda `user` payload sözleşmesi tam alan setiyle doğrulanacak şekilde test güçlendirildi.
- Böylece bootstrap akışında kullanıcı bilgisinin kısmi değil tam JSON kontratı güvence altına alındı.


## Yeni adım (phase-45)
- Geçişin sadece read-only API geliştirme seviyesinde kalmaması için operasyonel icra planı oluşturuldu: `MIGRATION_EXECUTION_PLAN.md`.
- Plan 6 haftalık takvime bölündü (kontrat freeze, veri mapping/doğrulama, paralel çalışma, UAT, kademeli trafik geçişi, tam cutover).
- Her hafta için ölçülebilir çıkış kriterleri tanımlanarak "takvim doğrultusunda ilerleme" yönetilebilir hale getirildi.


## Yeni adım (phase-46)
- `MIGRATION_FREEZE_SCOPE.md` eklendi ve Hafta-1 için read-only API kontrat freeze kapsamı resmi hale getirildi.
- Core ve modules endpointleri için method/payload sınırları tek dokümanda netleştirildi.
- Takvimdeki Hafta-1 maddelerinde freeze + doğrulama komutu adımı tamamlandı; sonraki odak Hafta-2 mapping/doğrulama scriptleri olacak.


## Yeni adım (phase-47)
- Hafta-1 için migration readiness metrikleri `MIGRATION_WEEKLY_METRICS.md` içinde tanımlandı (M1 API contract coverage, M2 read-only method safety, M3 auth flow health).
- İlk baseline ölçümü test çıktısı ile kayıt altına alındı (`86/86`, `%100` başarı).
- Böylece Hafta-1 takvim maddeleri (freeze + metric tanımı + doğrulama) tamamlanmış oldu.


## Yeni adım (phase-48)
- Hafta-2'nin ilk çıktısı olarak `MIGRATION_MAPPING_MATRIX.md` eklendi.
- Kritik 6 modül + auth kullanıcı kaynağı için legacy tablo/kolon -> yeni response alanı eşlemeleri servis bazında dokümante edildi.
- `MIGRATION_EXECUTION_PLAN.md` içinde Hafta-2 "mapping matrisi" maddesi tamamlandı olarak işaretlendi.


## Yeni adım (phase-49)
- Hafta-2'nin ikinci maddesi tamamlandı: `backend/scripts/row_count_compare.py` eklendi.
- Script, legacy tablo satır sayılarını `get_dashboard_summary()` çıktısıyla karşılaştırıp JSON rapor üretir (`all_match`, modül bazında karşılaştırma).
- `MIGRATION_EXECUTION_PLAN.md` içinde "satır sayısı karşılaştırma scripti" maddesi tamamlandı olarak işaretlendi.


## Yeni adım (phase-50)
- Hafta-2'nin üçüncü maddesi tamamlandı: `backend/scripts/sample_record_compare.py` eklendi.
- Script, modül bazında deterministik örnek kayıtları (default `SAMPLE_SIZE=10`) legacy SQL sonuçları ile servis çıktıları arasında karşılaştırır.
- `MIGRATION_EXECUTION_PLAN.md` içinde Hafta-2 checklist'i (mapping + row count + sample record compare) tamamen tamamlandı.


## Yeni adım (phase-51)
- Hafta-3 başlangıcı için `backend/scripts/shadow_diff_report.py` eklendi.
- Script, `row_count_compare.py` ve `sample_record_compare.py` çıktısını tek JSON raporda (`backend/reports/shadow_diff_report.json`) birleştirir.
- `MIGRATION_EXECUTION_PLAN.md` içinde Hafta-3'ün ilk maddesi (endpoint fark raporu) tamamlandı olarak işaretlendi.


## Yeni adım (phase-52)
- Hafta-3 için `shadow_diff_report.py` sınıflandırma katmanı genişletildi: `beklenen`, `regresyon`, `veri_kirliligi`, `degraded_or_runtime_error`.
- Degraded gözlemlenebilirlik metrikleri rapora eklendi (`degraded_detected`, `degraded_sources`, `total_checks`, `error_checks`).
- `MIGRATION_EXECUTION_PLAN.md` içinde Hafta-3 checklist'i (diff raporu + sınıflandırma + degraded metrikleri) tamamlandı.


## Yeni adım (phase-53)
- Hafta-4'ün ilk çıktısı olarak `MIGRATION_UAT_CHECKLIST.md` eklendi.
- Kritik kullanıcı senaryoları (auth/session/permissions, bootstrap-full, degraded görünürlüğü, parity scriptleri, frontend temel akışları) UAT listesine dönüştürüldü.
- `MIGRATION_EXECUTION_PLAN.md` içinde Hafta-4 "UAT checklist" maddesi tamamlandı olarak işaretlendi.


## Yeni adım (phase-54)
- Hafta-4'ün ikinci maddesi tamamlandı: `MIGRATION_CUTOVER_RUNBOOK.md` eklendi.
- Cutover adımları, süre tahminleri (~1.5 saat), Go/No-Go kriterleri, metrik eşikleri ve sorumluluk matrisi tanımlandı.
- `MIGRATION_EXECUTION_PLAN.md` içinde "Cutover runbook taslağı" maddesi tamamlandı olarak işaretlendi.


## Yeni adım (phase-55)
- Hafta-4'ün üçüncü maddesi tamamlandı: `MIGRATION_ROLLBACK_RUNBOOK.md` eklendi.
- Rollback tetik koşulları, adım adım geri dönüş akışı ve **RTO <= 15 dakika** hedefi tanımlandı.
- `MIGRATION_EXECUTION_PLAN.md` içinde "Rollback runbook + RTO" maddesi tamamlandı olarak işaretlendi.


## Yeni adım (phase-56)
- Hafta-5'in ilk çıktısı olarak `MIGRATION_TRAFFIC_RAMP_PLAN.md` eklendi.
- Trafik geçiş basamakları `%5 -> %20 -> %50` ve faz bazlı Go/No-Go kriterleri tanımlandı.
- `MIGRATION_EXECUTION_PLAN.md` içinde "kademeli trafik geçişi" maddesi tamamlandı olarak işaretlendi.


## Yeni adım (phase-57)
- Hafta-5'in kalan iki maddesi tamamlandı: `MIGRATION_TRAFFIC_MONITORING_RUNBOOK.md` ve `MIGRATION_AUTO_ROLLBACK_PROCEDURE.md` eklendi.
- 5xx/auth/latency/degraded metrikleri için eşikler ve alarm seviyeleri tanımlandı.
- Eşik ihlali 2 ardışık tur sürdüğünde `rollback_candidate` üretilecek otomatik tetik prosedürü dokümante edildi.


## Yeni adım (phase-58)
- Hafta-6'nın ilk maddesi tamamlandı: `MIGRATION_FULL_CUTOVER_RUNBOOK.md` eklendi.
- %100 trafik geçişi için ön koşullar, uygulama adımları ve T+10 karar noktası tanımlandı.
- `MIGRATION_EXECUTION_PLAN.md` içinde "%100 trafik geçişi" maddesi tamamlandı olarak işaretlendi.


## Yeni adım (phase-59)
- Hafta-6'nın kalan maddeleri tamamlandı: `MIGRATION_STABILIZATION_PLAYBOOK.md` ve `MIGRATION_LEGACY_DECOMMISSION_PLAN.md` eklendi.
- %100 cutover sonrası 72 saat gözlem dilimleri, kapanış kriterleri ve incident kuralları tanımlandı.
- Legacy bağımlılıkların L1/L2/L3 fazlarıyla aşamalı kapatılması planı dokümante edildi.


## Yeni adım (phase-60)
- 6 haftalık migration programı için kapanış raporu eklendi: `MIGRATION_PROGRAM_COMPLETION_REPORT.md`.
- Hafta-1..Hafta-6 artefaktları tek dokümanda toplu olarak özetlendi.
- Program seviyesinde dokümantasyon teslimleri tamamlandı; sonraki odak canlı ortam kanıtlarının operasyonel onayıdır.
