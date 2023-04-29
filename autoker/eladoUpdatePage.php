<?php

include_once("common/dbfunctions.php");

$eladoIgszam= $_POST["igszam"];
$uzletID = $_POST["uzletid"];
$eladoNev = $_POST["nev"];
$eladoFelhasznlonev = $_POST["felhasznalonev"];

include_once('common/navigation.php');

?>
    <!DOCTYPE HTML>
    <HTML>
    <HEAD>
        <title>Eladó Adatai Frissítése</title>
        <link rel="stylesheet" type="text/css" href="css/alap.css">
        <link rel="icon" href="image/icon.png" type="image/icon">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>G
        <meta charset="utf-8" />
    </HEAD>
<BODY >


<?php
include_once "common/header.php";
navi();
?>
    <h1 class="kozepre">Eladó szerkesztés:</h1>

    <form method="POST" action="Update/eladoUpdate.php" accept-charset="utf-8" class="kozepre">
        <table><tr>
                <td><label>Igazolványszáma: <?php echo $eladoIgszam ?></label></td>
                <td><label>Neve: <?php echo $eladoNev ?></label></td>
                <td><label>Felhasználóneve: <?php echo $eladoFelhasznlonev ?></label></td>
                <td><label for="uzletID">Munkahelye(Üzlet):</label></td>
                <td> <select name="uzletID" required>
                        <?php
                        $uzlet = getUzletList();
                        oci_execute($uzlet);
                        while( $row = oci_fetch_array($uzlet, OCI_ASSOC + OCI_RETURN_NULLS)) {
                            if ($row["uzletid"]==$uzletID){
                                echo '<option value="'.$row["uzletid"].'" selected>'.$row["nev"].'</option>';
                            }else{
                                echo '<option value="'.$row["uzletid"].'">'.$row["nev"].'</option>';
                            }
                        }
                        ?>
                    </select></td>
                <td><input type="hidden" name="eladoIgszam" value="<?php echo $eladoIgszam ?>" /><input type="submit" value="Mentés" /></td>
            </tr></table>
    </form>
<?php


