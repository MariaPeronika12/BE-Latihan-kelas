<?php
include '../db.php';

header('Content-Type: application/json');

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

    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

echo json_encode([
    "status" => "success",
    "data"   => $data
]);
$conn->close();
?>
