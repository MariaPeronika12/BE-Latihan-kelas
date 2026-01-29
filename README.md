## Serenica – Aplikasi Kesehatan Mental Anak Muda Indonesia

Serenica adalah aplikasi backend sederhana berbasis PHP dan MySQL yang digunakan untuk mendukung aplikasi kesehatan mental anak muda Indonesia. Backend ini menyediakan fitur CRUD (Create, Read, Update, Delete) untuk mengelola data mood tracking pengguna.

Semua endpoint menghasilkan respons dalam format JSON dan dirancang sebagai latihan backend API.

## Deskripsi

Aplikasi Serenica menyediakan empat endpoint utama untuk mengelola data mood tracking pengguna:

## CREATE : Menambahkan data mood baru

## READ   : Membaca/menampilkan data mood

## UPDATE : Memperbarui data mood yang sudah ada

## DELETE : Menghapus data mood

Aplikasi ini menggunakan database serenica_db.

## Struktur Tabel

Tabel mood_tracking memiliki struktur sebagai berikut:

Kolom

Tipe Data

Deskripsi

mood_id

INT

Primary Key, Auto Increment

user_id

INT

ID pengguna

mood

VARCHAR

Kondisi mood pengguna

note

TEXT

Catatan tambahan pengguna

created_at

DATETIME

Waktu pencatatan mood

Endpoint API

## 1. CREATE – Menambahkan Data Mood Baru

URL : /mahasiswa/create.php

Method : POST

Parameter :

user_id (integer) – ID pengguna

mood (string) – Mood pengguna (senang, sedih, cemas, dll)

note (string) – Catatan tambahan

created_at (datetime) – Waktu pencatatan

Contoh Request :

curl -X POST \
  -d "user_id=1" \
  -d "mood=Senang" \
  -d "note=Hari ini merasa lebih baik" \
  -d "created_at=2025-01-29 10:00:00" \
  http://localhost/BE-Latihan-kelas/mahasiswa/create.php

Contoh Respons Sukses :

{
  "status": "success",
  "message": "Data mood berhasil ditambahkan",
  "data": {
    "mood_id": 1,
    "user_id": 1,
    "mood": "Senang",
    "note": "Hari ini merasa lebih baik",
    "created_at": "2025-01-29 10:00:00"
  }
}

## 2. READ – Membaca Data Mood

URL : /mahasiswa/read.php

Method : GET

Parameter (Opsional) :

mood_id (integer) – Menampilkan data berdasarkan ID mood

user_id (integer) – Menampilkan data berdasarkan pengguna

Jika tidak ada parameter, maka akan menampilkan seluruh data mood.

Contoh Request :

curl http://localhost/BE-Latihan-kelas/mahasiswa/read.php

Contoh Respons Sukses :

{
  "status": "success",
  "message": "Data ditemukan",
  "data": [
    {
      "mood_id": 1,
      "user_id": 1,
      "mood": "Senang",
      "note": "Hari ini merasa lebih baik",
      "created_at": "2025-01-29 10:00:00"
    }
  ]
}

## 3. UPDATE – Memperbarui Data Mood

URL : /mahasiswa/update.php

Method : POST

Parameter :

mood_id (integer) – ID mood yang akan diperbarui

user_id (integer) – ID pengguna

mood (string) – Mood terbaru

note (string) – Catatan terbaru

created_at (datetime) – Waktu pembaruan

Contoh Request :

curl -X POST \
  -d "mood_id=1" \
  -d "user_id=1" \
  -d "mood=Tenang" \
  -d "note=Mulai merasa lebih stabil" \
  -d "created_at=2025-01-29 12:00:00" \
  http://localhost/BE-Latihan-kelas/mahasiswa/update.php

Contoh Respons Sukses :

{
  "status": "success",
  "message": "Data mood berhasil diperbarui"
}

## 4. DELETE – Menghapus Data Mood

URL : /mahasiswa/delete.php

Method : POST

Parameter :

mood_id (integer) – ID mood yang akan dihapus

Contoh Request :

curl -X POST \
  -d "mood_id=1" \
  http://localhost/BE-Latihan-kelas/mahasiswa/delete.php

Contoh Respons Sukses :

{
  "status": "success",
  "message": "Data mood berhasil dihapus"
}

Instalasi

Pastikan PHP dan MySQL sudah terinstal

Salin folder project ke direktori web server (Laragon/XAMPP)

Buat database dengan nama serenica_db

Import tabel mood_tracking

Atur koneksi database di file db.php

Jalankan endpoint menggunakan browser atau Postman

Catatan

Semua respons menggunakan format JSON

Gunakan metode POST untuk CREATE, UPDATE, dan DELETE

Gunakan metode GET untuk READ

Gunakan prepared statements untuk mencegah SQL Injection

Project ini dibuat sebagai latihan backend API PHP & MySQL

## ✨ Serenica – Peduli Kesehatan Mental Anak Muda Indonesia