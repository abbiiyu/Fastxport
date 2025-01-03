<?php
session_start(); // Start the session

if (isset($_POST['login'])) {
    // Get and sanitize input
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Connect to the database
    require_once '../conn.php';

    // Query to retrieve user data based on email
    $sql1 = "SELECT role, password FROM login_acc WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql1);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 's', $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result) {
            $r1 = mysqli_fetch_array($result, MYSQLI_ASSOC);
            if ($r1) {
                // Verify password (consider using password_verify for hashed passwords)
                if ($password === $r1['password']) {
                    // Password is correct, set session variables
                    $_SESSION['email'] = $email;
                    $_SESSION['role'] = $r1['role'];

                    // Fetch the full name from the database and set it in the session
                    $query = "SELECT full_name FROM login_acc WHERE email = '$email'";
                    $resultName = mysqli_query($conn, $query);
                    
                    if ($resultName && mysqli_num_rows($resultName) > 0) {
                        $row = mysqli_fetch_assoc($resultName);
                        $_SESSION['full_name'] = $row['full_name'];
                    }

                    mysqli_stmt_close($stmt);
                    mysqli_close($conn);
                    header("Location: ../index.php"); // Redirect to index after login
                    exit();
                } else {
                    echo "<div class='alert alert-danger'>Password tidak sesuai</div>";
                }
            } else {
                echo "<div class='alert alert-danger'>Email tidak ditemukan</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>Terjadi kesalahan saat mengambil data</div>";
        }
        mysqli_stmt_close($stmt);
    } else {
        die("Query gagal: " . mysqli_error($conn));
    }
    mysqli_close($conn);
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
</head>
<body>
    <div class="back-home">
        <button class="home-btn" onclick="window.location.href='../index.php'">Back to Home</button>
    </div>

    <div class="login-container">
        <h1>Login</h1>
        <form class="login-form" action="" method="post">
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
            <button type="submit" name="login" class="login-btn">Log in</button>

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
