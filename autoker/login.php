<?php
session_start();
$felhasz = $_POST['felh'];
$jelsz = $_POST['jel'];

if (FelhasznalonevVan($felhasz) ==1){
    $_SESSION["felhasz"] = $_POST['felh'];
    $_SESSION["jelsz"] = $_POST['jel'];
    header("Location: index.php");
}else{
    header("Location: bejelentkezes.php");

}




?>