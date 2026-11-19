<?php
include("koneksi.php");
if (isset($_POST['Submit'])) {
    $judul = $_POST['judul'];
    $konten = $_POST['konten'];

    $result = mysqli_query($koneksi, "INSERT INTO posts(judul, konten) VALUES('$judul', '$konten')");
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Tambah Post Berita</title>
</head>
<body>
    <h1>Tambah Post Berita!</h1>
    <a href="index.php">Batal</a>
    <br><br>
    <form action="create.php" method="POST">
        <table>
            <tr>
                <td>Judul</td>
                <td><input type="text" name="judul" required></td>
            </tr>
            <tr>
                <td>Konten</td>
                <td><textarea name="konten" rows="5" cols="40" required></textarea></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="Submit" value="Tambah"></td>
            </tr>
        </table>
    </form>
</body>
</html>