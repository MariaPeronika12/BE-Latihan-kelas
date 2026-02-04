<?php
// Menghubungkan ke database
include_once '../db.php';

// Memberitahu client bahwa response berbentuk JSON
header('Content-Type: application/json');


// ==============================
// Ambil data dari POST
// ==============================

// user_id WAJIB → karena kita mau update user tertentu
$user_id = $_POST['user_id'];

// Data baru yang ingin diubah
$username = $_POST['username'];
$email = $_POST['email'];


// ==============================
// Validasi sederhana
// ==============================

if(empty($user_id) || empty($username) || empty($email)){
    
    echo json_encode([
        "status" => "error",
        "message" => "Semua field wajib diisi!"
    ]);
    exit();
}


// ==============================
// Query UPDATE pakai prepared statement
// (SUPER AMAN dari SQL Injection)
// ==============================

$stmt = $conn->prepare("
    UPDATE users 
    SET username = ?, email = ?
    WHERE user_id = ?
");


// s = string
// s = string
// i = integer
$stmt->bind_param("ssi", $username, $email, $user_id);


// ==============================
// Eksekusi query
// ==============================

if($stmt->execute()){

    // Cek apakah ada baris yang benar-benar berubah
    if($stmt->affected_rows > 0){

        echo json_encode([
            "status" => "success",
            "message" => "User berhasil diupdate"
        ]);

    } else {

        echo json_encode([
            "status" => "warning",
            "message" => "Data tidak berubah atau user tidak ditemukan"
        ]);
    }

}else{

    echo json_encode([
        "status" => "error",
        "message" => $stmt->error
    ]);
}


// Tutup statement & koneksi
$stmt->close();
$conn->close();

?>
