# Migration Weekly Metrics (Hafta 1 Baseline)

Bu doküman, `MIGRATION_EXECUTION_PLAN.md` içindeki **Hafta-1 migration readiness metriği** maddesinin ölçüm formatını ve başlangıç (baseline) değerlerini tanımlar.

## 1) Ölçüm Çerçevesi

## M1 — API Contract Coverage

Amaç:
- Core + modules endpoint sözleşmelerinin (method/payload/limit/degraded) testlerle doğrulanma seviyesini takip etmek.

Hesap:
- `M1 = (geçen contract test sayısı / toplam contract test sayısı) * 100`

Bu hafta ölçüm kaynağı:
- `apps.core.tests`
- `apps.modules.tests`

## M2 — Read-only Güvenliği (Method Restriction)

Amaç:
- Read-only endpointlerde method sözleşmesi ihlallerinin (`POST -> 405`) test güvencesini izlemek.

Hesap:
- `M2 = (geçen method-restriction testleri / toplam method-restriction testleri) * 100`

Not:
- Bu metrik, write endpointleri kapsam dışı tutar; sadece read-only sınır güvencesini ölçer.

## M3 — Auth Akış Sağlığı

Amaç:
- Login/session/permissions/bootstrap/logout kontratlarının stabilitesini izlemek.

Hesap:
- `M3 = (geçen auth testleri / toplam auth testleri) * 100`

---

## 2) Hafta-1 Baseline Ölçümü

Doğrulama komutu:

```bash
cd backend && DB_ENGINE=django.db.backends.sqlite3 DB_NAME=:memory: python3 manage.py test apps.core.tests apps.modules.tests
```

Sonuç özeti (Hafta-1):
- Toplam test: `86`
- Başarılı: `86`
- Başarısız: `0`
- Genel başarı: `%100`

Program bazlı yorum:
- M1 (API Contract Coverage): `%100` (mevcut contract test setinde)
- M2 (Read-only Güvenliği): `%100` (mevcut method restriction test setinde)
- M3 (Auth Akış Sağlığı): `%100` (mevcut auth test setinde)

---

## 3) Haftalık Güncelleme Formatı

Her hafta aşağıdaki blok eklenir:

- Hafta no / tarih aralığı
- Çalıştırılan doğrulama komutu
- Test özeti (toplam/geçen/kalan)
- M1, M2, M3 değerleri
- Kırmızı riskler ve aksiyon planı

Bu yapı ile geçiş ilerlemesi "yorum" yerine "ölçüm" ile yönetilir.

---

## 4) Hafta-2 İlerleme Notu

Tamamlanan maddeler:
- Mapping matrisi (`MIGRATION_MAPPING_MATRIX.md`)
- Satır sayısı karşılaştırma scripti (`backend/scripts/row_count_compare.py`)
- Örnek kayıt karşılaştırma scripti (`backend/scripts/sample_record_compare.py`)

Hafta-2 doğrulama komutları:

```bash
python3 -m py_compile backend/scripts/row_count_compare.py
python3 -m py_compile backend/scripts/sample_record_compare.py
```

Not:
- Scriptlerin canlı karşılaştırma çalışması için legacy şemanın erişilebilir olduğu DB bağlantısı gereklidir.


---

## 5) Hafta-3 Başlangıç (Shadow Diff Raporu)

Eklenen otomasyon:
- `backend/scripts/shadow_diff_report.py`

Amaç:
- `row_count_compare.py` ve `sample_record_compare.py` çıktısını tek raporda birleştirerek günlük shadow diff görünürlüğü üretmek.

Rapor çıktısı:
- `backend/reports/shadow_diff_report.json`

Doğrulama komutu:

```bash
python3 -m py_compile backend/scripts/shadow_diff_report.py
```


Hafta-3 sınıflandırma + gözlemlenebilirlik güncellemesi:
- `shadow_diff_report.py` artık farkları `beklenen / regresyon / veri_kirliligi / degraded_or_runtime_error` sınıflarıyla raporlar.
- Rapor çıktısında `degraded_metrics` bloğu eklendi (`degraded_detected`, `degraded_sources`, `total_checks`, `error_checks`).


---

## 6) Hafta-4 Başlangıç (UAT Checklist)

Eklenen artefakt:
- `MIGRATION_UAT_CHECKLIST.md`

Ölçüm kuralı:
- Toplam 15 senaryo, geçiş barajı >= %90 (en az 14 yeşil).

Bloker senaryolar:
- UAT-02, UAT-03, UAT-05, UAT-08, UAT-10, UAT-13


---

## 7) Hafta-4 İlerleme (Cutover Runbook)

Eklenen artefakt:
- `MIGRATION_CUTOVER_RUNBOOK.md`

Planlanan cutover penceresi:
- ~1.5 saat (T-30 hazırlık -> T+60 final karar)

Go/No-Go girdileri:
- UAT >= %90
- Bloker UAT maddeleri yeşil
- Son 3 shadow diff raporunda kritik regresyon yok


---

## 8) Hafta-4 İlerleme (Rollback Runbook)

Eklenen artefakt:
- `MIGRATION_ROLLBACK_RUNBOOK.md`

Hedefler:
- RTO <= 15 dakika
- Rollback tetik koşullarının metrik bazlı tanımlanması
- Dry-run kontrol listesi ile operasyonel doğrulama


---

## 9) Hafta-5 Başlangıç (Traffic Ramp Plan)

Eklenen artefakt:
- `MIGRATION_TRAFFIC_RAMP_PLAN.md`

Ramp fazları:
- Ramp-1: %5
- Ramp-2: %20
- Ramp-3: %50

Faz geçiş kuralı:
- Error/auth/latency eşikleri + shadow diff + degraded metrikleri birlikte yeşil olmalı.


---

## 10) Hafta-5 İlerleme (Monitoring + Auto-Rollback)

Eklenen artefaktlar:
- `MIGRATION_TRAFFIC_MONITORING_RUNBOOK.md`
- `MIGRATION_AUTO_ROLLBACK_PROCEDURE.md`

Kritik eşikler:
- 5xx < %1
- Auth başarı > %98
- p95 latency SLO altında
- degraded error_checks = 0

Otomatik tetik kuralı:
- Eşik ihlali 2 ardışık tur sürerse rollback_candidate alarmı üretilir.


---

## 11) Hafta-6 Başlangıç (%100 Cutover)

Eklenen artefakt:
- `MIGRATION_FULL_CUTOVER_RUNBOOK.md`

Ana karar sinyalleri:
- 5xx, auth başarı, p95 latency, degraded error_checks

Karar noktası:
- T+10 dakikada continue vs rollback değerlendirmesi
