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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
        <meta charset="utf-8" />
    </HEAD>
<BODY >


<?php
include_once "common/header.php";
navi();
?>
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
                <td><input type="hidden" name="szereloIgszam" value="<?php echo $szereloIgszam ?>" /><input type="submit" value="Mentés" class="gomb1"/></td>
            </tr></table>
    </form>
<?php
include_once "common/footer.php";
?>
</body>
</html>

