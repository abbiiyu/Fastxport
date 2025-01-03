<?php
// Mengimpor file koneksi database (koneksi.php)
include('../conn.php');

// Proses ketika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil input dari form
    $full_name = $_POST['full_name']; // Sesuaikan nama field dengan form HTML
    $email = $_POST['email'];
    $country = $_POST['country'];
    $phone_number = $_POST['phone_number'];
    $user_address = $_POST['user_address'];
    $password = $_POST['password']; // Ambil password yang dimasukkan user
    $confirm_password = $_POST['confirm_password']; // Ambil konfirmasi password

    // Mengecek apakah password dan konfirmasi password sama
    if (trim($password) === trim($confirm_password)) {
        // Password valid, lanjutkan proses penyimpanan data
        
        // Generate ID secara manual (jika diinginkan)
        // Mengambil ID terakhir yang ada
        $result = $conn->query("SELECT MAX(id_acc) AS last_id FROM login_acc");
        $row = $result->fetch_assoc();
        $last_id = $row['last_id'];
        $new_id = 'ACC-' . str_pad($last_id + 1, 4, '0', STR_PAD_LEFT); // Format ID baru (ACC-0001, ACC-0002, dll.)

        // Menyimpan data ke database menggunakan prepared statements untuk keamanan
        $stmt = $conn->prepare("INSERT INTO login_acc (id_acc, full_name, email, country, phone_number, user_add, password, role) 
                               VALUES (?, ?, ?, ?, ?, ?, ?, 'customer')");
        $stmt->bind_param("sssssss", $new_id, $full_name, $email, $country, $phone_number, $user_address, $password);
        
        if ($stmt->execute()) {
            header("Location: ./login.php"); 
            exit(); 
        }
        $stmt->close();
    } else {
        header("Location: error_page.php"); 
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Page</title>
    <link rel="stylesheet" href="../css/register.css">
</head>
<body>
    <nav class="navbar">
        <div class="logo">
            <a href="../index.html">
                <img src="../assets/images/LOGO1.png" alt="Logo" />
            </a>
        </div> 
        <ul class="tulisan-navbar">
            <li><a href="product.html">Product</a></li>
            <li><a href="joinassupplier.html">Join as Supplier</a></li>
            <li><a href="Shipment.html">Expedition</a></li>
            <li><a href="#">Help</a></li>
        </ul>
        <button class="login-button" onclick="window.location.href='login.html'">Sign In</button>
    </nav>

    <div class="coba">
        <div class="wrapper">
            <h1>Sign Up</h1>
            <!-- Form pendaftaran -->
            <form action="register.php" method="POST" class="form">
                <div class="input-box">
                    <p>Country / State</p>
                    <input id="country" class="country" type="text" name="country" placeholder="Enter your country / region" required>
                </div>

                <div class="input-box">
                    <p>Email</p>
                    <input id="email" class="email" type="email" name="email" placeholder="Enter your email" required>
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
                    <input class="name" type="text" name="full_name" placeholder="Enter your full name" required>
                </div>

                <div class="input-box">
                    <p>Telephone</p>
                    <input class="no" type="text" name="phone_number" placeholder="Enter your telephone number" required>
                </div>

                <div class="input-box">
                    <p>Address</p>
                    <input class="address" type="text" name="user_address" placeholder="Enter your address" required>
                </div>

                <div class="remember-forgot">
                    <label>
                        <input type="checkbox" name="agree" required>
                        I agree to the terms and privacy policy. I agree to obtain further information about products and services from Fastxport.
                    </label>
                </div>

                <!-- Dropdown role -->

                <div class="button">
                    <button type="submit" class="button1">Submit</button>
                </div>
            </form>
        </div>
    </div> 
</body>
</html>
