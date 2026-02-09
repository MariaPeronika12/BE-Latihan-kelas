<?php
header("Content-Type: application/json");
include "../db.php";

// Cek method
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode([
        "status" => "error",
        "message" => "Method tidak diizinkan"
    ]);
    exit;
}

// Validasi input
if (
    empty($_POST['nama_komunitas']) ||
    empty($_POST['deskripsi']) ||
    empty($_POST['kategori']) ||
    empty($_POST['jumlah_anggota']) ||
    empty($_POST['status_komunitas'])
) {
    echo json_encode([
        "status" => "error",
        "message" => "Data tidak lengkap"
    ]);
    exit;
}

// Ambil data
$nama_komunitas   = $_POST['nama_komunitas'];
$deskripsi        = $_POST['deskripsi'];
$kategori         = $_POST['kategori'];
$jumlah_anggota   = (int) $_POST['jumlah_anggota'];
$status_komunitas = $_POST['status_komunitas'];

// INSERT ke tabel komunitas
$sql = "INSERT INTO komunitas
(nama_komunitas, deskripsi, kategori, jumlah_anggota, status_komunitas)
VALUES (?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param(
    "sssis",
    $nama_komunitas,
    $deskripsi,
    $kategori,
    $jumlah_anggota,
    $status_komunitas
);

// Eksekusi
if ($stmt->execute()) {
    echo json_encode([
        "status" => "success",
        "message" => "Data komunitas berhasil ditambahkan",
        "data" => [
            "id" => $stmt->insert_id,
            "nama_komunitas" => $nama_komunitas,
            "deskripsi" => $deskripsi,
            "kategori" => $kategori,
            "jumlah_anggota" => $jumlah_anggota,
            "status_komunitas" => $status_komunitas
        ]
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Gagal menambahkan data"
    ]);
}

$stmt->close();
$conn->close();
?>
