<?php
include_once ("common/dbfunctions.php");
session_start();
$felhasz = $_POST['felh'];
$jelsz = $_POST['jel'];

if (FelhasznalonevVan($felhasz) !=''  || ($felhasz == "vezeto" && $jelsz="vezeto")){
    $_SESSION["felhasz"] = $_POST['felh'];
    $_SESSION["jelsz"] = $_POST['jel'];
    header("Location: index.php");
}else{
}

?>