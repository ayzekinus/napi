import type { DashboardDegradedMap } from '@/lib/api'

export function DashboardDegradedDetails({ degradedMap }: { degradedMap: DashboardDegradedMap }) {
  const rows = Object.entries(degradedMap)

  return (
    <details style={{ marginBottom: 12 }}>
      <summary>Degraded detayları</summary>
      <ul style={{ marginTop: 8 }}>
        {rows.map(([key, value]) => (
          <li key={key}>
            <strong>{key}</strong>: {value ? 'degraded' : 'ok'}
          </li>
        ))}
      </ul>
    </details>
  )
}
