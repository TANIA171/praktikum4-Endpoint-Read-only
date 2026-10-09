# Praktikum Minggu 4 — Read-only Laravel API

## Resource
Book

## Endpoint
- GET /api/books
- GET /api/books/{book}

## Verifikasi
- 200 Daftar Buku — Berhasil
- 200 Detail Buku — Berhasil
- 404 Buku Tidak Ditemukan — Berhasil

## Perbandingan dengan Contract
Actual response sudah sesuai dengan API Contract Minggu 3:
- Struktur dibungkus di dalam `data` 
- Nama kolom: `id`, `title`, `isbn`, `author_name`, `published_year`, `available`, `created_at` 
- Tipe data: `id` bilangan bulat, `available` bernilai boolean 
- Status 404 mengembalikan `message` dan `errors: null` sesuai kesepakatan 

## Bukti Pengujian
- **List Books** → menampilkan 2 buku, urut berdasarkan id
- **Show Book id 1** → menampilkan data buku "Clean Code"
- **Show Book id 999999** → mengembalikan status 404 dengan pesan "Book not found"

## Refleksi
- Rute di `routes/api.php` menentukan alamat URL endpoint
- Migration menentukan struktur tabel dan tipe data di database
- Membandingkan respons penting agar sisi klien dan server tetap memahami format yang sama
- Daftar kosong tetap mengembalikan 200 dengan array kosong, bukan 404, karena rute-nya benar
- Penggunaan API Resource di Minggu 5 akan menyederhanakan pembentukan respons

## Referensi
- Dokumentasi Laravel — Rute: https://laravel.com/docs/routing
- Dokumentasi Laravel — Controller: https://laravel.com/docs/controllers
- Dokumentasi Laravel — Eloquent: https://laravel.com/docs/eloquent
- Dokumentasi Laravel — Migration: https://laravel.com/docs/migrations
- Dokumentasi Laravel — Seeding: https://laravel.com/docs/seeding