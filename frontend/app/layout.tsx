import './globals.css'

export const metadata = {
  title: 'NAPI Migration Dashboard',
  description: 'Django + Next.js migration preview UI',
}

export default function RootLayout({
  children,
}: {
  children: React.ReactNode
}) {
  return (
    <html lang="tr">
      <body>{children}</body>
    </html>
  )
}
