<?php
session_start();

// Data user disimpan di dalam array (bukan dari database)
$users = [
    "andi"  => "andi123",
    "bunga" => "bunga321",
    "citra" => "citra456"
];

// Jika sudah login, langsung ke halaman index
if (isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}

$pesan = "";
$warna = "red";

if (isset($_GET['timeout'])) {
    $pesan = "Waktu 10 detik habis, Anda otomatis keluar. Silakan login lagi.";
    $warna = "orange";
}
if (isset($_GET['logout'])) {
    $pesan = "Anda berhasil logout.";
    $warna = "green";
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Cek username & password pada array
    if (isset($users[$username]) && $users[$username] === $password) {
        session_regenerate_id(true);
        $_SESSION['username']    = $username;
        $_SESSION['waktu_login'] = time();   // catat waktu login
        header("Location: index.php");
        exit;
    } else {
        $pesan = "Username atau password salah!";
        $warna = "red";
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <title>Login Tugas</title>
</head>

<body>
    <h1>Halaman Login</h1>

    <?php if ($pesan != "") { ?>
        <p style="color:<?php echo $warna; ?>;"><?php echo $pesan; ?></p>
    <?php } ?>

    <form method="POST" action="">
        <ul>
            <li>Username <input type="text" name="username"></li>
            <li>Password <input type="password" name="password"></li>
            <li><button type="submit" name="login">Login</button></li>
        </ul>
    </form>
</body>

</html>
