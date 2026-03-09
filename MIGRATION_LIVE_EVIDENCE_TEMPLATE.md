# Migration Live Evidence Template (Post-Program)

Bu şablon, program kapanışı sonrasında canlı ortam yürütüm kanıtlarını standart formatta toplamak için kullanılır.

## 1) Genel Bilgi

- Tarih/Saat:
- Ortam:
- Sorumlu ekip:
- Değişiklik referansı:

---

## 2) Dry-Run Kanıtları

- Cutover dry-run sonucu:
- Rollback dry-run sonucu:
- Süre ölçümleri (dk):
- Sapma/öğrenim notları:

---

## 3) Canlı Cutover Kanıtları

- Trafik geçiş adımları (%):
- T0 / T+5 / T+10 metrik snapshot:
  - API 5xx:
  - Auth başarı:
  - p95 latency:
  - degraded error_checks:
- Karar: continue / rollback

---

## 4) Stabilizasyon (72 saat) Kanıtları

- 0-6 saat özet:
- 6-24 saat özet:
- 24-48 saat özet:
- 48-72 saat özet:
- Incident listesi + durum:

---

## 5) Legacy Decommission Kanıtları

- L1 sonucu:
- L2 sonucu:
- L3 sonucu:
- Kalan bağımlılık var mı?:

---

## 6) Final Onay

- Kalıcı geçiş onayı: approve / hold
- Onaylayan roller:
- Sonraki aksiyonlar:
