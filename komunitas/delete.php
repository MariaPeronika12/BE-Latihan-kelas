<?php
include "../db.php";
header("Content-Type: application/json");

$id = $_POST['id_komunitas'] ?? null;

if (!$id) {
    echo json_encode([
        "status" => "error",
        "message" => "ID komunitas tidak ditemukan"
    ]);
    exit;
}

$sql = "DELETE FROM komunitas WHERE id_komunitas = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo json_encode([
        "status" => "success",
        "message" => "Komunitas berhasil dihapus"
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => $stmt->error
    ]);
}
?>
