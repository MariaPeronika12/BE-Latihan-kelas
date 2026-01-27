<?php
// Menghubungkan file koneksi database
include_once '../db.php';

// Memberi tahu client bahwa response berbentuk JSON
header('Content-Type: application/json');

// Mengambil data user_id dari request POST
$user_id = $_POST['user_id'];

// Mengambil data mood dari request POST
$mood = $_POST['mood'];

// Mengambil catatan (note) dari request POST
$note = $_POST['note'];

// Menyiapkan query SQL INSERT ke tabel mood_tracking
// mood_id tidak ditulis karena AUTO_INCREMENT
// created_at menggunakan waktu sekarang (NOW())
$stmt = $conn->prepare("
    INSERT INTO mood_tracking (user_id, mood, note, created_at)
    VALUES (?, ?, ?, NOW())
");

// Mengikat parameter ke query
// i = integer (user_id)
// s = string (mood)
// s = string (note)
$stmt->bind_param("iss", $user_id, $mood, $note);

// Mengeksekusi query INSERT
if ($stmt->execute()) {

    // Jika berhasil, kirim response JSON sukses
    echo json_encode([
        "status"  => "success",                    // Status response
        "message" => "Mood berhasil disimpan",     // Pesan ke client
        "data"    => [
            "mood_id" => $stmt->insert_id,         // ID mood yang baru ditambahkan
            "user_id" => $user_id,                 // ID user
            "mood"    => $mood,                    // Mood user
            "note"    => $note                     // Catatan tambahan
        ]
    ]);

} else {

    // Jika gagal, kirim response error
    echo json_encode([
        "status"  => "error",                      // Status error
        "message" => $stmt->error                  // Pesan error dari MySQL
    ]);

}

// Menutup prepared statement untuk menghemat resource
$stmt->close();

// Menutup koneksi database
$conn->close();
?>

