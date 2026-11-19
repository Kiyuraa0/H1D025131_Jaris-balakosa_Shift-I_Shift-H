<?php
include 'koneksi.php';

if (isset($_POST['simpan'])) {
    $id = $_POST['id']; $nama = $_POST['nama']; $harga = $_POST['harga'];
    if ($id)
        mysqli_query($koneksi, "UPDATE barang SET nama='$nama', harga='$harga' WHERE id='$id'");
    else
        mysqli_query($koneksi, "INSERT INTO barang VALUES (NULL, '$nama', '$harga')");
    header("Location: barang.php");
}

if (isset($_GET['hapus'])) {
    mysqli_query($koneksi, "DELETE FROM barang WHERE id='$_GET[hapus]'");
    header("Location: barang.php");
}

$e = ['id' => '', 'nama' => '', 'harga' => ''];
if (isset($_GET['edit']))
    $e = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM barang WHERE id='$_GET[edit]'"));

$data = mysqli_query($koneksi, "SELECT * FROM barang");
?>
<h1>CRUD Tabel Barang</h1>
<a href="index.php">Index</a> | <a href="barang.php">Barang</a> |
<a href="pembeli.php">Pembeli</a> | <a href="kurir.php">Kurir</a>

<form method="post">
    <input type="hidden" name="id" value="<?= $e['id'] ?>">
    Nama <input type="text" name="nama" value="<?= $e['nama'] ?>"><br>
    Harga <input type="number" name="harga" value="<?= $e['harga'] ?>"><br>
    <button name="simpan">Simpan</button>
</form>

<table border="1" cellpadding="5">
    <tr><th>ID</th><th>Nama</th><th>Harga</th><th>Aksi</th></tr>
    <?php while ($r = mysqli_fetch_assoc($data)) { ?>
    <tr>
        <td><?= $r['id'] ?></td>
        <td><?= $r['nama'] ?></td>
        <td><?= $r['harga'] ?></td>
        <td>
            <a href="?edit=<?= $r['id'] ?>">Edit</a> |
            <a href="?hapus=<?= $r['id'] ?>">Hapus</a>
        </td>
    </tr>
    <?php } ?>
</table>