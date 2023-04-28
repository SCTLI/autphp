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
<?php if ($_SESSION["role"]!="0"){?>
<h2>Új Autó felvitele az adatbázisba</h2>

<span class="kozepre">Ahoz, hogy egy új autót vigyen fel az adatbázisba kérem töltse ki az alábbi űrlapot.(minden mező kitöltése kötelező)</span>
<form method="POST" action="Insert/autoInsert.php" accept-charset="utf-8">
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
    <label>Ár:</label>
    <input type="number" name="ar" placeholder="100000">
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
            echo '<option value="'.$row['telepid'].'">'.$row['nev'].'</option>';
        }
        ?>
    </select>
    <br />
    <input type="submit" value="Feltöltés">
</form>
<?php } ?>
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
    <?php if($_SESSION['role']=='elado'){?><th>Elhelyezkedése(Telep)</th><?php } ?>
    <th></th>
</tr>
<?php

$stid = getAutokList();
oci_execute($stid);

while ( $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
    echo '<tr>';
    echo '<td>'. $row["alvazszam"] . '</td>';
    echo '<td>'. $row["marka"] . '</td>';
    echo '<td>'. $row["modell"] . '</td>';
    echo '<td>'. $row["uzemanyag"] . '</td>';
    echo '<td>'. $row["teljesitmeny"] . '</td>';
    echo '<td>'. $row["szin"] . '</td>';
    echo '<td>'. $row["ar"] . '</td>';
    if($_SESSION['role']=='elado'){ echo '<td>'. $row["telepnev"] . '</td>';}
if($_SESSION['role']=='ugyfel'){ echo '<td><form method="POST" action="vasarolpreInsert.php">
            <input type="hidden" name="alvazszam" value="'. $row["alvazszam"] .'" />
            <input type="submit" value="Vásárol" />
          </form></td>';}
if($_SESSION['role']=='elado'){ echo '<td><form method="POST" action="Delete/autoDelete.php">
				  <input type="hidden" name="autoDelete" value="'. $row["alvazszam"] .'" />
				  <input type="submit" value="Törlés" />
		          </form></td>';}
//if($_SESSION['role']=='szerelo'){ echo '<td><form method="POST" action="Insert/szerelInsert.php">
//				  <input type="hidden" name="autoDelete" value="'. $row["alvazszam"] .'" />
//				  <input type="submit" value="Törlés" />
//		          </form></td>';}
if($_SESSION['role']=='elado'){echo '<td style="text-align: center" class="lista"><form method="POST" action="autokUpdatePage.php">
				  <input type="hidden" name="telepid" value="'. $row["telepid"] .'" />
				  <input type="hidden" name="alvazszam" value="'. $row["alvazszam"] .'" />
				  <input type="hidden" name="marka" value="'. $row["marka"] .'" />
				  <input type="hidden" name="modell" value="'. $row["modell"] .'" />
				  <input type="hidden" name="uzemanyag" value="'. $row["uzemanyag"] .'" />
				  <input type="hidden" name="teljesitmeny" value="'. $row["teljesitmeny"] .'" />
				  <input type="hidden" name="szin" value="'. $row["szin"] .'" />
				  <input type="hidden" name="ar" value="'. $row["ar"] .'" />
				  <input type="submit" value="Szerkeszt" />
		          </form></td>';}
    echo '</tr>';
}
echo '</table>';
?>

    <?php
    include_once "common/footer.php";
    ?>
</body>
</html>