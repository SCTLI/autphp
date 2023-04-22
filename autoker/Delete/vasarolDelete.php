<?php

include_once('../common/dbfunctions.php');

$vasarolAlvazszam = $_POST["vasarolDeleteAlvazszam"];
$uzletID = $_POST["vasarolDeleteUzletID"];
$ugyfelIgsz = $_POST["vasarolDeleteUgyfeligsz"];

if ( isset($vasarolAlvazszam) && isset($uzletID) && isset($ugyfelIgsz) ){
    $sikeres = deleteVasarol($vasarolAlvazszam,$uzletID,$ugyfelIgsz);

    if ( $sikeres ) {
        header('Location: ../vasarol.php');
    } else {
        echo 'Hiba! Nem sikerült a vasarlas ';
    }
} else {
    echo 'Hiba! Nem sikerült a vasarlas törlése!';

}

?>
