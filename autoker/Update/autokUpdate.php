<?php
include_once('../common/dbfunctions.php');

$autoAlvazszam = $_POST["autoAlvazszam"];
$telepID = $_POST["telepID"];
$autoTeljesitmeny = $_POST["autoTeljesitmeny"];
$autoSzin = $_POST["autoSzin"];
$autoAr = $_POST["autoAr"];

if ( isset($autoAlvazszam) && isset($telepID) && isset($autoTeljesitmeny) && isset($autoSzin) && isset($autoAr)) {

    $siker = updateAutok($autoAlvazszam, $telepID, $autoTeljesitmeny, $autoSzin, $autoAr);
    if($siker == true){
        header("Location: ../autok.php");
    }


} else {
    error_log("Nem lett kitöltve a mező!");

}
?>