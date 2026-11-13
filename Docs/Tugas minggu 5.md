# Tugas  Minggu 5 — CRUD

## Tujuan
Tujuan praktikum ini adalah  untuk melanjutkan pekerjaan minggu lalu agar sistem bisa mengelola data buku secara lengkap, mulai dari menampilkan, menambah, mengubah, sampai menghapus data. Semua respons yang dikembalikan harus seragam, pesan kesalahan jelas, dan data yang masuk sudah diperiksa.

## Perubahan yang Dilakukan
Bagian yang diubah dan  yang ditambahkan yaitu :
- Membuat file aturan validasi `StoreBookRequest.php` dan `UpdateBookRequest.php` supaya data yang masuk diperiksa
- Membuat `BookResource.php` agar format tampilan data seragam di semua respons
- Memperbarui `BookController.php` supaya memakai aturan validasi dan format respons yang sudah dibuat
- Menyesuaikan `routes/api.php` memakai `apiResource` agar semua alamat tersedia
- Menyesuaikan migrasi supaya kolom yang tidak dipakai tidak mengganggu penyimpanan data
- Menyesuaikan `$fillable` di `Book.php` sesuai kolom yang dipakai
- Membuat folder `docs` beserta laporan ini

## Endpoint / Kontrak API
| Metode | Alamat | Keterangan |
|---|---|---|
| GET | `/api/books` | Menampilkan semua daftar buku |
| POST | `/api/books` | Menambah buku baru |
| GET | `/api/books/{book}` | Menampilkan satu buku berdasarkan nomor ID |
| PATCH | `/api/books/{book}` | Mengubah sebagian data buku |
| DELETE | `/api/books/{book}` | Menghapus buku |

**Aturan data:**
- Tambah buku: `title` wajib 3–200 huruf, `isbn` wajib 13 angka dan belum dipakai, `available` boleh diisi atau tidak
- Ubah buku: kolom hanya dicek jika dikirim; ISBN boleh sama dengan buku yang sedang diubah

## Bukti Pengujian
| No | Yang Diuji | Hasil Diharapkan | Hasil Diperoleh | Status |
|---|---|---|---|---|
| 1 | Tambah buku dengan data lengkap benar | Kode **201 Created** + data buku | Sesuai |
| 2 | Kirim data salah/kosong | Kode **422** + daftar pesan kesalahan | Sesuai |
| 3 | Ubah sebagian data saja | Kode **200 OK**, yang diubah berubah, yang lain tetap | Sesuai |
| 4 | Cari buku nomor tidak ada | Kode **404 Not Found** + pesan "Book not found" | Sesuai |
| 5 | Hapus buku | Kode **204 No Content**, lalu cek ulang = 404 | Sesuai |

## Kasus Kesalahan
| Masalah | Penyebab | Cara Memperbaiki |
|---|---|---|
| Error simpan data — kolom tidak boleh kosong | Tabel punya kolom tambahan yang tidak diisi | Ubah migrasi tambah `->nullable()`, lalu jalankan `migrate:fresh` |
| Tetap muncul 200 padahal data salah | Lupa pakai `POST` atau salah alamat | Ubah ke `POST`, pastikan alamat tanpa nomor ID |
| Tidak ketemu buku saat ubah/hapus | Tulis `{id}` apa adanya di alamat | Ganti langsung dengan nomor buku, contoh: `/api/books/1` |
| Tidak muncul 422 | `authorize()` di Request bernilai `false` | Ubah jadi `return true;` |

## Kesimpulan
Setelah semua bagian diperbaiki dan diuji satu per satu, semua fungsi sudah berjalan sesuai harapan. Data yang benar tersimpan dengan kode 201, data yang salah ditolak dengan kode 422, mengubah data berjalan dengan kode 200, buku yang tidak ada menampilkan kode 404, dan menghapus menampilkan kode 204. Format respons sudah seragam, pesan kesalahan jelas, dan tidak ada data rahasia yang ikut tersimpan.

## Referensi
- Dokumentasi Laravel Validasi — https://laravel.com/docs/validation
- Dokumentasi Laravel Eloquent Resource — https://laravel.com/docs/eloquent-resources
- Dokumentasi Laravel Controller — https://laravel.com/docs/controllers
- Panduan Postman — https://learning.postman.com/docs/sending-requests/requests/

## Deklarasi Penggunaan Bantuan
Saya memakai bantuan untuk memahami alur kerja dari mengirim permintaan di Postman sampai data masuk ke database, menyusun kode sesuai instruksi, mencari tahu penyebab pesan error, dan menyusun laporan ini. Semua langkah sudah saya periksa dan coba jalankan sendiri. Tidak ada kata sandi, kunci, atau data rahasia yang tertulis di dokumen ini.