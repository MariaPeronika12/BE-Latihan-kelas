<?php
include "../db.php";
header("Content-Type: application/json");

$id = $_POST['id_pengaturan'] ?? null;

if (!$id) {
    echo json_encode([
        "status" => "error",
        "message" => "ID pengaturan tidak ditemukan"
    ]);
    exit;
}

$sql = "DELETE FROM pengaturan WHERE id_pengaturan = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo json_encode([
        "status" => "success",
        "message" => "Pengaturan berhasil dihapus"
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => $stmt->error
    ]);
}
?>
