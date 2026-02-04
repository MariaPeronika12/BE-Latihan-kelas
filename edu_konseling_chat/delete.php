<?php
// Koneksi database
include '../db.php';

// Response JSON
header('Content-Type: application/json');

// Cek parameter
if (!isset($_POST['chat_id'])) {
    echo json_encode([
        "status"  => "error",
        "message" => "chat_id wajib diisi"
    ]);
    exit;
}

$chat_id = $_POST['chat_id'];

// Prepare delete
$stmt = $conn->prepare(
    "DELETE FROM edu_konseling_chat WHERE chat_id = ?"
);
$stmt->bind_param("i", $chat_id);

if ($stmt->execute()) {
    echo json_encode([
        "status"  => "success",
        "message" => "Data chat berhasil dihapus"
    ]);
} else {
    echo json_encode([
        "status"  => "error",
        "message" => "Gagal menghapus data"
    ]);
}

$stmt->close();
$conn->close();
?>
