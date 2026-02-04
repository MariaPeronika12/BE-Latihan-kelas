<?php
// Koneksi ke database
include '../db.php';

// Response JSON
header('Content-Type: application/json');

// Penampung data
$data = [];

if (isset($_GET['chat_id']) || isset($_GET['user_id'])) {

    if (isset($_GET['chat_id'])) {
        $chat_id = $_GET['chat_id'];
        $stmt = $conn->prepare(
            "SELECT * FROM edu_konseling_chat WHERE chat_id = ?"
        );
        $stmt->bind_param("i", $chat_id);

    } else {
        $user_id = $_GET['user_id'];
        $stmt = $conn->prepare(
            "SELECT * FROM edu_konseling_chat WHERE user_id = ? ORDER BY created_at DESC"
        );
        $stmt->bind_param("i", $user_id);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    $stmt->close();

} else {
    // Jika tidak ada parameter → ambil semua data
    $sql = "SELECT * FROM edu_konseling_chat ORDER BY created_at DESC";
    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Output JSON
echo json_encode([
    "status" => "success",
    "data"   => $data
]);

$conn->close();
?>
