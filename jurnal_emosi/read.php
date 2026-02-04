<?php
include __DIR__ . "/../db.php";
header("Content-Type: application/json");

// Ambil parameter (opsional)
$id_jurnal = $_GET['id_jurnal'] ?? null;
$user_id   = $_GET['user_id'] ?? null;

/* =========================
   JIKA AMBIL 1 JURNAL (BY ID)
   ========================= */
if ($id_jurnal) {

    $stmt = $conn->prepare("
        SELECT 
            id,
            user_id,
            tanggal,
            judul,
            isi,
            emosi,
            created_at,
            updated_at
        FROM jurnal_emosi
        WHERE id = ?
    ");
    $stmt->bind_param("i", $id_jurnal);

}
/* =========================
   JIKA AMBIL PER USER
   ========================= */
elseif ($user_id) {

    $stmt = $conn->prepare("
        SELECT 
            id,
            user_id,
            tanggal,
            judul,
            isi,
            emosi,
            created_at,
            updated_at
        FROM jurnal_emosi
        WHERE user_id = ?
        ORDER BY tanggal DESC
    ");
    $stmt->bind_param("i", $user_id);

}
/* =========================
   AMBIL SEMUA DATA
   ========================= */
else {

    $stmt = $conn->prepare("
        SELECT 
            id,
            user_id,
            tanggal,
            judul,
            isi,
            emosi,
            created_at,
            updated_at
        FROM jurnal_emosi
        ORDER BY tanggal DESC
    ");
}

$stmt->execute();
$result = $stmt->get_result();

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
