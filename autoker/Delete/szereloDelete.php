<?php

include_once("../common/dbFunctions.php");

$delete = $_POST["szereloDelete"];
$delete2 = $_POST["szereloFelhasznalonev"];

if ( isset($delete) && isset($delete2) ) {
    $sikeres = deleteSzerelo($delete,$delete2);

    if ( $sikeres ) {
        header('Location: ../szerelo.php');
    } else {
        echo 'Hiba! Nem sikerült a szerelo törlése!';
    }
} else {
    echo 'Hiba! Nem sikerült a szerelo törlése!';

}

?>
