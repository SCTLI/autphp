<?php

include_once('../dbfunctions.php');

$delete = $_POST["autoDelete"];

if ( isset($delete) ) {

    header('Location: ../autok.php');

} else {
    echo 'Hiba! Nem sikerült az áruó';

}

?>
