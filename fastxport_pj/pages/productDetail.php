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

    <div class="search-container">
        <input type="text" placeholder="Search supplier, commodity..." class="search-input">
        <button class="search-btn">
          <img src="https://img.icons8.com/ios-glyphs/30/FFFFFF/search.png" alt="Search icon">
        </button>
        <button class="filter-btn">
          <img src="https://img.icons8.com/ios-glyphs/30/FFFFFF/filter.png" alt="Filter icon">
        </button>
      </div>
      
      <br>
      <div class="Product-Info">
        <div class="Product-Info-left">
            <h1>Ters Farmer</h1>
            <img src="../assets/images/cabe.jpg" alt="cabbage">
            <div class="Product-Detail">
                <h3>Description</h3>
                <p> Fresh, high-quality green cabbage for sale at $300 per ton.
                    Each head weighs approximately 1.5 to 2.5 kg and features bright green leaves. 
                    Packaged in bulk or crates, our cabbage has a shelf life of 2-3 weeks under proper storage. 
                    It's rich in vitamins C and K, fiber, and antioxidants, making it perfect for salads, cooking, and pickling. 
                    Ideal for wholesalers and restaurants. 
                    Contact us for bulk orders!</p>
            </div>
        </div>
        <div class="Product-Info-right">
            <h2>Fresh Green Cabbage</h2>
            <br>
            <span>Jawa Barat</span>
            <span><strong>$ 300/ ton</span>
            <span>Minimal Pembelian: 5 pcs</span>
            
            <div class="quantity-selector">
                <button class="decrease" onclick="decreaseQuantity()">-</button>
                <input type="text" id="quantity" value="1" readonly>
                <button class="increase" onclick="increaseQuantity()">+</button>
                <span>Stock Total: 3000</span>
            </div>
             
            <script>
                let stockTotal = 3000;  // Stock total
                let quantity = 1;       // Initial quantity
            
                function increaseQuantity() {
                    if (quantity < stockTotal) {  // Check if current quantity is less than stock total
                        quantity++;
                        document.getElementById('quantity').value = quantity;
                    }
                }
            
                function decreaseQuantity() {
                    if (quantity > 1) {  // Prevent quantity from going below 1
                        quantity--;
                        document.getElementById('quantity').value = quantity;
                    }
                }
            </script>

            <div class="actions">
                <button>Chat</button>
                <button>Add to cart</button>
            </div>
        </div>
    </div>
    
    
</body>
</html>