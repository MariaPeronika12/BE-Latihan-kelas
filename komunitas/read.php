<?php
include __DIR__ . "/../db.php";
header("Content-Type: application/json");

$sql = "SELECT * FROM komunitas";
$result = $conn->query($sql);

if (!$result) {
    echo json_encode([
        "status" => false,
        "message" => $conn->error
    ]);
    exit;
}

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode([
    "status" => true,
    "total" => count($data),
    "data" => $data
]);

$conn->close();
