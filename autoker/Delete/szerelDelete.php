<?php

include_once('../dbfunctions.php');

$delete = $_POST["autoDelete"];

if ( isset($delete) ) {
    $sikeres = deleteAru($delete);

    if ( $sikeres ) {
        header('Location: ../auto.php');
    } else {
        echo 'Hiba! Nem sikerült az autó törlése!';
    }
} else {
    echo 'Hiba! Nem sikerült az autó törlése!';

}

?>
