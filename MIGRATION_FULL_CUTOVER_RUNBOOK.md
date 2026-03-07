# Migration Full Cutover Runbook (Hafta 6 / Adım 1)

Bu doküman, `MIGRATION_EXECUTION_PLAN.md` içindeki **Hafta-6: %100 trafik geçişi** maddesinin teslimidir.

## 1) Amaç

- %50 trafik fazından sonra yeni stack'e %100 geçişi kontrollü olarak tamamlamak.
- Karar mekanizmasını ölçülebilir sinyallerle (UAT, shadow diff, ramp metrikleri) yönetmek.

---

## 2) Ön Koşullar

Aşağıdaki koşullar sağlanmadan %100 geçiş adımı başlatılmaz:

1. Hafta-5 ramp fazları (%5/%20/%50) başarıyla tamamlanmış.
2. Son 30 dakikada kritik eşik ihlali olmamış.
3. `shadow_diff_report` çıktısında kritik regresyon bulunmamış.
4. Rollback runbook ve sorumlular aktif hazır durumda.

---

## 3) Uygulama Adımları

1. **T-10 son kontrol**
   - Metrik panelleri, alarm akışı, operasyon kanalı doğrulanır.
2. **T0 trafik %100**
   - Yönlendirme kuralı tam yeni stack olacak şekilde güncellenir.
3. **T+5 hızlı sağlık kontrolü**
   - Health/auth/bootstrap kritik akış smoke kontrolleri.
4. **T+10 karar noktası**
   - Eşikler yeşil ise %100'de kal.
   - İhlal varsa rollback prosedürü başlat.

---

## 4) Kontrol Edilecek Metrikler

- API 5xx < %1
- Auth başarı > %98
- Kritik endpoint p95 SLO altında
- `degraded_metrics.error_checks == 0`

---

## 5) Çıktı Kayıtları

- %100 geçiş zaman damgası
- Karar logu (continue/rollback)
- İlk 10 dakikalık metrik özeti
- Varsa incident referansları

Kayıt hedefi: `MIGRATION_WEEKLY_METRICS.md`
