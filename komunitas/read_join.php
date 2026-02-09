<?php
header('Content-Type: application/json');

// koneksi database
include __DIR__ . '/../db.php';

// validasi parameter
if (!isset($_GET['id_pengaturan'])) {
    echo json_encode([
        "status" => false,
        "message" => "Parameter id_pengaturan wajib dikirim"
    ]);
    exit;
}

$id_pengaturan = (int) $_GET['id_pengaturan'];

// QUERY JOIN (PASTI JALAN JIKA TABEL ADA)
$sql = "
SELECT 
    p.id_pengaturan,
    p.nama_pengaturan,
    p.nilai,
    u.id_user,
    u.nama_user,
    u.email
FROM pengaturan p
JOIN users u ON p.id_user = u.id_user
WHERE p.id_pengaturan = ?
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_pengaturan);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode([
        "status" => false,
        "message" => "Data tidak ditemukan"
    ]);
    exit;
}

echo json_encode([
    "status" => true,
    "data" => $result->fetch_assoc()
]);
