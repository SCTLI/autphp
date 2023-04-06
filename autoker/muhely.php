<html>
<head>
    <title>Muhelyek tabla</title>
    <link rel="stylesheet" type="text/css" href="alap.css">
    <link rel="icon" href="icon.png" type="image/icon">
    <meta charset="utf-8" />
</head>
<body>
<nav>
    <ul>
        <li><a href="index.php">Kezdő Oldal</a></li>
        <li><a href="autok.php">Autók tábla</a></li>
        <li><a href="telephely.php">Telephelyek tábla</a></li>
        <li><a href="elado.php">Eladók tábla</a></li>
        <li><a href="muhely.php">Műhelyek tábla</a></li>
        <li><a href="uzlet.php">Üzletek tábla</a></li>
        <!--<li><a href="szerelo.php">Szerelők tábla</a></li> -->
        <!--<li><a href="ugyfel.php">Ügyfelek tábla</a></li> -->
        <!--<li><a href="vasarlasok.php">Vásárlások tábla</a></li> -->
        <!--<li><a href="szerelesek.php">Szerelések tábla</a></li> -->
    </ul>
</nav>
<?php
$conn = oci_connect('C##admin', 'admin123', "localhost/XE",'UTF8');

echo '<h2>Műhelyek</h2>';
echo '<table border="0">';


//// -- lekerdezzuk a tabla tartalmat
$stid = oci_parse($conn, 'SELECT muhely_nev AS "Neve", muhely_varos AS "Városa" FROM Muhely');

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
<footer>
    <p>&copy;Ami jog van az fent van tartva:)</p>
</footer>
</body>
</html>