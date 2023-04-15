<?php

include_once("../common/dbFunctions.php");

$ugyfelIgszam = $_POST['igszam'];
$ugyfelNev = $_POST['nev'];
$ugyfelFelhasznalonev = $_POST['felhasznalonev'];
$ugyfelJelszo = $_POST['jelszo'];

if ( isset($ugyfelIgszam) && isset($ugyfelNev) && isset($ugyfelFelhasznalonev) && isset($ugyfelJelszo)) {

    $sikeres=insertUgyfel($ugyfelIgszam,$ugyfelNev,$ugyfelFelhasznalonev,password_hash($ugyfelJelszo, PASSWORD_DEFAULT));
    if ($sikeres==true){
        header("Location: ../ugyfel.php");
    }

} else {
    error_log("Nem lett kitöltve a mező!");

}
?>