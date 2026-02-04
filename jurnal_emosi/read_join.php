<?php
include __DIR__ . "/../db.php";
header("Content-Type: application/json");

// Ambil parameter opsional
$id_jurnal = $_GET['id_jurnal'] ?? null;
$user_id   = $_GET['user_id'] ?? null;

/* =========================
   BASE QUERY (JOIN)
   ========================= */
$sql = "
    SELECT 
        j.id AS id_jurnal,
        j.tanggal,
        j.judul,
        j.isi,
        j.emosi,
        j.created_at,
        j.updated_at,
        u.user_id,
        u.username,
        u.email
    FROM jurnal_emosi j
    JOIN users u 
        ON j.user_id = u.user_id
";

/* =========================
   FILTER
   ========================= */
$params = [];
$types  = "";

if ($id_jurnal) {
    $sql .= " WHERE j.id = ?";
    $params[] = $id_jurnal;
    $types .= "i";
} elseif ($user_id) {
    $sql .= " WHERE j.user_id = ?";
    $params[] = $user_id;
    $types .= "i";
}

$sql .= " ORDER BY j.tanggal DESC";

/* =========================
   PREPARE & EXECUTE
   ========================= */
$stmt = $conn->prepare($sql);

if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}

$stmt->execute();
$result = $stmt->get_result();

/* =========================
   RESPONSE
   ========================= */
$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode([
    "status" => true,
    "total"  => count($data),
    "data"   => $data
]);

$stmt->close();
$conn->close();
