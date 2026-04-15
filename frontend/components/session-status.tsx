'use client'

import { useEffect, useState } from 'react'

type SessionUser = {
  ID: number
  kullanici: string
  adsoyad: string
  yetki: string
}

type PermissionMap = Record<string, boolean>

const API_BASE = process.env.NEXT_PUBLIC_API_BASE_URL ?? 'http://localhost:8000/api'

export function SessionStatus() {
  const [user, setUser] = useState<SessionUser | null>(null)
  const [permissions, setPermissions] = useState<PermissionMap | null>(null)
  const [loading, setLoading] = useState(true)

  async function loadSession() {
    setLoading(true)

    try {
      const response = await fetch(`${API_BASE}/auth/bootstrap`, {
        credentials: 'include',
        cache: 'no-store',
      })

      if (!response.ok) {
        setUser(null)
        setPermissions(null)
        setLoading(false)
        return
      }

      const data = (await response.json()) as {
        authenticated?: boolean
        user?: SessionUser
        permissions?: PermissionMap
      }

      setUser(data.authenticated ? (data.user ?? null) : null)
      setPermissions(data.permissions ?? null)
    } catch {
      setUser(null)
      setPermissions(null)
    }

    setLoading(false)
  }

  async function logout() {
    try {
      await fetch(`${API_BASE}/auth/logout`, {
        method: 'POST',
        credentials: 'include',
      })
    } finally {
      await loadSession()
    }
  }

  useEffect(() => {
    void loadSession()
  }, [])

  if (loading) return <p>Oturum kontrol ediliyor...</p>
  if (!user) return <p>Aktif oturum yok.</p>

  const grantedCount = permissions ? Object.values(permissions).filter(Boolean).length : 0

  return (
    <div style={{ marginBottom: 12 }}>
      <p>
        Aktif kullanıcı: <strong>{user.adsoyad}</strong> ({user.kullanici}) - Yetki: {user.yetki}
      </p>
      <p>Yetki özeti: {grantedCount} izin aktif.</p>
      <button type="button" onClick={logout}>
        Çıkış Yap
      </button>
    </div>
  )
}
