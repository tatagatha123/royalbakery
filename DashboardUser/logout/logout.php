<?php
session_start();
session_unset();   // hapus semua session
session_destroy(); // hancurkan session

// beri tanda ke JS bahwa logout berhasil
header("Location: ../Home/homepage.php?logout=1");
exit();
?>