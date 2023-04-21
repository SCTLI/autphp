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

    </HEAD>
<BODY >


<?php echo navigation();?>
    <h1>Eladó szerkesztés:</h1>

    <form method="POST" action="Update/eladoUpdate.php" accept-charset="utf-8">
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


