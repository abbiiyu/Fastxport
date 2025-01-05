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
            <?php
            // Ambil data dari URL
            include '../conn.php'; // Pastikan path-nya sesuai

            $productId = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : null;
            $quantity = isset($_GET['qty']) ? intval($_GET['qty']) : 0;

            // Validasi data dari URL
            if ($productId && $quantity > 0) {
                // Ambil nama dan harga produk dari database
                $stmt = $conn->prepare("SELECT product_name, price FROM product WHERE id_product=?");
                $stmt->bind_param("s", $productId);
                $stmt->execute();
                $result = $stmt->get_result();
                
                if ($result->num_rows > 0) {
                    $productData = $result->fetch_assoc();
                    $productName = htmlspecialchars($productData['product_name']);
                    $price = floatval($productData['price']); // Harga satuan

                    // Hitung ulang total
                    $calculatedTotal = $price * $quantity;

                    // Tampilkan data pada tabel
                    echo "<tr>";
                    echo "<td>1</td>";
                    echo "<td>$productName</td>";
                    echo "<td>$quantity</td>";
                    echo "<td>Rp " . number_format($price, 2, ',', '.') . "</td>"; // Harga satuan
                    echo "<td>Rp " . number_format($calculatedTotal, 2, ',', '.') . "</td>"; // Total
                    echo "</tr>";
                } else {
                    echo "<tr><td colspan='5'>Produk tidak ditemukan.</td></tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Data pembelian tidak valid.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <!-- Ringkasan Total -->
    <div class="summary">
        <!-- Menampilkan total -->
        <p><strong>Total:</strong> Rp <?= isset($calculatedTotal) ? number_format($calculatedTotal, 2, ',', '.') : '0,00' ?></p> 
    </div>

    <!-- Footer -->
    <div class="footer">
        <!-- Pesan Terima Kasih -->
        <p>Terima Kasih atas Pembelian Anda!</p> 
    </div>

    <!-- Tombol Selesai -->
    <!-- Kembali ke halaman supplier -->
    <button onclick="window.location.href='supplier.php'">Done</button> 
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
