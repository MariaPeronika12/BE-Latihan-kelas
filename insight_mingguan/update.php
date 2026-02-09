<?php
header("Content-Type: application/json");
include "../db.php";

$id_user = $_POST['id_user'] ?? null;
$grafik_mood = $_POST['grafik_mood'] ?? '';

$target_meditasi  = $_POST['target_meditasi'] ?? 0;
$target_minum_air = $_POST['target_minum_air'] ?? 0;

if (!$id_user) {
    echo json_encode([
        "status" => "error",
        "message" => "id_user wajib dikirim"
    ]);
    exit;
}

// validasi JSON grafik_mood
json_decode($grafik_mood);
if (json_last_error() !== JSON_ERROR_NONE) {
    echo json_encode([
        "status" => "error",
        "message" => "grafik_mood harus JSON valid"
    ]);
    exit;
}

$sql = "UPDATE insight_mingguan 
        SET target_meditasi = ?, 
            target_minum_air = ?, 
            grafik_mood = ?
        WHERE id_user = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param(
    "iisi",
    $target_meditasi,
    $target_minum_air,
    $grafik_mood,
    $id_user
);

if ($stmt->execute()) {
    echo json_encode([
        "status" => "success",
        "message" => "Insight berhasil diupdate"
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => $stmt->error
    ]);
}
