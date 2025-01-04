<?php
session_start();

// Check if id_supplier is set in the session
if (!isset($_SESSION['id_supplier'])) {
    die("ID Supplier not found in session.");
}

// Ambil ID supplier dari session
$id_supplier = $_SESSION['id_supplier'];

// Check login status
$isLoggedIn = isset($_SESSION['email']);
$role = $isLoggedIn ? $_SESSION['role'] : null;
$fullName = $isLoggedIn && isset($_SESSION['full_name']) ? $_SESSION['full_name'] : "Guest";

// Koneksi ke Database
$host = 'localhost'; // Ganti dengan host Anda
$dbname = 'fastxport_db'; // Ganti dengan nama database Anda
$username = 'root'; // Ganti dengan username Anda
$password = ''; // Ganti dengan password Anda

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Proses form jika ada data yang dikirim
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data form
    $product_name = $_POST['productName'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $minBuy = $_POST['minBuy'];
    $category = $_POST['category'];

    // Validasi input (misalnya, pastikan harga dan stok adalah angka)
    if (!isset($_POST['price']) || !is_numeric($_POST['price'])) {
        die("Harga harus berupa angka.");
    }
    if (!isset($_POST['stock']) || !is_numeric($_POST['stock'])) {
        die("Stok harus berupa angka.");
    }
    if (!isset($_POST['minBuy']) || !is_numeric($_POST['minBuy'])) {
        die("Minimum pembelian harus berupa angka.");
    }

    // Proses upload gambar
    if (isset($_FILES['media']) && $_FILES['media']['error'] == 0) {
        $fileTmpName = $_FILES['media']['tmp_name'];
        $fileType = $_FILES['media']['type'];

        // Mengecek tipe file
        $allowed = ['image/jpeg', 'image/png'];
        if (!in_array($fileType, $allowed)) {
            die("Hanya gambar JPEG atau PNG yang diizinkan.");
        }

        // Mengonversi gambar menjadi string base64
        $imageData = file_get_contents($fileTmpName);
        $base64Image = base64_encode($imageData);

        // Menyimpan base64 dalam database
        $fileDestination = $base64Image;
    } else {
        $fileDestination = null; // Jika tidak ada file yang diupload
    }

    // Proses penyimpanan produk ke database
    try {
        // Menentukan prefix kategori berdasarkan pilihan user
        $category_prefix = '';
        switch ($category) {
            case 'pertanian':
                $category_prefix = 'PNT';
                break;
            case 'perkebunan':
                $category_prefix = 'PRK';
                break;
            case 'perhutanan':
                $category_prefix = 'PHN';
                break;
            case 'perikanan':
                $category_prefix = 'PRN';
                break;
            case 'peternakan':
                $category_prefix = 'PTK';
                break;
        }

        // Ambil nomor urut produk dalam kategori yang sama
        $stmt = $pdo->prepare("SELECT COUNT(*) + 1 AS next_id FROM product WHERE category = ?");
        $stmt->execute([$category]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $next_id = $row['next_id'];

        // Format ID produk dengan nomor urut
        $id_product = $category_prefix . '-' . str_pad($next_id, 4, '0', STR_PAD_LEFT);

        // Query untuk memasukkan data produk
        $query = "INSERT INTO product (id_product, product_name, description, media, price, stock, minBuy, category, id_supplier) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$id_product, $product_name, $description, $fileDestination, $price, $stock, $minBuy, $category, $id_supplier]);

        echo "Produk berhasil ditambahkan! ID Produk: $id_product";
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AddProduct</title>
    <link rel="stylesheet" href="../css/addproduct.css">
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

    <div class="Add-Product">
        <h1>Add Product</h1>
        <form action="addproduct.php" method="POST" enctype="multipart/form-data">
            <div class="form-row">
                <label for="productName">Product Name</label>
                <input type="text" id="productName" name="productName" placeholder="Name your product">
            </div>

            <div class="form-row">
                <label for="description">Description</label>
                <textarea id="description" name="description" placeholder="contains information about weight, quality, etc"></textarea>
            </div>

            <div class="form-row">
                <label for="media">Media</label>
                <div class="media-upload">
                    <input type="file" id="media" name="media" multiple>
                    <span class="icon-plus">+</span>
                    <span class="upload-text">Add file or drag and drop files here</span>
                </div>
            </div>

            <div class="form-row">
                <label for="price">Price</label>
                <input type="number" id="price" name="price" placeholder="your price">
            </div>

            <div class="form-row">
                <label for="stock">Stock</label>
                <input type="number" id="stock" name="stock" placeholder="Stock...">
            </div>

            <div class="form-row">
                <label for="minBuy">Minimum Buy</label>
                <input type="number" id="minBuy" name="minBuy" placeholder="0">
            </div>

            <div class="form-row">
                <label for="category">Category</label>
                <select id="category" name="category">
                    <option value="pertanian">Pertanian</option>
                    <option value="perkebunan">Perkebunan</option>
                    <option value="perhutanan">Perhutanan</option>
                    <option value="perikanan">Perikanan</option>
                    <option value="perternakan">Perternakan</option>
                </select>
            </div>

            <div class="button-container">
                <button class="add-button">Add</button>
            </div>
        </form>
    </div>

    <script src="./product.js"></script>
</body>
</html>
