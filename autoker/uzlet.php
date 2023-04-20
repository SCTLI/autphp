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
    <input type="number" name="varos" placeholder="Tázlár">
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
    </tr>
    <?php
    $stid = getUzletList();
    oci_execute($stid);

while ( $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
    echo '<tr>';
    echo '<td>'.$row['nev'].'</td>';
    echo '<td>'.$row['varos'].'</td>';
    echo '</tr>';
}
echo '</table>';
?>

    <?php
    include_once "common/footer.php";
    ?>
</body>
</html>