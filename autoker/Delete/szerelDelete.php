<?php

include_once("../common/dbFunctions.php");

$delete1 = $_POST["szerelAlvazszamDelete"];
$delete2 = $_POST["szerelIdoDelete"];

if ( isset($delete1) && isset($delete2) ) {
    $sikeres = deleteSzerel($delete1,$delete2);

    if ( $sikeres ) {
        header('Location: ../szerel.php');
    } else {
        echo 'Hiba! Nem sikerült a ';
    }
} else {
    echo 'Hiba! Nem sikerült a szerelés törlése!';

}

?>
