<?php
include_once('common/navigation.php');
include_once('common/dbfunctions.php');
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Szerelések tabla</title>
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

<h2>Szerelések tábla</h2>
<table border="0">
    <tr>
        <th>Szerelt Autó Alvázszáma szám</th>
        <th>Szerelt Autó Márkája</th>
        <th>Szerelt Autó Modellje</th>
        <th>Műhely</th>
        <th>Szerelt Alkatrész</th>
        <th>Szerelés időpontja</th>
    </tr>
    <?php
    $stid = getSzerelList();
    oci_execute($stid);

    while ( $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
        echo '<tr>';
        echo '<td>'.$row['alvazszam'].'</td>';
        echo '<td>'.$row['marka'].'</td>';
        echo '<td>'.$row['modell'].'</td>';
        echo '<td>'.$row['muhelynev'].'</td>';
        echo '<td>'.$row['alkatresz'].'</td>';
        echo '<td>'.$row['idopont'].'</td>';
        echo '<td><form method="POST" action="Delete/szerelDelete.php">
				  <input type="hidden" name="szerelAlvazszamDelete" value="'. $row["alvazszam"] .'" />
				  <input type="hidden" name="szerelIdoDelete" value="'. $row["idopont"] .'" />
				  
				  <input type="submit" value="Törlés" class="gomb2"/>
		          </form></td>';
    }
    echo '</table>';
    ?>
    <?php
    include_once "common/footer.php";
    ?>
</body>
</html>