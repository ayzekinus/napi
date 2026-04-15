# Migration Traffic Ramp Plan (Hafta 5 / Adım 1)

Bu doküman, `MIGRATION_EXECUTION_PLAN.md` içindeki **Hafta-5: Trafiğin küçük yüzdesini yeni stack'e alma** maddesinin teslimidir.

## 1) Amaç

- Trafiği kontrollü biçimde yeni Django + Next.js stack'e aktarmak.
- Erken aşamada riskleri tespit edip rollback penceresini korumak.

---

## 2) Geçiş Basamakları

| Faz | Trafik Oranı | Min. Gözlem Süresi | Geçiş Kriteri |
|---|---:|---:|---|
| Ramp-1 | %5 | 10 dk | Error/auth/latency eşikleri yeşil |
| Ramp-2 | %20 | 15 dk | Shadow diff kritik regresyon yok |
| Ramp-3 | %50 | 20 dk | Degraded metrikleri normal, kritik akışlar stabil |

Not: Her faz sonunda Go/No-Go kararı verilir; No-Go durumunda rollback runbook tetiklenir.

---

## 3) Faz Bazlı Kontrol Listesi

## Ramp-1 (%5)
- [ ] Trafik yönlendirme kuralı aktif
- [ ] API 5xx oranı < %1
- [ ] Auth başarı oranı > %98
- [ ] p95 latency kabul edilen SLO içinde

## Ramp-2 (%20)
- [ ] `shadow_diff_report.json` kontrol edildi
- [ ] `classification` içinde kritik `regresyon` sinyali yok
- [ ] Degraded metriklerinde anormal artış yok

## Ramp-3 (%50)
- [ ] UAT bloker akışları canlıda smoke edildi
- [ ] Login / dashboard / bootstrap akışları stabil
- [ ] Olay kaydı ve metrik özeti güncellendi

---

## 4) Go/No-Go Karar Kuralı

Bir sonraki faza geçiş için aşağıdakilerin tamamı sağlanmalıdır:
- Error rate, auth success, latency eşikleri yeşil
- Shadow diff kritik regresyon göstermiyor
- Degraded metriclerinde sürekli bozulma yok

Aksi durumda:
- Faz ilerletilmez
- Sorun sınıflandırılır (`regresyon`, `veri_kirliligi`, `degraded_or_runtime_error`)
- Gerekirse rollback runbook çalıştırılır

---

## 5) Operasyonel Çıktılar

Her faz sonunda aşağıdaki kayıtlar tutulur:
- Faz adı ve zaman damgası
- Trafik oranı
- Metrik özeti (5xx, auth, latency)
- Shadow diff sonucu
- Karar (Go / No-Go / Rollback)

Kayıt hedefi:
- `MIGRATION_WEEKLY_METRICS.md` (haftalık özet)
- Incident log (olay bazlı detay)
