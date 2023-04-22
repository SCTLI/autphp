<?php

include_once("common/dbfunctions.php");

$szereloIgszam= $_POST["igszam"];
$muhelyID = $_POST["muhelyid"];
$szereloNev = $_POST["nev"];
$szereloFelhasznlonev = $_POST["felhasznalonev"];

include_once('common/navigation.php');

?>
    <!DOCTYPE HTML>
    <HTML>
    <HEAD>
        <title>Szerelő Adatai Frissítése</title>
        <link rel="stylesheet" type="text/css" href="css/alap.css">
        <link rel="icon" href="image/icon.png" type="image/icon">
        <meta charset="utf-8" />
    </HEAD>
<BODY >


<?php echo navigation();?>
    <h1 class="kozepre">Szerelő szerkesztés:</h1>

    <form method="POST" action="Update/szereloUpdate.php" accept-charset="utf-8" class="kozepre">
        <table><tr>
                <td><label>Igazolványszáma: <?php echo $szereloIgszam ?></label></td>
                <td><label>Neve: <?php echo $szereloNev ?></label></td>
                <td><label>Felhasználóneve: <?php echo $szereloFelhasznlonev ?></label></td>
                <td><label for="muhelyID">Munkahelye(Műhely):</label></td>
                <td> <select name="muhelyID" required>
                        <?php
                        $muhely = getMuhelyList();
                        while( $row = oci_fetch_array($muhely, OCI_ASSOC + OCI_RETURN_NULLS)) {
                            if ($row["muhelyid"]==$muhelyID){
                                echo '<option value="'.$row["muhelyid"].'" selected>'.$row["nev"].'</option>';
                            }else{
                                echo '<option value="'.$row["muhelyid"].'">'.$row["nev"].'</option>';
                            }
                        }
                        ?>
                    </select></td>
                <td><input type="hidden" name="szereloIgszam" value="<?php echo $szereloIgszam ?>" /><input type="submit" value="Mentés" /></td>
            </tr></table>
    </form>
<?php
include_once "common/footer.php";
?>
</body>
</html>

