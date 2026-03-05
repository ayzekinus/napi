export default function HomePage() {
  return (
    <main style={{ fontFamily: 'sans-serif', padding: 24 }}>
      <h1>NAPI - Yeni Frontend Başlangıcı</h1>
      <p>Bu proje, legacy PHP sistemden Next.js + Django mimarisine geçiş için başlatıldı.</p>
      <ul>
        <li>Backend health: <code>/api/health</code></li>
        <li>Module inventory: <code>/api/modules/inventory</code></li>
      </ul>
    </main>
  )
}
