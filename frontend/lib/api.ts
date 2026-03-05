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

export type AcmaRaporItem = {
  acma_rapor_id: number
  acma_rapor_no: string
  sezon: string
}

const API_BASE = process.env.NEXT_PUBLIC_API_BASE_URL ?? 'http://localhost:8000/api'

export async function getModuleInventory(): Promise<ModuleInventoryItem[]> {
  const response = await fetch(`${API_BASE}/modules/inventory`, {
    cache: 'no-store',
  })
  if (!response.ok) {
    return []
  }

  const data = (await response.json()) as { modules?: ModuleInventoryItem[] }
  return data.modules ?? []
}

export async function getAnakodList(limit = 10): Promise<AnakodItem[]> {
  const response = await fetch(`${API_BASE}/modules/anakod?limit=${limit}`, {
    cache: 'no-store',
  })

  if (!response.ok) {
    return []
  }

  const data = (await response.json()) as { items?: AnakodItem[] }
  return data.items ?? []
}

export async function getBuluntuList(limit = 10): Promise<BuluntuItem[]> {
  const response = await fetch(`${API_BASE}/modules/buluntu?limit=${limit}`, {
    cache: 'no-store',
  })

  if (!response.ok) {
    return []
  }

  const data = (await response.json()) as { items?: BuluntuItem[] }
  return data.items ?? []
}

export async function getEvrakList(limit = 10): Promise<EvrakItem[]> {
  const response = await fetch(`${API_BASE}/modules/evrak?limit=${limit}`, {
    cache: 'no-store',
  })

  if (!response.ok) {
    return []
  }

  const data = (await response.json()) as { items?: EvrakItem[] }
  return data.items ?? []
}

export async function getAcmaRaporList(limit = 10): Promise<AcmaRaporItem[]> {
  const response = await fetch(`${API_BASE}/modules/acma-rapor?limit=${limit}`, {
    cache: 'no-store',
  })

  if (!response.ok) {
    return []
  }

  const data = (await response.json()) as { items?: AcmaRaporItem[] }
  return data.items ?? []
}
