<?php
include '../koneksi.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Koneksi ke database
    $conn = new mysqli('localhost', 'root', '', 'fastxport');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Ambil data dari form
    $country = $_POST['country'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $name = $_POST['name'];
    $telp = $_POST['telp'];

    // Insert data ke tabel `customers`
    $stmt = $conn->prepare("INSERT INTO customers (country, email, password, name, telp) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $country, $email, $password, $name, $telp);

    if ($stmt->execute()) {
        echo "<script>alert('Registration successful!');</script>";
        header("Location: signsucces.html");
        exit(); // Hentikan script setelah redirect
    } else {
        echo "<script>alert('Registration failed: " . $stmt->error . "');</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up page</title>
    <link rel="stylesheet" href="../css/register.css">
</head>
<body>
    <nav class="navbar">
        <div class="logo">
            <img src="../logo.png" alt="Logo" />
        </div>
        <ul class="tulisan-navbar">
            <li><a href="product.html">Product</a></li>
            <li><a href="joinassupplier.html">Join as Supplier</a></li>
            <li><a href="#">Expedition</a></li>
            <li><a href="#">Help</a></li>
        </ul>
        <button class="login-button" onclick="window.location.href='login.html'">Sign In</button>
    </nav>
    <div class="coba">
        <div class="wrapper">
            <h1>Sign Up</h1>

            <form action="register.php" method="POST" class="form">    
                <div class="input-box">
                    <p>Country / State</p>
                    <input class="country" type="text" name="country" placeholder="Enter your country / region" required>
                </div>            
                <div class="input-box">
                    <p>Email</p>
                    <input class="email" type="text" name="email" placeholder="Enter your email" required>
                </div>
                <div class="input-box">
                    <p>Enter Password</p>
                    <input type="password" name="password" placeholder="Enter your password" required>
                </div>
                <div class="input-box">
                    <p>Confirm Password</p>
                    <input class="confirm" type="password" name="confirm_password" placeholder="Confirm your password" required>
                </div>
                <div class="input-box">
                    <p>Full Name</p>
                    <input class="name" type="text" name="name" placeholder="Enter your full name" required>
                </div>
                <div class="input-box">
                    <p>Telp</p>
                    <input class="no" type="text" name="telp" placeholder="Enter your telephone number" required>
                </div>    
                <div class="remember-forgot">
                    <label><input type="checkbox" required>
                        I agree to the terms and privacy policy. I agree to 
                        obtain further information about products and 
                        services from Fastxport
                    </label>
                </div>
                <div class="button">
                    <button type="submit" class="button1">Submit</button>
                </div>
            </form>
        </div>
    </div> 
</body>
</html>
