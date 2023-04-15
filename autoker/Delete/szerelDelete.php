<?php

include_once('../dbfunctions.php');

$delete1 = $_POST["szerelAlvazszamDelete"];
$delete2 = $_POST["szerelIdoDelete"];

if ( isset($delete) ) {
    $sikeres = deleteSzerel($delete1,$delete2);

    if ( $sikeres ) {
        header('Location: ../szerel.php');
    } else {
        echo 'Hiba! Nem sikerült a szerelés törlése!';
    }
} else {
    echo 'Hiba! Nem sikerült a szerelés törlése!';

}

?>
