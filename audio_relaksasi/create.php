<?php
include "../db.php";
header("Content-Type: application/json");

// Ambil data dari POST
$data = $_POST;

// Validasi data
if (
    empty($data['judul']) ||
    empty($data['deskripsi']) ||
    empty($data['file_audio']) ||
    empty($data['durasi']) ||
    empty($data['kategori']) ||
    empty($data['cover_image'])
) {
    echo json_encode([
        "status" => "error",
        "message" => "Data tidak lengkap"
    ]);
    exit;
}

// Query insert
$sql = "INSERT INTO audio_relaksasi
        (judul, deskripsi, file_audio, durasi, kategori, cover_image, created_at)
        VALUES (?, ?, ?, ?, ?, ?, NOW())";

$stmt = $conn->prepare($sql);
$stmt->bind_param(
    "ssssss",
    $data['judul'],
    $data['deskripsi'],
    $data['file_audio'],
    $data['durasi'],
    $data['kategori'],
    $data['cover_image']
);

if ($stmt->execute()) {
    echo json_encode([
        "status" => "success",
        "message" => "Audio relaksasi berhasil ditambahkan"
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => $stmt->error
    ]);
}
?>
