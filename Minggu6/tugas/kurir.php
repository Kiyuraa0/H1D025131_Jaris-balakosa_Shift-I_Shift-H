<?php
include 'koneksi.php';

// ---------- CREATE & UPDATE ----------
if (isset($_POST['simpan'])) {
    $id   = (int) $_POST['id'];
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $hp   = mysqli_real_escape_string($koneksi, $_POST['nomor_hp']);

    if ($id > 0) {
        mysqli_query($koneksi, "UPDATE kurir SET nama='$nama', nomor_hp='$hp' WHERE id=$id");
    } else {
        mysqli_query($koneksi, "INSERT INTO kurir (nama, nomor_hp) VALUES ('$nama', '$hp')");
    }
    header("Location: kurir.php");
    exit;
}

// ---------- DELETE ----------
if (isset($_GET['hapus'])) {
    $id = (int) $_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM kurir WHERE id=$id");
    header("Location: kurir.php");
    exit;
}

// ---------- AMBIL DATA UNTUK EDIT ----------
$edit = ['id' => 0, 'nama' => '', 'nomor_hp' => ''];
if (isset($_GET['edit'])) {
    $id  = (int) $_GET['edit'];
    $res = mysqli_query($koneksi, "SELECT * FROM kurir WHERE id=$id");
    if ($row = mysqli_fetch_assoc($res)) {
        $edit = $row;
    }
}

// ---------- READ ----------
$data = mysqli_query($koneksi, "SELECT * FROM kurir ORDER BY id");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>CRUD Kurir</title>
</head>
<body>
    <h1>CRUD Tabel Kurir</h1>
    <p>
        <a href="index.php">Index</a> |
        <a href="barang.php">Barang</a> |
        <a href="pembeli.php">Pembeli</a> |
        <a href="kurir.php">Kurir</a>
    </p>

    <h3><?= $edit['id'] ? 'Edit Kurir' : 'Tambah Kurir' ?></h3>
    <form method="post" action="kurir.php">
        <input type="hidden" name="id" value="<?= $edit['id'] ?>">
        <table>
            <tr>
                <td>Nama</td>
                <td><input type="text" name="nama" value="<?= htmlspecialchars($edit['nama']) ?>" required></td>
            </tr>
            <tr>
                <td>Nomor HP</td>
                <td><input type="text" name="nomor_hp" value="<?= htmlspecialchars($edit['nomor_hp']) ?>" required></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <button type="submit" name="simpan">Simpan</button>
                    <?php if ($edit['id']) { ?><a href="kurir.php">Batal</a><?php } ?>
                </td>
            </tr>
        </table>
    </form>

    <h3>Data Kurir</h3>
    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Nomor HP</th>
            <th>Aksi</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($data)) { ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['nama']) ?></td>
            <td><?= htmlspecialchars($row['nomor_hp']) ?></td>
            <td>
                <a href="kurir.php?edit=<?= $row['id'] ?>">Edit</a> |
                <a href="kurir.php?hapus=<?= $row['id'] ?>" onclick="return confirm('Hapus data ini?')">Hapus</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
