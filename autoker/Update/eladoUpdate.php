<?php
include_once('../common/dbfunctions.php');

$eladoIgszam= $_POST["eladoIgszam"];
$uzletID = $_POST["uzletID"];

if ( isset($uzletID) && isset($eladoIgszam)) {

    updateElado($eladoIgszam, $uzletID);

    header("Location: ../elado.php");

} else {
    error_log("Nem lett kitöltve a mező!");

}
?>