<?php
function dbConnect(){
    $conn = oci_connect('C##admin', 'admin123', "localhost/XE",'UTF8') or die("HIBA! Nem sikerült csaltakozni az adatbázishoz!");

    return $conn;
}
//
// ---------------------------------------------- Listák lekérdezése ----------------------------------------------
//
function getAutokList()
{

    if (!($conn = dbConnect())) {
        return false;
    }

    $result = oci_parse($conn, 'SELECT alvazszam AS "Alvázszám", marka AS "Márka", modell AS "Modell", uzemanyag_tipus AS "Üzemanyag", teljesitmeny AS "Teljesítmény", szin AS "Szín", ar AS "Ár (Ft)" FROM Autok');

    oci_close($conn);
    return $result;

}
function getMuhelyList()
{

    if (!($conn = dbConnect())) {
        return false;
    }

    $result = oci_parse($conn, 'SELECT muhely_nev AS "Neve", muhely_varos AS "Városa" FROM Muhely');

    oci_close($conn);
    return $result;

}
function getUzletList()
{

    if (!($conn = dbConnect())) {
        return false;
    }

    $result = oci_parse($conn, 'SELECT uzlet_nev AS "Neve", uzlet_varos AS "Városa"  FROM Uzlet');

    oci_close($conn);
    return $result;

}
function getTelephelyList()
{

    if (!($conn = dbConnect())) {
        return false;
    }

    $result = oci_parse($conn, 'SELECT telep_nev AS "Neve", telep_varos AS "Városa"FROM Telephely');

    oci_close($conn);
    return $result;

}
function getEladoList()
{

    if (!($conn = dbConnect())) {
        return false;
    }

    $result = oci_parse($conn, 'SELECT eladoigszam AS "Igazolvány szám", elado_nev AS "Név", elado.felhasznalonev AS "Felhasználónév" FROM Elado');

    oci_close($conn);
    return $result;

}
function getUgyfelList()
{

    if (!($conn = dbConnect())) {
        return false;
    }

    $result = oci_parse($conn, 'SELECT ugyfeligszam AS "Igazolvány szám", ugyfel_nev AS "Név", ugyfel.felhasznalonev AS "Felhasználónév" FROM Ugyfel');

    oci_close($conn);
    return $result;

}
function getSzereloList()
{

    if (!($conn = dbConnect())) {
        return false;
    }

    $result = oci_parse($conn, 'SELECT szereloigszam AS "Igazolvány szám", szerelo_nev AS "Név", szerelo.felhasznalonev AS "Felhasználónév" FROM Elado');

    oci_close($conn);
    return $result;

}
//
// ---------------------------------------------- Táblákból törlés ----------------------------------------------
//
function deleteAuto($id)
{

    if (!($conn = dbConnect())) {
        return false;
    }

    $delete = oci_parse($conn, "DELETE FROM autok WHERE alvazszam = ".$id);
    oci_execute($delete);

    oci_close($conn);

}

