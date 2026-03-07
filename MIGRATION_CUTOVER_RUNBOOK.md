# Migration Cutover Runbook (Hafta 4 / Adım 2)

Bu doküman, `MIGRATION_EXECUTION_PLAN.md` içindeki **Hafta-4: Cutover runbook taslağı** maddesinin teslimidir.

## 1) Amaç

- PHP tabanlı mevcut sistemden Django + Next.js stack'e kontrollü trafik geçişini adım adım yürütmek.
- Geçiş sırasında kararları ölçülebilir sinyallerle (UAT, shadow diff, degraded metricleri) vermek.

---

## 2) Ön Koşullar (Go/No-Go)

Cutover başlatmadan önce aşağıdaki koşullar sağlanmalıdır:

1. UAT checklist sonucu >= %90 (en az 14/15 yeşil).
2. Bloker UAT maddelerinde kırmızı olmaması (`UAT-02,03,05,08,10,13`).
3. `shadow_diff_report.json` son 3 raporda kritik regresyon göstermemesi.
4. Operasyon iletişim kanalı (war-room) aktif olması.

No-Go kriterlerinden biri varsa cutover başlatılmaz.

---

## 3) Rollout Aşamaları ve Süre Tahmini

| Aşama | Süre (dk) | Açıklama |
|---|---:|---|
| T-30 Hazırlık | 30 | Ekip hazır, metrik panelleri açık, iletişim kanalı aktif |
| T-15 Son kontrol | 15 | UAT/Shadow/DB bağlantı son kontrol |
| T0 Kademeli yönlendirme başlangıcı | 10 | Trafik %5 yeni stack |
| T+10 Değerlendirme-1 | 10 | Error rate/auth başarı/latency kontrol |
| T+20 Trafik artırımı | 10 | Trafik %20 |
| T+30 Değerlendirme-2 | 10 | Eşikler tekrar kontrol |
| T+40 Trafik artırımı | 10 | Trafik %50 |
| T+50 Değerlendirme-3 | 10 | Kritik akışlar ve degraded metrikleri |
| T+60 Final karar | 10 | %100'e çıkış veya rollback |

Toplam planlı pencere: ~**1.5 saat**

---

## 4) Adım Adım Uygulama

1. **Freeze**
   - Yeni deploy/şema değişikliği durdurulur.
2. **Son doğrulama**
   - Backend test smoke + parity script smoke çalıştırılır.
3. **%5 trafik**
   - Error rate, auth success, p95 latency izlenir.
4. **%20 trafik**
   - Shadow diff raporunda regresyon olup olmadığı kontrol edilir.
5. **%50 trafik**
   - Degraded metriclerinde anomali var mı izlenir.
6. **%100 veya rollback kararı**
   - Tüm eşikler sağlanıyorsa %100.
   - Eşik ihlali varsa rollback runbook devreye alınır.

---

## 5) İzlenecek Göstergeler ve Eşikler

- API 5xx oranı: < %1
- Auth login başarı oranı: > %98
- Kritik endpoint p95 latency: kabul edilen SLO sınırında
- Degraded check error sayısı: 0 (veya önceden onaylı tolerans)

Eşik ihlalinde "duraklat-değerlendir" adımına geçilir.

---

## 6) Sorumluluk Matrisi

- **Cutover Lead:** geçiş kararları ve adım geçiş onayı
- **Backend Lead:** API sağlık, auth ve parity script takibi
- **Frontend Lead:** UI kritik akışlar ve login/dashboard doğrulama
- **Ops Lead:** trafik yönlendirme, gözlem panelleri, olay kaydı

---

## 7) Komut Referansı (Örnek)

```bash
cd backend && DB_ENGINE=django.db.backends.sqlite3 DB_NAME=:memory: python3 manage.py test apps.core.tests apps.modules.tests
python3 backend/scripts/row_count_compare.py
python3 backend/scripts/sample_record_compare.py
python3 backend/scripts/shadow_diff_report.py
```

---

## 8) Kapanış

- Cutover sonrası 72 saat stabilizasyon penceresi uygulanır.
- Olay, metrik ve karar özeti `MIGRATION_WEEKLY_METRICS.md` içine işlenir.
