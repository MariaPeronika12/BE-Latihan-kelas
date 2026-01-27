<?php
// Koneksi ke database menggunakan file db.php
include '../db.php';

// Menentukan bahwa respon akan dalam format JSON
header('Content-Type: application/json');

// Array untuk menyimpan data hasil query
$data = [];

if (isset($_GET['user_id']) || isset($_GET['mood_id'])) {
    if (isset($_GET['mood_id'])) {
        $mood_id = $_GET['mood_id'];
        $stmt = $conn->prepare("SELECT * FROM mood_tracking WHERE mood_id = ?");
        $stmt->bind_param("i", $mood_id);
    } else {
        $user_id = $_GET['user_id'];
        $stmt = $conn->prepare("SELECT * FROM mood_tracking WHERE user_id = ? ORDER BY created_at DESC");
        $stmt->bind_param("i", $user_id);
    }

$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}
    
    $stmt->close();
} else {
    $sql = "SELECT * FROM mood_tracking ORDER BY created_at DESC";
    $result = $conn->query($sql);

    // Loop melalui semua hasil dan tambahkan ke array data
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Kirimkan data dalam format JSON
echo json_encode([
    "status" => "success",
    "data"   => $data
]);
$conn->close();

/*
PETUNJUK UNTUK MENYESUAIKAN DENGAN SCHEMA TABEL LAIN:

Jika ingin menggunakan skema tabel yang berbeda, ubah bagian-bagian berikut:
1. Nama tabel: Ganti 'tb_mahasiswa' dengan nama tabel Anda
2. Nama kolom: Ganti 'nim', 'id' sesuai dengan kolom pencarian di tabel Anda
3. Parameter GET: Sesuaikan dengan nama parameter yang ingin Anda gunakan untuk pencarian
4. Tipe data parameter: Perhatikan tipe data saat menggunakan bind_param()
   Misalnya: "ii" untuk dua integer, "ss" untuk dua string
*/
?>
