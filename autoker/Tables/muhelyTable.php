<html>
<head>

</head>
<body>
<?php
$conn = oci_connect('C##admin', 'admin123', "localhost/XE",'UTF8');

echo '<h2>Műhelyek</h2>';
echo '<table border="0">';


//// -- lekerdezzuk a tabla tartalmat
$stid = oci_parse($conn, 'SELECT * FROM Muhely');

oci_execute($stid);

//// -- eloszor csak az oszlopneveket kerem le
$nfields = oci_num_fields($stid);
echo '<tr>';
for ($i = 1; $i<=$nfields; $i++){
    $field = oci_field_name($stid, $i);
    echo '<td>' . $field . '</td>';
}
echo '</tr>';

//// -- ujra vegrehajtom a lekerdezest, es kiiratom a sorokat
oci_execute($stid);

while ( $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
    echo '<tr>';
    foreach ($row as $item) {
        echo '<td>' . $item . '</td>';
    }
    echo '</tr>';
}
echo '</table>';

oci_close($conn);


?>
</body>
</html>