<?php
header('Content-Type: application/json');

include __DIR__ . '/../db.php';

if (!isset($_GET['id_pengaturan'])) {
    echo json_encode([
        "status" => false,
        "message" => "id_pengaturan tidak terbaca"
    ]);
    exit;
}

$id_pengaturan = (int) $_GET['id_pengaturan'];

$sql = "SELECT * FROM pengaturan WHERE id_pengaturan = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_pengaturan);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode([
        "status" => false,
        "message" => "Data pengaturan tidak ditemukan"
    ]);
    exit;
}

echo json_encode([
    "status" => true,
    "data" => $result->fetch_assoc()
]);
