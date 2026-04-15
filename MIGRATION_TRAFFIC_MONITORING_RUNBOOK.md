# Migration Traffic Monitoring Runbook (Hafta 5 / Adım 2)

Bu doküman, `MIGRATION_EXECUTION_PLAN.md` içindeki **Hafta-5: Hata oranı, auth başarı oranı, kritik endpoint latency takibi** maddesinin teslimidir.

## 1) İzlenecek Ana Metrikler

- API 5xx oranı
- Auth login başarı oranı
- Kritik endpoint p95 latency
- Degraded hata kontrol sayısı (`shadow_diff_report` -> `degraded_metrics.error_checks`)

---

## 2) Eşikler (Alert Thresholds)

- API 5xx oranı: **< %1**
- Auth başarı oranı: **> %98**
- Kritik endpoint p95: **SLO sınırı altında**
- degraded `error_checks`: **0**

---

## 3) Takip Döngüsü

- Ramp-1 (%5): her 5 dakikada kontrol
- Ramp-2 (%20): her 5 dakikada kontrol
- Ramp-3 (%50): her 3 dakikada kontrol

Her kontrol turunda:
1. Metrik snapshot alınır
2. Eşik karşılaştırması yapılır
3. Sonuç `green/yellow/red` olarak işaretlenir

---

## 4) Alarm Seviyeleri

- **Green:** tüm metrikler eşik içinde
- **Yellow:** tek metrik kısa süreli ihlal (1 tur)
- **Red:** aynı metrik 2+ tur ihlal veya çoklu metrik ihlali

Red durumunda rollback tetik prosedürü değerlendirilir.

---

## 5) Kayıt Formatı

Her kontrol turu için:
- timestamp
- trafik fazı
- 5xx oranı
- auth başarı
- p95 latency
- degraded error_checks
- karar (`continue / hold / rollback`)

Bu kayıtlar haftalık rapor ve incident kaydına işlenir.
