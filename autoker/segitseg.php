<html>
<head>
    <link rel=stylesheet type="text/css" href="mystyle.css" />
</head>
<body>
<?php

$tns = "
(DESCRIPTION =
    (ADDRESS_LIST =
      (ADDRESS = (PROTOCOL = TCP)(HOST = orania2.inf.u-szeged.hu)(PORT = 1521))
    )
    (CONNECT_DATA =
      (SID = orania2)
    )
  )";
 
$conn = oci_connect('hr', 'hr', $tns,'UTF8');

echo '<h2>Az Employees tábla adatai: </h2>';
echo '<table border="0">';


//// -- lekerdezzuk a tabla tartalmat
$stid = oci_parse($conn, 'SELECT * FROM Employees');

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