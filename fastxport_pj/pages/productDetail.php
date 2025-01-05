<?php
session_start();
// Periksa login
$isLoggedIn = isset($_SESSION['email']); 
$role = $isLoggedIn ? $_SESSION['role'] : null; 
$fullName = $isLoggedIn && isset($_SESSION['full_name']) ? $_SESSION['full_name'] : "Guest"; 
$email = $isLoggedIn ? $_SESSION['email'] : null; // Ambil email dari session

// Hubungkan ke database
include '../conn.php'; // Sesuaikan dengan path ke file koneksi database Anda

// Ambil ID produk dari URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $productID = $_GET['id']; // Tidak perlu menggunakan intval karena ID adalah string
    var_dump($productID); // Memastikan ID yang diterima benar
} else {
    die("Product ID is missing or invalid.");
}

// Ambil detail produk dari database
$sql = "SELECT p.product_name, p.description, p.media, p.price, p.stock, p.minBuy, s.shop_name, l.user_add AS location
        FROM product p
        JOIN supplier s ON p.id_supplier = s.id_supplier
        JOIN login_acc l ON s.id_acc = l.id_acc
        WHERE p.id_product = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $productID); // Gunakan 's' karena id_product adalah string
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Product not found.");
}

$product = $result->fetch_assoc();

// Ambil alamat pengguna dari login_acc
$address = null;
if ($isLoggedIn && $email) {
    $addressSql = "SELECT user_add FROM login_acc WHERE email = ?";
    $addressStmt = $conn->prepare($addressSql);
    $addressStmt->bind_param("s", $email);
    $addressStmt->execute();
    $addressResult = $addressStmt->get_result();

    if ($addressResult->num_rows > 0) {
        $addressData = $addressResult->fetch_assoc();
        $address = $addressData['user_add'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Detail</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="../css/productDetail.css">
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

<div class="Product-Info">
    <div class="Product-Info-left">
        <h1><?php echo htmlspecialchars($product['shop_name']); ?></h1>
        <img src="data:image/jpeg;base64,<?php echo htmlspecialchars($product['media']); ?>" alt="Product Image">
        <div class="Product-Detail">
            <h3>Description</h3>
            <p><?php echo htmlspecialchars($product['description']); ?></p>
        </div>
    </div>
    <div class="Product-Info-right">
        <h2><?php echo htmlspecialchars($product['product_name']); ?></h2>
        <br>
        <span><?php echo htmlspecialchars($product['location']); ?></span>
        <span><strong>$<?php echo number_format($product['price'], 2, '.', ','); ?>/ton</strong></span>
        <span>Minimal Pembelian: <?php echo htmlspecialchars($product['minBuy']); ?> pcs</span>
        <?php if ($address): ?>
            <div class="address">
                <strong>Your Address:</strong> <p><?php echo htmlspecialchars($address); ?></p>
            </div>
        <?php endif; ?>
        <div class="quantity-selector">
            <button class="decrease" onclick="decreaseQuantity()">-</button>
            <input type="text" id="quantity" value="1" readonly>
            <button class="increase" onclick="increaseQuantity()">+</button>
            <span>Stock Total: <?php echo htmlspecialchars($product['stock']); ?></span>
        </div>
        <script>
            let stockTotal = <?php echo $product['stock']; ?>; 
            let quantity = 1; 

            function increaseQuantity() {
                if (quantity < stockTotal) {
                    quantity++;
                    document.getElementById('quantity').value = quantity;
                }
            }

            function decreaseQuantity() {
                if (quantity > 1) {
                    quantity--;
                    document.getElementById('quantity').value = quantity;
                }
            }
        </script>
        <div class="actions">
            <button>Chat</button>
            <button onclick="window.location.href='#';">Buy</button>
        </div>
    </div>
</div>
</body>
</html>
