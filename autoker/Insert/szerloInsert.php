<?php

include_once("../common/dbFunctions.php");

$szereloIgszam = $_POST['igszam'];
$szereloNev = $_POST['nev'];
$szereloFelhasznalonev = $_POST['felhasznalonev'];
$szereloJelszo = $_POST['jelszo'];

if ( isset($szereloIgszam) && isset($szereloNev) && isset($szereloFelhasznalonev) && isset($szereloJelszo)) {

    $sikeres=insertSzerelo($szereloIgszam,$szereloNev,$szereloFelhasznalonev,password_hash($szereloJelszo, PASSWORD_DEFAULT));
    if ($sikeres==true){
        header("Location: ../szerelo.php");
    }

} else {
    error_log("Nem lett kitöltve a mező!");

}
?>