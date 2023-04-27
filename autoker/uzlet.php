<?php
include_once('common/navigation.php');
include_once('common/dbfunctions.php');
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Uzletek tabla</title>
    <link rel="stylesheet" type="text/css" href="css/alap.css">
    <link rel="icon" href="image/icon.png" type="image/icon">
    <meta charset="utf-8" />
</head>
<body>
<?php echo navigation();?>
<h2>Új Üzlet felvitele az adatbázisba</h2>
<span class="kozepre">Ahoz, hogy egy új üzletet vigyen fel az adatbázisba kérem töltse ki az alábbi űrlapot.(minden mező kitöltése kötelező)</span>
<form method="POST" action="Insert/uzletInsert.php" accept-charset="utf-8">
    <label>Üzlet Városa:</label>
    <input type="text" name="varos" placeholder="Tázlár">
    <br />
    <label>Üzlet Neve:</label>
    <input type="text" name="nev" placeholder="Árazva">
    <br />
    <input type="submit" value="Feltöltés">
</form>
<h2>Üzletek </h2>
<table border="0">
    <tr>
        <th>Neve</th>
        <th>Városa</th>
        <th></th>
    </tr>
    <?php
    $stid = getUzletList();
    oci_execute($stid);

while ( $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
    echo '<tr>';
    echo '<td>'.$row['nev'].'</td>';
    echo '<td>'.$row['varos'].'</td>';
    echo '<td><form method="POST" action="Delete/uzletDelete.php">
				  <input type="hidden" name="uzletDelete" value="'. $row["uzletid"] .'" />
				  <input type="submit" value="Törlés" />
		          </form></td>';
    echo '<td style="text-align: center" class="lista"><form method="POST" action="uzletUpdatePage.php">
				  <input type="hidden" name="varos" value="'. $row["varos"] .'" />
				  <input type="hidden" name="nev" value="'. $row["nev"] .'" />
				  <input type="hidden" name="uzletid" value="'. $row["uzletid"] .'" />
				  <input type="submit" value="Szerkeszt" />
		          </form></td>';
    echo '</tr>';
    echo '</tr>';
}
echo '</table>';
?>

    <?php
    include_once "common/footer.php";
    ?>
</body>
</html>