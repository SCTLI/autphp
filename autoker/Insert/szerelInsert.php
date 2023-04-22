<?php

include_once("../common/dbFunctions.php");

$autoAlvazszam = $_POST['alvazszam'];
$muhelyID = $_POST['muhelyid'];
$szerelSzereltAlkatresz= $_POST['alkatresz'];

if ( isset($autoAlvazszam) && isset($muhelyID) && isset($szerelSzereltAlkatresz)) {

    $sikeres=insertSzerel($autoAlvazszam,$muhelyID,$szerelSzereltAlkatresz);
    if ($sikeres==true){
        header("Location: ../szerel.php");
    }

} else {
    error_log("Nem lett kitöltve a mező!");

}
?>