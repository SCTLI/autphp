<?php

include_once("../common/dbFunctions.php");

$eladoIgszam = $_POST['igszam'];
$eladoNev = $_POST['nev'];
$eladoFelhasznalonev = $_POST['felhasznalonev'];
$eladoJelszo = $_POST['jelszo'];

if ( isset($eladoIgszam) && isset($eladoNev) && isset($eladoFelhasznalonev) && isset($eladoJelszo)) {

    $sikeres=insertElado($eladoIgszam,$eladoNev,$eladoFelhasznalonev,password_hash($eladoJelszo, PASSWORD_DEFAULT));
    if ($sikeres==true){
        header("Location: ../elado.php");
    }

} else {
    error_log("Nem lett kitöltve a mező!");

}
?>