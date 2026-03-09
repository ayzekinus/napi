import type { ModuleInventoryItem } from '@/lib/api'

export function ModuleStatusList({ items }: { items: ModuleInventoryItem[] }) {
  return (
    <section>
      <h2>Modül Geçiş Durumu</h2>
      <ul>
        {items.map((item) => (
          <li key={item.key}>
            <strong>{item.key}</strong>: {item.status}
          </li>
        ))}
      </ul>
    </section>
  )
}
