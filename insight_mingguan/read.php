<?php
include "../db.php";
header("Content-Type: application/json");

// Ambil parameter optional
$id_user = isset($_GET['id_user']) ? $_GET['id_user'] : null;

if ($id_user) {

    $sql = "SELECT 
                id_insight,
                id_user,
                minggu_ke,
                tanggal_mulai,
                tanggal_selesai,
                insight_ringkasan,
                mood_rata_rata,
                grafik_mood,
                target_meditasi,
                target_minum_air,
                rekomendasi_meditasi,
                rekomendasi_musik,
                rekomendasi_journaling,
                created_at
            FROM insight_mingguan
            WHERE id_user = ?
            ORDER BY created_at DESC";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_user);
    $stmt->execute();
    $result = $stmt->get_result();

} else {

    $sql = "SELECT 
                id_insight,
                id_user,
                minggu_ke,
                tanggal_mulai,
                tanggal_selesai,
                insight_ringkasan,
                mood_rata_rata,
                grafik_mood,
                target_meditasi,
                target_minum_air,
                rekomendasi_meditasi,
                rekomendasi_musik,
                rekomendasi_journaling,
                created_at
            FROM insight_mingguan
            ORDER BY created_at DESC";

    $result = $conn->query($sql);
}

$data = [];

while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode([
    "status" => "success",
    "data" => $data
]);
?>
