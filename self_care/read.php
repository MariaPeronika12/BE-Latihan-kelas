<?php
include __DIR__ . "/../db.php";
header("Content-Type: application/json");

$id_selfcare = $_POST['id_selfcare'] ?? null;

if (!$id_selfcare) {
    echo json_encode([
        "status" => "error",
        "message" => "id_selfcare wajib diisi"
    ]);
    exit;
}

// cek data ada atau tidak
$cek = $conn->prepare("SELECT id_selfcare FROM self_care WHERE id_selfcare = ?");
$cek->bind_param("i", $id_selfcare);
$cek->execute();
$result = $cek->get_result();

if ($result->num_rows === 0) {
    echo json_encode([
        "status" => "error",
        "message" => "ID self care tidak ditemukan"
    ]);
    exit;
}

// delete data
$stmt = $conn->prepare("DELETE FROM self_care WHERE id_selfcare = ?");
$stmt->bind_param("i", $id_selfcare);

$stmt->execute();

echo json_encode([
    "status" => "success",
    "message" => "Data self care berhasil dihapus"
]);

$stmt->close();
$conn->close();
