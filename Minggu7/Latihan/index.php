<?php
session_start();

// Pengecekan session: jika belum login, arahkan ke halaman login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <title>Index</title>
</head>

<body>
    <h1>Hallo <?php echo htmlspecialchars($_SESSION['username']); ?> &#128075;,</h1>
    <h3>Selamat Datang Di Halaman Latihan Belajar Session dan User Authenthication!</h3>
    <p>ID Session anda adalah : <?php echo session_id(); ?></p>
    <a href="logout.php">Logout</a>
</body>

</html>
