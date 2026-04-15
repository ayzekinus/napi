import type { EvrakItem } from '@/lib/api'

export function EvrakPreviewTable({ items }: { items: EvrakItem[] }) {
  return (
    <section>
      <h2>Evrak Önizleme (İlk 10)</h2>
      <table cellPadding={8} style={{ borderCollapse: 'collapse' }}>
        <thead>
          <tr>
            <th>ID</th>
            <th>Tip</th>
            <th>No</th>
            <th>Tarih</th>
          </tr>
        </thead>
        <tbody>
          {items.map((item) => (
            <tr key={item.evrak_id}>
              <td>{item.evrak_id}</td>
              <td>{item.evrak_tipi}</td>
              <td>{item.evrak_no}</td>
              <td>{item.evrak_tarihi ?? '-'}</td>
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
