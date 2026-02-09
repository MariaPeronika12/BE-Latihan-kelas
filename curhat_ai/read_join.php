<?php
include __DIR__ . "/../db.php";

header('Content-Type: application/json');

$chat_id = isset($_GET['chat_id']) ? intval($_GET['chat_id']) : 0;

if ($chat_id <= 0) {
    echo json_encode([
        "status" => false,
        "message" => "chat_id wajib diisi dan harus angka"
    ]);
    exit;
}

$sql = "
    SELECT
        chat_id,
        pesan AS message,
        created_at,
        CASE 
            WHEN pengirim = 'siswa' THEN nama_siswa
            WHEN pengirim = 'psikolog' THEN nama_psikolog
            ELSE 'Tidak diketahui'
        END AS nama_pengirim
    FROM edu_konseling_chat
    WHERE chat_id = ?
    ORDER BY created_at ASC
";

$stmt = $conn->prepare($sql);
if (!$stmt) {
    echo json_encode([
        "status" => false,
        "message" => "Prepare failed: " . $conn->error
    ]);
    exit;
}

$stmt->bind_param("i", $chat_id);
$stmt->execute();

$result = $stmt->get_result();
$data = [];

while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode([
    "status" => true,
    "data" => $data
]);

$stmt->close();
$conn->close();
