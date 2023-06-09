<?php
include_once('common/navigation.php');
include_once('common/dbfunctions.php');
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Eladok tabla</title>
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
<h2>Szerelők </h2>
<table border="0">
    <tr>
        <th>Igazolvány szám</th>
        <th>Név</th>
        <th>Felhasználónév</th>
        <th>Munkahelye(Műhely)</th>
        <th></th>
    </tr>
    <?php
    $stid = getSzereloList();
    oci_execute($stid);

    while ( $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
        echo '<tr>';
        echo '<td>'.$row['igsz'].'</td>';
        echo '<td>'.$row['nev'].'</td>';
        echo '<td>'.$row['felhasznalonev'].'</td>';
        echo '<td>'.$row['muhelynev'].'</td>';
        echo '<td><form method="POST" action="Delete/szereloDelete.php">
				  <input type="hidden" name="szereloDelete" value="'. $row["igsz"] .'" />
				  <input type="hidden" name="szereloFelhasznalonev" value="'. $row["felhasznalonev"] .'" />
				  <input type="submit" value="Törlés" class="gomb2"/>
		          </form></td>';
        echo '<td style="text-align: center" class="lista"><form method="POST" action="szereloUpdatePage.php">
				  <input type="hidden" name="igszam" value="'. $row["igsz"] .'" />
				  <input type="hidden" name="nev" value="'. $row["nev"] .'" />
				  <input type="hidden" name="felhasznalonev" value="'. $row["felhasznalonev"] .'" />
				  <input type="hidden" name="muhelyid" value="'. $row["muhelyid"] .'" />
				  <input type="submit" value="Szerkeszt" class="gomb1"/>
		          </form></td>';
        echo '</tr>';
        echo '</tr>';
    }
    echo '</table>';
    ?>

    <h2>Szerelések</h2>
    <table width="25%">
        <tr>
            <th>Műhely neve</th>
            <th>db</th>
        </tr>
        <?php
        $stid = MuhelySzerel();
        oci_execute($stid);

        while ( $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
            echo '<tr>';
            echo '<td>'.$row['nev'].'</td>';
            echo '<td>'.$row['db'].'</td>';

            echo '</tr>';
        }
        echo '</table>';

        ?>
    <?php
    include_once "common/footer.php";
    ?>
</body>
</html>