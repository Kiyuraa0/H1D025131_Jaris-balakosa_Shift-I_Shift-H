<?php
session_start();
include "koneksi.php";

// Jika sudah login, langsung ke halaman index
if (isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}

$pesan = "";
$warna = "red";

if (isset($_GET['daftar']) && $_GET['daftar'] == "berhasil") {
    $pesan = "Registrasi berhasil, silakan login!";
    $warna = "green";
}
if (isset($_GET['logout'])) {
    $pesan = "Anda berhasil logout.";
    $warna = "green";
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Cari user berdasarkan username
    $sql  = "SELECT id, username, password FROM user WHERE username = ?";
    $stmt = mysqli_prepare($koneksi, $sql);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $hasil = mysqli_stmt_get_result($stmt);
    $data  = mysqli_fetch_assoc($hasil);

    // Cocokkan password dengan hash di database
    if ($data && password_verify($password, $data['password'])) {
        session_regenerate_id(true);
        $_SESSION['id']       = $data['id'];
        $_SESSION['username'] = $data['username'];
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
    <title>Login</title>
</head>

<body>
    <h1>Halaman Login User yang Terdaftar!</h1>

    <?php if ($pesan != "") { ?>
        <p style="color:<?php echo $warna; ?>;"><?php echo $pesan; ?></p>
    <?php } ?>

    <form method="POST" action="">
        <ul>
            <li>Username <input type="text" name="username"></li>
            <li>Password <input type="password" name="password"></li>
            <li><button type="submit" name="login">Login!</button></li>
        </ul>
    </form>
    <a href="register.php">Buat akun baru!</a>
</body>

</html>
