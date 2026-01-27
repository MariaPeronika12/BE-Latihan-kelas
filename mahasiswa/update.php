<?php
// Menghubungkan ke database
include '../db.php';

// Memberitahu client bahwa response berupa JSON
header('Content-Type: application/json');

// Mengambil data dari POST
// mood_id digunakan untuk menentukan data mana yang akan di-update
$mood_id = $_POST['mood_id'];

// Mengambil mood baru
$mood = $_POST['mood'];

// Mengambil catatan baru
$note = $_POST['note'];

// Menyiapkan query UPDATE ke tabel mood_tracking
$stmt = $conn->prepare("
    UPDATE mood_tracking
    SET mood = ?, note = ?
    WHERE mood_id = ?
");

// Mengikat data ke query
// s = string (mood)
// s = string (note)
// i = integer (mood_id)
$stmt->bind_param("ssi", $mood, $note, $mood_id);

// Menjalankan query UPDATE
if ($stmt->execute()) {

    // Jika berhasil
    echo json_encode([
        "status"  => "success",
        "message" => "Mood berhasil diperbarui",
        "data"    => [
            "mood_id" => $mood_id,
            "mood"    => $mood,
            "note"    => $note
        ]
    ]);

} else {

    // Jika gagal
    echo json_encode([
        "status"  => "error",
        "message" => $stmt->error
    ]);

}

// Menutup statement
$stmt->close();

// Menutup koneksi database
$conn->close();

/*
PETUNJUK UNTUK MENYESUAIKAN DENGAN SCHEMA TABEL LAIN:

Jika ingin menggunakan skema tabel yang berbeda, ubah bagian-bagian berikut:
1. Nama tabel: Ganti 'tb_mahasiswa' dengan nama tabel Anda
2. Nama kolom: Ganti 'id', 'nim', 'nama', 'alamat', 'no_telp' sesuai dengan kolom di tabel Anda
3. Parameter POST: Sesuaikan dengan nama field yang dikirim dari form Anda
4. Tipe data parameter: Perhatikan tipe data saat menggunakan bind_param()
   Misalnya: "iiiss" untuk integer, integer, integer, string, string
*/
?>
