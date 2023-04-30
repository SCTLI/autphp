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
        <title>Műhely Adatai Frissítése</title>
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
    <h1 class="kozepre">Műhely szerkesztés:</h1>
<div class="regi" id="helyet">
    <form method="POST" action="Update/muhelyUpdate.php" accept-charset="utf-8" class="kozepre">
        <table><tr>
                    <?php
                        $stid = MuhelyDolgozoi();
                        oci_execute($stid);
                        while ( $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
                            if ($row["muhelyid"]==$muhelyID){
                                echo '<label type="text">Műhely dolgozói: '.$row["szam"].'</label>';
                            }
                    }
                    ?>
                <td><label for="muhelyNev">Neve:</label></td>
                <td><input type="text" name="muhelyNev" value="<?php echo $muhelyNev ?>" required></td>
                <td><label for="muhelyVaros">Városa:</label></td>
                <td><input type="text" name="muhelyVaros" value="<?php echo $muhelyVaros ?>" required></td>
                <td><input type="hidden" name="muhelyID" value="<?php echo $muhelyID ?>" /><input type="submit" value="Mentés" class="gomb1"/></td>
            </tr></table>
    </form>
</div>
<?php
include_once "common/footer.php";
?>
</body>
</html>

