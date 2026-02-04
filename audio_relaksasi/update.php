<?php
// ===============================
// CREATE AUDIO RELAKSASI
// ===============================

// Koneksi database
include "../db.php";

// Set response JSON
header("Content-Type: application/json");

// Ambil data dari FORM-DATA / x-www-form-urlencoded
$data = $_POST;

// Validasi data wajib
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
        "message" => "Data tidak lengkap",
        "debug" => $data
    ]);
    exit;
}

// Query INSERT
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

// Eksekusi
if ($stmt->execute()) {
    echo json_encode([
        "status" => "success",
        "message" => "Audio relaksasi berhasil ditambahkan"
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Gagal menambahkan audio"
    ]);
}
?>
