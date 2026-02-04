<?php
// ===============================
// READ AUDIO RELAKSASI
// ===============================

include "../db.php";

header("Content-Type: application/json");

// Ambil semua data audio
$sql = "SELECT * FROM audio_relaksasi ORDER BY created_at DESC";
$result = $conn->query($sql);

$data = [];

while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

// Response
echo json_encode([
    "status" => "success",
    "total" => count($data),
    "data" => $data
]);
?>
