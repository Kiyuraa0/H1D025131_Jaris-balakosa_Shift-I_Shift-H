<?php
include 'koneksi.php';

// Proses Tambah Data
if (isset($_POST['tambah'])) {
    $nama  = $_POST['nama'];
    $harga = $_POST['harga'];
    mysqli_query($koneksi, "INSERT INTO barang (nama, harga) VALUES ('$nama', '$harga')");
    header("Location: barang.php");
}

// Proses Hapus Data
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM barang WHERE id='$id'");
    header("Location: barang.php");
}

// Proses Edit Data
if (isset($_POST['update'])) {
    $id    = $_POST['id'];
    $nama  = $_POST['nama'];
    $harga = $_POST['harga'];
    mysqli_query($koneksi, "UPDATE barang SET nama='$nama', harga='$harga' WHERE id='$id'");
    header("Location: barang.php");
}

$edit_data = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $result = mysqli_query($koneksi, "SELECT * FROM barang WHERE id='$id'");
    $edit_data = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>CRUD Tabel Barang</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        form { background: #f9f9f9; padding: 15px; width: 300px; border: 1px solid #ccc; }
        input[type=text], input[type=number] { width: 100%; padding: 6px; margin: 6px 0; box-sizing: border-box; }
    </style>
</head>
<body>

<h2>CRUD Tabel Barang</h2>

<!-- Form Tambah / Edit -->
<form method="POST" action="">
    <h3><?php echo $edit_data ? 'Edit Barang' : 'Tambah Barang'; ?></h3>
    <input type="hidden" name="id" value="<?php echo $edit_data['id'] ?? ''; ?>">
    <label>Nama Barang:</label>
    <input type="text" name="nama" value="<?php echo $edit_data['nama'] ?? ''; ?>" required>
    <label>Harga:</label>
    <input type="number" name="harga" value="<?php echo $edit_data['harga'] ?? ''; ?>" required>
    
    <?php if ($edit_data): ?>
        <button type="submit" name="update">Update</button>
        <a href="barang.php">Batal</a>
    <?php else: ?>
        <button type="submit" name="tambah">Simpan</button>
    <?php endif; ?>
</form>

<!-- Tabel Data Barang -->
<table>
    <tr>
        <th>ID</th>
        <th>Nama Barang</th>
        <th>Harga</th>
        <th>Aksi</th>
    </tr>
    <?php
    $data = mysqli_query($koneksi, "SELECT * FROM barang");
    while ($row = mysqli_fetch_assoc($data)) {
        echo "<tr>
            <td>{$row['id']}</td>
            <td>{$row['nama']}</td>
            <td>{$row['harga']}</td>
            <td>
                <a href='barang.php?edit={$row['id']}'>Edit</a> | 
                <a href='barang.php?hapus={$row['id']}' onclick='return confirm(\"Yakin ingin menghapus?\")'>Hapus</a>
            </td>
        </tr>";
    }
    ?>
</table>

</body>
</html>