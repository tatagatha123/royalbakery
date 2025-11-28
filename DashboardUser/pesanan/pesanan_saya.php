<?php
include('../../koneksi/koneksi.php');
session_start();

// Cek login user
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Jika user klik konfirmasi diterima
if (isset($_GET['konfirmasi'])) {
    $id = (int) $_GET['konfirmasi'];

    // Pastikan transaksi milik user
    $cek = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE id='$id' AND user_id='$user_id'");
    if (mysqli_num_rows($cek) > 0) {
        mysqli_query($koneksi, "
            UPDATE transaksi SET status='Diterima' WHERE id='$id'
        ");
        echo "<script>alert('Pesanan telah dikonfirmasi sebagai diterima!');</script>";
    }
}

// Ambil semua transaksi user
$query = mysqli_query($koneksi, "
    SELECT * FROM transaksi 
    WHERE user_id='$user_id'
    ORDER BY tanggal_pesan DESC
");
?>
    <!-- Header -->
    <header>
        <nav class="navbar">
            <div class="logo">🍞 ROYAL BAKERY</div>

            <!-- Toggle untuk versi mobile -->
            <div class="menu-toggle">
                <span></span>
                <span></span>
                <span></span>
            </div>

            <!-- NAVBAR DINAMIS -->
            <ul class="nav-links">
                <li><a href="../../dashboardUser/home/homepage.php">Home</a></li>
                <li><a href="../../dashboardUser/about/about.php">About Us</a></li>
                <li><a href="../../dashboardUser/produk/produk.php">Menu</a></li>
                    <li><a href="../../dashboardUser/pesanan/pesanan_saya.php" class="active">Lihat Pesanan</a></li>
                    <li><a href="../../dashboardUser/logout/logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Pesanan Saya - Royal Bakery</title>
<link rel="stylesheet" href="pesanan_saya.css">
</head>
<body>

<div class="container">
    <!-- <h2>Pesanan Saya</h2> -->

    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Total</th>
                <th>Metode</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            <?php while ($t = mysqli_fetch_assoc($query)): ?>

            <?php
            // Badge warna
            $badgeClass = [
                "Menunggu Konfirmasi" => "w1",
                "Diproses"            => "w2",
                "Dikirim"             => "w3",
                "Diterima"            => "w4"
            ];
            $class = $badgeClass[$t['status']] ?? "w1";
            ?>

            <tr>
                <td><?= $t['tanggal_pesan'] ?></td>
                <td>Rp <?= number_format($t['total'], 0, ',', '.') ?></td>
                <td><?= $t['metode_pembayaran'] ?></td>

                <td>
                    <span class="status <?= $class ?>">
                        <?= $t['status'] ?>
                    </span>
                </td>

                <td>
                    <?php if ($t['status'] == "Dikirim"): ?>
                        <a class="btn-konfirmasi" 
                           href="pesanan_saya.php?konfirmasi=<?= $t['id'] ?>" 
                           onclick="return confirm('Pastikan pesanan sudah diterima ya!')">
                           Konfirmasi Diterima
                        </a>
                    <?php else: ?>
                        -
                    <?php endif; ?>
                </td>
            </tr>

            <?php endwhile; ?>
        </tbody>
    </table>
</div>

</body>
</html>
