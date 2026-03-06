'use client'

import { useEffect, useState } from 'react'

type SessionUser = {
  ID: number
  kullanici: string
  adsoyad: string
  yetki: string
}

const API_BASE = process.env.NEXT_PUBLIC_API_BASE_URL ?? 'http://localhost:8000/api'

export function SessionStatus() {
  const [user, setUser] = useState<SessionUser | null>(null)
  const [loading, setLoading] = useState(true)

  async function loadSession() {
    setLoading(true)
    const response = await fetch(`${API_BASE}/auth/session`, {
      credentials: 'include',
      cache: 'no-store',
    })

    if (!response.ok) {
      setUser(null)
      setLoading(false)
      return
    }

    const data = (await response.json()) as { authenticated?: boolean; user?: SessionUser }
    setUser(data.authenticated ? (data.user ?? null) : null)
    setLoading(false)
  }

  async function logout() {
    await fetch(`${API_BASE}/auth/logout`, {
      method: 'POST',
      credentials: 'include',
    })
    await loadSession()
  }

  useEffect(() => {
    void loadSession()
  }, [])

  if (loading) return <p>Oturum kontrol ediliyor...</p>
  if (!user) return <p>Aktif oturum yok.</p>

  return (
    <div>
      <p>
        Aktif kullanıcı: <strong>{user.adsoyad}</strong> ({user.kullanici}) - Yetki: {user.yetki}
      </p>
      <button type="button" onClick={logout}>
        Çıkış Yap
      </button>
    </div>
  )
}
