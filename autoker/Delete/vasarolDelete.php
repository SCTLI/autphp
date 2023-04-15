<?php

include_once('../dbfunctions.php');

$delete = $_POST["vasarolDelete"];

if ( isset($delete) ) {
    $sikeres = deleteVasarol($delete);

    if ( $sikeres ) {
        header('Location: ../vasarol.php');
    } else {
        echo 'Hiba! Nem sikerült a vasarlas törlése!';
    }
} else {
    echo 'Hiba! Nem sikerült a vasarlas törlése!';

}

?>
