<?php

// Menghubungkan file koneksi database
// File db.php biasanya berisi:
// $conn = mysqli_connect("localhost","root","","nama_database");
include_once '../db.php';


// Memberitahu client (Postman / aplikasi) bahwa response berbentuk JSON
header('Content-Type: application/json');


// Mengambil data dari request POST
// Key harus sama dengan yang dikirim dari Postman!
$username = $_POST['username'];
$email = $_POST['email'];


// Menyiapkan query INSERT menggunakan PREPARED STATEMENT
// Kenapa pakai ini?
// 👉 Supaya aman dari SQL Injection
$stmt = $conn->prepare("
    INSERT INTO users (username, email, created_at)
    VALUES (?, ?, NOW())
");


// Mengikat parameter ke tanda tanya (?, ?)
// "ss" artinya:
// s = string (username)
// s = string (email)
$stmt->bind_param("ss", $username, $email);


// Menjalankan query
if ($stmt->execute()) {

    // Jika berhasil, kirim response sukses
    echo json_encode([
        "status" => "success",
        "message" => "User berhasil ditambahkan",
        
        // insert_id = ID terakhir yang masuk AUTO_INCREMENT
        "user_id" => $stmt->insert_id
    ]);

} else {

    // Jika gagal, tampilkan error MySQL
    echo json_encode([
        "status" => "error",
        "message" => $stmt->error
    ]);
}


// Menutup statement → supaya hemat memory server
$stmt->close();


// Menutup koneksi database
$conn->close();

?>
