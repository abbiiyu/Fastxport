<?php
include("../koneksi.php");
$email = "";
$password = "";
$err = "";
if (isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    if ($email == '' or $password == '') {
        $err .= "<li>Silakan masukkan email dan password</li>";
    }
    if(empty($err)) {
        $sql1 = "select * from admin where email = '$email'";
        $q1 = mysqli_query($koneksi,$sql1);
        $r1 = mysqli_fetch_array($q1);
        if($r1['password'] != md5($password)){
            $err .= "<li>Akun tidak ditemukan</li>";
        }
    }
    if(empty($err)){
        $_SESSION['admin_username'] = $email;
        header("location:supplier.php");
        exit();
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="../css/login.css">
    <style>
        
    </style>
</head>
<body>
    <div class="login-container">
        <form class="login-form" action="signsucces.html" method="post">
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
                <button type="button" class="show-password" onclick="togglePassword()">
                    <i class="fas fa-eye-slash"></i>
                </button>
            </div>
            <button type="submit" class="login-btn">Log in</button>

            <div class="divider">
                <span>or</span>
            </div>
            <button type="button" class="google-btn">
                <i class="fa-brands fa-google"></i> Sign in with Google
            </button>
            <p class="register-text">
                Don't have an account? <a href="../pages/register.php">Register here</a>
            </p>
        </form>
    </div>

    <script>
        function togglePassword() {
            const passwordField = document.getElementById("password");
            const icon = document.querySelector(".show-password i");
            if (passwordField.type === "password") {
                passwordField.type = "text";
                icon.classList.replace("fa-eye-slash", "fa-eye");
            } else {
                passwordField.type = "password";
                icon.classList.replace("fa-eye", "fa-eye-slash");
            }
        }
    </script>
</body>
</html>
