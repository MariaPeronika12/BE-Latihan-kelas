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
            i.id_insight,
            i.minggu_ke,
            i.tanggal_mulai,
            i.tanggal_selesai,
            i.insight_ringkasan,
            i.mood_rata_rata,
            i.grafik_mood,
            i.target_meditasi,
            i.target_minum_air,
            i.rekomendasi_meditasi,
            i.rekomendasi_musik,
            i.rekomendasi_journaling,
            i.created_at,
            u.nama,
            u.email
        FROM insight_mingguan i
        JOIN user u ON i.id_user = u.id_user
        WHERE i.id_user = ?
        ORDER BY i.minggu_ke DESC";

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
