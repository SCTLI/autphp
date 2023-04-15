<?php

include_once("../common/dbFunctions.php");

$autoAlvazszam = $_POST['alvazszam'];
$szerelIdopont = $_POST['idopont'];
$muhelyID = $_POST['muhelyid'];
$szerelSzereltAlkatresz= $_POST['alkatresz'];

if ( isset($autoAlvazszam) && isset($szerelIdopont) && isset($muhelyID) && isset($szerelSzereltAlkatresz)) {

    $sikeres=insertSzerel($autoAlvazszam,$szerelIdopont,$muhelyID,$szerelSzereltAlkatresz);
    if ($sikeres==true){
        header("Location: ../szerel.php");
    }

} else {
    error_log("Nem lett kitöltve a mező!");

}
?>