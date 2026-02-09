<?php
include __DIR__ . "/../db.php";
header("Content-Type: application/json");

// Ambil data dari POST
$user_id  = $_POST['user_id'] ?? null;
$mood     = $_POST['mood'] ?? null;
$catatan = $_POST['catatan'] ?? null;
$emoji   = $_POST['emoji'] ?? null;

// Validasi data
if (
    !$user_id ||
    !$mood ||
    $catatan === null ||
    $emoji === null
) {
    echo json_encode([
        "status" => "error",
        "message" => "Data tidak lengkap"
    ]);
    exit;
}

// Insert sesuai struktur tabel
$stmt = $conn->prepare("
    INSERT INTO self_care (
        user_id,
        mood,
        catatan,
        emoji
    ) VALUES (?, ?, ?, ?)
");

$stmt->bind_param(
    "isss",
    $user_id,
    $mood,
    $catatan,
    $emoji
);

if ($stmt->execute()) {
    echo json_encode([
        "status" => "success",
        "message" => "Self care berhasil ditambahkan"
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => $stmt->error
    ]);
}

$stmt->close();
$conn->close();
