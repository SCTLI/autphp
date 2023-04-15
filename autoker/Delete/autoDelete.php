<?php

include_once("../common/dbFunctions.php");

$delete = $_POST["szerelDelete"];

if ( isset($delete) ) {
    $sikeres = deleteAuto($delete);

    if ( $sikeres ) {
        header('Location: ../auto.php');
    } else {
        echo 'Hiba! Nem sikerült az autó törlése!';
    }
} else {
    echo 'Hiba! Nem sikerült az autó törlése!';

}

?>
