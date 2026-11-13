# Tugas 4 — Endpoint Read-only Laravel

## Tujuan
Menerapkan rancangan API Contract dari Minggu 3 menjadi titik akhir API yang dapat dijalankan nyata di Laravel, serta memastikan kesesuaian antara kesepakatan antarmuka dan hasil implementasi kode.

## Perubahan
- Menyiapkan struktur tabel `books` sesuai aturan kontrak: kolom `title`, `isbn`, `author_name`, `published_year`, `available`
- Membuat data pengujian berisi 2 buku
- Menyusun pengendali `BookController` dengan metode `index()` dan `show()`
- Mendaftarkan 2 rute baca-saja di `routes/api.php`
- Menguji respons nyata dan mencocokkan dengan contoh kontrak
- Memperbarui kumpulan permintaan di Postman
- Menyusun laporan pengujian

## Endpoint & Kontrak
| Metode | Alamat | Tujuan | Status Berhasil | Status Galat |
|---|---|---|---|---|
| GET | `/api/books` | Menampilkan daftar semua buku | 200 OK | — |
| GET | `/api/books/{book}` | Menampilkan rincian satu buku berdasarkan ID | 200 OK | 404 Not Found |

### Bentuk Respons — Daftar Buku (200 OK)
```json
{
  "data": [
    {
      "id": 1,
      "title": "Clean Code",
      "isbn": "9780132350884",
      "author_name": "Robert C. Martin",
      "published_year": 2008,
      "available": true,
      "created_at": "2026-10-09T14:30:00.000000Z"
    },
    {
      "id": 2,
      "title": "The Pragmatic Programmer",
      "isbn": "9780135957059",
      "author_name": "David Thomas & Andrew Hunt",
      "published_year": 1999,
      "available": false,
      "created_at": "2026-10-09T14:30:00.000000Z"
    }
  ]
}
```
### Bentuk Respons — Satu Buku (200 OK)
```json
{
  "data": {
    "id": 1,
    "title": "Clean Code",
    "isbn": "9780132350884",
    "author_name": "Robert C. Martin",
    "published_year": 2008,
    "available": true,
    "created_at": "2026-10-09T14:30:00.000000Z"
  }
}
```
### Bentuk Respons — Tidak Ditemukan (404 Not Found)
```json
{
  "message": "Book not found",
  "errors": null
}
```
### Bukti Pengujian
| Permintaan | Hasil Aktual | Status | Kesesuaian Kontrak |
|---|---|---|---|
| GET /api/books | Menampilkan 2 buku lengkap | 200 OK | Struktur data[], nama kolom & tipe data sesuai |
| GET /api/books/1 | Menampilkan 1 objek buku | 200 OK | Objek tunggal di dalam data |
| GET /api/books/999999 | Mengembalikan pesan tidak ditemukan | 404 Not Found | message & errors: null sesuai kesepakatan |


## Keputusan Utama
- Struktur tabel disesuaikan langsung dengan daftar kolom di kontrak agar tidak terjadi perbedaan nama
- Pengendali tidak mengembalikan objek mentah, melainkan menyusun respons secara terpusat agar mudah dijaga kesesuaiannya
- Rute ditulis tanpa awalan /api karena Laravel otomatis menambahkannya untuk berkas routes/api.php

Kolom available bersifat baca-saja dari sisi klien; nilainya diatur sistem
## Kesimpulan
Dua titik akhir baca-saja telah berhasil dibangun dan diuji. Hasil implementasi sesuai dengan kontrak yang disepakati, sehingga antarmuka dapat dipakai tanpa penyesuaian format. Pengujian menunjukkan kode status dan struktur data berfungsi sebagaimana mestinya.
## Referensi
Laravel — Perutean: https://laravel.com/docs/routing
Laravel — Pengendali: https://laravel.com/docs/controllers
Laravel — Eloquent ORM: https://laravel.com/docs/eloquent
Laravel — Migrasi: https://laravel.com/docs/migrations
Laravel — Pengisian Data: https://laravel.com/docs/seeding
Postman — Mengirim Permintaan: https://learning.postman.com/docs/sending-requests/requests/