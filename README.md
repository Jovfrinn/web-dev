# TrendStore — Platform E-Commerce TEFA Sekolah

> Solusi digital untuk unit usaha TEFA (Teaching Factory) agar siswa dan pelanggan dapat mengecek produk, stok, dan harga secara online — tanpa harus datang langsung ke tempat.

---

## Latar Belakang

Unit usaha TEFA di sekolah seringkali menghadapi masalah klasik: pelanggan (siswa, guru, maupun masyarakat sekitar) harus **datang langsung** ke lokasi hanya untuk mengetahui produk apa yang tersedia, berapa stoknya, dan berapa harganya. Hal ini tidak efisien dan membatasi jangkauan penjualan.

**TrendStore** hadir sebagai solusi — sebuah platform e-commerce berbasis web yang memungkinkan pelanggan browsing produk, menambahkan ke keranjang, dan melakukan pembayaran kapan saja dan dari mana saja.

---

## Fitur Utama

### Untuk Pelanggan
- **Katalog Produk** — Tampilan produk dengan foto, harga, dan stok real-time
- **Filter Kategori & Pencarian** — Cari produk berdasarkan nama atau kategori
- **Keranjang Belanja** — Tambah, ubah kuantitas, dan hapus item
- **Checkout & Pembayaran Online** — Integrasi **Midtrans** (transfer bank, QRIS, kartu kredit, dll.)
- **Riwayat Pesanan** — Pantau status pesanan dari pending hingga delivered
- **Wishlist** — Simpan produk favorit untuk dibeli nanti
- **Review Produk** — Berikan ulasan setelah pembelian
- **Profil Pengguna** — Kelola data akun dan password

### Untuk Admin / Pengelola TEFA
- **Dashboard Analytics** — Ringkasan pendapatan, total pesanan, produk terlaris, dan stok menipis
- **Manajemen Produk** — CRUD produk lengkap dengan upload multi-foto
- **Manajemen Stok** — Update stok per produk dengan riwayat perubahan
- **Manajemen Pesanan** — Proses pesanan dan update status (pending → processing → shipped → delivered)
- **Manajemen Kategori** — Tambah, edit, hapus kategori produk
- **Manajemen Pengguna** — Kelola akun dan hak akses (Admin / Super Admin / Customer)

---

## Tech Stack

| Layer | Teknologi |
|---|---|
| Backend | PHP 8.1, Laravel 10 |
| Frontend | Blade Templating, Bootstrap, Vite |
| Database | MySQL |
| Payment Gateway | Midtrans |
| Authentication | Laravel Auth (session-based) |
| Server | Apache / Nginx |

---

## Screenshot

> *(Tambahkan screenshot aplikasi di sini untuk memperkuat portofolio)*

---

## Cara Instalasi (Development)

### Prasyarat
- PHP >= 8.1
- Composer
- Node.js & NPM
- MySQL

### Langkah-langkah

```bash
# 1. Clone repository
git clone <url-repo>
cd web-dev

# 2. Install dependencies
composer install
npm install

# 3. Konfigurasi environment
cp .env.example .env
php artisan key:generate

# 4. Sesuaikan database di .env
# DB_DATABASE=tefa_db
# DB_USERNAME=root
# DB_PASSWORD=

# 5. Konfigurasi Midtrans di .env
# MIDTRANS_SERVER_KEY=your_server_key
# MIDTRANS_CLIENT_KEY=your_client_key
# MIDTRANS_IS_PRODUCTION=false

# 6. Jalankan migrasi & seeder
php artisan migrate --seed

# 7. Build assets
npm run dev

# 8. Jalankan server
php artisan serve
```

Akses aplikasi di `http://localhost:8000`

### Akun Default (setelah seeder)

| Role | Email | Password |
|---|---|---|
| Super Admin | admin@tefa.com | password |
| Customer | customer@tefa.com | password |

---

## Struktur Role

- **Customer** — Dapat browsing, beli produk, dan lihat riwayat pesanan
- **Admin** — Kelola produk, stok, dan pesanan
- **Super Admin** — Semua akses Admin + kelola pengguna dan role

---

## Tentang Pengembang

Dibangun sebagai proyek nyata untuk mendukung digitalisasi unit usaha TEFA di lingkungan sekolah.

Dikembangkan dengan Laravel 10 mengikuti arsitektur MVC, role-based access control, dan payment gateway Midtrans untuk transaksi yang aman dan terpercaya.

---

> Tertarik dengan proyek serupa? Hubungi saya untuk diskusi lebih lanjut.
