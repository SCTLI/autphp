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
    <meta charset="utf-8" />
</head>
<body>
<?php echo navigation();?>
<h2>Eladók </h2>
<table border="0">
    <tr>
        <th>Igazolvány szám</th>
        <th>Név</th>
        <th>Felhasználónév</th>
        <th>Munkahelye(Üzlet)</th>
        <th></th>
    </tr>
    <?php
    $stid = getEladoList();
    oci_execute($stid);

while ( $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
    echo '<tr>';
    echo '<td>'.$row['igsz'].'</td>';
    echo '<td>'.$row['nev'].'</td>';
    echo '<td>'.$row['felhasznalonev'].'</td>';
    echo '<td>'.$row['uzletnev'].'</td>';
    echo '<td><form method="POST" action="Delete/eladoDelete.php">
				  <input type="hidden" name="eladoDelete" value="'. $row["igsz"] .'" />
				  <input type="submit" value="Törlés" />
		          </form></td>';
    echo '<td style="text-align: center" class="lista"><form method="POST" action="eladoUpdatePage.php">
				  <input type="hidden" name="igszam" value="'. $row["igsz"] .'" />
				  <input type="hidden" name="nev" value="'. $row["nev"] .'" />
				  <input type="hidden" name="felhasznalonev" value="'. $row["felhasznalonev"] .'" />
				  <input type="hidden" name="uzletid" value="'. $row["uzletid"] .'" />
				  <input type="submit" value="Szerkeszt" />
		          </form></td>';
    echo '</tr>';
}
echo '</table>';
?>
    <?php
    include_once "common/footer.php";
    ?>
</body>
</html>