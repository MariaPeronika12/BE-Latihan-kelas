<?php
// ===============================
// DELETE AUDIO RELAKSASI
// ===============================

// Koneksi database
include "../db.php";

// Set response JSON
header("Content-Type: application/json");

// Ambil data dari form-data / x-www-form-urlencoded
$data = $_POST;

// Validasi ID (WAJIB)
if (empty($data['id_audio'])) {
    echo json_encode([
        "status" => "error",
        "message" => "ID audio wajib dikirim"
    ]);
    exit;
}

// Simpan ID ke variabel
$id_audio = $data['id_audio'];

// Query DELETE
$sql = "DELETE FROM audio_relaksasi WHERE id_audio = ?";

// Prepare statement
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_audio);

// Eksekusi query
if ($stmt->execute()) {
    echo json_encode([
        "status" => "success",
        "message" => "Data audio berhasil dihapus"
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Gagal menghapus data"
    ]);
}
?>
