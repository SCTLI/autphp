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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
    <meta charset="utf-8" />
</head>
<body>
<?php
include_once "common/header.php";
navi();
?>
<?php if ($_SESSION["role"]=="elado"){?>
<h2>Új Autó felvitele az adatbázisba</h2>
<div id="helyet" class="regi">
<p class="kozepre">Ahoz, hogy egy új autót vigyen fel az adatbázisba kérem töltse ki az alábbi űrlapot.(minden mező kitöltése kötelező)</p>
<form method="POST" action="Insert/autoInsert.php" accept-charset="utf-8">
    <label>Alvázszám:</label>
    <input type="number" name="alvazszam" placeholder="123456" required>
    <br />
    <label>Márka:</label>
    <input type="text" name="marka" placeholder="Audi" required>
    <br />
    <label>Modell</label>
    <input type="text" name="modell" placeholder="SUV" required>
    <br />
    <label>Teljesítmény:</label>
    <input type="text" name="teljesitmeny" placeholder="xkW, xLE" required>
    <br />
    <label>Szín:</label>
    <input type="text" name="szin" placeholder="Piros" required>
    <br />
    <label>Ár:</label>
    <input type="number" name="ar" placeholder="100000" required>
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
    <input class="gomb1" type="submit" value="Feltöltés">
</form>
</div>
<?php } ?>
<h2>Autók </h2>
<div id="helyet" class="regi">
    <?php
    if($_SESSION["role"] == "vezeto"){
        $stid = AVGeladott();
        oci_execute($stid);
        while ( $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
            echo '<p class="kozepre">Átlag autó eladási ár: ';
            echo $row["jooci"];
            echo ' FT';
            echo '</p>';
        }
    }
    ?>
</div>
<table border="0">
<tr>
    <th>Alvázszám</th>
    <th>Márka</th>
    <th>Modell</th>
    <th>Üzemanyag</th>
    <th>Teljesítmény</th>
    <th>Szín</th>
    <th>Ár (Ft)</th>
    <?php if($_SESSION['role']=='elado' || $_SESSION['role']=='szerelo'){?><th>Elhelyezkedése(Telep)</th><?php } ?>
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
    if($_SESSION['role']=='elado' || $_SESSION['role']=='szerelo'){ echo '<td>'. $row["telepnev"] . '</td>';}
if($_SESSION['role']=='ugyfel'){ echo '<td><form method="POST" action="vasarolpreInsert.php">
            <input type="hidden" name="alvazszam" value="'. $row["alvazszam"] .'" />
            <input type="submit" value="Vásárol" class="gomb1"/>
          </form></td>';}
if($_SESSION['role']=='elado'){ echo '<td><form method="POST" action="Delete/autoDelete.php">
				  <input type="hidden" name="autoDelete" value="'. $row["alvazszam"] .'" />
				  <input type="submit" value="Törlés" class="gomb2"/>
		          </form></td>';}
if($_SESSION['role']=='szerelo' && HolSzerel()!=30){ echo '<td><form method="POST" action="szerelpreInsert.php">
				  <input type="hidden" name="muhely" value="'. HolSzerel() .'" />
				  <input type="hidden" name="alvazszam" value="'. $row["alvazszam"] .'" />
				  <input type="submit" value="Szerel" class="gomb1"/>
		          </form></td>';}
if($_SESSION['role']=='elado'){echo '<td style="text-align: center" class="lista"><form method="POST" action="autokUpdatePage.php">
				  <input type="hidden" name="telepid" value="'. $row["telepid"] .'" />
				  <input type="hidden" name="alvazszam" value="'. $row["alvazszam"] .'" />
				  <input type="hidden" name="marka" value="'. $row["marka"] .'" />
				  <input type="hidden" name="modell" value="'. $row["modell"] .'" />
				  <input type="hidden" name="uzemanyag" value="'. $row["uzemanyag"] .'" />
				  <input type="hidden" name="teljesitmeny" value="'. $row["teljesitmeny"] .'" />
				  <input type="hidden" name="szin" value="'. $row["szin"] .'" />
				  <input type="hidden" name="ar" value="'. $row["ar"] .'" />
				  <input type="submit" value="Szerkeszt" class="gomb1"/>
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