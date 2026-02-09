<?php
include __DIR__ . "/../db.php";
header("Content-Type: application/json");

// Ambil data dari POST
$id_user            = $_POST['id_user'] ?? null;
$email              = $_POST['email'] ?? null;
$privasi_akun       = $_POST['privasi_akun'] ?? null;
$notifikasi_harian  = $_POST['notifikasi_harian'] ?? null;
$mode_tampilan      = $_POST['mode_tampilan'] ?? null;
$tutorial           = $_POST['tutorial'] ?? null;

// Validasi data
if (
    !$id_user ||
    !$email ||
    !$privasi_akun ||
    $notifikasi_harian === null ||
    !$mode_tampilan ||
    $tutorial === null
) {
    echo json_encode([
        "status" => "error",
        "message" => "Data tidak lengkap"
    ]);
    exit;
}

// Query insert
$stmt = $conn->prepare("
    INSERT INTO pengaturan (
        id_user,
        email,
        privasi_akun,
        notifikasi_harian,
        mode_tampilan,
        tutorial
    ) VALUES (?, ?, ?, ?, ?, ?)
");

$stmt->bind_param(
    "ississ",
    $id_user,
    $email,
    $privasi_akun,
    $notifikasi_harian,
    $mode_tampilan,
    $tutorial
);

if ($stmt->execute()) {
    echo json_encode([
        "status" => "success",
        "message" => "Pengaturan berhasil ditambahkan"
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => $stmt->error
    ]);
}

$stmt->close();
$conn->close();
