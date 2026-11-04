# Chiamonshop Store

**Chiamonshop Store** adalah sebuah aplikasi web berbasis Laravel yang dirancang untuk mendukung operasional toko Chiamonshop, yang bergerak di bidang penjualan pakan ikan. Aplikasi ini saat ini digunakan untuk mencatat penjualan, mencatat harga barang, serta menghasilkan laporan keuntungan.

---

## 🎯 Tujuan Proyek

Membuat sebuah landing page dan sistem pencatatan internal untuk membantu operasional toko Chiamonshop secara digital, terutama dalam:

-   Pencatatan penjualan harian
-   Manajemen harga barang
-   Laporan keuntungan toko

---

## 🛠️ Tech Stack

-   PHP 8.3 atau lebih baru (PHP 8.5 direkomendasikan)
-   [Laravel](https://laravel.com/) (versi terbaru)
-   MySQL
-   Bootstrap (opsional jika dipakai)
-   Blade Templating Engine

---

## 🚀 Fitur Utama

-   ✅ Halaman landing toko
-   ✅ CRUD data barang dan harga
-   ✅ Pencatatan transaksi penjualan
-   ✅ Laporan keuntungan berdasarkan periode
-   ✅ Riwayat penjualan
-   (Pengembangan lanjutan akan ditambahkan seiring kebutuhan toko)

---

## ⚙️ Cara Instalasi

Pastikan sudah menginstal Composer, PHP 8.3 atau lebih baru (PHP 8.5 direkomendasikan), dan MySQL. Pastikan PHP CLI yang digunakan Composer dan Artisan juga sesuai (`php -v`). Pada macOS dengan Homebrew, dahulukan PHP Homebrew di `PATH`, misalnya `export PATH="/opt/homebrew/opt/php/bin:$PATH"`. Kemudian ikuti langkah-langkah berikut:

```bash
git clone https://github.com/username/chiamonshop-store.git
cd chiamonshop-store

# Install dependency Laravel
composer install

# Salin file .env dan atur konfigurasi database
cp .env.example .env

# Generate app key
php artisan key:generate

# Buat database dan jalankan migrasi
php artisan migrate

# (Opsional) Seed data awal jika tersedia
php artisan db:seed

# Jalankan aplikasi
php artisan serve
```
