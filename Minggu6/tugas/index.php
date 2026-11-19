<?php
include 'koneksi.php';

$data = mysqli_query($koneksi, "SELECT barang.id, barang.nama AS barang, pembeli.nama AS pembeli, kurir.nama AS kurir
    FROM barang
    JOIN pembeli ON barang.id = pembeli.id
    JOIN kurir ON barang.id = kurir.id");
?>
<h1>Menampilkan data dari database!</h1>
<a href="index.php">Index</a> | <a href="barang.php">Barang</a> |
<a href="pembeli.php">Pembeli</a> | <a href="kurir.php">Kurir</a>

<table border="1" cellpadding="3">
    <tr><th>ID</th><th>Nama Barang</th><th>Nama Pembeli</th><th>Nama Kurir</th></tr>
    <?php while ($r = mysqli_fetch_assoc($data)) { ?>
    <tr>
        <td><?= $r['id'] ?></td>
        <td><?= $r['barang'] ?></td>
        <td><?= $r['pembeli'] ?></td>
        <td><?= $r['kurir'] ?></td>
    </tr>
    <?php } ?>
</table>