<?php
session_start();
$isLoggedIn = isset($_SESSION['username']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Royal Bakery | Freshly Baked Happiness</title>
    <link rel="stylesheet" href="homepage.css">
</head>
<body>

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
    <li><a href="../../dashboardUser/home/homepage.php" class="active">Home</a></li>
    <li><a href="../../dashboardUser/about/about.php">About Us</a></li>
    <li><a href="../../dashboardUser/produk/produk.php">Menu</a></li>

    <!-- Jika belum login: tampilkan tombol Login -->
    <?php if (!$isLoggedIn): ?>
        <li><a href="../../dashboardUser/login/login.php">Login</a></li>
    <?php endif; ?>

    <!-- Jika sudah login: tampilkan tombol Pesanan Saya & Logout -->
    <?php if ($isLoggedIn): ?>
        <li><a href="../../dashboardUser/pesanan/pesanan_saya.php">Lihat Pesanan</a></li>
        <li><a href="../../dashboardUser/logout/logout.php">Logout</a></li>
    <?php endif; ?>
</ul>
        </nav>
    </header>

    <!-- Sidebar -->
    <div class="sidebar">
        <ul class="sidebar-menu">
            <li><a href="/royalbakery/dashboardUser/home/homepage.php" class="active">Home</a></li>
            <li><a href="/royalbakery/dashboardUser/about/about.php">About Us</a></li>
            <li><a href="/royalbakery/dashboardUser/produk/produk.php">Menu</a></li>

            <?php if ($isLoggedIn): ?>
                <li><a href="../../dashboardUser/pesanan/pesanan_saya.php">Lihat Pesanan</a></li>
                <li><a href="../../dashboardUser/logout/logout.php">Logout</a></li>
            <?php endif; ?>
        </ul>
    </div>
    <div class="overlay"></div>

    <!-- Hero Section -->
    <section class="hero fade-in">
        <div class="hero-content">
            <div class="hero-text">
                <h1>Freshly Baked, Perfectly Made</h1>
                <p>Where every bite tells a story of warmth, sweetness, and passion — baked fresh every morning for you.</p>

                <!-- ORDER NOW DINAMIS -->
                <a href="<?php echo $isLoggedIn ? '../../DashboardUser/produk/produk.php' : '../../DashboardUser/login/login.php'; ?>" class="cta-btn">
                    🍰 Order Now
                </a>
            </div>
            <div class="hero-img">
                <img src="../gambar/roti.png" alt="Bakery">
            </div>
        </div>
    </section>

    <!-- Highlight Section -->
    <section class="highlight slide-up">
        <h2 class="section-title">Our Core Values</h2>
        <div class="features">
            <div class="card">
                <h3>🥐 Fresh Daily</h3>
                <p>We bake every morning to ensure you enjoy only the freshest pastries and bread.</p>
            </div>
            <div class="card">
                <h3>💛 Handmade with Love</h3>
                <p>Every loaf and croissant is crafted with care by our skilled bakers.</p>
            </div>
            <div class="card">
                <h3>☕ Cozy Experience</h3>
                <p>Enjoy your favorites in a warm, inviting atmosphere that feels just like home.</p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer-container">
        <div class="footer-col">
            <h3>Find Us</h3>
            <ul>
                <p>🕒 Open Daily: 07:00 AM - 09:00 PM</p>
                <p>📍 Royal Bakery - Jl. Margonda Raya No. 123, Depok</p>
                <p>🗺 <a href="https://goo.gl/maps/abc123xyz" target="_blank">View on Google Maps</a></p>
            </ul>
        </div>

        <div class="footer-col">
            <h3>Help & Policies</h3>
            <ul>
                <li><a href="#">FAQ</a></li>
                <li><a href="#">Terms & Conditions</a></li>
                <li><a href="#">Privacy Policy</a></li>
            </ul>
        </div>

        <div class="footer-col">
            <h3>Contact Us</h3>
            <p>📞 0812-3456-7890</p>
            <p>📧 royalbakery@gmail.com</p>
            <p>🔗 www.royalbakery.com</p>
        </div>
    </footer>

    <script src="royalbakery.js"></script>
</body>
</html>