<?php
include "../db.php";
header("Content-Type: application/json");

$id = $_POST['id_selfcare'] ?? null;

if (!$id) {
    echo json_encode([
        "status" => "error",
        "message" => "ID tidak dikirim"
    ]);
    exit;
}

$sql = "DELETE FROM self_care WHERE id_selfcare = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo json_encode([
        "status" => "success",
        "message" => "Self care berhasil dihapus"
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Data dengan ID tersebut tidak ada di database"
    ]);
}

$stmt->close();
$conn->close();
?>
