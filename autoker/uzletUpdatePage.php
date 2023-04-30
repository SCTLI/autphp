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
        <title>Üzlet Adatai Frissítése</title>
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
    <h1>Üzlet szerkesztés:</h1>
<div class="regi" id="helyet">
    <form method="POST" action="Update/uzletUpdate.php" accept-charset="utf-8" class="kozepre">
        <table><tr>
                <?php
                $stid = UzletDolgozoi();
                oci_execute($stid);
                while ( $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
                    if ($row["uzletid"]==$uzletID){
                        echo '<label type="text">Üzlet dolgozói: '.$row["szam"].'</label>';
                    }
                }
                ?>
                <td><label for="uzletNev">Neve:</label></td>
                <td><input type="text" name="uzletNev" value="<?php echo $uzletNev ?>" required></td>
                <td><label for="uzletVaros">Városa:</label></td>
                <td><input type="text" name="uzletVaros" value="<?php echo $uzletVaros ?>" required></td>
                <td><input type="hidden" name="uzletID" value="<?php echo $uzletID ?>" /><input type="submit" value="Mentés" class="gomb1"/></td>
            </tr></table>
    </form>
</div>
<?php
include_once "common/footer.php";
?>
</body>
</html>
