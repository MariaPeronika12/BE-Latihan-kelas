<?php
header('Content-Type: application/json');

/* =============================
   KONEKSI DATABASE
   ============================= */
include __DIR__ . '/../koneksi.php';

/* =============================
   VALIDASI PARAMETER
   ============================= */
if (!isset($_GET['chat_id'])) {
    echo json_encode([
        "status" => false,
        "message" => "chat_id wajib diisi"
    ]);
    exit;
}

$chat_id = intval($_GET['chat_id']);

/* =============================
   QUERY JOIN (AMAN)
   ============================= */
$sql = "
    SELECT 
        c.chat_id,
        c.pesan,
        c.created_at,
        u.user_id,
        u.nama AS nama_user
    FROM edu_konseling_chat c
    JOIN users u ON c.user_id = u.user_id
    WHERE c.chat_id = ?
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $chat_id);
$stmt->execute();
$result = $stmt->get_result();

/* =============================
   HASIL
   ============================= */
$data = [];

while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

$stmt->close();
$conn->close();

/* =============================
   RESPONSE
   ============================= */
echo json_encode([
    "status" => true,
    "data" => $data
]);
