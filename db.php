<?php
// HEADER CORS (sesuai contoh dosen)
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");

// KONFIGURASI DATABASE SERENICA
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "serenica_db"; // WAJIB sesuai database kamu

// KONEKSI DATABASE
$conn = new mysqli($servername, $username, $password, $dbname);

// CEK KONEKSI
if ($conn->connect_error) {
    die(json_encode([
        "status"  => "error",
        "message" => "Koneksi database gagal: " . $conn->connect_error
    ]));
}
?>
