<?php
session_start();

$batas_waktu = 10; // detik

// Jika belum login, kembali ke halaman login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Hitung sisa waktu sejak login
$sisa = $batas_waktu - (time() - $_SESSION['waktu_login']);

// Jika waktu habis, logout otomatis
if ($sisa <= 0) {
    header("Location: logout.php?timeout=1");
    exit;
}

// Browser otomatis pindah ke logout.php setelah $sisa detik
header("Refresh: $sisa; url=logout.php?timeout=1");
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <title>Halaman Utama</title>
</head>

<body>
    <h1>Hallo <?php echo htmlspecialchars($_SESSION['username']); ?>,</h1>
    <h3>Selamat Datang Di Halaman Utama!</h3>
    <p>Anda akan otomatis keluar dalam
        <b><span id="hitung"><?php echo $sisa; ?></span></b> detik.</p>
    <a href="logout.php">Logout</a>

    <script>
        var sisa = <?php echo $sisa; ?>;
        var el = document.getElementById("hitung");
        setInterval(function () {
            if (sisa > 0) { sisa--; }
            el.textContent = sisa;
        }, 1000);
    </script>
</body>

</html>
