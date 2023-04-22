<?php
include_once('../common/dbfunctions.php');

$UgyfelIgszam = $_POST["ugyfeligszam"];
$UgyfelNev =$_POST["ugyfelnev"];
$Felhasznalonev =$_POST["ugyfelfelhanev"];
$Jelszo =$_POST["ugyfeljel"];

if ( isset($UgyfelIgszam) && isset($UgyfelNev)&& isset($Felhasznalonev)&& isset($Jelszo)) {

    updateUgyfel($UgyfelIgszam,$UgyfelNev, $Felhasznalonev, password_hash($Jelszo, PASSWORD_DEFAULT));

    header("Location: ../ugyfel.php");

} else {
    error_log("Nem lett kitöltve minden mező!");

}
?>