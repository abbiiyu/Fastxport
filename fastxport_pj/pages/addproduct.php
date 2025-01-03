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
        <form>
            <div class="form-row">
                <label for="productName">Product Name</label>
                <input type="text" id="productName" placeholder="Name your product">
            </div>

            <div class="form-row">
                <label for="description">Description</label>
                <textarea id="description" placeholder="contains information about weight, quality, etc"></textarea>
            </div>

            <div class="form-row">
                <label for="media">Media</label>
                <div class="media-upload">
                    <input type="file" id="media" multiple>
                    <span class="icon-plus">+</span>
                    <span class="upload-text">Add file or drag and drop files here</span>
                </div>
            </div>

            <div class="form-row">
                <label for="price">Price</label>
                <input type="number" id="price" placeholder="your price">
            </div>

            <div class="form-row">
                <label for="stock">Stock</label>
                <input type="number" id="stock" placeholder="Stock...">
            </div>

            <div class="form-row">
                <label for="minBuy">Minimum Buy</label>
                <input type="number" id="minBuy" placeholder="0">
            </div>

            <div class="form-row">
                <label for="category">Category</label>
                <select id="category">
                    <option value="vegetable">Vegetable</option>
                    <option value="fruit">Fruit</option>
                    <option value="beans">Beans</option>
                </select>
            </div>

            <div class="button-container">
                <button class="add-button"><a href="./supplier.php">Add</a></button>
        </form>
    </div>

    
</body>
</html>