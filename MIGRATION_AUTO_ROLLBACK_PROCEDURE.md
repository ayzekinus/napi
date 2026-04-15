# Migration Auto-Rollback Trigger Procedure (Hafta 5 / Adım 3)

Bu doküman, `MIGRATION_EXECUTION_PLAN.md` içindeki **Hafta-5: Eşik aşımlarında otomatik rollback tetik prosedürü** maddesinin teslimidir.

## 1) Amaç

- Metrik ihlallerinde karar süresini azaltmak.
- Tutarlı ve tekrarlanabilir rollback tetik kuralı tanımlamak.

---

## 2) Tetik Kuralları

Aşağıdaki koşullardan biri sağlanırsa `rollback_candidate=true`:

1. API 5xx > %1 ve ardışık 2 tur devam
2. Auth başarı < %98 ve ardışık 2 tur devam
3. p95 latency SLO üstü ve ardışık 2 tur devam
4. degraded `error_checks > 0` ve 2 turda düzelmeme
5. shadow diff sınıflandırmasında kritik `regresyon`

---

## 3) Otomatik Karar Akışı

1. Monitoring döngüsü metrikleri toplar
2. Kural motoru ihlal sayaçlarını günceller
3. `rollback_candidate=true` ise:
   - Cutover lead + Ops lead kanalına alarm atılır
   - `MIGRATION_ROLLBACK_RUNBOOK.md` adım-1 tetiklenir
4. Alarm sonrası 2 dakika içinde manuel onay yoksa güvenlik gereği rollback başlatılır

---

## 4) Alarm Payload Örneği

```json
{
  "level": "critical",
  "phase": "Ramp-2",
  "reason": "auth_success_below_threshold",
  "observed": 96.7,
  "threshold": 98.0,
  "consecutive_breaches": 2,
  "action": "rollback_candidate"
}
```

---

## 5) Doğrulama Adımı

- Dry-run sırasında sahte metriklerle kural motoru tetik testleri yapılır.
- Test senaryoları:
  - tek ihlal (rollback yok)
  - ardışık çift ihlal (rollback aday)
  - çoklu metrik ihlali (rollback aday)
