<?php

include_once("../common/dbFunctions.php");

$delete = $_POST["autoDelete"];

if ( isset($delete) ) {
    $sikeres = deleteAuto($delete);

    if ( $sikeres ) {
        header('Location: ../autok.php');
    } else {
        echo 'Hiba! Nem sikerült az autó törlése!';
    }
} else {
    echo 'Hiba! Nem sikerült az autó törlése!';

}

?>
