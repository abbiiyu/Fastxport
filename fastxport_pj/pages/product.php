<?php
session_start();
// Check login status
$isLoggedIn = isset($_SESSION['email']); 
$role = $isLoggedIn ? $_SESSION['role'] : null; 
$fullName = $isLoggedIn && isset($_SESSION['full_name']) ? $_SESSION['full_name'] : "Guest"; // Check if full_name exists
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=width=device-width, initial-scale=1.0">
    <title>Product</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="../css/product.css">
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

    <div class="search-container">
        <input type="text" placeholder="Search supplier, commodity..." class="search-input">
        <button class="search-btn">
          <img src="https://img.icons8.com/ios-glyphs/30/FFFFFF/search.png" alt="Search icon">
        </button>
        <button class="filter-btn">
          <img src="https://img.icons8.com/ios-glyphs/30/FFFFFF/filter.png" alt="Filter icon">
        </button>
      </div>

    <div class="product-grid">

        <a href="productDetail.php" class="product-isi">
            <img src="../assets/images/cabe.jpg" alt="gambar produk" class="product-image">
            <h1 class="farmer-name">Ters Farmer</h1>
            <p class="product-title">Cabe merah banget</p>
            <p class="product-price">Rp.23.000/kg</p>
            <p class="min-order">min order 10</p>
            <p class="asal-product">Jawa Barat</p>
        </a>
        

        <a href="productDetail.php" class="product-isi">
            <img src="../assets/images/cabe.jpg" alt="gambar produk" class="product-image">
            <h1 class="farmer-name">Ters Farmer</h1>
            <p class="product-title">Cabe merah banget</p>
            <p class="product-price">Rp.23.000/kg</p>
            <p class="min-order">min order 10</p>
            <p class="asal-product">Jawa Barat</p>
        </a>
        <a href="productDetail.php" class="product-isi">
            <img src="../assets/images/cabe.jpg" alt="gambar produk" class="product-image">
            <h1 class="farmer-name">Ters Farmer</h1>
            <p class="product-title">Cabe merah banget</p>
            <p class="product-price">Rp.23.000/kg</p>
            <p class="min-order">min order 10</p>
            <p class="asal-product">Jawa Barat</p>
        </a>
        <a href="productDetail.php" class="product-isi">
            <img src="../assets/images/cabe.jpg" alt="gambar produk" class="product-image">
            <h1 class="farmer-name">Ters Farmer</h1>
            <p class="product-title">Cabe merah banget</p>
            <p class="product-price">Rp.23.000/kg</p>
            <p class="min-order">min order 10</p>
            <p class="asal-product">Jawa Barat</p>
        </a>
        <a href="productDetail.php" class="product-isi">
            <img src="../assets/images/cabe.jpg" alt="gambar produk" class="product-image">
            <h1 class="farmer-name">Ters Farmer</h1>
            <p class="product-title">Cabe merah banget</p>
            <p class="product-price">Rp.23.000/kg</p>
            <p class="min-order">min order 10</p>
            <p class="asal-product">Jawa Barat</p>
        </a>
        <a href="productDetail.php" class="product-isi">
            <img src="../assets/images/cabe.jpg" alt="gambar produk" class="product-image">
            <h1 class="farmer-name">Ters Farmer</h1>
            <p class="product-title">Cabe merah banget</p>
            <p class="product-price">Rp.23.000/kg</p>
            <p class="min-order">min order 10</p>
            <p class="asal-product">Jawa Barat</p>
        </a>

        <a href="productDetail.php" class="product-isi">
            <img src="../assets/images/cabe.jpg" alt="gambar produk" class="product-image">
            <h1 class="farmer-name">Ters Farmer</h1>
            <p class="product-title">Cabe merah banget</p>
            <p class="product-price">Rp.23.000/kg</p>
            <p class="min-order">min order 10</p>
            <p class="asal-product">Jawa Barat</p>
        </a>

        <a href="productDetail.php" class="product-isi">
            <img src="../assets/images/cabe.jpg" alt="gambar produk" class="product-image">
            <h1 class="farmer-name">Ters Farmer</h1>
            <p class="product-title">Cabe merah banget</p>
            <p class="product-price">Rp.23.000/kg</p>
            <p class="min-order">min order 10</p>
            <p class="asal-product">Jawa Barat</p>
        </a>
    </div>

    <div class="filter">
        <div class="category">
            <ul>
                <h2>Category</h2>
                <ul>
                    <li class="beans-button">
                        <label class="checkbox-container">
                            <input type="checkbox" class="single-checkbox">
                            <span class="checkmark"></span>
                            <a href="#">Beans</a>
                        </label>
                    </li>
                    <li class="Food-button">
                        <label class="checkbox-container">
                            <input type="checkbox" class="single-checkbox">
                            <span class="checkmark"></span>
                            <a href="#">Food Ingredients</a>
                        </label>
                    </li>
                    <li class="Fruit-button">
                        <label class="checkbox-container">
                            <input type="checkbox" class="single-checkbox">
                            <span class="checkmark"></span>
                            <a href="#">Fruit</a>
                        </label>
                    </li>
                    <li class="Grains-button">
                        <label class="checkbox-container">
                            <input type="checkbox" class="single-checkbox">
                            <span class="checkmark"></span>
                            <a href="#">Grains</a>
                        </label>
                    </li>
                    <li class="Leaves-button">
                        <label class="checkbox-container">
                            <input type="checkbox" class="single-checkbox">
                            <span class="checkmark"></span>
                            <a href="#">Leaves</a>
                        </label>
                    </li>
                    <li class="Vegetables-button">
                        <label class="checkbox-container">
                            <input type="checkbox" class="single-checkbox">
                            <span class="checkmark"></span>
                            <a href="#">Vegetables</a>
                        </label>
                    </li>
                </ul>
                
                <script>
                    const checkboxes = document.querySelectorAll('.single-checkbox');
                    checkboxes.forEach((checkbox) => {
                        checkbox.addEventListener('change', () => {
                            if (checkbox.checked) {
                                checkboxes.forEach((otherCheckbox) => {
                                    if (otherCheckbox !== checkbox) {
                                        otherCheckbox.checked = false;
                                    }
                                });
                            }
                        });
                    });
                </script>
        <div class="Price">
            <h2>Price</h2>
            <input type="number" placeholder="Min" class="Min-search">
            <input type="number" placeholder="Min" class="Max-search">
            <br>
            <button class="search-price">Search</button>
        </div>
        <div class="Min-Order">
            <h2>Min Order</h2>
            <input type="number" placeholder="Min.Order" class="Minorder-search">
            <br>
            <button class="search-price">Search</button>
        </div>
        <div class="location">
            <h2>Location</h2>
            <input type="text" placeholder="Lokasi.." class="location-search">
            <br>
            <button class="search-price">Search</button>
        </div>

        </div>
    </div>
    
    <footer>
        <div class="kontainer">
            <div class="footer-content contact-section">
                <h3>Contact Us</h3>
                <p>Email:info@example.com</p>
                <p>Phone:+62 812XXXXXXXX</p>
                <P>Address:Our address company</p>
            </div>
            <div class="footer-content follow-section">
                <h3>Follow Us</h3>
                <ul>
                    <li><a href=""><i class="fa-brands fa-facebook-f" style="color: #ffffff;"></i></a></li>
                    <li><a href=""><i class="fa-brands fa-instagram" style="color: #ffffff;"></i></a></li>
                    <li><a href=""><i class="fa-brands fa-x-twitter" style="color: #ffffff;"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="bottom-bar">
            <p>&copy; 2024 FastXport. All rights reserved</p>
        </div>
    </footer>
    

</div>
      
</body>
</html>