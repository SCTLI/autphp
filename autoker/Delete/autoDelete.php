<?php

include_once('../dbfunctions.php');

$delete = $_POST["szerelDelete"];

if ( isset($delete) ) {
    $sikeres = deleteSzerel($delete);

    if ( $sikeres ) {
        header('Location: ../auto.php');
    } else {
        echo 'Hiba! Nem sikerült az autó törlése!';
    }
} else {
    echo 'Hiba! Nem sikerült az autó törlése!';

}

?>
