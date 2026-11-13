# Tugas 6 Endpoint Collection yang Dapat Dicari

## Tujuan
Tugas kali ini supaya daftar buku yang ada di sistem bisa dicari, diurutkan, dan dipisah ke beberapa halaman. Kalau ada parameter yang salah dikirim, sistem harus menolak dengan pesan yang jelas. Semua hasil yang dikirim ke Postman harus bentuknya seragam dan mudah dibaca.

## Endpoint & Query Contract
Alamat yang dipakai: `GET /api/books`

Aturan yang dipakai:
- **search**: dicari di judul buku atau nomor ISBN, maksimal 100 huruf
- **sort**: boleh pakai `id`, `title`, `isbn`, atau `created_at` saja; kalau tidak dipakai, urut berdasarkan `id`
- **direction**: `asc` dari kecil ke besar atau `desc` dari besar ke kecil; bawaan `asc`
- **page**: nomor halaman, minimal 1; bawaan halaman 1
- **per_page**: jumlah data per halaman, boleh 1 sampai 50; bawaan 5 data

## Kolom yang Dipakai
| Kegunaan | Nama Kolom |
|---|---|
| Tempat mencari kata kunci | `title`, `isbn` |
| Yang boleh dipakai untuk mengurut | `id`, `title`, `isbn`, `created_at` |

## Aturan Validasi
Kalau yang dikirim tidak sesuai daftar di atas, sistem akan membalas kode **422** dengan pesan kesalahan:
- Nama kolom untuk mengurut selain daftar di atas → muncul `errors.sort`
- Jumlah data per halaman kurang dari 1 atau lebih dari 50 → muncul `errors.per_page`
- Arah urutan selain `asc` atau `desc` → ditolak juga

## Hasil Pengujian di Postman

### 1. Pemisahan Halaman Bawaan
| Bagian | Isi |
|---|---|
| Alamat | `http://127.0.0.1:8000/api/books` |
| Status | 200 OK|
| Yang muncul | 5 buku pertama, ada tautan ke halaman lain dan keterangan halaman |

### 2. Halaman dan Jumlah Sendiri
| Bagian | Isi |
|---|---|
| Alamat | `http://127.0.0.1:8000/api/books?page=2&per_page=2` |
| Status | 200 OK|
| Yang muncul | Halaman kedua, isinya beda dari halaman pertama |

### 3. Cari di Judul
| Bagian | Isi |
|---|---|
| Alamat | `http://127.0.0.1:8000/api/books?search=Domain` |
| Status | 200 OK|
| Yang muncul | Hanya buku yang judulnya mengandung kata "Domain" |

### 4. Cari di ISBN
| Bagian | Isi |
|---|---|
| Alamat | `http://127.0.0.1:8000/api/books?search=9780131177055` |
| Status | 200 OK|
| Yang muncul | Buku yang nomor ISBN-nya sama persis atau mengandung angka tersebut |

### 5. Urut dari A ke Z
| Bagian | Isi |
|---|---|
| Alamat | `http://127.0.0.1:8000/api/books?sort=title&direction=asc` |
| Status | 200 OK |
| Yang muncul | Buku tersusun menurut huruf depan judulnya, dari awal sampai akhir |

### 6. Urut dari Z ke A
| Bagian | Isi |
|---|---|
| Alamat | `http://127.0.0.1:8000/api/books?sort=title&direction=desc` |
| Status | 200 OK|
| Yang muncul | Buku tersusun terbalik, huruf belakang duluan |

### 7. Semua Dipakai Sekaligus
| Bagian | Isi |
|---|---|
| Alamat | `http://127.0.0.1:8000/api/books?search=Design&sort=title&direction=asc&per_page=2&page=1` |
| Status | 200 OK |
| Yang muncul | Dicari, diurutkan, lalu dipisah halaman sekaligus. Tautan ke halaman berikutnya tetap menyimpan kata kunci dan urutan |

### 8. Yang Dikirim Salah
| Bagian | Isi |
|---|---|
| Alamat | `http://127.0.0.1:8000/api/books?sort=password` |
| Status | 422 Unprocessable Content |
| Yang muncul | Pesan di `errors.sort` memberitahu kolom ini tidak boleh dipakai |

## Bagian Isi Respons
- **data** → daftar buku yang tampil di halaman yang sedang dibuka
- **links** → alamat untuk pindah ke halaman pertama, sebelumnya, berikutnya, atau terakhir
- **meta** → keterangan nomor halaman sekarang, berapa halaman keseluruhan, dan berapa buku yang ada di sistem

## Alasan Dibatasi
Nama kolom untuk mengurut sengaja dibatasi supaya tidak ada yang bisa memaksa sistem mengurut berdasarkan bagian yang tidak seharusnya dilihat. Cara ini juga menjaga supaya kalau nama yang dikirim salah tulis, sistem tidak rusak.

## Kesimpulan
Semua yang diminta di tugas sudah dicoba dan berjalan sesuai aturan. Mencari di judul dan ISBN berfungsi, mengurut naik dan turun berfungsi, kalau ada yang salah dikirim sistem menolak dengan kode 422, dan tautan halaman tetap ingat kata kunci yang dipakai.

## Referensi
- Buku panduan Laravel — Cara memisah halaman: https://laravel.com/docs/pagination
- Buku panduan Laravel — Cara memeriksa masukan: https://laravel.com/docs/validation
- Buku panduan Laravel — Bentuk respons seragam: https://laravel.com/docs/eloquent-resources

## Penggunaan Bantuan
Setiap alamat dicoba sendiri di Postman, kode diperiksa tidak ada salah tulis, hasil dibandingkan dengan yang diminta di soal. Tidak ada kata sandi, nomor rahasia, atau data pribadi yang ditulis di sini.