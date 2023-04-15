<?php

include_once("../common/dbFunctions.php");

$delete = $_POST["szereloDelete"];

if ( isset($delete) ) {
    $sikeres = deleteSzerelo($delete);

    if ( $sikeres ) {
        header('Location: ../szerelo.php');
    } else {
        echo 'Hiba! Nem sikerült a szerelo törlése!';
    }
} else {
    echo 'Hiba! Nem sikerült a szerelo törlése!';

}

?>
