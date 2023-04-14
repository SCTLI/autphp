<?php

include_once('../dbFunctions.php');

$delete = $_POST["autoDelete"];

if ( isset($delete) ) {

    header('Location: ../autok.php');

} else {
    echo 'Hiba! Nem sikerült az áruó';

}

?>
