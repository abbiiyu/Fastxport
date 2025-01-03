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
    <title>Navigation Bar</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="./css/styles.css">
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="logo">
                <a href="index.php">
                    <img src="./assets/images/LOGO1.png" alt="Logo" />
                </a>
            </div>        

            <ul class="tulisan-navbar">
                <li><a href="./pages/product.php">Product</a></li>
                <?php if ($role === 'supplier'): ?>
                    <li><a href="./pages/supplier.php">Supplier</a></li>
                <?php else: ?>
                    <li><a href="./pages/joinassupplier.php">Join as Supplier</a></li>
                <?php endif; ?>
                <li><a href="./pages/Shipment.php">Expedition</a></li>
                <li><a href="./pages/Help.php">Help</a></li>
            </ul>

            <?php if ($isLoggedIn): ?>
                <div class="profile-section">
                    <a href="cart.html" class="cart-button">
                        <i class="fas fa-shopping-cart"></i>
                    </a>
                    <div class="profile-user">
                        <img src="./assets/images/user.png" alt="profile" class="profile-icon">
                        <span><?php echo htmlspecialchars($fullName); ?></span> 
                    </div>
                    <a href="./pages/logout.php" class="logout-btn">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </div>
            <?php else: ?>
                <a href="./pages/login.php" class="login-button">Sign In</a>
            <?php endif; ?>
        </nav>
    </header>
    <div>
        <h1 class="welcome">
            <p>WELCOME</p>
            <p>FIND WHAT YOU NEED HERE! </p>
        </h1>
        <h2 class="tulisan-kecil">
            <p>There are more than 100 products available that you can buy at the best deal</p>
        </h2>
    </div>

    <div class="search-button">
        <input type="text" placeholder="Search...">
        <i class="fa fa-search"></i>
    </div>
    
    <div>
        <ul class="kategori">
            <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i>Top Trusted Supplier</a></li>
            <li><a href="#"><i class="fa fa-tasks" aria-hidden="true"></i>More than 100 items</a></li>
            <li><a href="#"><i class="fa fa-shopping-bag" aria-hidden="true"></i>Shipping with guarantee</a></li>
            <li><a href="#"><i class="fa fa-check-circle" aria-hidden="true"></i>Following market trends</a></li>
        </ul>
    </div>

    <div class="List-product">
        <div>
            <h1>Add your products now!</h1>
            <p>Have a big target in business? Join FastXPort to become a <br>supplier that meets worldwide demand and is ready to ship <br>worldwide with a fast and safe guarantee.</p>
            <button onclick="window.location.href='./pages/joinassupplier.html'">Join as Supplier</button>
        </div>
        <div class="gmbr-tablet">
            <img src="./assets/images/tablet.png" alt="Tablet">
        </div>
    </div>

    <div class="container">
        <img src="./assets/images/kapallaut.jpg" alt="kapallaut">
    </div>

    <div class="more">
        <h1>Best Delivery</h1>
        <p>FastXPort provides delivery services with various types <br> of transportation according to the capacity of <br>your goods and we have a guarantee <br>that the goods will arrive safely.</p>
        <button onclick="window.location.href='./pages/supplier.php'" class="more-button">More</button>
    </div>

    <!-- Footer Section -->
    <footer>
        <div class="kontainer">
            <img src="./assets/images/LOGO1.png" alt="">
            <div class="footer-content inform-section">
                <h3>Information</h3>
                <a href="./pages/product.html"><p>Product</p></a>
                <a href="./pages/joinassupplier.html"><p>Join as supplier</p></a>
                <a href="./pages/Shipment.html"><p>Shipment</p></a>
            </div>

            <!-- Support Section -->
            <div class="support-section">
                <h3>Get Support</h3>
                <p>Help</p>
            </div>

            <!-- Contact Section -->
            <div class="footer-content contact-section">
                <h3>Contact Us</h3>
                <ul>
                    <!-- Add actual links for social media -->

                    <li><a href="#"><i class="fa-brands fa-facebook-f" style="color: #ffffff;"></i></a></li>
                    <li><a href="#"><i class="fa-brands fa-instagram" style="color: #ffffff;"></i></a></li>
                    <li><a href="#"><i class="fa-brands fa-x-twitter" style="color: #ffffff;"></i></a></li>
                </ul>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="bottom-bar">
            <p>&copy; 2024 FastXport. All rights reserved.</p>
        </div>
    </footer>
   
</body>
</html>
