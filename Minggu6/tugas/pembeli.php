<?php
include 'koneksi.php';

// ---------- CREATE & UPDATE ----------
if (isset($_POST['simpan'])) {
    $id     = (int) $_POST['id'];
    $nama   = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $hp     = mysqli_real_escape_string($koneksi, $_POST['nomor_hp']);
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);

    if ($id > 0) {
        mysqli_query($koneksi, "UPDATE pembeli SET nama='$nama', nomor_hp='$hp', alamat='$alamat' WHERE id=$id");
    } else {
        mysqli_query($koneksi, "INSERT INTO pembeli (nama, nomor_hp, alamat) VALUES ('$nama', '$hp', '$alamat')");
    }
    header("Location: pembeli.php");
    exit;
}

// ---------- DELETE ----------
if (isset($_GET['hapus'])) {
    $id = (int) $_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM pembeli WHERE id=$id");
    header("Location: pembeli.php");
    exit;
}

// ---------- AMBIL DATA UNTUK EDIT ----------
$edit = ['id' => 0, 'nama' => '', 'nomor_hp' => '', 'alamat' => ''];
if (isset($_GET['edit'])) {
    $id  = (int) $_GET['edit'];
    $res = mysqli_query($koneksi, "SELECT * FROM pembeli WHERE id=$id");
    if ($row = mysqli_fetch_assoc($res)) {
        $edit = $row;
    }
}

// ---------- READ ----------
$data = mysqli_query($koneksi, "SELECT * FROM pembeli ORDER BY id");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>CRUD Pembeli</title>
</head>
<body>
    <h1>CRUD Tabel Pembeli</h1>
    <p>
        <a href="index.php">Index</a> |
        <a href="barang.php">Barang</a> |
        <a href="pembeli.php">Pembeli</a> |
        <a href="kurir.php">Kurir</a>
    </p>

    <h3><?= $edit['id'] ? 'Edit Pembeli' : 'Tambah Pembeli' ?></h3>
    <form method="post" action="pembeli.php">
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
                <td>Alamat</td>
                <td><textarea name="alamat" rows="3" cols="30" required><?= htmlspecialchars($edit['alamat']) ?></textarea></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <button type="submit" name="simpan">Simpan</button>
                    <?php if ($edit['id']) { ?><a href="pembeli.php">Batal</a><?php } ?>
                </td>
            </tr>
        </table>
    </form>

    <h3>Data Pembeli</h3>
    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Nomor HP</th>
            <th>Alamat</th>
            <th>Aksi</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($data)) { ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['nama']) ?></td>
            <td><?= htmlspecialchars($row['nomor_hp']) ?></td>
            <td><?= htmlspecialchars($row['alamat']) ?></td>
            <td>
                <a href="pembeli.php?edit=<?= $row['id'] ?>">Edit</a> |
                <a href="pembeli.php?hapus=<?= $row['id'] ?>" onclick="return confirm('Hapus data ini?')">Hapus</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
