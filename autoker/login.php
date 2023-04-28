<?php

$felhasz = $_POST['felh'];
$jelsz = $_POST['jel'];

$siker = dbConnectt($felhasz,$jelsz);
if($siker){
    header("Location: index.php");
}else{
    echo("NEM JÓ");
}
function dbConnectt($felh, $jel){
    $conn = oci_connect($felh, $jel, "localhost/XE",'UTF8') or die("HIBA! Nem sikerült csaltakozni az adatbázishoz!");
    return $conn;
}
?>