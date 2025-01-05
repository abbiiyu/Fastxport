<?php
session_start();
include_once('../conn.php'); // Pastikan path-nya sesuai

// Ambil ID produk dari URL
$id_product = isset($_GET['id']) ? $_GET['id'] : '';

// Pastikan ID produk valid
if (empty($id_product)) {
    die("Invalid product ID.");
}

// Hapus query
$stmt = $conn->prepare("DELETE FROM product WHERE id_product=?");
$stmt->bind_param("s", $id_product);

if ($stmt->execute()) {
    header("Location: supplier.php?message=Product deleted successfully.");
    exit();
} else {
    echo "Error deleting product: " . htmlspecialchars($stmt->error);
}

// Menutup koneksi
$stmt->close();
$conn->close();
?>
