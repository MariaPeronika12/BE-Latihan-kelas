<?php
include "../db.php";
header("Content-Type: application/json");

$id_chat = $_POST['id_chat'];

if (empty($id_chat)) {
    echo json_encode([
        "status" => "error",
        "message" => "ID chat tidak ditemukan"
    ]);
    exit;
}

$sql = "DELETE FROM curhat_ai WHERE id_chat = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_chat);

if ($stmt->execute()) {
    echo json_encode([
        "status" => "success",
        "message" => "Pesan curhat berhasil dihapus"
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => $stmt->error
    ]);
}
?>
