<?php
include "../db.php";
header("Content-Type: application/json");

$data = $_POST;

// Validasi
if (
    empty($data['id_user']) ||
    empty($data['kategori_curhat']) ||
    empty($data['pesan']) ||
    empty($data['pengirim'])
) {
    echo json_encode([
        "status" => "error",
        "message" => "Data tidak lengkap"
    ]);
    exit;
}

$status_pesan = "terkirim";

$sql = "INSERT INTO curhat_ai 
        (id_user, kategori_curhat, pesan, pengirim, status_pesan, created_at)
        VALUES (?, ?, ?, ?, ?, NOW())";

$stmt = $conn->prepare($sql);
$stmt->bind_param(
    "issss",
    $data['id_user'],
    $data['kategori_curhat'],
    $data['pesan'],
    $data['pengirim'],
    $status_pesan
);

if ($stmt->execute()) {
    echo json_encode([
        "status" => "success",
        "message" => "Pesan curhat berhasil dikirim",
        "id_chat" => $conn->insert_id,
        "status_pesan" => $status_pesan
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => $stmt->error
    ]);
}
?>
