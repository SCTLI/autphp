<?php
include_once('navigation.php');
include_once('dbfunctions.php');
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Eladok tabla</title>
    <link rel="stylesheet" type="text/css" href="alap.css">
    <link rel="icon" href="icon.png" type="image/icon">
    <meta charset="utf-8" />
</head>
<body>
<?php echo navigation();?>

e<h2>Eladók </h2>
<table border="0">
    <tr>
        <th>Igazolvány szám</th>
        <th>Név</th>
        <th>Felhasználónév</th>
    </tr>
    <?php
    $stid = getEladoList();
    oci_execute($stid);

while ( $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
    echo '<tr>';
    echo '<td>'.$row['Igazolvány szám'].'</td>';
    echo '<td>'.$row['Név'].'</td>';
    echo '<td>'.$row['Felhasználónév'].'</td>';
    echo '</tr>';
}
echo '</table>';
?>
<footer>
    <p>&copy;Ami jog van az fent van tartva:)</p>
</footer>
</body>
</html>