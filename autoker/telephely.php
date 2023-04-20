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
    <meta charset="utf-8" />
</head>
<body>
<?php echo navigation();?>
<h2>Új Telephely felvitele az adatbázisba</h2>
<span class="kozepre">Ahoz, hogy egy új telephelyet vigyen fel az adatbázisba kérem töltse ki az alábbi űrlapot.(minden mező kitöltése kötelező)</span>
<form method="POST" action="Insert/telepInsert.php" accept-charset="utf-8">
    <label>Telephely Városa:</label>
    <input type="number" name="varos" placeholder="Kiskunmajsa">
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
    </tr>
    <?php
    $stid = getTelephelyList();
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