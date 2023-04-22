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
        <meta charset="utf-8" />
    </HEAD>
<BODY >


<?php echo navigation();?>
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


