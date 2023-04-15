<?php
include_once('common/navigation.php');
include_once('common/dbfunctions.php');
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Telephelyek tabla</title>
    <link rel="stylesheet" type="text/css" href="alap.css">
    <link rel="icon" href="icon.png" type="image/icon">
    <meta charset="utf-8" />
</head>
<body>
<?php echo navigation();?>

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
    echo '<td>'.$row['Neve'].'</td>';
    echo '<td>'.$row['Városa'].'</td>';
    echo '</tr>';
}
?>
</table>

<?php
include_once "common/footer.php";
?>
</body>
</html>