<?php

include_once('../dbfunctions.php');

$delete = $_POST["eladoDelete"];

if ( isset($delete) ) {
    $sikeres = deleteElado($delete);

    if ( $sikeres ) {
        header('Location: ../elado.php');
    } else {
        echo 'Hiba! Nem sikerült az elado törlése!';
    }
} else {
    echo 'Hiba! Nem sikerült az elado törlése!';

}

?>
