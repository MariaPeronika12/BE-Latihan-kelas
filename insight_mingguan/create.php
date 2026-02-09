<?php
header("Content-Type: application/json");

// Koneksi database
$conn = new mysqli("localhost", "root", "", "serenica_db");

if ($conn->connect_error) {
    echo json_encode([
        "status" => "error",
        "message" => "Koneksi database gagal"
    ]);
    exit;
}

// Ambil data POST dengan aman
$id_user                = $_POST['id_user'] ?? null;
$tanggal_mulai          = $_POST['tanggal_mulai'] ?? null;
$tanggal_selesai        = $_POST['tanggal_selesai'] ?? null;
$insight_ringkasan      = $_POST['insight_ringkasan'] ?? '';
$mood_rata_rata         = $_POST['mood_rata_rata'] ?? '';
$target_meditasi        = isset($_POST['target_meditasi']) ? (int)$_POST['target_meditasi'] : 0;
$target_minum_air       = isset($_POST['target_minum_air']) ? (int)$_POST['target_minum_air'] : 0;
$rekomendasi_meditasi   = isset($_POST['rekomendasi_meditasi']) ? (int)$_POST['rekomendasi_meditasi'] : 0;
$rekomendasi_musik      = isset($_POST['rekomendasi_musik']) ? (int)$_POST['rekomendasi_musik'] : 0;
$rekomendasi_journaling = isset($_POST['rekomendasi_journaling']) ? (int)$_POST['rekomendasi_journaling'] : 0;

// ======= HANDLE JSON DENGAN AMAN =======
$grafik_mood_input = $_POST['grafik_mood'] ?? '{}';

// Coba decode JSON
$decoded = json_decode($grafik_mood_input, true);

// Jika tidak valid JSON → pakai default kosong
if (json_last_error() !== JSON_ERROR_NONE) {
    $grafik_mood = '{}';
} else {
    $grafik_mood = json_encode($decoded); // pastikan format valid
}

// Validasi minimal wajib
if (!$id_user || !$tanggal_mulai) {
    echo json_encode([
        "status" => "error",
        "message" => "id_user dan tanggal_mulai wajib diisi"
    ]);
    exit;
}

// Insert ke database
$stmt = $conn->prepare("INSERT INTO insight_mingguan 
(id_user, tanggal_mulai, tanggal_selesai, insight_ringkasan, mood_rata_rata,
 target_meditasi, target_minum_air, rekomendasi_meditasi,
 rekomendasi_musik, rekomendasi_journaling, grafik_mood, created_at)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");

if (!$stmt) {
    echo json_encode([
        "status" => "error",
        "message" => $conn->error
    ]);
    exit;
}

$stmt->bind_param(
    "issssiiiiis",
    $id_user,
    $tanggal_mulai,
    $tanggal_selesai,
    $insight_ringkasan,
    $mood_rata_rata,
    $target_meditasi,
    $target_minum_air,
    $rekomendasi_meditasi,
    $rekomendasi_musik,
    $rekomendasi_journaling,
    $grafik_mood
);

if ($stmt->execute()) {
    echo json_encode([
        "status" => "success",
        "message" => "Data berhasil ditambahkan"
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => $stmt->error
    ]);
}

$stmt->close();
$conn->close();
?>
