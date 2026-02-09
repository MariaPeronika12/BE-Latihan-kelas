<?php
include __DIR__ . "/../db.php";
header("Content-Type: application/json");

// WAJIB: id_selfcare
$id_selfcare = $_POST['id_selfcare'] ?? null;

if (!$id_selfcare) {
    echo json_encode([
        "status" => "error",
        "message" => "id_selfcare wajib diisi"
    ]);
    exit;
}

$fields = [];
$params = [];
$types  = "";

// OPTIONAL FIELD (mirip pengaturan)
if (isset($_POST['mood'])) {
    $fields[] = "mood = ?";
    $params[] = $_POST['mood'];
    $types   .= "s";
}

if (isset($_POST['catatan'])) {
    $fields[] = "catatan = ?";
    $params[] = $_POST['catatan'];
    $types   .= "s";
}

if (isset($_POST['emoji'])) {
    $fields[] = "emoji = ?";
    $params[] = $_POST['emoji'];
    $types   .= "s";
}

// Tidak ada field dikirim
if (count($fields) === 0) {
    echo json_encode([
        "status" => "error",
        "message" => "Tidak ada data yang diupdate"
    ]);
    exit;
}

// Query UPDATE dinamis
$sql = "UPDATE self_care SET " . implode(", ", $fields) . " WHERE id_selfcare = ?";
$params[] = $id_selfcare;
$types   .= "i";

$stmt = $conn->prepare($sql);
$stmt->bind_param($types, ...$params);

if ($stmt->execute()) {
    echo json_encode([
        "status" => "success",
        "message" => "Data self care berhasil diperbarui"
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => $stmt->error
    ]);
}

$stmt->close();
$conn->close();
