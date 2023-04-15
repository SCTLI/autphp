<?php

include_once('../dbfunctions.php');

$delete = $_POST["muhelyDelete"];

if ( isset($delete) ) {
    $sikeres = deleteMuhely($delete);

    if ( $sikeres ) {
        header('Location: ../muhely.php');
    } else {
        echo 'Hiba! Nem sikerült az muhely törlése!';
    }
} else {
    echo 'Hiba! Nem sikerült az muhely törlése!';

}

?>
