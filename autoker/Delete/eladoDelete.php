<?php

include_once("../common/dbFunctions.php");

$delete = $_POST["eladoDelete"];
$delete2 = $_POST["eladoFelhasznalonev"];

if ( isset($delete) && isset($delete2) ) {
    $sikeres = deleteElado($delete,$delete2);

    if ( $sikeres ) {
        header('Location: ../elado.php');
    } else {
        echo 'Hiba! Nem sikerült az elado törlése!';
    }
} else {
    echo 'Hiba! Nem sikerült az elado törlése!';

}

?>
