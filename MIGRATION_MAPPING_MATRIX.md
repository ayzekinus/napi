# Migration Mapping Matrix (Hafta 2 / Adım 1)

Bu doküman, `MIGRATION_EXECUTION_PLAN.md` içindeki **Hafta-2: Legacy tablo -> yeni servis alan mapping matrisi** maddesinin ilk teslimidir.

## Kapsam

- Read-only geçişte aktif kullanılan kritik 6 modül + auth kullanıcı kaynağı.
- Kaynaklar, mevcut backend servis sorgularından türetilmiştir.

---

## 1) Auth / Kullanıcı

| Alan | Değer |
|---|---|
| Legacy tablo | `_kullanici` |
| Servis | `apps.core.services.verify_legacy_credentials` |
| Legacy kolonlar | `ID`, `adsoyad`, `_kullanici`, `yetki`, `kisitlamalar`, `durum`, `_sifre` |
| Yeni response alanları | `ID`, `adsoyad`, `kullanici`, `yetki`, `kisitlamalar` |
| Dönüşüm | `_kullanici -> kullanici`, `durum` aktiflik kontrolü (`1` aktif), `_sifre` hash karşılaştırma |

---

## 2) Anakod

| Alan | Değer |
|---|---|
| Legacy tablo | `anakod` |
| Servis | `apps.modules.services.list_anakod` |
| Legacy kolonlar | `anakod_id`, `anakod` |
| Yeni response alanları | `anakod_id`, `anakod` |
| Dönüşüm | Doğrudan eşleme |

## 3) Buluntu

| Alan | Değer |
|---|---|
| Legacy tablo | `buluntu_karti` |
| Servis | `apps.modules.services.list_buluntu` |
| Legacy kolonlar | `bk_id`, `bk_anakod_id`, `buluntu_no`, `envanterlik` |
| Yeni response alanları | `bk_id`, `bk_anakod_id`, `buluntu_no`, `envanterlik` |
| Dönüşüm | `envanterlik -> bool(envanterlik)` |

## 4) Evrak

| Alan | Değer |
|---|---|
| Legacy tablo | `evrak_yonetimi` |
| Servis | `apps.modules.services.list_evrak` |
| Legacy kolonlar | `evrak_id`, `evrak_tipi`, `evrak_no`, `evrak_tarihi` |
| Yeni response alanları | `evrak_id`, `evrak_tipi`, `evrak_no`, `evrak_tarihi` |
| Dönüşüm | `evrak_tarihi -> isoformat() / None` |

## 5) Açma Rapor

| Alan | Değer |
|---|---|
| Legacy tablo | `acma_rapor` |
| Servis | `apps.modules.services.list_acma_rapor` |
| Legacy kolonlar | `acma_rapor_id`, `acma_rapor_no`, `sezon` |
| Yeni response alanları | `acma_rapor_id`, `acma_rapor_no`, `sezon` |
| Dönüşüm | Doğrudan eşleme |

## 6) Demirbaş

| Alan | Değer |
|---|---|
| Legacy tablo | `demirbas_listesi` |
| Servis | `apps.modules.services.list_demirbas` |
| Legacy kolonlar | `dl_id`, `buluntu_id`, `envanter_no`, `durum` |
| Yeni response alanları | `dl_id`, `buluntu_id`, `envanter_no`, `durum` |
| Dönüşüm | Doğrudan eşleme |

## 7) Kullanıcılar Liste

| Alan | Değer |
|---|---|
| Legacy tablo | `_kullanici` |
| Servis | `apps.modules.services.list_kullanicilar` |
| Legacy kolonlar | `ID`, `adsoyad`, `_kullanici`, `yetki`, `durum` |
| Yeni response alanları | `ID`, `adsoyad`, `kullanici`, `yetki`, `durum` |
| Dönüşüm | `_kullanici -> kullanici`, `durum -> int(durum)` |

---

## Dashboard Summary Mapping

| Summary key | Legacy kaynak |
|---|---|
| `anakod` | `COUNT(*) FROM anakod` |
| `buluntu` | `COUNT(*) FROM buluntu_karti` |
| `acma_rapor` | `COUNT(*) FROM acma_rapor` |
| `evrak` | `COUNT(*) FROM evrak_yonetimi` |
| `demirbas` | `COUNT(*) FROM demirbas_listesi` |
| `kullanicilar` | `COUNT(*) FROM _kullanici` |

---

## Hafta-2 Sonraki Adım

- Bu matrisi kullanarak:
  1) tablo bazlı satır sayısı karşılaştırma scripti ✅ (`backend/scripts/row_count_compare.py`),
  2) örnek kayıt karşılaştırma scripti (sıradaki adım)
  hazırlanacak.
