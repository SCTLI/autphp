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
<h2>Új Autó felvitele az adatbázisba</h2>
<span class="kozepre">Ahoz, hogy egy új autót vigyen fel az adatbázisba kérem töltse ki az alábbi űrlapot.(minden mező kitöltése kötelező)</span>
<form method="POST" action="Insert/autofel.php" accept-charset="utf-8">
    <label>Alvázszám:</label>
    <input type="number" name="alvazszam" placeholder="123456">
    <br />
    <label>Márka:</label>
    <input type="text" name="marka" placeholder="Audi">
    <br />
    <label>Modell</label>
    <input type="text" name="modell" placeholder="SUV">
    <br />
    <label>Teljesítmény:</label>
    <input type="text" name="teljesitmeny" placeholder="xkW, xLE">
    <br />
    <label>Szín:</label>
    <input type="text" name="szin" placeholder="Piros">
    <br />
    <label>Üzemanyag típus:</label>
    <select name="uzemanyag">
        <option value="Benzin">Benzin</option>
        <option value="Dízel">Dízel</option>
        <option value="Elektromos">Elektromos</option>
        <option value="PB Gáz">PB Gáz</option>
    </select>
    <br />
    <label>Telephely:</label>
    <select name="telephelyid">
        <?php
        $stid = getTelephelyList();
        oci_execute($stid);
        while ( $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
            echo '<option value="'.$row['telepid'].'">Telephely neve: '.$row['Neve'].' Telephely városa: '.$row['Városa'].'</option>';
        }
        ?>
    </select>
</form>
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