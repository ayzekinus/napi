import type { AnakodItem } from '@/lib/api'

export function AnakodPreviewTable({ items }: { items: AnakodItem[] }) {
  return (
    <section>
      <h2>Anakod Önizleme (İlk 10)</h2>
      <table cellPadding={8} style={{ borderCollapse: 'collapse' }}>
        <thead>
          <tr>
            <th>ID</th>
            <th>Anakod</th>
          </tr>
        </thead>
        <tbody>
          {items.map((item) => (
            <tr key={item.anakod_id}>
              <td>{item.anakod_id}</td>
              <td>{item.anakod}</td>
            </tr>
          ))}
          {items.length === 0 && (
            <tr>
              <td colSpan={2}>Kayıt bulunamadı (veya backend erişimi yok).</td>
            </tr>
          )}
        </tbody>
      </table>
    </section>
  )
}
