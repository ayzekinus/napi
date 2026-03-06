import { AcmaRaporPreviewTable } from '@/components/acma-rapor-preview-table'
import { AnakodPreviewTable } from '@/components/anakod-preview-table'
import { BuluntuPreviewTable } from '@/components/buluntu-preview-table'
import { DemirbasPreviewTable } from '@/components/demirbas-preview-table'
import { DashboardSummaryCards } from '@/components/dashboard-summary-cards'
import { EvrakPreviewTable } from '@/components/evrak-preview-table'
import { KullanicilarPreviewTable } from '@/components/kullanicilar-preview-table'
import { ModuleStatusList } from '@/components/module-status-list'
import { SessionStatus } from '@/components/session-status'
import { DashboardDegradedAlert } from '@/components/dashboard-degraded-alert'
import {
  getAcmaRaporList,
  getAnakodList,
  getBuluntuList,
  getDashboardSummary,
  getDemirbasList,
  getEvrakList,
  getKullanicilarList,
  getModuleInventory,
} from '@/lib/api'

export default async function HomePage() {
  const [modules, summaryResponse, anakodItems, buluntuItems, demirbasItems, evrakItems, acmaRaporItems, kullaniciItems] =
    await Promise.all([
      getModuleInventory(),
      getDashboardSummary(),
      getAnakodList(10),
      getBuluntuList(10),
      getDemirbasList(10),
      getEvrakList(10),
      getAcmaRaporList(10),
      getKullanicilarList(10),
    ])

  return (
    <main style={{ fontFamily: 'sans-serif', padding: 24 }}>
      <h1>NAPI - Django + Next.js Migration Dashboard</h1>
      <p>Legacy modülleri kademeli olarak yeni altyapıya taşıyoruz.</p>

      <p>
        <a href="/login">Legacy uyumlu giriş ekranı</a>
      </p>
      <SessionStatus />
      <DashboardDegradedAlert degraded={summaryResponse.degraded} />
      <DashboardSummaryCards summary={summaryResponse.summary} />
      <ModuleStatusList items={modules} />
      <AnakodPreviewTable items={anakodItems} />
      <BuluntuPreviewTable items={buluntuItems} />
      <DemirbasPreviewTable items={demirbasItems} />
      <EvrakPreviewTable items={evrakItems} />
      <AcmaRaporPreviewTable items={acmaRaporItems} />
      <KullanicilarPreviewTable items={kullaniciItems} />
    </main>
  )
}
