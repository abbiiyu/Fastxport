<?php
include('../conn.php');
session_start();

$is_logged_in = isset($_SESSION['user_id']);
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $shop_name = trim($_POST['shop_name']);
    $bio = trim($_POST['bio']);

    if (!$is_logged_in) {
        // Data untuk user baru
        $full_name = trim($_POST['full_name']);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $country = trim($_POST['country']);
        $phone_number = trim($_POST['phone_number']);
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $user_add = trim($_POST['user_add']);

        // Validasi input
        if (empty($full_name) || empty($email) || empty($country) || empty($phone_number) || empty($password) || $password !== $confirm_password) {
            $error = "Please fill in all fields and make sure passwords match.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "Invalid email format.";
        }

        if (empty($error)) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Simpan data ke login_acc
            $stmt_login = $conn->prepare("INSERT INTO login_acc (full_name, email, password, country, phone_number, user_add, role) 
                                          VALUES (?, ?, ?, ?, ?, ?, 'supplier')");
            if (!$stmt_login) {
                $error = "Preparation error: " . $conn->error;
            } else {
                $stmt_login->bind_param("ssssss", $full_name, $email, $hashed_password, $country, $phone_number, $user_add);

                if (!$stmt_login->execute()) {
                    $error = "Error while saving login data: " . $stmt_login->error;
                } else {
                    $_SESSION['user_id'] = $conn->insert_id; // Ambil ID baru
                }
            }
        }
    } else {
        // Update role jika user sudah login
        $update_role_stmt = $conn->prepare("UPDATE login_acc SET role = 'supplier' WHERE id_acc = ? AND role = 'customer'");
        if (!$update_role_stmt) {
            $error = "Preparation error: " . $conn->error;
        } else {
            $update_role_stmt->bind_param("i", $_SESSION['user_id']);
            if (!$update_role_stmt->execute()) {
                $error = "Error while updating role: " . $update_role_stmt->error;
            }
        }
    }

    if (empty($error)) {
        // Generate ID Supplier baru
        $result = $conn->query("SELECT MAX(id_supplier) AS last_id FROM supplier");
        if (!$result) {
            $error = "Error fetching last supplier ID: " . $conn->error;
        } else {
            $last_id = ($result->num_rows > 0) ? $result->fetch_assoc()['last_id'] : 'SUP-0000';
            $last_id_number = (int)str_replace('SUP-', '', $last_id);
            $new_id = 'SUP-' . str_pad($last_id_number + 1, 4, '0', STR_PAD_LEFT);

            // Simpan data ke tabel supplier
            $stmt_supplier = $conn->prepare("INSERT INTO supplier (id_supplier, id_acc, shop_name, bio) VALUES (?, ?, ?, ?)");
            if (!$stmt_supplier) {
                $error = "Preparation error: " . $conn->error;
            } else {
                $stmt_supplier->bind_param("siss", $new_id, $_SESSION['user_id'], $shop_name, $bio);

                if ($stmt_supplier->execute()) {
                    header("Location: ../index.php");
                    exit();
                } else {
                    $error = "Error while saving supplier data: " . $stmt_supplier->error;
                }
            }
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join as Supplier</title>
    <link rel="stylesheet" href="../css/joinformulir.css">
</head>
<body>
    <div class="form-container">
        <h1>Join as Supplier</h1>
        <?php if (isset($error)) : ?>
            <p style="color:red;"><?= htmlspecialchars($error); ?></p>
        <?php endif; ?>
        <form action="joinformulir.php" method="POST">
            <?php if (!$is_logged_in): ?>
                <!-- Form untuk user baru -->
                <div class="form-group">
                    <label for="full_name">Full Name:</label>
                    <input type="text" name="full_name" id="full_name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" required>
                </div>
                <div class="form-group">
                    <label for="country">Country:</label>
                    <input type="text" name="country" id="country" required>
                </div>
                <div class="form-group">
                    <label for="phone_number">Phone Number:</label>
                    <input type="tel" name="phone_number" id="phone_number" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password" required>
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirm Password:</label>
                    <input type="password" name="confirm_password" id="confirm_password" required>
                </div>
                <div class="form-group">
                    <label for="user_add">Address:</label>
                    <input type="text" name="user_add" id="user_add" required>
                </div>
            <?php endif; ?>
            <!-- Field yang selalu diisi -->
            <div class="form-group">
                <label for="shop_name">Shop Name:</label>
                <input type="text" name="shop_name" id="shop_name" required>
            </div>
            <div class="form-group">
                <label for="bio">Bio:</label>
                <textarea name="bio" id="bio" rows="4" required></textarea>
            </div>
            <button type="submit" class="submit-btn">Join</button>
        </form>
    </div>
</body>
</html>