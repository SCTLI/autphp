<?php

include_once("common/dbfunctions.php");

$ugyfelneve= $_POST["ugyfelneve"];
$ugyfelfelhnev = $_POST["ugyfelfelhnev"];
$ugyfelig = $_POST["ugyfeligszam"];

include_once('common/navigation.php');

?>
<!DOCTYPE HTML>
<HTML>
<HEAD>
    <title>Ügyfél Adatai Frissítése</title>
    <link rel="stylesheet" type="text/css" href="css/alap.css">
    <link rel="icon" href="image/icon.png" type="image/icon">
    <meta charset="utf-8" />
</HEAD>
<BODY >


<?php echo navigation();?>
<h1 class="kozepre">Ügyfél szerkesztés:</h1>

<form method="POST" action="Update/ugyfelUpdate.php" accept-charset="utf-8" class="kozepre">
    <table><tr>
            <td><label>Neve:</label></td>
            <td><input type="text" name="ugyfelnev" value="<?php echo $ugyfelneve ?>" required></td>
            <td><label>Felhasználóneve:</label></td>
            <td><input type="text" name="ugyfelfelhanev" value="<?php echo $ugyfelfelhnev ?>" required></td>
            <td><label>Jelszó Módosítása(minden alaklommal kötelező):</label></td>
            <td><input type="text" name="ugyfeljel" value="" required></td>
            <td><input type="hidden" name="ugyfeligszam" value="<?php echo $ugyfelig ?>" /><input type="submit" value="Mentés" /></td>
        </tr></table>
</form>
<?php
include_once "common/footer.php";
?>
</body>
</html>

