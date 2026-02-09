<?php
include "../db.php";
header("Content-Type: application/json");

$id_insight = $_POST['id_insight'];

if (empty($id_insight)) {
    echo json_encode([
        "status" => "error",
        "message" => "ID insight tidak ditemukan"
    ]);
    exit;
}

$sql = "DELETE FROM insight_mingguan WHERE id_insight = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_insight);

if ($stmt->execute()) {
    echo json_encode([
        "status" => "success",
        "message" => "Insight mingguan berhasil dihapus"
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => $stmt->error
    ]);
}
?>
