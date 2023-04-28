<?php
include_once('common/dbfunctions.php');
$felhasz = $_POST['felh'];
$jelsz = $_POST['jel'];
session_start();

$_SESSION["felhasz"] = $_POST['felh'];
$_SESSION["jelsz"] = $_POST['jel'];

$siker = dbConnect($felhasz,$jelsz);
if($siker){
    header("Location: index.php");
}else{
    echo("NEM JÓ");
}
?>