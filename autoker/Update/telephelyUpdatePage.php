<?php

include_once('../common/dbfunctions.php');

$telepID = $_POST["telepid"];
$telepVaros = $_POST["varos"];
$telepNev = $_POST["nev"];

include_once('../common/navigation.php');

?>
    <!DOCTYPE HTML>
    <HTML>
    <HEAD>

    </HEAD>
<BODY>


<?php echo navigation();?>
    <h1>Telephely szerkesztés:</h1>

    <form method="POST" action="telephelyUpdate.php" accept-charset="utf-8">
        <table><tr>
                <td><label for="telepNev">Neve:</label></td>
                <td><input type="text" name="telepNev" value="<?php echo $telepNev ?>" required></td>
                <td><label for="telepVaros">Városa:</label></td>
                <td><input type="text" name="telepVaros" value="<?php echo $telepVaros ?>" required></td>
                <td><input type="hidden" name="telepID" value="<?php echo $telepID ?>" /><input type="submit" value="Mentés" /></td>
            </tr></table>
    </form>
<?php


