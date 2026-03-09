import type { DashboardSummary } from '@/lib/api'

export function DashboardSummaryCards({ summary }: { summary: DashboardSummary }) {
  const items = [
    ['Anakod', summary.anakod],
    ['Buluntu', summary.buluntu],
    ['Açma Rapor', summary.acma_rapor],
    ['Evrak', summary.evrak],
    ['Demirbaş', summary.demirbas],
    ['Kullanıcı', summary.kullanicilar],
  ] as const

  return (
    <section>
      <h2>Genel Özet</h2>
      <div style={{ display: 'grid', gridTemplateColumns: 'repeat(3, minmax(120px, 1fr))', gap: 8, marginBottom: 16 }}>
        {items.map(([label, value]) => (
          <div key={label} style={{ border: '1px solid #ddd', borderRadius: 8, padding: 12 }}>
            <div style={{ fontSize: 12, opacity: 0.7 }}>{label}</div>
            <div style={{ fontSize: 24, fontWeight: 700 }}>{value}</div>
          </div>
        ))}
      </div>
    </section>
  )
}
