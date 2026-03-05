import { AcmaRaporPreviewTable } from '@/components/acma-rapor-preview-table'
import { AnakodPreviewTable } from '@/components/anakod-preview-table'
import { BuluntuPreviewTable } from '@/components/buluntu-preview-table'
import { EvrakPreviewTable } from '@/components/evrak-preview-table'
import { ModuleStatusList } from '@/components/module-status-list'
import {
  getAcmaRaporList,
  getAnakodList,
  getBuluntuList,
  getEvrakList,
  getModuleInventory,
} from '@/lib/api'

export default async function HomePage() {
  const [modules, anakodItems, buluntuItems, evrakItems, acmaRaporItems] = await Promise.all([
    getModuleInventory(),
    getAnakodList(10),
    getBuluntuList(10),
    getEvrakList(10),
    getAcmaRaporList(10),
  ])

  return (
    <main style={{ fontFamily: 'sans-serif', padding: 24 }}>
      <h1>NAPI - Django + Next.js Migration Dashboard</h1>
      <p>Legacy modülleri kademeli olarak yeni altyapıya taşıyoruz.</p>

      <p><a href="/login">Legacy uyumlu giriş ekranı</a></p>
      <ModuleStatusList items={modules} />
      <AnakodPreviewTable items={anakodItems} />
      <BuluntuPreviewTable items={buluntuItems} />
      <EvrakPreviewTable items={evrakItems} />
      <AcmaRaporPreviewTable items={acmaRaporItems} />
    </main>
  )
}
