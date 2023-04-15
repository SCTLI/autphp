<?php

include_once("../common/dbFunctions.php");

$uzletNev = $_POST['nev'];
$uzletVaros = $_POST['varos'];

if (isset($uzletNev) && isset($uzletVaros)) {

    $sikeres=insertUzlet($uzletNev,$uzletVaros);
    if ($sikeres==true){
        header("Location: ../uzlet.php");
    }

} else {
    error_log("Nem lett kitöltve a mező!");

}
?>