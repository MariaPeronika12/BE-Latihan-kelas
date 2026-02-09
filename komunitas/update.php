<?php
include "../db.php";
header("Content-Type: application/json");

$data = $_POST;

if (
    empty($data['id_komunitas']) ||
    empty($data['nama_komunitas']) ||
    empty($data['deskripsi']) ||
    empty($data['kategori'])
) {
    echo json_encode([
        "status" => "error",
        "message" => "Data tidak lengkap"
    ]);
    exit;
}

$sql = "UPDATE komunitas
        SET nama_komunitas = ?, deskripsi = ?, kategori = ?
        WHERE id_komunitas = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param(
    "sssi",
    $data['nama_komunitas'],
    $data['deskripsi'],
    $data['kategori'],
    $data['id_komunitas']
);

if ($stmt->execute()) {
    echo json_encode([
        "status" => "success",
        "message" => "Komunitas berhasil diperbarui"
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => $stmt->error
    ]);
}
?>
