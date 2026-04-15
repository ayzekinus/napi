import type { DemirbasItem } from '@/lib/api'

export function DemirbasPreviewTable({ items }: { items: DemirbasItem[] }) {
  return (
    <section>
      <h2>Demirbaş Önizleme (İlk 10)</h2>
      <table cellPadding={8} style={{ borderCollapse: 'collapse' }}>
        <thead>
          <tr>
            <th>ID</th>
            <th>Buluntu ID</th>
            <th>Envanter No</th>
            <th>Durum</th>
          </tr>
        </thead>
        <tbody>
          {items.map((item) => (
            <tr key={item.dl_id}>
              <td>{item.dl_id}</td>
              <td>{item.buluntu_id}</td>
              <td>{item.envanter_no}</td>
              <td>{item.durum}</td>
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
