<?php

include_once('../dbfunctions.php');

$delete = $_POST["uzletDelete"];

if ( isset($delete) ) {
    $sikeres = deleteUzlet($delete);

    if ( $sikeres ) {
        header('Location: ../uzlet.php');
    } else {
        echo 'Hiba! Nem sikerült az uzlet törlése!';
    }
} else {
    echo 'Hiba! Nem sikerült az uzlet törlése!';

}

?>
