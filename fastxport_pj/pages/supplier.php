<?php
session_start();
// Check login status
$isLoggedIn = isset($_SESSION['email']);
$role = $isLoggedIn ? $_SESSION['role'] : null;
$fullName = $isLoggedIn && isset($_SESSION['full_name']) ? $_SESSION['full_name'] : "Guest";

// Include database connection
include_once('../conn.php'); // Pastikan path-nya sesuai

// Ambil data produk berdasarkan supplier yang login
$products = [];
if ($isLoggedIn && $role === 'supplier') {
    // Query untuk mengambil data produk
    $stmt = $conn->prepare("SELECT p.id_product, p.product_name, p.description, p.media, p.price, p.stock, p.minBuy, p.category, p.sold
                           FROM product p
                           INNER JOIN supplier s ON p.id_supplier = s.id_supplier
                           INNER JOIN login_acc la ON s.id_acc = la.id_acc
                           WHERE la.email = ?");
    $stmt->bind_param("s", $_SESSION['email']);
    $stmt->execute();
    $result = $stmt->get_result();

    // Mengambil data produk
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supplier Dashboard</title>
    <link rel="stylesheet" href="../css/supplier.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>
<body>
<header>
    <nav class="navbar">
        <div class="logo">
            <a href="../index.php">
                <img src="../assets/images/LOGO1.png" alt="Logo" />
            </a>
        </div>        

        <ul class="tulisan-navbar">
            <li><a href="./product.php">Product</a></li>
            <?php if ($role === 'supplier'): ?>
                <li><a href="./supplier.php">Supplier</a></li>
            <?php else: ?>
                <li><a href="./joinassupplier.php">Join as Supplier</a></li>
            <?php endif; ?>
            <li><a href="./Shipment.php">Expedition</a></li>
            <li><a href="./Help.php">Help</a></li>
        </ul>

        <?php if ($isLoggedIn): ?>
            <div class="profile-section">
                <a href="cart.html" class="cart-button">
                    <i class="fas fa-shopping-cart"></i>
                </a>
                <div class="profile-user">
                    <img src="../assets/images/user.png" alt="profile" class="profile-icon">
                    <span><?php echo htmlspecialchars($fullName); ?></span> 
                </div>
                <a href="./logout.php" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
        <?php else: ?>
            <a href="./login.php" class="login-button">Sign In</a>
        <?php endif; ?>
    </nav>
</header>

<div class="container">
    <a href="./addproduct.php" id="addProduct"><button>Tambah Produk</button></a>
    <table id="productTable">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Deskripsi</th> <!-- Kolom Deskripsi -->
                <th>Harga</th>
                <th>Stok</th>
                <th>Sold</th> <!-- Kolom Sold -->
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($products) > 0): ?>
                <?php foreach ($products as $index => $product): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= htmlspecialchars($product['product_name']) ?></td> <!-- Menggunakan product_name -->
                        <td><?= htmlspecialchars($product['description']) ?></td> <!-- Menampilkan deskripsi -->
                        <td><?= htmlspecialchars($product['price']) ?></td> <!-- Menggunakan price -->
                        <td><?= htmlspecialchars($product['stock']) ?></td> <!-- Menggunakan stock -->
                        <td><?= htmlspecialchars($product['sold']) ?></td> <!-- Menampilkan sold -->
                        <td>
                            <a href="editproduct.php?id=<?= $product['id_product'] ?>">Edit</a> | 
                            <a href="deleteproduct.php?id=<?= $product['id_product'] ?>" onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <!-- Perbaiki jumlah kolom di sini -->
                <tr>
                    <td colspan="7">No products registered yet.</td> 
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- Footer Section -->
<footer>
    <!-- Tambahkan footer jika diperlukan -->
</footer>

<?php
$conn->close(); // Menutup koneksi database di akhir script
?>
    
</body>
</html>
