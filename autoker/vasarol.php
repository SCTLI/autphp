<?php
include_once('common/navigation.php');
include_once('common/dbfunctions.php');
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Vásárlások tabla</title>
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
<h2>Függőben Lévő Vásárlások tábla</h2>
<table border="0">
    <tr>
        <th>Megvasarolni Kívánt Autó Alvázszáma</th>
        <th>Megvásárolni Kívánt Autó Márkája</th>
        <th>Megvásárolni Kívánt Autó Modellje</th>
        <th>Üzlet</th>
        <th>Ügyfél Igazolvány száma</th>
        <th>Ügyfél neve</th>
    </tr>
    <?php
    $stid = getVasarolList();
    oci_execute($stid);

    while ( $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
        echo '<tr>';
        echo '<td>'.$row['alvazszam'].'</td>';
        echo '<td>'.$row['marka'].'</td>';
        echo '<td>'.$row['modell'].'</td>';
        echo '<td>'.$row['uzletnev'].'</td>';
        echo '<td>'.$row['igsz'].'</td>';
        echo '<td>'.$row['nev'].'</td>';
        echo '<td><form method="POST" action="Delete/vasarolDelete.php">
				  <input type="hidden" name="vasarolDeleteAlvazszam" value="'. $row["alvazszam"] .'" />
				  <input type="hidden" name="vasarolDeleteUzletID" value="'. $row["uzletid"] .'" />
				  <input type="hidden" name="vasarolDeleteUgyfeligsz" value="'. $row["igsz"] .'" />
				  <input type="submit" value="Elfogad" class="gomb2"/>
		          </form></td>';
//        echo '<td style="text-align: center" class="lista"><form method="POST" action="vasarlasUpdatePage.php">
//				  <input type="hidden" name="vasarolAlvazszamUpdate" value="'. $row["alvazszam"] .'" />
//				  <input type="hidden" name="vasarolUzletidUpdate" value="'. $row["muhelynev"] .'" />
//				  <input type="hidden" name="vasarolIgszUpdate" value="'. $row["igsz"] .'" />
//				  <input type="submit" value="Szerkeszt" />
//		          </form></td>';
        echo '</tr>';
    }
    echo '</table>';
    ?>
    <?php
    include_once "common/footer.php";
    ?>
</body>
</html>