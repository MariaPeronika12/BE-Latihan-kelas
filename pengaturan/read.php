<?php
include __DIR__ . "/../db.php";

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    echo json_encode([
        "status" => false,
        "message" => "Method harus GET"
    ]);
    exit;
}

// query aman tanpa nebak kolom
$sql = "
    SELECT p.*
    FROM pengaturan p
";

$result = $conn->query($sql);

if (!$result) {
    echo json_encode([
        "status" => false,
        "message" => $conn->error
    ]);
    exit;
}

if ($result->num_rows === 0) {
    echo json_encode([
        "status" => false,
        "message" => "Data pengaturan kosong"
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
