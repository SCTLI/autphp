<?php
include_once('../common/dbfunctions.php');

$uzletID = $_POST["uzletID"];
$uzletVaros = $_POST["uzletVaros"];
$uzletNev = $_POST["uzletNev"];


if ( isset($uzletID) && isset($uzletVaros) && isset($uzletNev)) {

    updateTelephely($uzletID,  $uzletNev, $uzletVaros);

    header("Location: ../uzlet.php");

} else {
    error_log("Nem lett kitöltve a mező!");

}
?>