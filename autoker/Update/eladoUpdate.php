<?php
include_once('../common/dbfunctions.php');

$eladoIgszam= $_POST["eladoIgszam"];
$uzletID = $_POST["uzletID"];

if ( isset($uzletID) && isset($eladoIgszam)) {

    $siker = updateElado($eladoIgszam, $uzletID);
    if($siker == true){
        header("Location: ../elado.php");
    }


} else {
    error_log("Nem lett kitöltve a mező!");

}
?>