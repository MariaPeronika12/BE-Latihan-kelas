# Serenica – Backend API Documentation

---

## Deskripsi Aplikasi

**Serenica** adalah aplikasi backend untuk mendukung **kesehatan mental anak muda Indonesia**. Aplikasi ini menyediakan fitur pencatatan suasana hati, jurnal emosi, edukasi konseling chat, serta audio relaksasi.

Backend dikembangkan menggunakan **PHP & MySQL**, dengan API berbasis **CRUD (Create, Read, Update, Delete)** serta **JOIN antar tabel**.

---

## Teknologi yang Digunakan

| Teknologi | Keterangan          |
| --------- | ------------------- |
| PHP       | Backend API         |
| MySQL     | Database Relasional |
| JSON      | Format Response     |
| REST API  | CRUD & JOIN         |

---

## Daftar Tabel Database

| No | Nama Tabel         |
| -- | ------------------ |
| 1  | users              |
| 2  | mood_tracking      |
| 3  | jurnal_emosi       |
| 4  | edu_konseling_chat |
| 5  | audio_relaksasi    |

---

## Tabel Users

### Struktur Tabel

| Kolom      | Tipe Data | Keterangan                  |
| ---------- | --------- | --------------------------- |
| user_id    | INT       | Primary Key, Auto Increment |
| nama       | VARCHAR   | Nama pengguna               |
| email      | VARCHAR   | Email pengguna              |
| password   | VARCHAR   | Password (hashed)           |
| usia       | INT       | Usia pengguna               |
| created_at | DATETIME  | Waktu pendaftaran           |

---

## Tabel Mood Tracking

### Struktur Tabel

| Kolom   | Tipe Data | Keterangan          |
| ------- | --------- | ------------------- |
| mood_id | INT       | Primary Key         |
| user_id | INT       | Foreign Key (users) |
| mood    | VARCHAR   | Mood pengguna       |
| catatan | TEXT      | Catatan tambahan    |
| tanggal | DATE      | Tanggal pencatatan  |

---

## Tabel Jurnal Emosi

### Struktur Tabel

| Kolom     | Tipe Data | Keterangan          |
| --------- | --------- | ------------------- |
| jurnal_id | INT       | Primary Key         |
| user_id   | INT       | Foreign Key (users) |
| emosi     | VARCHAR   | Jenis emosi         |
| deskripsi | TEXT      | Catatan emosi       |
| tanggal   | DATE      | Tanggal pencatatan  |

---

## Tabel Edukasi Konseling Chat

### Struktur Tabel

| Kolom   | Tipe Data | Keterangan          |
| ------- | --------- | ------------------- |
| chat_id | INT       | Primary Key         |
| user_id | INT       | Foreign Key (users) |
| pesan   | TEXT      | Pesan konseling     |
| role    | VARCHAR   | user / admin        |
| waktu   | DATETIME  | Waktu chat          |

---

## Tabel Audio Relaksasi

### Struktur Tabel

| Kolom      | Tipe Data | Keterangan      |
| ---------- | --------- | --------------- |
| audio_id   | INT       | Primary Key     |
| judul      | VARCHAR   | Judul audio     |
| deskripsi  | TEXT      | Deskripsi audio |
| file_audio | VARCHAR   | File audio      |
| durasi     | VARCHAR   | Durasi audio    |
| created_at | DATETIME  | Waktu upload    |

---

## Catatan

* Semua response menggunakan format **JSON**
* Relasi antar tabel menggunakan **Foreign Key**
* Backend siap digunakan untuk **Web & Mobile App**

---

## Endpoint API Detail

---

## Users (CRUD)

### CREATE User

* URL: `/users/create.php`
* Method: POST

```json
{
  "nama": "Andi",
  "email": "andi@gmail.com",
  "password": "123456",
  "usia": 20
}
```

### READ Users

* URL: `/users/read.php`
* Method: GET

### UPDATE User

* URL: `/users/update.php`
* Method: POST

### DELETE User

* URL: `/users/delete.php`
* Method: POST

---

## Mood Tracking (CRUD)

### CREATE Mood

* URL: `/mood_tracking/create.php`
* Method: POST

```json
{
  "user_id": 1,
  "mood": "Bahagia",
  "catatan": "Hari ini produktif"
}
```

### READ Mood

* URL: `/mood_tracking/read.php`
* Method: GET

---

## Jurnal Emosi (CRUD)

### CREATE Jurnal

* URL: `/jurnal_emosi/create.php`
* Method: POST

```json
{
  "user_id": 1,
  "emosi": "Sedih",
  "deskripsi": "Merasa tertekan"
}
```

---

## Edukasi Konseling Chat (CRUD)

### CREATE Chat

* URL: `/edu_konseling_chat/create.php`
* Method: POST

```json
{
  "user_id": 1,
  "pesan": "Saya merasa cemas",
  "role": "user"
}
```

---

## Audio Relaksasi (CRUD)

### CREATE Audio

* URL: `/audio_relaksasi/create.php`
* Method: POST

```json
{
  "judul": "Meditasi Pagi",
  "deskripsi": "Audio relaksasi pagi",
  "durasi": "05:00"
}
```

---

## Contoh JOIN Data

### JOIN Users & Mood Tracking

* URL: `/mood_tracking/read_join_users.php`
* Method: GET

```json
{
  "status": "success",
  "data": [
    {
      "nama": "Andi",
      "mood": "Bahagia",
      "tanggal": "2026-02-04"
    }
  ]
}
```

---

**Serenica – Backend API**
Aplikasi Kesehatan Mental Anak Muda Indonesia
