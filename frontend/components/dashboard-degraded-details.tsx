import type { DashboardDegradedMap } from '@/lib/api'

const LABELS: Record<keyof DashboardDegradedMap, string> = {
  summary: 'Özet sorgusu',
  anakod: 'Anakod',
  buluntu: 'Buluntu',
  demirbas: 'Demirbaş',
  evrak: 'Evrak',
  acma_rapor: 'Açma Rapor',
  kullanicilar: 'Kullanıcılar',
}

export function DashboardDegradedDetails({ degradedMap }: { degradedMap: DashboardDegradedMap }) {
  const rows = (Object.keys(LABELS) as Array<keyof DashboardDegradedMap>).map((key) => ({
    key,
    label: LABELS[key],
    degraded: degradedMap[key],
  }))

  const degradedCount = rows.filter((row) => row.degraded).length

  return (
    <details style={{ marginBottom: 12 }}>
      <summary>
        Degraded detayları {degradedCount > 0 ? `(${degradedCount} sorunlu kaynak)` : '(tümü sağlıklı)'}
      </summary>
      <ul style={{ marginTop: 8 }}>
        {rows.map((row) => (
          <li key={row.key}>
            <strong>{row.label}</strong>: {row.degraded ? '⚠️ degraded' : '✅ ok'}
          </li>
        ))}
      </ul>
    </details>
  )
}
