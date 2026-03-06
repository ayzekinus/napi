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
import { DashboardDegradedDetails } from '@/components/dashboard-degraded-details'
import {
  getDashboardBootstrapFull,
} from '@/lib/api'

export default async function HomePage() {
  const bootstrap = await getDashboardBootstrapFull(10)

  return (
    <main style={{ fontFamily: 'sans-serif', padding: 24 }}>
      <h1>NAPI - Django + Next.js Migration Dashboard</h1>
      <p>Legacy modülleri kademeli olarak yeni altyapıya taşıyoruz.</p>

      <p>
        <a href="/login">Legacy uyumlu giriş ekranı</a>
      </p>
      <SessionStatus />
      <DashboardDegradedAlert degraded={bootstrap.degraded} />
      <DashboardDegradedDetails degradedMap={bootstrap.degraded_map} />
      <DashboardSummaryCards summary={bootstrap.summary} />
      <ModuleStatusList items={bootstrap.modules} />
      <AnakodPreviewTable items={bootstrap.data.anakod} />
      <BuluntuPreviewTable items={bootstrap.data.buluntu} />
      <DemirbasPreviewTable items={bootstrap.data.demirbas} />
      <EvrakPreviewTable items={bootstrap.data.evrak} />
      <AcmaRaporPreviewTable items={bootstrap.data.acma_rapor} />
      <KullanicilarPreviewTable items={bootstrap.data.kullanicilar} />
    </main>
  )
}
