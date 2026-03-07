# PHP -> Django + Next.js Geçiş İcra Takvimi

Bu doküman, read-only fazdan kontrollü cutover'a kadar uygulanacak **tek sorumlu (end-to-end ownership)** çalışma planıdır.

## 0) Mevcut Durum Özeti

- Read-only API iskeleti ve endpoint method sözleşmeleri büyük ölçüde tamamlandı.
- Legacy auth/session + permissions kontratları testlerle güvence altında.
- Modül bootstrap/degraded davranışları test kapsamına alındı.
- Kalan kritik iş: veri doğrulama, paralel çalışma, cutover ve rollback prova adımları.

> Hedef: üretime geçiş riskini koddan çok operasyonel doğrulama ile düşürmek.

---

## 1) 6 Haftalık Uygulama Takvimi

## Hafta 1 — Kontrat Dondurma + Ölçümleme

- [x] Read-only sözleşmesinin resmi freeze'i (endpoint + payload + method seti).
- [x] "migration readiness" metriği tanımı:
  - API sözleşme test kapsaması
  - Modül bazlı degraded görünürlüğü
  - Kritik auth akış başarı oranı
- [x] Takvimdeki tüm maddeler için owner/doğrulama komutu eklenmesi (Hafta-1 kapsamı).

**Çıkış kriteri**
- Tek sayfalık "freeze scope" tamam ve repoda yayınlanmış.
- Haftalık metrik raporu üretilebiliyor.

## Hafta 2 — Veri Eşleme (Mapping) ve Doğrulama Scriptleri

- [x] Legacy tablo -> yeni servis alan mapping matrisi çıkarılması.
- [x] Satır sayısı karşılaştırma scripti (tablo bazlı).
- [x] Örnek kayıt karşılaştırma scripti (deterministik örneklem ile).

**Çıkış kriteri**
- En az kritik 6 modül için mapping dosyası tamam.
- Satır sayısı ve örnek kayıt kıyasları otomatik koşabiliyor.

## Hafta 3 — Shadow / Paralel Okuma

- [x] Seçili endpointlerde legacy sonuç vs yeni endpoint çıktısı fark raporu.
- [x] Farkların sınıflandırılması (beklenen / regresyon / veri kirliliği).
- [x] Degraded senaryoları için gözlemlenebilirlik metrikleri.

**Çıkış kriteri**
- Kritik endpointler için günlük fark raporu alınabiliyor.
- Regresyon olarak sınıflanan farklar issue listesinde kapanma planına bağlı.

## Hafta 4 — UAT + Operasyon Provaları

- [x] En kritik kullanıcı senaryoları için UAT checklist.
- [ ] Cutover runbook taslağı (adım adım, süre tahmini ile).
- [ ] Rollback runbook + geri dönüş süresi hedefi (RTO).

**Çıkış kriteri**
- UAT checklist'inin en az %90'ı yeşil.
- Cutover ve rollback adımları dry-run ile doğrulanmış.

## Hafta 5 — Kademeli Trafik Geçişi

- [ ] Trafiğin küçük yüzdesini yeni stack'e alma (ör. %5 -> %20 -> %50).
- [ ] Hata oranı, auth başarı oranı, kritik endpoint latency takibi.
- [ ] Eşik aşımlarında otomatik rollback tetik prosedürü.

**Çıkış kriteri**
- Önceden tanımlanan SLO/SLA eşikleri korunuyor.
- %50 trafikte kritik hata yok.

## Hafta 6 — Tam Cutover + Stabilizasyon

- [ ] %100 trafik geçişi.
- [ ] 72 saat yoğun gözlem (stabilizasyon penceresi).
- [ ] Legacy bağımlılıklarının aşamalı kapatılması planı.

**Çıkış kriteri**
- Kritik iş akışları stabil.
- Rollback penceresi sonunda kalıcı geçiş onayı verilebilir.

---

## 2) Yürütme Kuralları

- Önce read-only kapsam: CRUD genişlemesi yalnızca cutover sonrası fazda.
- Her adım için "kanıt" zorunlu:
  - test çıktısı
  - karşılaştırma raporu
  - runbook dry-run sonucu
- Geçiş kararı yalnızca metrik eşiklerine göre verilir; sezgisel karar alınmaz.

---

## 3) Riskler ve Önleyici Aksiyon

- **Risk:** Legacy veri kalitesi tutarsızlığı.
  - **Aksiyon:** Mapping + örnek kayıt doğrulamasını release gate yapmak.
- **Risk:** Auth kenar durumları (kısıtlama tokenları, supervisor bypass).
  - **Aksiyon:** Auth payload kontrat testlerini genişletmeye devam etmek.
- **Risk:** Kısmi DB erişim hataları.
  - **Aksiyon:** degraded_map + fallback davranışını her kritik endpointte korumak.

---

## 4) Anlık İlerleme Takibi (Başlangıç)

- Read-only sözleşme sertliği: **%95**
- Veri taşıma/doğrulama otomasyonu: **%20**
- Cutover/rollback operasyon hazırlığı: **%10**
- Genel geçiş hazırlığı: **%45**

> Bu oranlar haftalık raporla güncellenecek; hedef "ölçülebilir ilerleme"dir.
