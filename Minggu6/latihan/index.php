<?php
include("koneksi.php");
$read = mysqli_query($koneksi, "SELECT * FROM posts ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Post News Ter-Update</title>
</head>
<body>
    <h1>Post News Ter-Update!</h1>
    <a href="create.php"><button>Tambah Post</button></a>
    <hr>
    <?php
    while ($row = mysqli_fetch_array($read)) {
        echo "<h3>" . $row['id'] . ". " . $row['judul'] . "</h3>";
        echo "<a href='update.php?id=" . $row['id'] . "'>Edit</a> | ";
        echo "<a href='delete.php?id=" . $row['id'] . "'>Delete</a>";
        echo "<p>" . nl2br($row['konten']) . "</p>";
        echo "<hr>";
    }
    ?>
</body>
</html>