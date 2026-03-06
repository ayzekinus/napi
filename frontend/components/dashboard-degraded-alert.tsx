export function DashboardDegradedAlert({ degraded }: { degraded: boolean }) {
  if (!degraded) {
    return null
  }

  return (
    <div
      style={{
        border: '1px solid #f0ad4e',
        background: '#fff8e5',
        color: '#8a6d3b',
        padding: '10px 12px',
        borderRadius: 8,
        marginBottom: 12,
      }}
    >
      Uyarı: Backend verisine kısmi erişim var (degraded mod). Gösterilen bazı sayılar/listeler eksik olabilir.
    </div>
  )
}
