<?php

include_once("../common/dbFunctions.php");

$autoAlvazszam = $_POST['alvazszam'];
$uzletID = $_POST['uzletid'];
$ugyfelIgazolvanyszam = $_POST['igszam'];

if ( isset($autoAlvazszam) && isset($uzletID) && isset($ugyfelIgazolvanyszam)) {

    $sikeres=insertVasarol($autoAlvazszam,$uzletID,$ugyfelIgazolvanyszam);
    if ($sikeres==true){
        header("Location: ../autok.php");
    }

} else {
    error_log("Nem lett kitöltve a mező!");

}
?>