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
$host = 'localhost'; 
$dbname = 'fastxport_db'; 
$username = 'root'; 
$password = ''; 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  // Debugging mode
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Proses form jika ada data yang dikirim
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data form dan sanitasi
    $product_name = htmlspecialchars($_POST['productName']);
    $description = htmlspecialchars($_POST['description']);
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $minBuy = $_POST['minBuy'];
    $category = $_POST['category'];

    // Validasi input
    if (!is_numeric($price) || !is_numeric($stock) || !is_numeric($minBuy)) {
        die("Harga, Stok, dan Minimum Pembelian harus berupa angka.");
    }

    // Proses upload gambar
    $fileDestination = null;
    if (isset($_FILES['media']) && $_FILES['media']['error'] == 0) {
        $fileTmpName = $_FILES['media']['tmp_name'];
        $fileType = $_FILES['media']['type'];
        $fileSize = $_FILES['media']['size'];

        // Mengecek tipe file dan ukuran file (max 2MB)
        $allowed = ['image/jpeg', 'image/png'];
        if (!in_array($fileType, $allowed)) {
            die("Hanya gambar JPEG atau PNG yang diizinkan.");
        }
        if ($fileSize > 2 * 1024 * 1024) {  // 2MB limit
            die("Ukuran file tidak boleh lebih dari 2MB.");
        }

        // Mengonversi gambar menjadi string base64
        $imageData = file_get_contents($fileTmpName);
        $fileDestination = base64_encode($imageData);
    }

    try {
        // Menentukan prefix kategori berdasarkan pilihan user
        $category_prefix = [
            'pertanian' => 'PNT',
            'perkebunan' => 'PRK',
            'perhutanan' => 'PHN',
            'perikanan' => 'PRN',
            'peternakan' => 'PTK'
        ][$category] ?? '';

        // Ambil nomor urut produk dalam kategori yang sama
        $stmt = $pdo->prepare("SELECT COUNT(*) + 1 AS next_id FROM product WHERE category = ?");
        $stmt->execute([$category]);
        $next_id = $stmt->fetch(PDO::FETCH_ASSOC)['next_id'];

        // Format ID produk dengan nomor urut
        $id_product = $category_prefix . '-' . str_pad($next_id, 4, '0', STR_PAD_LEFT);

        // Cek apakah id_product sudah ada di database
        $stmt_check = $pdo->prepare("SELECT COUNT(*) FROM product WHERE id_product = ?");
        $stmt_check->execute([$id_product]);

        // Jika id_product sudah ada, regenerasi ID
        while ($stmt_check->fetchColumn() > 0) {
            $next_id++;  // Increment the next_id to try the next one
            $id_product = $category_prefix . '-' . str_pad($next_id, 4, '0', STR_PAD_LEFT);
            
            // Re-check the new ID
            $stmt_check->execute([$id_product]);

            // If the new ID doesn't exist, break out of the loop
            if ($stmt_check->fetchColumn() == 0) {
                break;
            }
        }


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
    <title>Add Product</title>
    <link rel="stylesheet" href="../css/addproduct.css">
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="logo">
                <a href="../index.php">
                    <img src="../assets/images/LOGO1.png" alt="Logo">
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
                    <input type="file" id="media" name="media" accept="image/*" multiple onchange="loadFiles(event)">
                    <div class="upload-text-container">
                        <span class="icon-plus">+</span>
                        <span class="upload-text">Add file or drag and drop files here</span>
                    </div>
                    <div id="preview-container" class="preview-container">
                        <!-- Pratinjau gambar akan ditampilkan di sini -->
                    </div>
                    <div id="file-names" class="file-names">
                        <!-- Nama file akan ditampilkan di sini -->
                    </div>
                </div>
            </div>

            <script>
                var loadFiles = function(event) {
                    const previewContainer = document.getElementById('preview-container');
                    const fileNamesContainer = document.getElementById('file-names');
                    previewContainer.innerHTML = ''; // Bersihkan pratinjau sebelumnya
                    fileNamesContainer.innerHTML = ''; // Bersihkan daftar nama file sebelumnya

                    const files = event.target.files;
                    for (let i = 0; i < files.length; i++) {
                        const file = files[i];

                        // Pastikan hanya memproses file gambar
                        if (file.type.startsWith('image/')) {
                            // Tambahkan pratinjau gambar
                            const imgElement = document.createElement('img');
                            imgElement.src = URL.createObjectURL(file);
                            imgElement.onload = function() {
                                URL.revokeObjectURL(imgElement.src); // Bersihkan URL sementara setelah gambar dimuat
                            };
                            imgElement.className = 'preview-image';
                            previewContainer.appendChild(imgElement);

                            // Tambahkan nama file
                            const fileNameElement = document.createElement('div');
                            fileNameElement.textContent = file.name;
                            fileNamesContainer.appendChild(fileNameElement);
                        }
                    }
                };
            </script>
            

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
                    <option value="peternakan">Peternakan</option>
                </select>
            </div>

            <div class="button-container">
                <button class="add-button">Add</button>
            </div>
        </form>
    </div>
</body>
</html>