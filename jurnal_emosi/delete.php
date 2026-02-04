<?php
include __DIR__ . "/../db.php";
header("Content-Type: application/json");

// Pastikan method POST (lebih aman dari GET)
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode([
        "status" => false,
        "message" => "Method harus POST"
    ]);
    exit;
}

// Ambil id jurnal
$id_jurnal = $_POST['id_jurnal'] ?? null;

// Validasi
if (!$id_jurnal) {
    echo json_encode([
        "status" => false,
        "message" => "id_jurnal wajib diisi"
    ]);
    exit;
}

/* =========================
   CEK DATA ADA ATAU TIDAK
   ========================= */
$cek = $conn->prepare("SELECT id FROM jurnal_emosi WHERE id = ?");
$cek->bind_param("i", $id_jurnal);
$cek->execute();
$cek->store_result();

if ($cek->num_rows === 0) {
    echo json_encode([
        "status" => false,
        "message" => "Data jurnal tidak ditemukan"
    ]);
    exit;
}
$cek->close();

/* =========================
   DELETE DATA
   ========================= */
$stmt = $conn->prepare("DELETE FROM jurnal_emosi WHERE id = ?");
$stmt->bind_param("i", $id_jurnal);

if ($stmt->execute()) {
    echo json_encode([
        "status" => true,
        "message" => "Jurnal emosi berhasil dihapus"
    ]);
} else {
    echo json_encode([
        "status" => false,
        "message" => $stmt->error
    ]);
}

$stmt->close();
$conn->close();
