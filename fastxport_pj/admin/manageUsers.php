<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: ../pages/login.php");
    exit();
}
include '../includes/database.php';

// Ambil data pengguna
$query = "SELECT * FROM customer WHERE role = 'user'";
$result = $conn->query($query);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header>
        <h1>Manage Users</h1>
        <a href="dashboard.php">Back to Dashboard</a>
    </header>
    <main>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['id_cust']; ?></td>
                    <td><?php echo $row['cust_name']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td>
                        <a href="deleteUser.php?id=<?php echo $row['id_cust']; ?>">Delete</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </main>
</body>
</html>
