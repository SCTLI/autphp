<?php

include_once("../common/dbFunctions.php");


$igszam = $_POST['igszam'];
$nev = $_POST['nev'];
$felhasznalonev = $_POST['felhasznalonev'];
$jelszo = $_POST['jelszo'];
$szerepkor = $_POST['szerepkor'];

if (felhasznalonevVan($felhasznalonev)==0){

if ($szerepkor='elado'){
    if ( isset($igszam) && isset($nev) && isset($felhasznalonev) && isset($jelszo)) {
        $eladofel = eladoletre($felhasznalonev, $jelszo);
        $sikeres=insertElado($igszam,$nev,$felhasznalonev,password_hash($jelszo, PASSWORD_DEFAULT));
        if ($sikeres==true && $eladofel == true){
            header("Location: ../index.php");
        }
    } else {
        error_log("Nem lett kitöltve a mező!");
    }
} elseif ($szerepkor='szerelo'){
    if ( isset($igszam) && isset($nev) && isset($felhasznalonev) && isset($jelszo)) {

        $sikeres=insertSzerelo($igszam,$nev,$felhasznalonev,password_hash($jelszo, PASSWORD_DEFAULT));
        if ($sikeres==true){
            header("Location: ../index.php");
        }
    } else {
        error_log("Nem lett kitöltve a mező!");
    }
} else {
    if (isset($igszam) && isset($nev) && isset($felhasznalonev) && isset($jelszo)) {

        $sikeres = insertUgyfel($igszam, $nev, $felhasznalonev, password_hash($jelszo, PASSWORD_DEFAULT));
        if ($sikeres == true) {
            header("Location: ../index.php");
        }
    } else {
        error_log("Nem lett kitöltve a mező!");
    }
}
}else{
    error_log("A felhasználónév máe foglalt");
}