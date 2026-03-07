# Migration Legacy Decommission Plan (Hafta 6 / Adım 3)

Bu doküman, `MIGRATION_EXECUTION_PLAN.md` içindeki **Hafta-6: Legacy bağımlılıklarının aşamalı kapatılması planı** maddesinin teslimidir.

## 1) Amaç

- Kalıcı geçiş onayı sonrasında legacy bağımlılıklarını kontrollü ve geri alınabilir şekilde kapatmak.

---

## 2) Aşamalı Kapatma Fazları

| Faz | Kapsam | Ön Koşul |
|---|---|---|
| L1 | Legacy read endpoint yönlendirmelerinin pasifleştirilmesi | 72 saat stabilizasyon yeşil |
| L2 | Legacy operasyon scriptlerinin devreden çıkarılması | L1 sonrası 24 saat sorun yok |
| L3 | Legacy infra bileşenlerinin kapatılması | L2 sonrası iş etkisi yok |

---

## 3) Güvenlik Kuralı

- Her faz sonrası en az 24 saat gözlem.
- Bir fazda sorun çıkarsa bir önceki faza geri dönülür.
- Faz geçişleri yalnızca change kaydı ile yapılır.

---

## 4) Envanter Kontrol Listesi

- [ ] Legacy cron/job bağımlılıkları
- [ ] Legacy API route yönlendirmeleri
- [ ] Legacy config/env secret kullanımları
- [ ] Legacy rapor/export iş akışları
- [ ] Legacy izleme/uyarı entegrasyonları

---

## 5) Onay Mekanizması

Decommission başlangıcı için:
1. Stabilizasyon playbook sonucu `approve`
2. Ops + backend lead ortak onayı
3. Rollback prosedürünün halen uygulanabilir olduğunun doğrulanması

---

## 6) Çıktılar

- Faz bazlı decommission kayıtları
- Kapatılan bağımlılık listesi
- Son durum özeti (legacy bağımlılık: kalan/yok)

Kayıt hedefi: `MIGRATION_WEEKLY_METRICS.md`
