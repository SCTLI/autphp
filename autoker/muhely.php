<?php
include_once('common/navigation.php');
include_once('common/dbfunctions.php');
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Muhelyek tabla</title>
    <link rel="stylesheet" type="text/css" href="css/alap.css">
    <link rel="icon" href="image/icon.png" type="image/icon">
    <meta charset="utf-8" />
</head>
<body>
<?php echo navigation();?>
<h2>Új Műhely felvitele az adatbázisba</h2>
<span class="kozepre">Ahoz, hogy egy új műhelyt vigyen fel az adatbázisba kérem töltse ki az alábbi űrlapot.(minden mező kitöltése kötelező)</span>
<form method="POST" action="Insert/muhelyInsert.php" accept-charset="utf-8">
    <label>Műhely Városa:</label>
    <input type="number" name="varos" placeholder="Miskolc">
    <br />
    <label>Műhely Neve:</label>
    <input type="text" name="nev" placeholder="Nem Megy Még a Vasba">
    <br />
    <input type="submit" value="Feltöltés">
</form>
<h2>Műhelyek</h2>
<table>
    <tr>
        <th>Neve</th>
        <th>Városa</th>
    </tr>
<?php

$stid = getMuhelyList();
oci_execute($stid);

while ( $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
    echo '<tr>';
    echo '<td>'.$row['nev'].'</td>';
    echo '<td>'.$row['varos'].'</td>';
    echo '</tr>';
}
?>
</table>
<?php
include_once "common/footer.php";
?>
</body>
</html>