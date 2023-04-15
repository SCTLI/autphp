<?php
include_once('common/navigation.php');
include_once('common/dbfunctions.php');
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Autok tabla</title>
    <link rel="stylesheet" type="text/css" href="css/alap.css">
    <link rel="icon" href="image/icon.png" type="image/icon">
    <meta charset="utf-8" />
</head>
<body>
<?php echo navigation();?>

<h2>Autók </h2>
<table border="0">
<tr>
    <th>Alvázszám</th>
    <th>Márka</th>
    <th>Modell</th>
    <th>Üzemanyag</th>
    <th>Teljesítmény</th>
    <th>Szín</th>
    <th>Ár (Ft)</th>
    <th></th>
</tr>
<?php

$stid = getAutokList();
oci_execute($stid);

while ( $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
    echo '<tr>';
    echo '<td>'. $row["Alvázszám"] . '</td>';
    echo '<td>'. $row["Márka"] . '</td>';
    echo '<td>'. $row["Modell"] . '</td>';
    echo '<td>'. $row["Üzemanyag"] . '</td>';
    echo '<td>'. $row["Teljesítmény"] . '</td>';
    echo '<td>'. $row["Szín"] . '</td>';
    echo '<td>'. $row["Ár (Ft)"] . '</td>';
    echo '<td><form method="POST" action="Delete/autoDelete.php">
				  <input type="hidden" name="autoDelete" value="'. $row["Alvázszám"] .'" />
				  <input type="submit" value="Törlés" />
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