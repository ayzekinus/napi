import type { KullaniciItem } from '@/lib/api'

export function KullanicilarPreviewTable({ items }: { items: KullaniciItem[] }) {
  return (
    <section>
      <h2>Kullanıcılar Önizleme (İlk 10)</h2>
      <table cellPadding={8} style={{ borderCollapse: 'collapse' }}>
        <thead>
          <tr>
            <th>ID</th>
            <th>Ad Soyad</th>
            <th>Kullanıcı</th>
            <th>Yetki</th>
            <th>Durum</th>
          </tr>
        </thead>
        <tbody>
          {items.map((item) => (
            <tr key={item.ID}>
              <td>{item.ID}</td>
              <td>{item.adsoyad}</td>
              <td>{item.kullanici}</td>
              <td>{item.yetki}</td>
              <td>{item.durum === 1 ? 'Aktif' : 'Pasif'}</td>
            </tr>
          ))}
          {items.length === 0 && (
            <tr>
              <td colSpan={5}>Kayıt bulunamadı (veya backend erişimi yok).</td>
            </tr>
          )}
        </tbody>
      </table>
    </section>
  )
}
