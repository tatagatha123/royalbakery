<?php
include('../../koneksi/koneksi.php');
session_start();

// Cek login admin
if (!isset($_SESSION['username'])) {
    header("Location: ../login/login.php");
    exit();
}

if (!isset($_GET['id']) || !isset($_GET['to'])) {
    die("Akses tidak valid");
}

$id = (int)$_GET['id'];
$status = $_GET['to'];
$allowed = ['Menunggu Konfirmasi','Diproses','Dikirim'];

if (!in_array($status, $allowed)) {
    die("Status tidak valid");
}

$query = "UPDATE transaksi SET status=? WHERE id=?";
$stmt = mysqli_prepare($koneksi, $query);
mysqli_stmt_bind_param($stmt, "si", $status, $id);
mysqli_stmt_execute($stmt);

echo "<script>
    alert('Status transaksi berhasil diperbarui!');
    window.location='dashboard.php';
</script>";
