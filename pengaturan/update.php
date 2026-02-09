<?php
include __DIR__ . "/../db.php";
header("Content-Type: application/json");

$id_user = $_POST['id_user'] ?? null;

if (!$id_user) {
    echo json_encode([
        "status" => "error",
        "message" => "id_user wajib diisi"
    ]);
    exit;
}

$fields = [];
$params = [];
$types  = "";

if (isset($_POST['email'])) {
    $fields[] = "email = ?";
    $params[] = $_POST['email'];
    $types .= "s";
}

if (isset($_POST['privasi_akun'])) {
    $fields[] = "privasi_akun = ?";
    $params[] = $_POST['privasi_akun'];
    $types .= "s";
}

if (isset($_POST['notifikasi_harian'])) {
    $fields[] = "notifikasi_harian = ?";
    $params[] = $_POST['notifikasi_harian'];
    $types .= "i";
}

if (isset($_POST['mode_tampilan'])) {
    $fields[] = "mode_tampilan = ?";
    $params[] = $_POST['mode_tampilan'];
    $types .= "s";
}

if (isset($_POST['tutorial'])) {
    $fields[] = "tutorial = ?";
    $params[] = $_POST['tutorial'];
    $types .= "i";
}

if (count($fields) === 0) {
    echo json_encode([
        "status" => "error",
        "message" => "Tidak ada data yang diupdate"
    ]);
    exit;
}

$sql = "UPDATE pengaturan SET " . implode(", ", $fields) . " WHERE id_user = ?";
$params[] = $id_user;
$types .= "i";

$stmt = $conn->prepare($sql);
$stmt->bind_param($types, ...$params);

$stmt->execute();

echo json_encode([
    "status" => "success",
    "message" => "Pengaturan berhasil diperbarui"
]);
