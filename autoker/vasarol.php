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
    <meta charset="utf-8" />
</head>
<body>
<?php echo navigation();?>
<h2>Függőben Lévő Vásárlások tábla</h2>
<table border="0">
    <tr>
        <th>Megvasarolni Kívánt Autó Alvázszáma szám</th>
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
				  <input type="submit" value="Törlés" />
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