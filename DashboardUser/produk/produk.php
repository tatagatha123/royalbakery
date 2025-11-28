<?php
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Menu | Royal Bakery</title>
  <link rel="stylesheet" href="produk.css">
</head>

<body data-login="<?php echo isset($_SESSION['user_id']) ? '1' : '0'; ?>">

  <!-- Navbar -->
  <header>
    <nav class="navbar">
      <div class="logo">🍞 ROYAL BAKERY</div>
      <ul class="nav-links">
        <li><a href="../../DashboardUser/Home/homepage.php">Home</a></li>
        <li><a href="../../DashboardUser/About/about.php">About Us</a></li>
        <li><a href="../../DashboardUser/produk/produk.php" class="active">Menu</a></li>
        <li><a href="../../DashboardUser/pesanan/pesanan_saya.php">Lihat Pesanan</a></li>

        <?php if (!isset($_SESSION['user_id'])): ?>
            <li><a href="../../DashboardUser/Login/login.php">Login</a></li>
        <?php else: ?>
            <li><a href="../../DashboardUser/Logout/logout.php">Logout</a></li>
        <?php endif; ?>
      </ul>
    </nav>
  </header>

  <!-- Hero -->
  <section class="menu-hero">
    <h1>Our Special Menu</h1>
    <p>Freshly baked every morning with love and the best ingredients.</p>
    <input type="text" id="searchBar" placeholder="Cari menu... 🍰">
  </section>

  <!-- Menu Grid -->
  <section class="menu-grid" id="menuGrid">
    <?php
    include '../../koneksi/koneksi.php';

    $isLogin = isset($_SESSION['user_id']) ? "1" : "0";

    $query = "SELECT produk_id, nama_produk, harga, stok, gambar FROM produk ORDER BY produk_id DESC";
    $result = mysqli_query($koneksi, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {

            $id     = htmlspecialchars($row['produk_id']);
            $nama   = htmlspecialchars($row['nama_produk']);
            $hargaRupiah = number_format($row['harga'], 0, ',', '.');
            $hargaAsli   = $row['harga'];
            $stok        = (int)$row['stok'];
            $gambarFile  = htmlspecialchars($row['gambar']);
            $gambarPath  = "../../uploads/" . $gambarFile;

            if (empty($gambarFile) || !file_exists($gambarPath)) {
                $gambarPath = "../../uploads/placeholder.jpg";
            }

            echo "
            <div class='menu-card' data-id='{$id}' data-name='{$nama}' data-price='{$hargaAsli}'>
                <img src='{$gambarPath}' alt='{$nama}'>
                <h3>{$nama}</h3>
                <p>Rp {$hargaRupiah}</p>
                <p class='stok'>Stok: {$stok}</p>

                <div class='quantity-controls'>
                    <button class='qty-btn minus'>-</button>
                    <span class='qty'>0</span>

                    <button class='qty-btn plus' data-login='{$isLogin}'>+</button>
                </div>
            </div>
            ";
        }
    } else {
        echo "<p style='text-align:center; width:100%; color:#888;'>Belum ada produk tersedia.</p>";
    }

    mysqli_close($koneksi);
    ?>
  </section>

  <!-- Floating Cart -->
  <div 
      class="cart-icon" 
      id="cartIcon"
      role="button" 
      title="Lihat Keranjang"
      data-login="<?php echo $isLogin; ?>"
  >
    🛒 <span id="cartCount">0</span> | Rp <span id="cartTotal">0</span>
  </div>

  <script src="../js/produk.js?v=22"></script>
</body>
</html>