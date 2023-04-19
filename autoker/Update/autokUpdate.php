<?php
include_once('../common/dbfunctions.php');

$autoAlvazszam = $_POST["autoAlvazszam"];
$telepID = $_POST["telepid"];
$autoTeljesitmeny = $_POST["autoTeljesitmeny"];
$autoSzin = $_POST["autoSzin"];
$autoAr = $_POST["autoAr"];

if ( isset($autoAlvazszam) && isset($telepID) && isset($autoTeljesitmeny) && isset($autoSzin) && isset($autoAr)) {

    updateAutok($autoAlvazszam, $telepID, $autoTeljesitmeny, $autoSzin, $autoAr);

    header("Location: ../autok.php");

} else {
    error_log("Nem lett kitöltve a mező!");

}
?>