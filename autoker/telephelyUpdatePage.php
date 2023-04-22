<?php

include_once('common/dbfunctions.php');

$telepID = $_POST["telepid"];
$telepVaros = $_POST["varos"];
$telepNev = $_POST["nev"];

include_once('common/navigation.php');

?>
    <!DOCTYPE HTML>
    <HTML>
    <HEAD>
        <title>Telephely Adatai Frissítése</title>
        <link rel="stylesheet" type="text/css" href="css/alap.css">
        <link rel="icon" href="image/icon.png" type="image/icon">
        <meta charset="utf-8" />
    </HEAD>
<BODY>


<?php echo navigation();?>
    <h1 class="kozepre">Telephely szerkesztés:</h1>

    <form method="POST" action="Update/telephelyUpdate.php" accept-charset="utf-8" class="kozepre">
        <table><tr>
                <td><label for="telepNev">Neve:</label></td>
                <td><input type="text" name="telepNev" value="<?php echo $telepNev ?>" required></td>
                <td><label for="telepVaros">Városa:</label></td>
                <td><input type="text" name="telepVaros" value="<?php echo $telepVaros ?>" required></td>
                <td><input type="hidden" name="telepID" value="<?php echo $telepID ?>" /><input type="submit" value="Mentés" /></td>
            </tr></table>
    </form>
<?php
include_once "common/footer.php";
?>
</body>
</html>

