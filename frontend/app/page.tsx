import { AnakodPreviewTable } from '@/components/anakod-preview-table'
import { BuluntuPreviewTable } from '@/components/buluntu-preview-table'
import { ModuleStatusList } from '@/components/module-status-list'
import { getAnakodList, getBuluntuList, getModuleInventory } from '@/lib/api'

export default async function HomePage() {
  const [modules, anakodItems, buluntuItems] = await Promise.all([
    getModuleInventory(),
    getAnakodList(10),
    getBuluntuList(10),
  ])

  return (
    <main style={{ fontFamily: 'sans-serif', padding: 24 }}>
      <h1>NAPI - Django + Next.js Migration Dashboard</h1>
      <p>Legacy modülleri kademeli olarak yeni altyapıya taşıyoruz.</p>

      <ModuleStatusList items={modules} />
      <AnakodPreviewTable items={anakodItems} />
      <BuluntuPreviewTable items={buluntuItems} />
    </main>
  )
}
