<?php

include_once("../common/dbFunctions.php");

$autoAlvazszam = $_POST['alvazszam'];
$autoMarka = $_POST['marka'];
$autoModell = $_POST['modell'];
$autoTeljesitmeny = $_POST['teljesitmeny'];
$autoSzin = $_POST['szin'];
$autoUzemanyag = $_POST['uzemanyag'];
$telepID = $_POST['telephelyid'];
$autoAr = $_POST['ar'];

if ( isset($autoAlvazszam) && isset($autoMarka) && isset($autoModell) && isset($autoTeljesitmeny) && isset($autoSzin) && isset($autoUzemanyag) && isset($telepID) && isset($autoAr)) {

    $sikeres=insertAutok($telepID,$autoMarka,$autoUzemanyag,$autoModell,$autoTeljesitmeny,$autoSzin,$autoAr,$autoAlvazszam);
if ($sikeres==true){
    header("Location: ../autok.php");
}else{
    echo $autoAlvazszam;
    echo $autoMarka;
    echo $autoModell;
    echo $autoTeljesitmeny;
    echo $autoSzin;
    echo $autoUzemanyag;
    echo $telepID;
    echo $autoAr;
}


} else {
    error_log("Nem lett kitöltve a mező!");

}
?>