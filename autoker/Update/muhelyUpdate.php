<?php
include_once('../common/dbfunctions.php');

$muhelyID = $_POST["muhelyID"];
$muhelyVaros = $_POST["muhelyVaros"];
$muhelyNev = $_POST["muhelyNev"];


if ( isset($muhelyID) && isset($muhelyVaros) && isset($muhelyNev)) {

    $siker = updateMuhely($muhelyID, $muhelyVaros, $muhelyNev);
    if($siker == true){
        header("Location: ../muhely.php");
    }


} else {
    error_log("Nem lett kitöltve a mező!");

}
?>