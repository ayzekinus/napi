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
