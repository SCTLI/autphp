<?php
include_once('../common/dbfunctions.php');

$szereloIgszam= $_POST["szereloIgszam"];
$muhelyID = $_POST["muhelyID"];

if ( isset($muhelyID) && isset($szereloIgszam)) {

    updateSzerelo($szereloIgszam, $muhelyID);

    header("Location: ../szerelo.php");

} else {
    error_log("Nem lett kitöltve a mező!");

}
?>