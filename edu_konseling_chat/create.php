<?php
include "../db.php";
header("Content-Type: application/json");

// Ambil data dari Postman (form-data)
$nama_siswa = $_POST['nama_siswa'] ?? '';
$email_siswa = $_POST['email_siswa'] ?? '';
$nama_psikolog = $_POST['nama_psikolog'] ?? '';
$pengirim = $_POST['pengirim'] ?? '';
$pesan = $_POST['pesan'] ?? '';
$metode_pembayaran = $_POST['metode_pembayaran'] ?? '';
$status_pembayaran = $_POST['status_pembayaran'] ?? '';
$harga = $_POST['harga'] ?? '';
$chat_id = $_POST['chat_id'] ?? '';

// Validasi
if (
    empty($nama_siswa) ||
    empty($email_siswa) ||
    empty($nama_psikolog) ||
    empty($pengirim) ||
    empty($pesan) ||
    empty($chat_id)
) {
    echo json_encode([
        "status" => "error",
        "message" => "Data tidak lengkap"
    ]);
    exit;
}

// ⚠️ PASTIKAN NAMA TABEL SESUAI DATABASE
$sql = "INSERT INTO edu_konseling_chat
(
    chat_id,
    nama_siswa,
    email_siswa,
    nama_psikolog,
    pengirim,
    pesan,
    metode_pembayaran,
    status_pembayaran,
    harga
)
VALUES (?,?,?,?,?,?,?,?,?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param(
    "isssssssi",
    $chat_id,
    $nama_siswa,
    $email_siswa,
    $nama_psikolog,
    $pengirim,
    $pesan,
    $metode_pembayaran,
    $status_pembayaran,
    $harga
);

if ($stmt->execute()) {
    echo json_encode([
        "status" => "success",
        "message" => "Chat konseling berhasil disimpan"
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Gagal menyimpan data"
    ]);
}
?>
