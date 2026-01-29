<?php
header("Content-Type: application/json");
include "../db.php";

// QUERY JOIN
$sql = "
    SELECT 
        m.mood_id,
        u.user_id,
        u.username`,
        u.email,
        m.mood,
        m.note,
        m.created_at
    FROM mood_tracking m
    INNER JOIN users u ON m.user_id = u.user_id
";

$result = mysqli_query($conn, $sql);

if (!$result) {
    echo json_encode([
        "status" => "error",
        "message" => mysqli_error($conn)
    ]);
    exit;
}

$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

echo json_encode([
    "status" => "success",
    "message" => count($data) > 0 ? "Data berhasil ditampilkan" : "Data kosong",
    "data" => $data
]);

exit;
