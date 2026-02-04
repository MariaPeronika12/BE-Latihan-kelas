<?php
// Menghubungkan ke database
include_once '../db.php';

// Memberitahu client bahwa response berbentuk JSON
header('Content-Type: application/json');

// Query untuk mengambil semua data users
$sql = "SELECT * FROM users";

// Jalankan query
$result = $conn->query($sql);

// Cek apakah ada data
if ($result->num_rows > 0) {

    // Siapkan array kosong untuk menampung data
    $users = [];

    // Ambil data satu per satu
    while($row = $result->fetch_assoc()) {

        // Masukkan setiap row ke array
        $users[] = $row;
    }

    // Kirim response sukses + data users
    echo json_encode([
        "status" => "success",
        "data" => $users
    ]);

} else {

    // Jika tidak ada data
    echo json_encode([
        "status" => "success",
        "message" => "Tidak ada data user"
    ]);
}

// Tutup koneksi database
$conn->close();

?>
