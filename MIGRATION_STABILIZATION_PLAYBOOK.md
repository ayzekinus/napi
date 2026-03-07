# Migration Stabilization Playbook (Hafta 6 / Adım 2)

Bu doküman, `MIGRATION_EXECUTION_PLAN.md` içindeki **Hafta-6: 72 saat yoğun gözlem** maddesinin teslimidir.

## 1) Amaç

- %100 cutover sonrası ilk 72 saat içinde kritik iş akışlarının stabil kaldığını doğrulamak.
- Olası bozulmaları erken yakalayıp rollback penceresi kapanmadan karar vermek.

---

## 2) 72 Saat Gözlem Dilimleri

| Zaman Dilimi | Takip Sıklığı | Odak |
|---|---:|---|
| 0-6 saat | 15 dk | Error spike, auth başarısı, kritik latency |
| 6-24 saat | 30 dk | Stabilizasyon trendi, shadow diff sınıfları |
| 24-48 saat | 60 dk | Kullanıcı akış tutarlılığı, degraded metrikleri |
| 48-72 saat | 60 dk | Kalıcı geçiş onayı öncesi final sağlık kontrolü |

---

## 3) Zorunlu Metrikler

- API 5xx oranı
- Auth başarı oranı
- Kritik endpoint p95 latency
- `shadow_diff_report` classification dağılımı
- `degraded_metrics.error_checks`

---

## 4) Alarm/İnsident Kuralı

- 2 ardışık tur kritik eşik ihlali => incident açılır.
- Incident açıldığında:
  - olay kaydı başlatılır,
  - etki analizi yapılır,
  - rollback gereksinimi değerlendirilir.

---

## 5) Kapanış Kriteri (72 saat sonunda)

Aşağıdaki koşullar sağlanırsa stabilizasyon tamamlanır:

1. Kritik iş akışlarında kalıcı hata yok.
2. Eşik ihlalleri geçici ve kapanmış.
3. Shadow diff kritik regresyon üretmiyor.
4. `degraded_metrics.error_checks` kalıcı artış göstermiyor.

---

## 6) Çıktı Kaydı

- 72 saatlik özet rapor
- Incident listesi + kapanış durumu
- Kalıcı geçiş onayı (approve/hold)

Kayıt hedefi: `MIGRATION_WEEKLY_METRICS.md`
