# 🌿 Serenica – Backend API Documentation

---

## 📌 Deskripsi Aplikasi

**Serenica** adalah aplikasi backend yang dirancang untuk mendukung **kesehatan mental anak muda Indonesia**. Sistem ini menyediakan berbagai fitur seperti pencatatan mood, jurnal emosi, komunitas, self-care, hingga konsultasi berbasis AI.

Backend dikembangkan menggunakan **PHP & MySQL** dengan arsitektur **REST API** yang mendukung operasi **CRUD (Create, Read, Update, Delete)** serta **JOIN antar tabel** untuk kebutuhan relasi data.

---

## ⚙️ Teknologi yang Digunakan

| Teknologi | Keterangan               |
| --------- | ------------------------ |
| PHP       | Backend API              |
| MySQL     | Database Relasional      |
| JSON      | Format Response          |
| REST API  | Komunikasi Client–Server |

---

## 🗂️ Daftar Tabel Database

| No | Nama Tabel         |
| -- | ------------------ |
| 1  | users              |
| 2  | mood_tracking      |
| 3  | jurnal_emosi       |
| 4  | edu_konseling_chat |
| 5  | audio_relaksasi    |
| 6  | curhat_ai          |
| 7  | insight_mingguan   |
| 8  | komunitas          |
| 9  | self_care          |
| 10 | pengaturan         |

---

# 📊 Struktur Database

## 👤 Tabel Users

| Kolom      | Tipe Data | Keterangan                  |
| ---------- | --------- | --------------------------- |
| user_id    | INT       | Primary Key, Auto Increment |
| nama       | VARCHAR   | Nama pengguna               |
| email      | VARCHAR   | Email pengguna              |
| password   | VARCHAR   | Password (hashed)           |
| usia       | INT       | Usia pengguna               |
| created_at | DATETIME  | Waktu pendaftaran           |

---

## 😊 Tabel Mood Tracking

| Kolom   | Tipe Data | Keterangan          |
| ------- | --------- | ------------------- |
| mood_id | INT       | Primary Key         |
| user_id | INT       | Foreign Key (users) |
| mood    | VARCHAR   | Mood pengguna       |
| catatan | TEXT      | Catatan tambahan    |
| tanggal | DATE      | Tanggal pencatatan  |

---

## 📖 Tabel Jurnal Emosi

| Kolom     | Tipe Data | Keterangan     |
| --------- | --------- | -------------- |
| jurnal_id | INT       | Primary Key    |
| user_id   | INT       | Foreign Key    |
| emosi     | VARCHAR   | Jenis emosi    |
| deskripsi | TEXT      | Catatan emosi  |
| tanggal   | DATE      | Tanggal dibuat |

---

## 💬 Tabel Edu Konseling Chat

| Kolom   | Tipe Data | Keterangan   |
| ------- | --------- | ------------ |
| chat_id | INT       | Primary Key  |
| user_id | INT       | Foreign Key  |
| pesan   | TEXT      | Isi pesan    |
| role    | VARCHAR   | user / admin |
| waktu   | DATETIME  | Waktu chat   |

---

## 🎧 Tabel Audio Relaksasi

| Kolom      | Tipe Data | Keterangan   |
| ---------- | --------- | ------------ |
| audio_id   | INT       | Primary Key  |
| judul      | VARCHAR   | Judul audio  |
| deskripsi  | TEXT      | Deskripsi    |
| file_audio | VARCHAR   | Lokasi file  |
| durasi     | VARCHAR   | Durasi audio |
| created_at | DATETIME  | Waktu upload |

---

## 🤖 Tabel Curhat AI

| Kolom      | Tipe Data | Keterangan      |
| ---------- | --------- | --------------- |
| curhat_id  | INT       | Primary Key     |
| user_id    | INT       | Foreign Key     |
| pesan_user | TEXT      | Pesan dari user |
| respon_ai  | TEXT      | Balasan AI      |
| created_at | DATETIME  | Waktu curhat    |

---

## 📈 Tabel Insight Mingguan

| Kolom          | Tipe Data | Keterangan               |
| -------------- | --------- | ------------------------ |
| insight_id     | INT       | Primary Key              |
| user_id        | INT       | Foreign Key              |
| ringkasan_mood | TEXT      | Ringkasan kondisi mental |
| skor_kesehatan | INT       | Skor kesehatan mental    |
| minggu_ke      | INT       | Minggu ke-               |
| created_at     | DATETIME  | Tanggal dibuat           |

---

## 🌐 Tabel Komunitas

| Kolom        | Tipe Data | Keterangan    |
| ------------ | --------- | ------------- |
| komunitas_id | INT       | Primary Key   |
| user_id      | INT       | Foreign Key   |
| judul_post   | VARCHAR   | Judul diskusi |
| isi_post     | TEXT      | Isi postingan |
| created_at   | DATETIME  | Waktu posting |

---

## 🌸 Tabel Self Care

| Kolom       | Tipe Data | Keterangan          |
| ----------- | --------- | ------------------- |
| selfcare_id | INT       | Primary Key         |
| user_id     | INT       | Foreign Key         |
| aktivitas   | VARCHAR   | Aktivitas self care |
| deskripsi   | TEXT      | Detail aktivitas    |
| tanggal     | DATE      | Tanggal dilakukan   |

---

## ⚙️ Tabel Pengaturan

| Kolom         | Tipe Data | Keterangan        |
| ------------- | --------- | ----------------- |
| pengaturan_id | INT       | Primary Key       |
| user_id       | INT       | Foreign Key       |
| notifikasi    | BOOLEAN   | Status notifikasi |
| mode_gelap    | BOOLEAN   | Dark mode         |
| bahasa        | VARCHAR   | Bahasa aplikasi   |

---

# 🚀 Endpoint API

## 📌 Format Response Standar

### ✅ Response Sukses

```json
{
  "status": "success",
  "message": "Data berhasil diproses",
  "data": {}
}
```

### ❌ Response Error

```json
{
  "status": "error",
  "message": "Terjadi kesalahan pada server"
}
```

### 📭 Response Data Kosong

```json
{
  "status": "success",
  "message": "Data tidak ditemukan",
  "data": []
}
```

---

# 🔥 Users (CRUD + JOIN)

### ✅ CREATE

* **URL:** `/users/create.php`
* **Method:** POST

```json
{
  "nama": "Budi",
  "email": "budi@gmail.com",
  "password": "123456",
  "usia": 21
}
```

### 📖 READ

* **URL:** `/users/read.php`
* **Method:** GET

### ✏️ UPDATE

* **URL:** `/users/update.php`
* **Method:** POST

### 🗑️ DELETE

* **URL:** `/users/delete.php`
* **Method:** POST

---

# 🔗 Contoh JOIN

## JOIN Users + Mood Tracking

* **URL:** `/mood_tracking/read_join_users.php`
* **Method:** GET

```json
{
  "status": "success",
  "data": [
    {
      "nama": "Budi",
      "mood": "Bahagia",
      "tanggal": "2026-02-10"
    }
  ]
}
```

---

# 📌 Catatan Penting

✅ Semua response menggunakan format **JSON**
✅ Relasi tabel menggunakan **Foreign Key**
✅ Backend siap digunakan untuk **Web maupun Mobile Apps**
✅ Struktur API dibuat modular agar mudah dikembangkan

---

# 🌿 Serenica Backend API

> Mendukung kesehatan mental anak muda Indonesia melalui teknologi yang aman, cepat, dan terstruktur.
