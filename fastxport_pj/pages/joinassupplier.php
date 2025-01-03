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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>joinassupplier</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="../css/joinassupplier.css">
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

    <div class="join-content">
        <h1>Increase your business sales on FastXport </h1>
        <a href="./joinformulir.php" class="join-button">Join</a>
    </div>

    <div class="gambar-arah">
       
    </div>

    <div class="supplier-footer">
        <div class="supplier-judul">
            <h2><strong>Why should you join FastXport?</strong></h2>
            <div class="content-columns">
                <div class="column">
                    <h3><strong>It's time to expand your business to the world</strong></h3>
                    <p>In the era of ever-growing globalization, opportunities to develop a business are no longer limited to the local market. Now is the right time for entrepreneurs to expand their business reach to the international market through exports to various countries. Through the right export strategy, you can take advantage of the various opportunities that exist in various countries.</p>
                </div>
                <div class="column">
                    <h4><strong>Look more professional with Web Export</strong></h4>
                    <p>The importance of having a website to market your products to the outside market cannot be ignored. With a website, your business has the opportunity to reach millions of potential consumers worldwide, without geographical limitations. With the right online marketing strategy, you can target the most potential markets and optimize your brand visibility.</p>
                </div>
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
