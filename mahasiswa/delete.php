<?php
include '../db.php';

header('Content-Type: application/json');

// ID MOOD DARI POSTMAN
$mood_id = $_POST['mood_id'];


$stmt = $conn->prepare("DELETE FROM mood_tracking WHERE mood_id = ?");
$stmt->bind_param("i", $mood_id);

if ($stmt->execute()) {

    echo json_encode([
        "status"  => "success",
        "message" => "Mood berhasil dihapus"
    ]);

} else {

    echo json_encode([
        "status"  => "error",
        "message" => $stmt->error
    ]);

}

$stmt->close();
$conn->close();
?>
