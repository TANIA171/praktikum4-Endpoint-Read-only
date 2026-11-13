# Praktikum Minggu 6 — Search, Sorting, dan Pagination

## Query Contract
- **search**: dicari di kolom `title` atau `isbn`; panjang maksimal 100 karakter; boleh kosong
- **sort**: hanya boleh `id`, `title`, `isbn`, atau `created_at`; nilai bawaan `id`
- **direction**: hanya boleh `asc` atau `desc`; nilai bawaan `asc`
- **page**: angka bilangan bulat, nilai minimal 1; nilai bawaan `1`
- **per_page**: angka bilangan bulat, antara 1 sampai 50; nilai bawaan `5`

## Verification

| No | Yang Diuji | Status | Hasil yang Diharapkan |
|---|---|---|---|
| 1 | Pagination — Halaman 1 | 200 OK | `data` berisi 2 buku, bagian `links` dan `meta` muncul lengkap  |
| 2 | Pagination — Halaman 2 | 200 OK | Buku yang ditampilkan berbeda dari halaman pertama |
| 3 | Search — Ditemukan | 200 OK | Hanya buku yang judul atau ISBN-nya cocok dengan kata kunci |
| 4 | Search — Tidak Ditemukan | 200 OK | `data: []` kosong, kode tetap 200, bukan 404  |
| 5 | Sorting — Naik (A ke Z) | 200 OK | Data berurutan dari huruf awal ke akhir |
| 6 | Sorting — Turun (Z ke A) | 200 OK | Data berurutan dari huruf akhir ke awal  |
| 7 | Sort — Nilai Tidak Diizinkan | 422 Unprocessable Entity | Pesan kesalahan muncul di bagian `errors.sort` |
| 8 | Per Page — Melebihi Batas | 422 Unprocessable Entity | Pesan kesalahan muncul di bagian `errors.per_page` |

## Response Structure

- **`data`** → Bagian utama yang berisi daftar buku yang muncul di halaman yang sedang dibuka saja, bukan semua data yang ada di basis data.
- **`links`** → Berisi tautan untuk langsung berpindah ke halaman pertama, halaman sebelumnya, halaman berikutnya, atau halaman terakhir. Kalau bagian tersebut tidak ada, isinya `null`.
- **`meta`** → Berisi informasi tambahan seperti nomor halaman yang sedang dibuka, berapa halaman keseluruhan, berapa data per halaman, dan berapa total data yang ada.

## Decision — Mengapa Sort Pakai Daftar Diizinkan?

Pemilihan kolom urutan dibatasi pakai daftar yang diizinkan (allowlist) supaya tidak sembarang nama kolom bisa dipakai. Tujuannya adalah untuk menjaga keamanan dan kerahasiaan data, misalnya kolom yang berisi informasi pribadi, kata sandi, atau token tidak bisa dipaksa untuk diurutkan dan ditampilkan. Selain itu, cara ini juga menjaga supaya kolom yang memang tidak ada di tabel tidak menyebabkan kesalahan sistem.

## Penggunaan Bantuan
Saya memakai bantuan untuk memahami cara kerja parameter pencarian, menulis kode pengurutan, dan menyusun laporan ini. Semua hasil sudah saya coba sendiri di Postman dan cocok dengan yang diharapkan. Tidak ada data rahasia, kata sandi, atau kunci akses yang tertulis di sini.