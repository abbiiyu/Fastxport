<?php
// Konfigurasi koneksi
$servername = "localhost"; // Host database
$username = "root";        // Username default XAMPP
$password = "";            // Password default XAMPP (biasanya kosong)
$dbname = "fastxport_db"; // Ganti dengan nama database Anda

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
//echo "Koneksi berhasil!";
?>