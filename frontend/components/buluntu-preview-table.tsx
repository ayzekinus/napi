import type { BuluntuItem } from '@/lib/api'

export function BuluntuPreviewTable({ items }: { items: BuluntuItem[] }) {
  return (
    <section>
      <h2>Buluntu Önizleme (İlk 10)</h2>
      <table cellPadding={8} style={{ borderCollapse: 'collapse' }}>
        <thead>
          <tr>
            <th>ID</th>
            <th>Anakod ID</th>
            <th>Buluntu No</th>
            <th>Envanterlik</th>
          </tr>
        </thead>
        <tbody>
          {items.map((item) => (
            <tr key={item.bk_id}>
              <td>{item.bk_id}</td>
              <td>{item.bk_anakod_id}</td>
              <td>{item.buluntu_no ?? '-'}</td>
              <td>{item.envanterlik ? 'Evet' : 'Hayır'}</td>
            </tr>
          ))}
          {items.length === 0 && (
            <tr>
              <td colSpan={4}>Kayıt bulunamadı (veya backend erişimi yok).</td>
            </tr>
          )}
        </tbody>
      </table>
    </section>
  )
}
