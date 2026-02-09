<?php
include "../db.php";
header("Content-Type: application/json");

$id_user = $_GET['id_user'];

if (empty($id_user)) {
    echo json_encode([
        "status" => "error",
        "message" => "ID user tidak ditemukan"
    ]);
    exit;
}

$sql = "SELECT 
            id_chat,
            id_user,
            kategori_curhat,
            pesan,
            pengirim,
            status_pesan,
            created_at
        FROM curhat_ai
        WHERE id_user = ?
        ORDER BY created_at ASC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_user);
$stmt->execute();

$result = $stmt->get_result();
$data = [];

while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode([
    "status" => "success",
    "data" => $data
]);
?>
