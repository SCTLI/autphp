<?php

include_once("common/dbfunctions.php");

$muhelyID = $_POST["muhelyid"];
$muhelyVaros = $_POST["varos"];
$muhelyNev = $_POST["nev"];

include_once('common/navigation.php');

?>
    <!DOCTYPE HTML>
    <HTML>
    <HEAD>

    </HEAD>
<BODY>


<?php echo navigation();?>
    <h1>Műhely szerkesztés:</h1>

    <form method="POST" action="Update/muhelyUpdate.php" accept-charset="utf-8">
        <table><tr>
                <td><label for="muhelyNev">Neve:</label></td>
                <td><input type="text" name="muhelyNev" value="<?php echo $muhelyNev ?>" required></td>
                <td><label for="muhelyVaros">Városa:</label></td>
                <td><input type="text" name="muhelyVaros" value="<?php echo $muhelyVaros ?>" required></td>
                <td><input type="hidden" name="muhelyID" value="<?php echo $muhelyID ?>" /><input type="submit" value="Mentés" /></td>
            </tr></table>
    </form>
<?php


