<?php

include_once('../dbfunctions.php');

$delete = $_POST["ugyfelDelete"];

if ( isset($delete) ) {
    $sikeres = deleteUgyfel($delete);

    if ( $sikeres ) {
        header('Location: ../ugyfel.php');
    } else {
        echo 'Hiba! Nem sikerült az ugyfel törlése!';
    }
} else {
    echo 'Hiba! Nem sikerült az ugyfel törlése!';

}

?>
