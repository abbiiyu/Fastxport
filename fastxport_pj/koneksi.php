<?php
// Konfigurasi koneksi
$db_host = "localhost"; // Host database
$db_user = "root";        // Username default XAMPP
$db_pass = "";            // Password default XAMPP (biasanya kosong)
$db_name= "fastxport_db"; // Ganti dengan nama database Anda

// Membuat koneksi
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

// Cek koneksi
if (!$conn) {
    die("Koneksi Gagal");
} 
?>