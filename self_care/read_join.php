<?php
include "../db.php";
header("Content-Type: application/json");

$sql = "SELECT
            s.id_self_care,
            s.judul,
            s.deskripsi,
            s.kategori,
            s.durasi,
            s.created_at,
            u.id_user,
            u.nama AS nama_user
        FROM self_care s
        JOIN users u ON s.id_user = u.id_user
        ORDER BY s.created_at DESC";

$result = $conn->query($sql);

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode([
    "status" => "success",
    "data" => $data
]);
?>
