<!DOCTYPE html>
<html>
<head>
    <title>Kalkulator Sederhana</title>
</head>
<body>
    <h2>Kalkulator Sederhana PHP</h2>
    
    <form method="POST">
        <input type="number" name="a" placeholder="Angka pertama" required>
        <select name="op">
            <option value="+">+</option>
            <option value="-">-</option>
            <option value="*">x</option>
            <option value="/">:</option>
        </select>
        <input type="number" name="b" placeholder="Angka kedua" required>
        <button type="submit" name="hitung">Hitung</button>
    </form>

    <?php
    if (isset($_POST['hitung'])) {
        $a = $_POST['a'];
        $b = $_POST['b'];
        $op = $_POST['op'];
        
        switch ($op) {
            case '+': $hasil = $a + $b; break;
            case '-': $hasil = $a - $b; break;
            case '*': $hasil = $a * $b; break;
            case '/': $hasil = ($b != 0) ? $a / $b : "Error: Pembagi nol"; break;
            default:  $hasil = 0;
        }

        echo "<h3>Hasil: $hasil</h3>";
    }
    ?>
</body>
</html>