<?php

include_once("common/dbfunctions.php");
include_once('common/navigation.php');

$telepID = $_POST["telepid"];
$autoAlvazszam = $_POST["alvazszam"];
$autoMarka = $_POST["marka"];
$autoModell = $_POST["modell"];
$autoUzemanyag = $_POST["uzemanyag"];
$autoTeljesitmeny = $_POST["teljesitmeny"];
$autoSzin = $_POST["szin"];
$autoAr = $_POST["ar"];

include_once('common/navigation.php');

?>
    <!DOCTYPE HTML>
    <HTML>
    <HEAD>
        <title>Autó Adatai Frissítése</title>
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
    <h1 class="kozepre">Autó szerkesztés:</h1>

    <div class="regi" id="helyet">
    <form method="POST" action="Update/autokUpdate.php" accept-charset="utf-8" class="kozepre">
        <table><tr>
                <td><label>Alvázszám: <?php echo $autoAlvazszam ?></label></td>
                <td><label>Márka: <?php echo $autoMarka ?></label></td>
                <td><label>Modell: <?php echo $autoModell ?></label></td>
                <td><label>Üzemanyag: <?php echo $autoUzemanyag ?></label></td>
                <td><label for="autoTeljesitmeny">Teljesítmény:</label></td>
                <td><input type="text" name="autoTeljesitmeny" value="<?php echo $autoTeljesitmeny ?>" required></td>
                <td><label for="autoSzin">Szín:</label></td>
                <td><input type="text" name="autoSzin" value="<?php echo $autoSzin ?>" required></td>
                <td><label for="autoAr">Ár (FT):</label></td>
                <td><input type="number" name="autoAr" value="<?php echo $autoAr ?>" required></td>
                <td><label for="telepID">Elhelyezkedése(Telep):</label></td>
                <td> <select name="telepID" required>
                        <?php

                        $telep = getTelephelyList();
                        oci_execute($telep);
                        while( $row = oci_fetch_array($telep, OCI_ASSOC + OCI_RETURN_NULLS)) {
                            if ($row["telepid"]==$telepID){
                                echo '<option value="'.$row["telepid"].'" selected>'.$row["nev"].'</option>';
                            }else{
                                echo '<option value="'.$row["telepid"].'">'.$row["nev"].'</option>';
                            }
                        }
                        ?>
                    </select></td>
                <td><input type="hidden" name="autoAlvazszam" value="<?php echo $autoAlvazszam ?>" /><input type="submit" value="Mentés" class="gomb1"/></td>
            </tr></table>
    </form>
    </div>
<?php
include_once "common/footer.php";
?>
</body>
</html>

