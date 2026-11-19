<?php
include("koneksi.php");
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $judul = $_POST['judul'];
    $konten = $_POST['konten'];

    $result = mysqli_query($koneksi, "UPDATE posts SET judul='$judul', konten='$konten' WHERE id=$id");
    header("Location: index.php");
}

$id = $_GET['id'];
$result = mysqli_query($koneksi, "SELECT * FROM posts WHERE id=$id");
while ($user_data = mysqli_fetch_array($result)) {
    $judul = $user_data['judul'];
    $konten = $user_data['konten'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Post Berita</title>
</head>
<body>
    <a href="index.php">Batal</a>
    <br><br>
    <form method="post" action="update.php">
        <table>
            <tr>
                <td>Judul</td>
                <td><input type="text" name="judul" value="<?php echo $judul; ?>" required></td>
            </tr>
            <tr>
                <td>Konten</td>
                <td><textarea name="konten" rows="5" cols="40" required><?php echo $konten; ?></textarea></td>
            </tr>
            <tr>
                <td><input type="hidden" name="id" value="<?php echo $_GET['id']; ?>"></td>
                <td><input type="submit" name="update" value="Update"></td>
            </tr>
        </table>
    </form>
</body>
</html>