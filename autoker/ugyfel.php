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
<h2>Új Ügyfél felvitele az adatbázisba</h2>
<span class="kozepre">Ahoz, hogy egy új ügyfelet vigyen fel az adatbázisba kérem töltse ki az alábbi űrlapot.(minden mező kitöltése kötelező)</span>
<form method="POST" action="Insert/ugyfelInsert.php" accept-charset="utf-8">
    <label>Ügyfél Igazolvány szám:</label>
    <input type="number" name="igszam" placeholder="123456">
    <br />
    <label>Ügyfél teljes neve:</label>
    <input type="text" name="nev" placeholder="Kátai Alex György">
    <br />
    <label>Ügyfél Felhasználó neve:</label>
    <input type="text" name="felhasznalonev" placeholder="gyuriba">
    <br />
    <label>Ügyfél Jelszava:</label>
    <input type="text" name="jelszo" placeholder="Semmi123">
    <br />
    <input type="submit" value="Feltöltés">
</form>
<h2>Ügyfelek </h2>
<table border="0">
    <tr>
        <th>Igazolvány szám</th>
        <th>Név</th>
        <th>Felhasználónév</th>
        <th></th>
    </tr>
    <?php
    $stid = getUgyfelList();
    oci_execute($stid);

    while ( $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
        echo '<tr>';
        echo '<td>'.$row['igsz'].'</td>';
        echo '<td>'.$row['nev'].'</td>';
        echo '<td>'.$row['felhasznalonev'].'</td>';
        echo '<td><form method="POST" action="Delete/ugyfelDelete.php">
				  <input type="hidden" name="ugyfelDelete" value="'. $row["igsz"] .'" />
				  <input type="submit" value="Törlés" />
		          </form></td>';
        echo '<td style="text-align: center" class="lista"><form method="POST" action="ugyfelUpdatePage.php">
				  <input type="hidden" name="ugyfeligszam" value="'. $row["igsz"] .'" />
				  <input type="hidden" name="ugyfelneve" value="'. $row["nev"] .'" />
				  <input type="hidden" name="ugyfelfelhnev" value="'. $row["felhasznalonev"] .'" />
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