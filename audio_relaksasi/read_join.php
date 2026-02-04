<?php
include "../db.php";
header("Content-Type: application/json");

// QUERY READ (TANPA JOIN)
$sql = "
SELECT 
    id_audio,
    judul,
    deskripsi,
    file_audio,
    durasi,
    kategori,
    cover_image,
    created_at
FROM audio_relaksasi
";

$result = $conn->query($sql);

if (!$result) {
    echo json_encode([
        "status" => "error",
        "message" => $conn->error
    ]);
    exit;
}

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode([
    "status" => "success",
    "data" => $data
]);
