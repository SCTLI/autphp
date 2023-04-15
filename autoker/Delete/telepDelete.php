<?php

include_once('../dbfunctions.php');

$delete = $_POST["telepDelete"];

if ( isset($delete) ) {
    $sikeres = deleteTelephely($delete);

    if ( $sikeres ) {
        header('Location: ../telephely.php');
    } else {
        echo 'Hiba! Nem sikerült a telephely törlése!';
    }
} else {
    echo 'Hiba! Nem sikerült a telephely törlése!';

}

?>
