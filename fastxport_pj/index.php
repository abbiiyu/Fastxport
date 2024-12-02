<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navigation Bar</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="logo">
                <img src="../logo.png" alt="FastXPort Logo" />
            </div>
            <ul class="tulisan-navbar">
                <li><a href="product.html">Product</a></li>
                <li><a href="joinassupplier.html">Join as Supplier</a></li>
                <li><a href="#">Expedition</a></li>
                <li><a href="#">Help</a></li>
            </ul>
            <a href="cart.html" class="cart-button">
                <i class="fas fa-shopping-cart"></i>
            </a>
            <button class="login-button" onclick="window.location.href='login.html'">Sign In</button>
        </nav>
    </header>

    <main>
        <h1 class="welcome">
            <p>WELCOME, </p>
            <p>FIND WHAT YOU NEED HERE!</p>
        </h1>
        <h2 class="tulisan-kecil">
            <p>There are more than 100 products available that you can buy at the best deal</p>
        </h2>
        
        <div class="search-button">
            <input type="text" placeholder="Search..." aria-label="Search products">
            <i class="fa fa-search"></i>
        </div>

        <ul class="kategori">
            <li><a href="#"><i class="fa fa-star"></i> Top Trusted Supplier</a></li>
            <li><a href="#"><i class="fa fa-tasks"></i> More than 100 items</a></li>
            <li><a href="#"><i class="fa fa-shopping-bag"></i> Shipping with guarantee</a></li>
            <li><a href="#"><i class="fa fa-check-circle"></i> Following market trends</a></li>
        </ul>

        <div class="List-product">
            <h1>List Your Products Now!</h1>
            <p>Have a big target in business? Join FastXPort to become a supplier that meets worldwide demand and is ready to ship worldwide with a fast and safe guarantee.</p>
            <button onclick="window.location.href='joinassupplier.html'">Join as Supplier</button>
            <img src="../tablet.png" alt="Tablet showcasing products">
        </div>

        <div class="container">
            <img src="../kapallaut.jpg" alt="kapallaut">
        </div>

        <div class="more">
            <p>FastXPort provides delivery services with various types of transportation according to the capacity of your goods and we have a guarantee that the goods will arrive safely.</p>
            <button class="more-button">More</button>
        </div>
    </main>

    <footer>
        <div class="kontainer">
            <div class="footer-content contact-section">
                <h3>Contact Us</h3>
                <p>Email: info@example.com</p>
                <p>Phone: +62 812XXXXXXXX</p>
                <p>Address: Our company address</p>
            </div>
            <div class="footer-content follow-section">
                <h3>Follow Us</h3>
                <ul>
                    <li><a href=""><i class="fa-brands fa-facebook-f"></i></a></li>
                    <li><a href=""><i class="fa-brands fa-instagram"></i></a></li>
                    <li><a href=""><i class="fa-brands fa-x-twitter"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="bottom-bar">
            <p>&copy; 2024 FastXport. All rights reserved</p>
        </div>
    </footer>
</body>
</html>
