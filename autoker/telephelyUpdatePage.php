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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
        <meta charset="utf-8" />
    </HEAD>
<BODY>


<?php
include_once "common/header.php";
navi();
?>
    <h1 class="kozepre">Telephely szerkesztés:</h1>
<div class="regi" id="helyet">
    <form method="POST" action="Update/telephelyUpdate.php" accept-charset="utf-8" class="kozepre">
        <table><tr>
                <td><label for="telepNev">Neve:</label></td>
                <td><input type="text" name="telepNev" value="<?php echo $telepNev ?>" required></td>
                <td><label for="telepVaros">Városa:</label></td>
                <td><input type="text" name="telepVaros" value="<?php echo $telepVaros ?>" required></td>
                <td><input type="hidden" name="telepID" value="<?php echo $telepID ?>" /><input type="submit" value="Mentés" class="gomb1"/></td>
            </tr></table>
    </form>
</div>
<?php
include_once "common/footer.php";
?>
</body>
</html>

