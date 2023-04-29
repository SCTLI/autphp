<?php
include_once ('common/dbfunctions.php');
include_once('common/navigation.php');
$autoAlvazszam = $_POST['alvazszam'];
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Kiválaszott autó lefogalála</title>
    <link rel="stylesheet" type="text/css" href="css/alap.css">
    <link rel="icon" href="image/icon.png" type="image/icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
    <meta charset="utf-8" />
</head>
<body>
<?php
include_once "common/header.php";
navi();
?>
<h1 class="kozepre">Az autó lefoglalálásához kérem töltse ki az alábbi űrlapot</h1>
<div class="regi" id="helyet">
<form method="post" action="Insert/vasarolInsert.php" class="kozepre">
    <input type="hidden" name="alvazszam" value="<?php echo $autoAlvazszam ?>" />
    <label>Melyik üzletben szeretné átvenni:</label>
    <select name="uzletid">
        <?php
        $stid = getUzletList();
        oci_execute($stid);
        while ( $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
            echo '<option value="'.$row['uzletid'].'">'.$row['nev'].'-'.$row['varos'].'</option>';
        }
        ?>
    </select>
    <br />
        <?php
        $ugyfelfelhasznalo = $_SESSION["felhasz"];
        $stid = getUgyfelList();
        oci_execute($stid);
        while ( $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
            if($row["felhasznalonev"] == $ugyfelfelhasznalo){
                $ugyfeligje = $row["igsz"];
                echo $ugyfeligje;
            }
        }
        ?>
    <input type="hidden" value="<?php echo $ugyfeligje ?>" name="igszam"/>
    <input type="submit" value="Lefoglalás" class="gomb1">
</form>
</div>
</body>
</html>