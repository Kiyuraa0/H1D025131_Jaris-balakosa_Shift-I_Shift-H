<?php
session_start();
include "koneksi.php";

// Jika sudah login, tidak perlu registrasi lagi
if (isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}

$pesan = "";
$username = "";

if (isset($_POST['register'])) {
    $username   = trim($_POST['username']);
    $password   = $_POST['password'];
    $konfirmasi = $_POST['konfirmasi'];

    if ($username == "" || $password == "") {
        $pesan = "Username dan password wajib diisi!";
    } elseif ($password != $konfirmasi) {
        $pesan = "Konfirmasi password tidak sama!";
    } else {
        // Cek apakah username sudah dipakai
        $sql  = "SELECT id FROM user WHERE username = ?";
        $stmt = mysqli_prepare($koneksi, $sql);
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) > 0) {
            $pesan = "Username sudah digunakan, silakan pakai yang lain!";
        } else {
            // Simpan user baru (password di-hash)
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql  = "INSERT INTO user (username, password) VALUES (?, ?)";
            $stmt = mysqli_prepare($koneksi, $sql);
            mysqli_stmt_bind_param($stmt, "ss", $username, $hash);

            if (mysqli_stmt_execute($stmt)) {
                header("Location: login.php?daftar=berhasil");
                exit;
            } else {
                $pesan = "Registrasi gagal, coba lagi!";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <title>Registrasi</title>
</head>

<body>
    <h1>Halaman Registrasi Akun Mahasiswa</h1>

    <?php if ($pesan != "") { ?>
        <p style="color:red;"><?php echo $pesan; ?></p>
    <?php } ?>

    <form method="POST" action="">
        <ul>
            <li>Username<br>
                <input type="text" name="username"
                    value="<?php echo htmlspecialchars($username); ?>">
            </li>
            <li>Password<br>
                <input type="password" name="password">
            </li>
            <li>Konfirmasi Password<br>
                <input type="password" name="konfirmasi">
            </li>
            <li>
                <button type="submit" name="register">Register!</button>
            </li>
        </ul>
    </form>
    <a href="login.php">Sudah memiliki akun?</a>
</body>

</html>
