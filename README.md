##Aplikasi Serenica – Mood Tracking Kesehatan Mental

Serenica adalah aplikasi kesehatan mental anak muda Indonesia yang dibangun menggunakan PHP dan MySQL. Aplikasi ini menyediakan fungsi CRUD (Create, Read, Update, Delete) untuk mengelola data mood tracking pengguna, sehingga pengguna dapat mencatat dan memantau kondisi emosional mereka secara berkala.

Deskripsi

Aplikasi Serenica menyediakan empat endpoint utama untuk mengelola data mood pengguna:

CREATE: Menambahkan catatan mood baru

READ: Menampilkan data mood pengguna

UPDATE: Memperbarui catatan mood

DELETE: Menghapus catatan mood

Semua endpoint mengembalikan respons dalam format JSON.

Struktur Tabel

Tabel mood_tracking memiliki struktur sebagai berikut:

Kolom	Tipe Data	Deskripsi
mood_id	INT	Primary Key, Auto Increment
user_id	INT	ID pengguna
mood	VARCHAR	Kondisi suasana hati pengguna
note	TEXT	Catatan tambahan pengguna
created_at	DATETIME	Waktu pencatatan mood
Endpoint
1. CREATE – Menambahkan Data Mood Baru

URL:
/mood_tracking/create.php

Metode:
POST

Parameter:

user_id (integer) – ID pengguna

mood (string) – Suasana hati (senang, sedih, stres, dll)

note (string) – Catatan tambahan

created_at (datetime) – Waktu pencatatan

Contoh Request:

curl -X POST \
  -d "user_id=1" \
  -d "mood=Senang" \
  -d "note=Hari ini produktif" \
  -d "created_at=2026-01-28 10:00:00" \
  http://localhost/BE-Latihan-kelas/mood_tracking/create.php


Contoh Respons Sukses:

{
  "status": "success",
  "message": "Mood berhasil ditambahkan",
  "data": {
    "mood_id": 1,
    "user_id": 1,
    "mood": "Senang",
    "note": "Hari ini produktif",
    "created_at": "2026-01-28 10:00:00"
  }
}

2. READ – Membaca Data Mood

URL:
/mood_tracking/read.php

Metode:
GET

Parameter (Opsional):

mood_id (integer) – Menampilkan mood berdasarkan ID

user_id (integer) – Menampilkan mood berdasarkan pengguna

Jika tidak ada parameter, sistem akan menampilkan semua data mood.

Contoh Request:

curl http://localhost/BE-Latihan-kelas/mood_tracking/read.php?user_id=1


Contoh Respons Sukses:

{
  "status": "success",
  "message": "Data mood ditemukan",
  "data": [
    {
      "mood_id": 1,
      "user_id": 1,
      "mood": "Senang",
      "note": "Hari ini produktif",
      "created_at": "2026-01-28 10:00:00"
    }
  ]
}

3. UPDATE – Memperbarui Data Mood

URL:
/mood_tracking/update.php

Metode:
POST

Parameter:

mood_id (integer) – ID mood yang akan diperbarui

mood (string) – Mood baru

note (string) – Catatan baru

Contoh Request:

curl -X POST \
  -d "mood_id=1" \
  -d "mood=Tenang" \
  -d "note=Sudah lebih rileks" \
  http://localhost/BE-Latihan-kelas/mood_tracking/update.php


Contoh Respons Sukses:

{
  "status": "success",
  "message": "Mood berhasil diperbarui"
}

4. DELETE – Menghapus Data Mood

URL:
/mood_tracking/delete.php

Metode:
POST

Parameter:

mood_id (integer) – ID mood yang akan dihapus

Contoh Request:

curl -X POST \
  -d "mood_id=1" \
  http://localhost/BE-Latihan-kelas/mood_tracking/delete.php


Contoh Respons Sukses:

{
  "status": "success",
  "message": "Mood berhasil dihapus"
}

Instalasi

Pastikan server web telah terpasang PHP dan MySQL

Salin file project ke folder web server

Buat database serenica_db

Buat tabel mood_tracking sesuai struktur di atas

Atur koneksi database pada file db.php

Jalankan endpoint sesuai kebutuhan

Catatan

Semua endpoint menggunakan format JSON

Gunakan metode POST untuk CREATE, UPDATE, DELETE

Gunakan metode GET untuk READ

Gunakan prepared statement untuk keamanan data

Pastikan parameter dikirim dengan benar untuk menghindari error
