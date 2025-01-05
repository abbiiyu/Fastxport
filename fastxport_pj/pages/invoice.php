<?php
// Ambil data dari URL dan koneksi database
include '../conn.php'; // Pastikan path-nya sesuai

$productId = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : null;
$quantity = isset($_GET['qty']) ? intval($_GET['qty']) : 0;

$calculatedTotal = 0;
$productName = '';
$price = 0;
$idSupplier = 0; // Anda perlu mendapatkan ID supplier dari produk yang dipilih
$idAcc = 0; // Anda perlu mendapatkan ID akun pengguna yang melakukan pembelian
$idShipment = 1; // Misalnya, Anda menetapkan ID pengiriman. Bisa disesuaikan dengan pilihan pengguna (Regular/Express)

// Validasi data dari URL
if ($productId && $quantity > 0) {
    // Ambil nama dan harga produk dari database
    $stmt = $conn->prepare("SELECT product_name, price, id_supplier FROM product WHERE id_product=?");
    $stmt->bind_param("s", $productId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $productData = $result->fetch_assoc();
        $productName = htmlspecialchars($productData['product_name']);
        $price = floatval($productData['price']);
        $idSupplier = $productData['id_supplier'];

        // Hitung ulang total
        $calculatedTotal = $price * $quantity;

        // Mendapatkan ID akun pengguna (pastikan pengguna sudah login)
        if (isset($_SESSION['id_acc'])) {
            $idAcc = $_SESSION['id_acc'];
        }

        // Masukkan data pembelian ke tabel orders
        if ($idAcc > 0) {
            $insertSql = "INSERT INTO orders (id_supplier, id_acc, id_product, product_name, total, id_shipment, shipment_category, user_add) 
                          VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $shipmentCategory = 'Regular'; // Ini bisa diubah sesuai dengan pilihan pengguna

            $userAdd = $_SESSION['address'] ?? ''; // Pastikan alamat pengguna ada di sesi

            $insertStmt = $conn->prepare($insertSql);
            $insertStmt->bind_param("iiisiiis", $idSupplier, $idAcc, $productId, $productName, $calculatedTotal, $idShipment, $shipmentCategory, $userAdd);
            $insertStmt->execute();

            if ($insertStmt->affected_rows > 0) {
                echo "Pembelian berhasil disimpan di database.";
            } else {
                echo "Gagal menyimpan data pembelian.";
            }
        }
    } else {
        $productName = 'Produk tidak ditemukan';
    }
} else {
    $productName = 'Data pembelian tidak valid';
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/invoice.css">
    <title>Invoice Pembelian</title>
</head>
<body>

<div class="invoice-container">
    <div class="header">
        <div class="header-content">
            <h1>Invoice Pembelian</h1>
            <img src="../assets/images/LOGO1.png" alt="Logo" class="logo">
        </div>
        
        <!-- Tanggal Pembelian -->
        <p class="date">Tanggal Pembelian: 
           <span id="tanggal-pembelian"></span></p> 
    </div>

    <!-- Tabel Invoice -->
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Qty</th>
                <th>Harga Satuan</th>
                <th>Total</th>
            </tr>
        </thead>

        <!-- Menampilkan Rincian Pembelian -->
        <tbody>
            <tr>
                <td>1</td>
                <td><?= $productName ?></td>
                <td><?= $quantity ?></td>
                <td>Rp <?= number_format($price, 2, ',', '.') ?></td>
                <td>Rp <?= number_format($calculatedTotal, 2, ',', '.') ?></td>
            </tr>
        </tbody>
    </table>

    <!-- Ringkasan Total -->
    <div class="summary">
        <p><strong>Total:</strong> Rp <?= number_format($calculatedTotal, 2, ',', '.') ?></p> 
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>Terima Kasih atas Pembelian Anda!</p> 
    </div>

    <!-- Tombol Selesai -->
    <!-- Kembali ke halaman supplier -->
    <button onclick="window.location.href='../index.php'">Done</button> 
</div>

<script>
// Mendapatkan tanggal hari ini dalam format Indonesia
const tanggalPembelian = new Date().toLocaleDateString('id-ID', {
   day: '2-digit',
   month: 'long',
   year: 'numeric'
});
document.getElementById('tanggal-pembelian').textContent = tanggalPembelian;
</script>

</body>
</html>
