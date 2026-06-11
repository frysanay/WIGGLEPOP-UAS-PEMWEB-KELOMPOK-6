# Wigglepop - Website Aksesori Handmade 🎀

[![Laravel Version](https://img.shields.io/badge/Laravel-12.x-red.svg)](https://laravel.com)
[![Tailwind CSS Version](https://img.shields.io/badge/TailwindCSS-v4.0-blue.svg)](https://tailwindcss.com)
[![PHP Version](https://img.shields.io/badge/PHP-%3E%3D%208.2-777bb4.svg)](https://php.net)
[![Vite Version](https://img.shields.io/badge/Vite-7.x-646cff.svg)](https://vitejs.dev)

Aplikasi web E-Commerce dan Custom Order modern untuk penjualan aksesori handmade seperti **bagcharm, bracelet, keychain, dan phonestrap**. Project ini dirancang dengan antarmuka yang lucu, cantik, dan interaktif menggunakan perpaduan teknologi Laravel 12 dan Tailwind CSS v4.

Project ini dibuat dan dikembangkan sebagai tugas **Ujian Akhir Semester (UAS)** untuk mata kuliah **Pemrograman Web**.

---

## 👥 Tim Pengembang (Kelompok UAS)

<table align="center">
  <tr>
    <th>Nama Anggota</th>
    <th>NIM</th>
  </tr>
  <tr>
    <td><b>Elia Rifana Rif'an</b></td>
    <td><code>24091397139</code></td>
  </tr>
  <tr>
    <td><b>Berliana Nidia Meiningrum</b></td>
    <td><code>24091397142</code></td>
  </tr>
  <tr>
    <td><b>Anindya Calista Raniah</b></td>
    <td><code>24091397157</code></td>
  </tr>
  <tr>
    <td><b>Frysa Nayla Ayu</b></td>
    <td><code>24091397162</code></td>
  </tr>
</table>

---

## 🚀 Fitur Utama

### 🛍️ Sisi Pelanggan (User Interface)
* **Landing Page Menarik**: Tampilan modern pastel bertema estetik dengan slider testimoni, kategori pilihan, dan call-to-action (CTA) interaktif.
* **Katalog & Kategori Produk**: Filter produk berdasarkan kategori dengan navigasi slug yang ramah SEO.
* **Sistem Wishlist**: Pengguna dapat menyimpan dan menandai aksesori favorit mereka ke halaman wishlist pribadi.
* **Keranjang Belanja (Shopping Cart)**: Menambah, memperbarui, dan menghapus produk di keranjang secara dinamis sebelum proses checkout.
* **Proses Checkout & Transaksi**: Formulir alamat pengiriman, penghitungan total harga otomatis, dan pelacakan transaksi.
* **Custom Desain Sendiri (Custom Order) 🎨**: Pengguna dapat memesan aksesori kustom dengan mengunggah gambar referensi, memberikan rincian deskripsi, dan menentukan budget awal mereka. Setelah disetujui admin, pengguna dapat mengunggah bukti pembayaran untuk memulai proses pengerjaan.
* **Formulir Kontak (Contact Us)**: Mengirimkan keluhan, saran, atau pertanyaan langsung ke panel admin.
* **Manajemen Profil**: Pengguna dapat memperbarui data diri seperti alamat pengiriman, nomor telepon, dan password.

### ⚙️ Sisi Administrator (Admin Panel)
* **Dashboard Statistik**: Rangkuman total penjualan, jumlah produk aktif, pesan masuk yang belum dibaca, dan grafik visual ringkas.
* **Manajemen Produk (CRUD & Soft Delete)**: Tambah, edit, hapus, serta fitur restore produk yang telah dihapus sebelumnya. Mendukung upload gambar produk dinamis.
* **Manajemen Kategori (CRUD)**: Kelola kategori produk dengan gambar penjelas tersendiri.
* **Manajemen Pesanan (Order Management)**: Lihat rincian pesanan dari pelanggan, verifikasi bukti pembayaran, dan ubah status pengiriman.
* **Manajemen Pesanan Kustom (Custom Order Admin)**: Tinjau proposal custom order dari pengguna, tentukan harga akhir (final price) yang sesuai, berikan catatan admin, serta kelola proses pembuatan hingga selesai.
* **Manajemen Pengguna (User Management)**: Lihat daftar pelanggan terdaftar dan aktifkan atau nonaktifkan akun mereka secara instan.
* **Manajemen Pesan Pelanggan (Inbox)**: Lihat pesan yang masuk dari formulir kontak, tandai sebagai dibaca, atau hapus pesan lama.
* **Manajemen Profil Admin**: Edit informasi bio dan tautan sosial media admin yang tampil di footer atau kontak.

---

## 🛠️ Tech Stack & Dependencies

* **Backend Framework**: [Laravel 12](https://laravel.com)
* **Frontend Styling**: [Tailwind CSS v4](https://tailwindcss.com) (dengan plugin `@tailwindcss/vite`)
* **Assets Bundler**: [Vite 7](https://vite.dev)
* **Icons Library**: [Lucide Icons](https://lucide.dev)
* **Database**: MySQL / SQLite (mendukung migrasi bawaan Laravel)
* **Javascript Utility**: Axios & Vanilla JS

---

## 💻 Langkah Instalasi & Pengoperasian Lokal

Ikuti langkah-langkah di bawah ini untuk memasang dan menjalankan project ini di komputer lokal Anda:

### Prasyarat Sistem
Pastikan sistem komputer Anda sudah terpasang:
1. PHP versi **8.2** atau lebih baru (dengan ekstensi yang diperlukan).
2. [Composer](https://getcomposer.org/)
3. [Node.js & npm](https://nodejs.org/)

---

### Langkah Instalasi

1. **Masuk ke Direktori Project**:
   ```bash
   cd wigglepop-laravel
   ```

2. **Jalankan Perintah Setup Otomatis**:
   Kami telah menyediakan script kustom di dalam `composer.json` untuk mengotomatisasi seluruh proses setup (instalasi dependensi PHP & Node, copy `.env`, generate key, migrasi database, dan build assets). Cukup jalankan:
   ```bash
   composer run setup
   ```

3. **Cara Manual (Jika Setup Otomatis Bermasalah)**:
   Jika terjadi kendala pada perintah di atas, jalankan langkah-langkah manual berikut:
   ```bash
   # 1. Install dependensi PHP
   composer install

   # 2. Salin file konfigurasi environment
   copy .env.example .env

   # 3. Generate Application Key
   php artisan key:generate

   # 4. Jalankan migrasi database beserta data seeder dummy
   php artisan migrate --seed

   # 5. Install dependensi JavaScript/CSS
   npm install

   # 6. Kompilasi asset untuk produksi
   npm run build
   ```

4. **Jalankan Aplikasi**:
   Jalankan server pengembangan PHP dan Vite compiler secara bersamaan dengan perintah:
   ```bash
   composer run dev
   ```
   *(Perintah ini memanfaatkan package `concurrently` untuk mempermudah menjalankan server `php artisan serve` dan `npm run dev` dalam satu terminal).*

5. **Akses Aplikasi**:
   Buka browser Anda dan navigasikan ke alamat:
   [http://127.0.0.1:8000](http://127.0.0.1:8000)

---

## 🔑 Akun Uji Coba (Dummy Credentials)

Agar memudahkan proses pengujian dan penilaian, gunakan akun dummy berikut yang telah disiapkan di seeder database:

### 💼 Akun Administrator (Akses Dashboard Admin)
* **Email**: `admin@wigglepop.com`
* **Password**: `password`

### 👤 Akun Pelanggan (Akses Belanja & Custom Order)
* **Email**: `user@wigglepop.com`
* **Password**: `password`

---

## 🗄️ Skema Database & Hubungan Relasi

Aplikasi ini menggunakan model data relasional Laravel (Eloquent) dengan struktur tabel berikut:
* `users`: Menyimpan kredensial pengguna, alamat, nomor telepon, dan penentuan role (`admin` atau `user`).
* `admin_profiles`: Menyimpan info tambahan khusus manager toko (bio, link media sosial).
* `categories`: Pengelompokan produk aksesori.
* `products`: Data produk yang siap dijual di katalog (nama, harga, deskripsi, gambar, stok).
* `wishlists`: Penghubung relasi favorit pengguna terhadap produk.
* `orders` & `order_items`: Informasi transaksi pembelian produk katalog dan rincian item pesanan.
* `custom_orders`: Detail pesanan kustom buatan pelanggan, memuat deskripsi rancangan, foto referensi, budget, penetapan harga dari admin, status pembayaran, dan status progress pembuatan.
* `contacts`: Tempat penyimpanan pesan dari form kontak support.
