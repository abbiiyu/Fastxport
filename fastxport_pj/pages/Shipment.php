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
    <title>Document</title>
    <link rel="stylesheet" href="../css/Shipment.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

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

    <img src="../assets/images/kontainermerah.png" class="gmbr1" alt="">

    <div class="kategori">
        <h1>Why is FastXport shipment the most reliable</h1>
        <div class="kategori-list">
            <div class="lingkaran-merah">
                <div class="content">
                    <div class="icon-container">
                        <img src="../assets/images/Truck.png" alt="Truck" class="icon">
                        <img src="../assets/images/Cargo Ship.png" alt="Cargo Ship" class="icon">
                    </div>
                    <p>Various transport are used as needed</p>
                </div>
            </div>
       

            <div class="lingkaran-hijau">
                <div class="content">
                    <div class="icon-container">
                        <img src="../assets/images/Box Secured.png" alt="Truck" class="icon">
                    </div>
                    <p>Guarantee that all items reach their destination safely</p>
                </div>
            </div>
        
        
            <div class="lingkaran-biru">
                <div class="content">
                    <div class="icon-container">
                        <img src="../assets/images/Opposite Opinion.png" alt="Truck" class="icon">
                    </div>
                    <p>Has express and regular delivery options</p>
                </div>
            </div>
        </div>
    </div>

    <div class="shipment-category">
        <div class="shipment-list">
            <div class="isi-shipment">
                <h2>REGULAR</h2>
                <img src="../assets/images/reguler.png" alt="">
                <div class="tulisan-shipment">
                    <p>Guaranteed items to arrive safely <br> Affordable costs</p>
                </div>
            </div>
        </div>
        <div class="shipment-list">
            <div class="isi-shipment">
                <h2>EXPRESS</h2>
                <img src="../assets/images/express.png" alt="">
                <div class="tulisan-shipment">
                    <p>Guaranteed items to arrive safely <br> Arrive faster</p>
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
    
</body>
</html>