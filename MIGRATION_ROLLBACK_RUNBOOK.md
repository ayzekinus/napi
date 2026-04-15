# Migration Rollback Runbook (Hafta 4 / Adım 3)

Bu doküman, `MIGRATION_EXECUTION_PLAN.md` içindeki **Hafta-4: Rollback runbook + RTO hedefi** maddesinin teslimidir.

## 1) Amaç

- Cutover sırasında veya sonrasında kritik eşik ihlali oluşursa, trafiği kontrollü şekilde legacy sisteme geri almak.
- İş etkisini sınırlamak için geri dönüş süresini (RTO) önceden tanımlı hedefte tutmak.

---

## 2) RTO Hedefi

- **Hedef RTO:** <= **15 dakika** (rollback kararı alındıktan sonra).
- **RPO yaklaşımı:** Read-only fazda veri yazımı olmadığı için veri kaybı riski minimize kabul edilir.

---

## 3) Rollback Tetik Koşulları

Aşağıdaki durumlardan biri gerçekleşirse rollback değerlendirmesi başlar:

1. API 5xx oranı > %1 ve 5 dakika boyunca düzelmiyor.
2. Auth başarı oranı < %98.
3. Kritik endpoint p95 gecikmesi kabul edilen SLO üstünde kalıcı.
4. `shadow_diff_report` sınıflandırmasında kritik regresyon sinyali.
5. Degraded metriclerinde beklenmeyen artış (`error_checks > 0` ve devamlılık).

---

## 4) Adım Adım Rollback Uygulaması

1. **Karar ve duyuru (T+0)**
   - Cutover lead rollback kararı verir.
   - War-room kanalında "rollback başladı" anonsu yapılır.

2. **Trafik geri yönlendirme (T+0..T+5)**
   - Trafik kademeli veya tek adımda legacy rotaya alınır.
   - Yeni stack üzerinde yazma yoksa sadece okuma trafiği kapanır.

3. **Sağlık doğrulaması (T+5..T+10)**
   - Legacy health ve kritik auth akışları doğrulanır.
   - Minimum smoke kontrolü çalıştırılır.

4. **Stabilizasyon doğrulaması (T+10..T+15)**
   - Hata oranı ve latency normal seviyeye döndü mü kontrol edilir.
   - Rollback tamamlandı anonsu geçilir.

---

## 5) Rollback Sonrası Zorunlu Kayıtlar

- Olay başlangıç/bitiş zamanları
- Tetikleyen metrik ve eşik
- Uygulanan teknik adımlar
- Etkilenen kullanıcı alanı
- Tekrar deneme için ön koşullar

Bu kayıtlar `MIGRATION_WEEKLY_METRICS.md` ve incident log'a işlenir.

---

## 6) Sorumluluklar

- **Rollback Lead:** karar, koordinasyon, kapanış onayı
- **Ops Lead:** trafik geri yönlendirme
- **Backend Lead:** auth/API sağlık doğrulaması
- **Frontend Lead:** login/dashboard smoke doğrulaması

---

## 7) Dry-Run Kontrol Listesi

- [ ] Rollback karar zinciri tatbik edildi
- [ ] Trafik geri yönlendirme adımı test edildi
- [ ] 15 dk RTO hedefi dry-run ile doğrulandı
- [ ] Olay kaydı şablonu dolduruldu

---

## 8) Komut Referansı (Örnek)

```bash
cd backend && DB_ENGINE=django.db.backends.sqlite3 DB_NAME=:memory: python3 manage.py test apps.core.tests apps.modules.tests
python3 backend/scripts/shadow_diff_report.py
```
