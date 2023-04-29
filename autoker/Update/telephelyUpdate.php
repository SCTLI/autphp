<?php
include_once('../common/dbfunctions.php');

$telepID = $_POST["telepID"];
$telepVaros = $_POST["telepVaros"];
$telepNev = $_POST["telepNev"];


if ( isset($telepID) && isset($telepVaros) && isset($telepNev)) {

    $siker = updateTelephely($telepID, $telepVaros, $telepNev);
    if($siker == true){
        header("Location: ../telephely.php");
    }


} else {
    error_log("Nem lett kitöltve a mező!");

}
?>