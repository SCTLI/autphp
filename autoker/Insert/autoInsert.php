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
    if(Lekapar($autoAlvazszam)==0){
        $sikeres=insertAutok($telepID,$autoMarka,$autoUzemanyag,$autoModell,$autoTeljesitmeny,$autoSzin,$autoAr,$autoAlvazszam);
    }else{
        header("Location: ../autok.php");
    }
if ($sikeres==true){
    header("Location: ../autok.php");
}

} else {
    error_log("Nem lett kitöltve a mező!");

}
?>