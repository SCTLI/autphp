<?php
include_once('common/navigation.php');
include_once('common/dbfunctions.php');
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Telephelyek tabla</title>
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
<h2>Új Telephely felvitele az adatbázisba</h2>
<p class="kozepre">Ahoz, hogy egy új telephelyet vigyen fel az adatbázisba kérem töltse ki az alábbi űrlapot.(minden mező kitöltése kötelező)</p>
<form method="POST" action="Insert/telepInsert.php" accept-charset="utf-8">
    <label>Telephely Városa:</label>
    <input type="text" name="varos" placeholder="Kiskunmajsa">
    <br />
    <label>Telephely Neve:</label>
    <input type="text" name="nev" placeholder="Kismajkaker">
    <br />
    <input type="submit" value="Feltöltés">
</form>
<h2>Telephelyek</h2>
<table border="0">
    <tr>
        <th>Neve</th>
        <th>Városa</th>
        <th>Autók száma</th>
        <th></th>
    </tr>
    <?php
    $stid = getTelephelyList();
    oci_execute($stid);

while ( $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
    echo '<tr>';
    echo '<td>'.$row['nev'].'</td>';
    echo '<td>'.$row['varos'].'</td>';
    echo '<td>'.CountAutokInTelephely($row["telepid"]).'</td>';
    echo '<td><form method="POST" action="Delete/telepDelete.php">
				  <input type="hidden" name="telepDelete" value="'. $row["telepid"] .'" />
				  <input type="submit" value="Törlés" class="gomb2"/>
		          </form></td>';
    echo '<td style="text-align: center" class="lista"><form method="POST" action="telephelyUpdatePage.php">
				  <input type="hidden" name="varos" value="'. $row["varos"] .'" />
				  <input type="hidden" name="nev" value="'. $row["nev"] .'" />
				  <input type="hidden" name="telepid" value="'. $row["telepid"] .'" />
				  <input type="submit" value="Szerkeszt" class="gomb1"/>
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