<?php
include_once('../common/dbfunctions.php');

$telepID = $_POST["telepID"];
$telepVaros = $_POST["telepVaros"];
$telepNev = $_POST["telepNev"];


if ( isset($telepID) && isset($telepVaros) && isset($telepNev)) {

    updateTelephely($telepID, $telepVaros, $telepNev);

    header("Location: ../telephely.php");

} else {
    error_log("Nem lett kitöltve a mező!");

}
?>