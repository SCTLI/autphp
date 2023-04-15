<?php

include_once("../common/dbFunctions.php");

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
