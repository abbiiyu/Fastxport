<?php
session_start();
include '../includes/database.php';

$email = $_POST['email'];
$password = $_POST['password'];

$query = "SELECT * FROM customer WHERE email = ? AND role = 'admin'";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user && password_verify($password, $user['password'])) {
    $_SESSION['admin_logged_in'] = true;
    $_SESSION['admin_name'] = $user['cust_name'];
    header("Location: ../admin/dashboard.php");
} else {
    header("Location: ../pages/login.php?error=Invalid credentials or not admin");
}
?>
