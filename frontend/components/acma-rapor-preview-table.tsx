import type { AcmaRaporItem } from '@/lib/api'

export function AcmaRaporPreviewTable({ items }: { items: AcmaRaporItem[] }) {
  return (
    <section>
      <h2>Açma Rapor Önizleme (İlk 10)</h2>
      <table cellPadding={8} style={{ borderCollapse: 'collapse' }}>
        <thead>
          <tr>
            <th>ID</th>
            <th>Rapor No</th>
            <th>Sezon</th>
          </tr>
        </thead>
        <tbody>
          {items.map((item) => (
            <tr key={item.acma_rapor_id}>
              <td>{item.acma_rapor_id}</td>
              <td>{item.acma_rapor_no}</td>
              <td>{item.sezon}</td>
            </tr>
          ))}
          {items.length === 0 && (
            <tr>
              <td colSpan={3}>Kayıt bulunamadı (veya backend erişimi yok).</td>
            </tr>
          )}
        </tbody>
      </table>
    </section>
  )
}
