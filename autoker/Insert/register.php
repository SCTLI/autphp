<?php

include_once("../common/dbFunctions.php");


$igszam = $_POST['igszam'];
$nev = $_POST['nev'];
$felhasznalonev = $_POST['felhasznalonev'];
$jelszo = $_POST['jelszo'];
$szerepkor = $_POST['szerepkor'];

if (felhasznalonevVan($felhasznalonev)==0 && $felhasznalonev!="vezeto" && strlen($igszam)==8 && kivagyte($igszam)==0){

if ($szerepkor=='elado'){
    if ( isset($igszam) && isset($nev) && isset($felhasznalonev) && isset($jelszo)) {
        $eladofel = eladoletre($felhasznalonev, $jelszo);
        $sikeres=insertElado($igszam,$nev,$felhasznalonev,password_hash($jelszo, PASSWORD_DEFAULT));
        if ($sikeres==true && $eladofel == true){
            header("Location: ../index.php");
        }
    } else {
        error_log("Nem lett kitöltve a mező!");
    }
} elseif ($szerepkor=='szerelo'){
    if ( isset($igszam) && isset($nev) && isset($felhasznalonev) && isset($jelszo)) {
        $szerelofel = szereloletre($felhasznalonev, $jelszo);
        $sikeres=insertSzerelo($igszam,$nev,$felhasznalonev,password_hash($jelszo, PASSWORD_DEFAULT));
        if ($sikeres==true && $szerelofel==true){
            header("Location: ../index.php");
        }
    } else {
        error_log("Nem lett kitöltve a mező!");
    }
} elseif ($szerepkor=='ugyfel') {
    if (isset($igszam) && isset($nev) && isset($felhasznalonev) && isset($jelszo)) {
        $ugyfelfel = ugyfelletre($felhasznalonev, $jelszo);
        $sikeres = insertUgyfel($igszam, $nev, $felhasznalonev, password_hash($jelszo, PASSWORD_DEFAULT));
        if ($sikeres == true && $ugyfelfel==true) {
            header("Location: ../index.php");
        }
    } else {
        error_log("Nem lett kitöltve a mező!");
    }
}
}else{
    header("Location: ../regisztracio.php");

}