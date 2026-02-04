<?php
// Menghubungkan ke database
include_once '../db.php';

// Memberitahu client bahwa response berupa JSON
header('Content-Type: application/json');

// Mengecek apakah user_id dikirim dari Postman
if (!isset($_POST['user_id'])) {

    echo json_encode([
        "status" => "error",
        "message" => "user_id wajib dikirim!"
    ]);
    exit();
}

// Menyimpan user_id ke variabel
$user_id = $_POST['user_id'];

// Membuat prepared statement untuk DELETE
$stmt = $conn->prepare("
    DELETE FROM users 
    WHERE user_id = ?
");

// Mengikat parameter
// i = integer karena user_id adalah angka
$stmt->bind_param("i", $user_id);

// Menjalankan query
$stmt->execute();


// 🔥 Mengecek apakah ada data yang benar-benar terhapus
if ($stmt->affected_rows > 0) {

    echo json_encode([
        "status" => "success",
        "message" => "User berhasil dihapus"
    ]);

} else {

    // Jika user tidak ditemukan
    echo json_encode([
        "status" => "warning",
        "message" => "User tidak ditemukan atau sudah dihapus"
    ]);
}

// Menutup statement & koneksi
$stmt->close();
$conn->close();
?>
