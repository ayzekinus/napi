# Migration UAT Checklist (Hafta 4 / Adım 1)

Bu doküman, `MIGRATION_EXECUTION_PLAN.md` içindeki **Hafta-4: En kritik kullanıcı senaryoları için UAT checklist** maddesinin teslimidir.

## 1) UAT Kapsamı

- Kritik read-only dashboard akışları
- Legacy uyumlu auth/session/permission akışları
- Degraded görünürlüğü ve fallback davranışları
- API sözleşmesi (method/payload) korunumu

---

## 2) Kritik Senaryo Seti

| ID | Senaryo | Beklenen Sonuç | Durum |
|---|---|---|---|
| UAT-01 | `GET /api/health` | `200`, `{ok: true, service: django-backend}` | ☐ |
| UAT-02 | `POST /api/auth/login` valid | `200`, `success=true`, session set | ☐ |
| UAT-03 | `GET /api/auth/session` authenticated | `200`, `authenticated=true`, user alanları tam | ☐ |
| UAT-04 | `GET /api/auth/permissions` | `200`, `permissions` map + `is_supervisor` doğru | ☐ |
| UAT-05 | `GET /api/auth/bootstrap` | `200`, `user + permissions` tek çağrıda | ☐ |
| UAT-06 | `POST /api/auth/logout` | `200`, `success=true`, session flush | ☐ |
| UAT-07 | Modules `POST -> 405` | Read-only endpointlerde write method reddi | ☐ |
| UAT-08 | `GET /api/modules/bootstrap-full?limit=10` | `200`, `modules + summary + data + degraded_map` | ☐ |
| UAT-09 | `limit` clamp davranışı | `0 -> 1`, büyük değer `-> 500` | ☐ |
| UAT-10 | Degraded görünürlüğü | Hata senaryosunda `degraded=true` ve map dolu | ☐ |
| UAT-11 | `row_count_compare.py` | JSON çıktıda `all_match` raporlanır | ☐ |
| UAT-12 | `sample_record_compare.py` | JSON çıktıda modül bazlı parity raporu | ☐ |
| UAT-13 | `shadow_diff_report.py` | Birleşik rapor + classification + degraded_metrics | ☐ |
| UAT-14 | Frontend `/login` | Login formu backend endpointine uyumlu çağrı yapar | ☐ |
| UAT-15 | Frontend `/` dashboard | Bootstrap verileri render edilir, degraded uyarısı görünür | ☐ |

---

## 3) Geçiş Kriterleri

- Toplam senaryo: **15**
- Geçme barajı: **>= %90** (en az 14 senaryo yeşil)
- Bloker kuralı:
  - UAT-02/03/05/08/10/13 maddelerinden herhangi biri kırmızı ise cutover provası başlatılmaz.

---

## 4) UAT Yürütme Notları

- UAT önce `DB_ENGINE=sqlite` ile smoke, sonra legacy benzeri DB ile shadow doğrulama şeklinde çalıştırılır.
- Her kırmızı senaryoya issue açılır ve "regresyon / veri_kirliligi / ortam" etiketi verilir.
- UAT sonucu haftalık metrik raporuna işlenir.

---

## 5) Önerilen Doğrulama Komutları

```bash
cd backend && DB_ENGINE=django.db.backends.sqlite3 DB_NAME=:memory: python3 manage.py test apps.core.tests apps.modules.tests
python3 -m py_compile backend/scripts/row_count_compare.py backend/scripts/sample_record_compare.py backend/scripts/shadow_diff_report.py
```
