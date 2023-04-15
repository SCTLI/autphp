<?php

include_once("../common/dbFunctions.php");

$muhelyVaros = $_POST['varos'];
$muhelyNev = $_POST['nev'];

if ( isset($muhelyVaros) && isset($muhelyNev)) {

    $sikeres=insertMuhely($muhelyVaros,$muhelyNev);
    if ($sikeres==true){
        header("Location: ../muhely.php");
    }

} else {
    error_log("Nem lett kitöltve a mező!");

}
?>