export type ModuleInventoryItem = {
  key: string
  status: 'planned' | 'in_progress' | 'done'
}

export type AnakodItem = {
  anakod_id: number
  anakod: string
}

export type BuluntuItem = {
  bk_id: number
  bk_anakod_id: number
  buluntu_no: number | null
  envanterlik: boolean
}

export type EvrakItem = {
  evrak_id: number
  evrak_tipi: string
  evrak_no: string
  evrak_tarihi: string | null
}

export type DemirbasItem = {
  dl_id: number
  buluntu_id: number
  envanter_no: string
  durum: number
}

export type KullaniciItem = {
  ID: number
  adsoyad: string
  kullanici: string
  yetki: string
  durum: number
}

export type AcmaRaporItem = {
  acma_rapor_id: number
  acma_rapor_no: string
  sezon: string
}

export type DashboardSummary = {
  anakod: number
  buluntu: number
  acma_rapor: number
  evrak: number
  demirbas: number
  kullanicilar: number
}

export type DashboardSummaryResponse = {
  summary: DashboardSummary
  degraded: boolean
}

export type DashboardBootstrapResponse = {
  modules: ModuleInventoryItem[]
  summary: DashboardSummary
  degraded: boolean
}

export type DashboardBootstrapFullResponse = DashboardBootstrapResponse & {
  data: {
    anakod: AnakodItem[]
    buluntu: BuluntuItem[]
    demirbas: DemirbasItem[]
    evrak: EvrakItem[]
    acma_rapor: AcmaRaporItem[]
    kullanicilar: KullaniciItem[]
  }
}

const API_BASE = process.env.NEXT_PUBLIC_API_BASE_URL ?? 'http://localhost:8000/api'

async function safeFetchJson<T>(path: string): Promise<T | null> {
  try {
    const response = await fetch(`${API_BASE}${path}`, {
      cache: 'no-store',
    })

    if (!response.ok) {
      return null
    }

    return (await response.json()) as T
  } catch {
    return null
  }
}

export async function getModuleInventory(): Promise<ModuleInventoryItem[]> {
  const data = await safeFetchJson<{ modules?: ModuleInventoryItem[] }>('/modules/inventory')
  return data?.modules ?? []
}

export async function getAnakodList(limit = 10): Promise<AnakodItem[]> {
  const data = await safeFetchJson<{ items?: AnakodItem[] }>(`/modules/anakod?limit=${limit}`)
  return data?.items ?? []
}

export async function getBuluntuList(limit = 10): Promise<BuluntuItem[]> {
  const data = await safeFetchJson<{ items?: BuluntuItem[] }>(`/modules/buluntu?limit=${limit}`)
  return data?.items ?? []
}

export async function getEvrakList(limit = 10): Promise<EvrakItem[]> {
  const data = await safeFetchJson<{ items?: EvrakItem[] }>(`/modules/evrak?limit=${limit}`)
  return data?.items ?? []
}

export async function getAcmaRaporList(limit = 10): Promise<AcmaRaporItem[]> {
  const data = await safeFetchJson<{ items?: AcmaRaporItem[] }>(`/modules/acma-rapor?limit=${limit}`)
  return data?.items ?? []
}

export async function getDemirbasList(limit = 10): Promise<DemirbasItem[]> {
  const data = await safeFetchJson<{ items?: DemirbasItem[] }>(`/modules/demirbas?limit=${limit}`)
  return data?.items ?? []
}

export async function getKullanicilarList(limit = 10): Promise<KullaniciItem[]> {
  const data = await safeFetchJson<{ items?: KullaniciItem[] }>(`/modules/kullanicilar?limit=${limit}`)
  return data?.items ?? []
}

export async function getDashboardSummary(): Promise<DashboardSummaryResponse> {
  const fallbackSummary: DashboardSummary = {
    anakod: 0,
    buluntu: 0,
    acma_rapor: 0,
    evrak: 0,
    demirbas: 0,
    kullanicilar: 0,
  }

  const data = await safeFetchJson<{ summary?: DashboardSummary; degraded?: boolean }>('/modules/dashboard-summary')
  return {
    summary: data?.summary ?? fallbackSummary,
    degraded: data?.degraded ?? true,
  }
}


export async function getDashboardBootstrap(): Promise<DashboardBootstrapResponse> {
  const fallbackSummary: DashboardSummary = {
    anakod: 0,
    buluntu: 0,
    acma_rapor: 0,
    evrak: 0,
    demirbas: 0,
    kullanicilar: 0,
  }

  const data = await safeFetchJson<{
    modules?: ModuleInventoryItem[]
    summary?: DashboardSummary
    degraded?: boolean
  }>('/modules/bootstrap')

  return {
    modules: data?.modules ?? [],
    summary: data?.summary ?? fallbackSummary,
    degraded: data?.degraded ?? true,
  }
}


export async function getDashboardBootstrapFull(limit = 10): Promise<DashboardBootstrapFullResponse> {
  const fallbackSummary: DashboardSummary = {
    anakod: 0,
    buluntu: 0,
    acma_rapor: 0,
    evrak: 0,
    demirbas: 0,
    kullanicilar: 0,
  }

  const fallbackData = {
    anakod: [] as AnakodItem[],
    buluntu: [] as BuluntuItem[],
    demirbas: [] as DemirbasItem[],
    evrak: [] as EvrakItem[],
    acma_rapor: [] as AcmaRaporItem[],
    kullanicilar: [] as KullaniciItem[],
  }

  const data = await safeFetchJson<{
    modules?: ModuleInventoryItem[]
    summary?: DashboardSummary
    degraded?: boolean
    data?: DashboardBootstrapFullResponse['data']
  }>(`/modules/bootstrap-full?limit=${limit}`)

  return {
    modules: data?.modules ?? [],
    summary: data?.summary ?? fallbackSummary,
    degraded: data?.degraded ?? true,
    data: data?.data ?? fallbackData,
  }
}
