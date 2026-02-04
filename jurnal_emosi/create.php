<?php
include __DIR__ . "/../db.php";
header("Content-Type: application/json");

// Pastikan method POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode([
        "status" => "error",
        "message" => "Method harus POST"
    ]);
    exit;
}

// Ambil data dari Postman (form-data / x-www-form-urlencoded)
$user_id = $_POST['user_id'] ?? '';
$tanggal = $_POST['tanggal'] ?? '';
$judul   = $_POST['judul'] ?? '';
$isi     = $_POST['isi'] ?? '';
$emosi   = $_POST['emosi'] ?? '';

// Validasi wajib
if (
    empty($user_id) ||
    empty($tanggal) ||
    empty($emosi)
) {
    echo json_encode([
        "status" => "error",
        "message" => "user_id, tanggal, dan emosi wajib diisi"
    ]);
    exit;
}

/* =========================
   CEK USER_ID ADA ATAU TIDAK
   ========================= */
$cekUser = $conn->prepare(
    "SELECT user_id FROM users WHERE user_id = ?"
);
$cekUser->bind_param("i", $user_id);
$cekUser->execute();
$cekUser->store_result();

if ($cekUser->num_rows === 0) {
    echo json_encode([
        "status" => "error",
        "message" => "user_id tidak ditemukan di tabel users"
    ]);
    exit;
}
$cekUser->close();

/* =========================
   INSERT KE JURNAL EMOSI
   ========================= */
$sql = "
    INSERT INTO jurnal_emosi
    (user_id, tanggal, judul, isi, emosi, created_at, updated_at)
    VALUES (?, ?, ?, ?, ?, NOW(), NOW())
";

$stmt = $conn->prepare($sql);
$stmt->bind_param(
    "issss",
    $user_id,
    $tanggal,
    $judul,
    $isi,
    $emosi
);

if ($stmt->execute()) {
    echo json_encode([
        "status" => "success",
        "message" => "Jurnal emosi berhasil disimpan",
        "id" => $stmt->insert_id
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => $stmt->error
    ]);
}

$stmt->close();
$conn->close();
