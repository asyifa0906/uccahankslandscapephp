# UCCHANK'S LANDSCAPE

Website UCCHANK'S LANDSCAPE merupakan aplikasi web untuk usaha jasa pembuatan taman dan kolam. Website ini membantu pengunjung melihat informasi layanan dan produk serta mengirimkan konsultasi. Halaman admin digunakan untuk mengelola data jasa, produk, dan konsultasi yang masuk.

## Fitur Aplikasi

### Halaman Pengunjung
- **Home** — menampilkan informasi umum mengenai UCCHANK'S LANDSCAPE.
- **Jasa Kami** — menampilkan layanan yang tersedia dan menyediakan akses ke konsultasi jasa.
- **Produk Kami** — menampilkan produk dalam kategori Tanaman & Bunga dan Rumput.
- **Kontak** — menampilkan informasi kontak dan form konsultasi.
- **Konsultasi** — memungkinkan pengunjung menyampaikan kebutuhan melalui formulir yang tersedia.

### Halaman Admin
- **Login** — membatasi akses ke halaman pengelolaan admin.
- **Dashboard** — menampilkan ringkasan data yang dikelola.
- **Pengelolaan Jasa** — menambah, melihat, mengubah, dan menghapus data jasa.
- **Pengelolaan Produk** — mengelola produk kategori Tanaman & Bunga dan Rumput.
- **Pengelolaan Konsultasi** — melihat konsultasi, memperbarui status, dan menghapus data konsultasi.
- **Logout** — mengakhiri sesi admin.

## Teknologi yang Digunakan

- PHP
- MySQL/MariaDB
- HTML
- CSS
- JavaScript
- XAMPP sebagai lingkungan pengembangan lokal

## Persyaratan

Sebelum menjalankan aplikasi, pastikan perangkat sudah memiliki:

- XAMPP atau lingkungan server lokal sejenis yang menyediakan Apache, PHP, dan MySQL/MariaDB.
- Browser web, seperti Google Chrome atau Microsoft Edge.
- Berkas proyek website dan berkas ekspor database SQL.

## Cara Menjalankan Aplikasi

### 1. Salin proyek ke folder web server

Letakkan folder proyek di direktori `htdocs` XAMPP. Contoh lokasi di Windows:

```text
C:\xampp\htdocs\usahatamankolam
```

Jika nama folder proyek berbeda, sesuaikan alamat pada langkah berikutnya.

### 2. Jalankan XAMPP

1. Buka XAMPP Control Panel.
2. Klik **Start** pada modul **Apache**.
3. Klik **Start** pada modul **MySQL**.

Pastikan kedua modul berjalan sebelum membuka website.

### 3. Buat database

1. Buka `http://localhost/phpmyadmin/` di browser.
2. Buat database dengan nama:

   ```text
   ucchankslandscape
   ```

3. Pilih database tersebut.
4. Buka tab **Import**.
5. Pilih berkas ekspor database proyek dengan ekstensi `.sql`, kemudian jalankan proses impor.

> **Catatan:** Berkas SQL perlu disertakan dalam repositori atau disediakan terpisah agar database dapat dipulihkan. Jika nama berkas SQL berbeda, gunakan berkas yang sesuai dengan proyek.

### 4. Periksa konfigurasi database

Buka berkas `config/db.php` dan pastikan konfigurasi sesuai dengan pengaturan MySQL lokal. Konfigurasi pengembangan XAMPP yang umum digunakan adalah:

```php
<?php
$conn = mysqli_connect("localhost", "root", "", "ucchankslandscape");

if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8mb4");
?>
```

Apabila username, password, host, atau nama database di perangkat berbeda, sesuaikan nilainya. Jangan memasukkan kredensial produksi ke repositori publik.

### 5. Buka website

Buka alamat berikut di browser:

- **Halaman pengunjung:** `http://localhost/usahatamankolam/`
- **Login admin:** `http://localhost/usahatamankolam/admin/login.php`

Jika nama folder proyek berbeda, ganti bagian `usahatamankolam` pada alamat URL sesuai nama folder tersebut.

### 6. Login ke halaman admin

Buka halaman login admin dan masukkan username serta password admin yang sudah terdaftar. Gunakan akun yang dibuat untuk instalasi lokal. Jangan membagikan kredensial admin dalam README atau repositori publik.

## Struktur Folder Utama

```text
usahatamankolam/
├── admin/
│   ├── index.php
│   ├── jasa/
│   ├── produk/
│   │   ├── tanaman-bunga/
│   │   └── rumput/
│   ├── konsultasi/
│   └── css/
│       └── admin.css
├── config/
│   └── db.php
├── index.php
├── jasa.php
├── produk.php
├── kontak.php
├── script.js
├── konsultasi.js
└── simpan_konsultasi.php
```

Struktur di atas merangkum folder dan berkas utama. Berkas lain dapat tersedia sesuai versi proyek.

## Alur Singkat Aplikasi

1. Pengunjung membuka halaman website untuk melihat jasa dan produk.
2. Pengunjung mengisi dan mengirim form konsultasi.
3. Aplikasi memproses data konsultasi melalui PHP dan menyimpannya ke database.
4. Admin login untuk memeriksa serta mengelola data jasa, produk, dan konsultasi.
5. Admin logout setelah selesai menggunakan halaman pengelolaan.

## Pemecahan Masalah Umum

- **Website tidak dapat dibuka:** pastikan Apache aktif dan folder proyek berada di dalam `htdocs`.
- **Koneksi database gagal:** pastikan MySQL aktif, database sudah dibuat, dan konfigurasi `config/db.php` benar.
- **Tabel atau data tidak ditemukan:** pastikan berkas SQL yang sesuai sudah diimpor ke database `ucchankslandscape`.
- **Login admin gagal:** periksa kembali username dan password akun admin yang terdaftar.
- **Konsultasi tidak terkirim:** pastikan MySQL aktif, kolom formulir sudah diisi sesuai ketentuan, dan periksa pesan kesalahan yang muncul.

## Keamanan

- Gunakan akun admin yang kuat dan jangan membagikan password.
- Jangan mengunggah kredensial, password, atau data pelanggan ke repositori publik.
- Sebelum digunakan di server publik, tinjau kembali pengaturan autentikasi, validasi masukan, hak akses, dan konfigurasi server.

## Pengembang

- **Nama:** Asyifa Nur Cahya Kamila
- **Kelas:** Teknik Komputer C
- **Program Studi:** Teknik Komputer
- **Universitas:** Universitas Negeri Makassar

> Isi README ini perlu disesuaikan jika nama folder, berkas database, atau fitur proyek berubah.
