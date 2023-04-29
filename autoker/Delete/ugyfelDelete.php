<?php

include_once("../common/dbFunctions.php");

$delete1 = $_POST["ugyfelDelete"];
$delete2 = $_POST["ugyfelFelhasznolev"];

if ( isset($delete1) && isset($delete2) ) {
    $sikeres = deleteUgyfel($delete1,$delete2);

    if ( $sikeres ) {
        header('Location: ../ugyfel.php');
    } else {
        echo 'Hiba! Nem sikerült az ugyfel törlése!';
    }
} else {
    echo 'Hiba! Nem sikerült az ugyfel törlése!';

}

?>
