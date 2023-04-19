<?php
include_once('../common/dbfunctions.php');

$eladoIgszam= $_POST["eladoIgszam"];
$uzletID = $_POST["telepid"];

if ( isset($uzletID) && isset($eladoIgszam)) {

    updateAutok($eladoIgszam, $uzletID);

    header("Location: ../elado.php");

} else {
    error_log("Nem lett kitöltve a mező!");

}
?>