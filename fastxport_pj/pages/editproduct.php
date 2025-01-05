<?php
session_start();
include_once('../conn.php'); // Pastikan path-nya sesuai

// Ambil ID produk dari URL
$id_product = isset($_GET['id']) ? $_GET['id'] : '';

// Pastikan ID produk valid
if (empty($id_product)) {
    die("Invalid product ID.");
}

// Ambil data produk untuk ditampilkan di form
$stmt = $conn->prepare("SELECT * FROM product WHERE id_product=?");
$stmt->bind_param("s", $id_product);
$stmt->execute();
$result = $stmt->get_result();

// Cek apakah produk ditemukan
if ($result->num_rows === 0) {
    die("Product not found.");
}

$product = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Proses pengeditan produk
    $product_name = $_POST['product_name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $sold = $_POST['sold'];

    // Update query
    $stmt = $conn->prepare("UPDATE product SET product_name=?, description=?, price=?, stock=?, sold=? WHERE id_product=?");
    $stmt->bind_param("ssiiis", $product_name, $description, $price, $stock, $sold, $id_product);
    
    if ($stmt->execute()) {
        header("Location: supplier.php?message=Product updated successfully.");
        exit();
    } else {
        echo "Error updating product: " . htmlspecialchars($stmt->error);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Product</title>
    <link rel="stylesheet" href="../css/editproduct.css">
</head>
<body>
    <h2>Edit Product</h2>
    <form method="post">
        <label for="product_name">Product Name:</label>
        <input type="text" name="product_name" id="product_name" value="<?= htmlspecialchars($product['product_name']) ?>" required>

        <label for="description">Description:</label>
        <textarea name="description" id="description" required><?= htmlspecialchars($product['description']) ?></textarea>

        <label for="price">Price:</label>
        <input type="number" name="price" id="price" value="<?= htmlspecialchars($product['price']) ?>" required>

        <label for="stock">Stock:</label>
        <input type="number" name="stock" id="stock" value="<?= htmlspecialchars($product['stock']) ?>" required>

        <label for="sold">Sold:</label>
        <input type="number" name="sold" id="sold" value="<?= htmlspecialchars($product['sold']) ?>" required>

        <button type="submit">Update Product</button>
    </form>
</body>
</html>
