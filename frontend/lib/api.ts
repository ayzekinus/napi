export type ModuleInventoryItem = {
  key: string
  status: 'planned' | 'in_progress' | 'done'
}

export type AnakodItem = {
  anakod_id: number
  anakod: string
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
