<?php
include "../db.php";
header("Content-Type: application/json");

$chat_id  = $_POST['chat_id'] ?? '';
$pengirim = $_POST['pengirim'] ?? '';
$pesan    = $_POST['pesan'] ?? '';

if (empty($chat_id) || empty($pengirim) || empty($pesan)) {
    echo json_encode([
        "status" => "error",
        "message" => "Data tidak lengkap"
    ]);
    exit;
}

$sql = "UPDATE edu_konseling_chat 
        SET pengirim = ?, pesan = ?
        WHERE chat_id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssi", $pengirim, $pesan, $chat_id);

if ($stmt->execute()) {
    echo json_encode([
        "status" => "success",
        "message" => "Chat berhasil diperbarui"
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Gagal update chat"
    ]);
}
?>
