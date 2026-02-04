<?php
include "../db.php";
header("Content-Type: application/json");

// Ambil data
$id_jurnal = $_POST['id_jurnal'] ?? '';
$tanggal   = $_POST['tanggal'] ?? '';
$judul     = $_POST['judul'] ?? '';
$isi       = $_POST['isi'] ?? '';
$emosi     = $_POST['emosi'] ?? '';

// Validasi
if ($id_jurnal == '') {
    echo json_encode([
        "status" => "error",
        "message" => "id jurnal wajib diisi"
    ]);
    exit;
}

$sql = "
    UPDATE jurnal_emosi
    SET tanggal = ?, judul = ?, isi = ?, emosi = ?, updated_at = NOW()
    WHERE id = ?
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssi", $tanggal, $judul, $isi, $emosi, $id_jurnal);

if ($stmt->execute()) {
    echo json_encode([
        "status" => "success",
        "message" => "Jurnal emosi berhasil diperbarui"
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => $stmt->error
    ]);
}

$stmt->close();
$conn->close();
