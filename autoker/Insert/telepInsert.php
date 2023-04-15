<?php

include_once("../common/dbFunctions.php");

$telepVaros = $_POST['varos'];
$telepNev = $_POST['nev'];

if ( isset($telepNev) && isset($telepVaros)) {

    $sikeres=inserttelephely($telepVaros,$telepNev);
    if ($sikeres==true){
        header("Location: ../telephely.php");
    }

} else {
    error_log("Nem lett kitöltve a mező!");

}
?>