<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: ../pages/login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header>
        <h1>Welcome, <?php echo $_SESSION['admin_name']; ?>!</h1>
        <a href="../actions/handleLogout.php">Logout</a>
    </header>
    <main>
        <h2>Dashboard</h2>
        <ul>
            <li><a href="manageUsers.php">Manage Users</a></li>
            <li><a href="manageProducts.php">Manage Products</a></li>
            <li><a href="manageOrders.php">Manage Orders</a></li>
            <li><a href="reports.php">Reports</a></li>
        </ul>
    </main>
</body>
</html>
