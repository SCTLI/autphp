<?php
include_once('../common/dbfunctions.php');

$UgyfelIgszam = $_POST["ugyfelIgszam"];
$UgyfelNev =$_POST["ugyfelnev"];
$Felhasznalonev =$_POST["felh"];
$Jelszo =$_POST["jel"];

if ( isset($UgyfelIgszam) && isset($UgyfelNev)&& isset($Felhasznalonev)&& isset($Jelszo)) {

    updateUgyfel($UgyfelIgszam,$UgyfelNev, $Felhasznalonev, $Jelszo);

    header("Location: ../ugyfel.php");

} else {
    error_log("Nem lett kitöltve minden mező!");

}
?>