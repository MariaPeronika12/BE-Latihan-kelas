<?php
include "../db.php";
header("Content-Type: application/json");

$data = $_POST;

if (
    empty($data['id_chat']) ||
    empty($data['status_pesan'])
) {
    echo json_encode([
        "status" => "error",
        "message" => "Data tidak lengkap"
    ]);
    exit;
}

$sql = "UPDATE curhat_ai 
        SET status_pesan = ?
        WHERE id_chat = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param(
    "si",
    $data['status_pesan'],
    $data['id_chat']
);

if ($stmt->execute()) {
    echo json_encode([
        "status" => "success",
        "message" => "Status pesan berhasil diperbarui"
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => $stmt->error
    ]);
}
?>
