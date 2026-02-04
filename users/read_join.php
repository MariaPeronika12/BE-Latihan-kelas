<?php
// koneksi database
include_once '../db.php';

// response JSON
header('Content-Type: application/json');

/*
 JOIN users dengan mood_tracking
 Tujuan:
 - menampilkan data user
 - menghitung jumlah mood per user
*/
$query = "
SELECT 
    users.user_id,
    users.username,
    users.email,
    COUNT(mood_tracking.mood_id) AS total_mood
FROM users
LEFT JOIN mood_tracking
    ON users.user_id = mood_tracking.user_id
GROUP BY users.user_id, users.username, users.email
ORDER BY users.user_id DESC
";

// jalankan query
$result = $conn->query($query);

if ($result->num_rows > 0) {

    $data = [];

    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    echo json_encode([
        "status" => "success",
        "data" => $data
    ]);

} else {

    echo json_encode([
        "status" => "success",
        "message" => "Data user belum ada"
    ]);
}

// tutup koneksi
$conn->close();
?>
