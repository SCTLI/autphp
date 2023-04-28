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
<p class="kozepre">Ahoz, hogy egy új műhelyt vigyen fel az adatbázisba kérem töltse ki az alábbi űrlapot.(minden mező kitöltése kötelező)</p>
<form method="POST" action="Insert/muhelyInsert.php" accept-charset="utf-8">
    <label>Műhely Városa:</label>
    <input type="text" name="varos" placeholder="Miskolc">
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
        <th></th>
    </tr>
<?php

$stid = getMuhelyList();
oci_execute($stid);

while ( $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
    echo '<tr>';
    echo '<td>'.$row['nev'].'</td>';
    echo '<td>'.$row['varos'].'</td>';
    echo '<td><form method="POST" action="Delete/muhelyDelete.php">
				  <input type="hidden" name="muhelyDelete" value="'. $row["muhelyid"] .'" />
				  <input type="submit" value="Törlés" />
		          </form></td>';
    echo '<td style="text-align: center" class="lista"><form method="POST" action="muhelyUpdatePage.php">
				  <input type="hidden" name="varos" value="'. $row["varos"] .'" />
				  <input type="hidden" name="nev" value="'. $row["nev"] .'" />
				  <input type="hidden" name="muhelyid" value="'. $row["muhelyid"] .'" />
				  <input type="submit" value="Szerkeszt" />
		          </form></td>';
    echo '</tr>';
    echo '</tr>';
}
?>
</table>
<?php
include_once "common/footer.php";
?>
</body>
</html>