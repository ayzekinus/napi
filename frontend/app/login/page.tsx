'use client'

import { FormEvent, useState } from 'react'

const API_BASE = process.env.NEXT_PUBLIC_API_BASE_URL ?? 'http://localhost:8000/api'

export default function LoginPage() {
  const [username, setUsername] = useState('')
  const [password, setPassword] = useState('')
  const [message, setMessage] = useState<string | null>(null)

  async function onSubmit(event: FormEvent<HTMLFormElement>) {
    event.preventDefault()
    setMessage('Giriş kontrol ediliyor...')

    const response = await fetch(`${API_BASE}/auth/login`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      credentials: 'include',
      body: JSON.stringify({ username, password }),
    })

    if (response.ok) {
      setMessage('Giriş başarılı. Dashboard sayfasına dönebilirsiniz.')
      return
    }

    setMessage('Giriş başarısız. Kullanıcı adı/şifre kontrol edin.')
  }

  return (
    <main style={{ fontFamily: 'sans-serif', padding: 24, maxWidth: 420 }}>
      <h1>Legacy Uyumlu Giriş</h1>
      <form onSubmit={onSubmit}>
        <label>
          Kullanıcı adı
          <input value={username} onChange={(e) => setUsername(e.target.value)} style={{ display: 'block', width: '100%', marginBottom: 12 }} />
        </label>
        <label>
          Şifre
          <input type="password" value={password} onChange={(e) => setPassword(e.target.value)} style={{ display: 'block', width: '100%', marginBottom: 12 }} />
        </label>
        <button type="submit">Giriş yap</button>
      </form>
      {message && <p>{message}</p>}
    </main>
  )
}
