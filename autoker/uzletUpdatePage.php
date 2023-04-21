<?php

include_once('common/dbfunctions.php');

$uzletID = $_POST["uzletid"];
$uzletVaros = $_POST["varos"];
$uzletNev = $_POST["nev"];

include_once('common/navigation.php');

?>
    <!DOCTYPE HTML>
    <HTML>
    <HEAD>

    </HEAD>
<BODY>


<?php echo navigation();?>
    <h1>Üzlet szerkesztés:</h1>

    <form method="POST" action="Update/uzletUpdate.php" accept-charset="utf-8">
        <table><tr>
                <td><label for="uzletNev">Neve:</label></td>
                <td><input type="text" name="uzletNev" value="<?php echo $uzletNev ?>" required></td>
                <td><label for="uzletVaros">Városa:</label></td>
                <td><input type="text" name="uzletVaros" value="<?php echo $uzletVaros ?>" required></td>
                <td><input type="hidden" name="uzletID" value="<?php echo $uzletID ?>" /><input type="submit" value="Mentés" /></td>
            </tr></table>
    </form>
<?php


