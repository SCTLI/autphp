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

    $result = oci_parse($conn, 'SELECT alvazszam AS "alvazszam", marka AS "marka", modell AS "modell", uzemanyag_tipus AS "uzemanyag", teljesitmeny AS "teljesitmeny", szin AS "szin", ar AS "ar",telepid AS "telepid", eladva AS "eladva" FROM Autok');

    oci_close($conn);
    return $result;

}
function getMuhelyList()
{

    if (!($conn = dbConnect())) {
        return false;
    }

    $result = oci_parse($conn, 'SELECT muhely_nev AS "nev", muhely_varos AS "varos", muhelyid AS "muhelyid" FROM Muhely');

    oci_close($conn);
    return $result;

}
function getUzletList()
{

    if (!($conn = dbConnect())) {
        return false;
    }

    $result = oci_parse($conn, 'SELECT uzlet_nev AS "nev", uzlet_varos AS "varos", uzletid AS "uzletid"  FROM Uzlet');

    oci_close($conn);
    return $result;

}
function getTelephelyList()
{

    if (!($conn = dbConnect())) {
        return false;
    }

    $result = oci_parse($conn, 'SELECT telep_nev AS "nev", telep_varos AS "varos", telepid AS "telepid" FROM Telephely');

    oci_close($conn);
    return $result;

}
function getEladoList()
{

    if (!($conn = dbConnect())) {
        return false;
    }

    $result = oci_parse($conn, 'SELECT eladoigszam AS "igsz", elado_nev AS "nev", elado.felhasznalonev AS "felhasznalonev", uzletid AS "uzletid" FROM Elado');

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
    $result = oci_execute($delete);

    oci_close($conn);
    return $result;

}
function deleteUzlet($id)
{

    if (!($conn = dbConnect())) {
        return false;
    }

    $delete = oci_parse($conn, "DELETE FROM uzlet WHERE uzletid = ".$id);
    $result = oci_execute($delete);

    oci_close($conn);
    return $result;

}
function deleteMuhely($id)
{

    if (!($conn = dbConnect())) {
        return false;
    }

    $delete = oci_parse($conn, "DELETE FROM muhely WHERE muhelyid = ".$id);
    $result = oci_execute($delete);

    oci_close($conn);
    return $result;
}
function deleteTelephely($id)
{

    if (!($conn = dbConnect())) {
        return false;
    }

    $delete = oci_parse($conn, "DELETE FROM telephely WHERE telepid = ".$id);
    $result = oci_execute($delete);

    oci_close($conn);
    return $result;
}
function deleteElado($id)
{

    if (!($conn = dbConnect())) {
        return false;
    }

    $delete = oci_parse($conn, "DELETE FROM elado WHERE eladoigszam = ".$id);
    $result = oci_execute($delete);

    oci_close($conn);
    return $result;
}
function deleteUgyfel($id)
{

    if (!($conn = dbConnect())) {
        return false;
    }

    $delete = oci_parse($conn, "DELETE FROM ugyfel WHERE ugyfeligszam = ".$id);
    $result = oci_execute($delete);

    oci_close($conn);
    return $result;
}
function deleteSzerelo($id)
{

    if (!($conn = dbConnect())) {
        return false;
    }

    $delete = oci_parse($conn, "DELETE FROM szerelo WHERE szereloigszam = ".$id);
    $result = oci_execute($delete);

    oci_close($conn);
    return $result;
}
function deleteVasarol($id)
{

    if (!($conn = dbConnect())) {
        return false;
    }

    $delete = oci_parse($conn, "DELETE FROM vasarol WHERE vasarol.alvazszam = ".$id);
    $result = oci_execute($delete);

    oci_close($conn);
    return $result;
}
function deleteSzerel($id1,$id2)
{

    if (!($conn = dbConnect())) {
        return false;
    }

    $delete = oci_parse($conn, "DELETE FROM szerel WHERE szerel.alvazszam = ".$id1." AND idopont = ".$id2);
    $result = oci_execute($delete);

    oci_close($conn);
    return $result;
}
//
// ---------------------------------------------- Táblába beszúrás ----------------------------------------------
//
function lekeruzlet(){
    if ( !($conn = dbConnect()) ) {
        return false;
    }
    $szam = oci_parse($conn, 'SELECT MAX(UzletId) FROM Uzlet');
    return  $szam;
}
function insertUzlet($uzletNev, $uzletVaros) {


    if ( !($conn = dbConnect()) ) {
        return false;
    }
    $max =lekeruzlet();
    oci_execute($max);
    $szam=0;
    while ( $row = oci_fetch_array($max, OCI_ASSOC + OCI_RETURN_NULLS)) {
        $szam=$row["szam"]+1;
    }
    $insert = oci_parse( $conn,"INSERT INTO uzlet VALUES (:telepid,:uzletnev,:uzletvaros)");
    oci_bind_by_name($insert,":telepid",$szam  );
    oci_bind_by_name($insert,":uzletnev",$uzletNev  );
    oci_bind_by_name($insert,":uzletvaros",$uzletVaros  );
    $result = oci_execute($insert);

    oci_close($conn);
    return $result;

}
function insertAutok($telepid, $marka, $uzemanyag, $model, $teljesitmeny , $szin, $ar, $alvazszam) {


    if ( !($conn = dbConnect()) ) {
        return false;
    }

    $insert = oci_parse( $conn,"INSERT INTO autok VALUES (:alvazszam,:telepid,:marka,:uzemanyag,:modell,:teljesitmeny,:szin,:ar,0)");
    oci_bind_by_name($insert,":alvazszam",$alvazszam  );
    oci_bind_by_name($insert,":telepid",$telepid  );
    oci_bind_by_name($insert,":marka",$marka  );
    oci_bind_by_name($insert,":uzemanyag",$uzemanyag  );
    oci_bind_by_name($insert,":modell",$model  );
    oci_bind_by_name($insert,":teljesitmeny",$teljesitmeny  );
    oci_bind_by_name($insert,":szin",$szin  );
    oci_bind_by_name($insert,":ar",$ar  );
    $result = oci_execute($insert);

    oci_close($conn);
    return $result;

}
function lekertelep(){
    if ( !($conn = dbConnect()) ) {
        return false;
    }
    $szam = oci_parse($conn, 'SELECT MAX(TelepId) FROM Telephely');
    return  $szam;
}
function insertTelep($telepNev, $telepVaros) {


    if ( !($conn = dbConnect()) ) {
        return false;
    }
    $max =lekertelep();
    oci_execute($max);
    $szam=0;
    while ( $row = oci_fetch_array($max, OCI_ASSOC + OCI_RETURN_NULLS)) {
        $szam=$row["szam"]+1;
    }
    $insert = oci_parse( $conn,"INSERT INTO uzlet VALUES (:telepid,:telepvaros,:telepnev)");
    oci_bind_by_name($insert,":telepid",$szam  );
    oci_bind_by_name($insert,":telepnev",$telepNev  );
    oci_bind_by_name($insert,":telepvaros",$telepVaros  );
    $result = oci_execute($insert);

    oci_close($conn);
    return $result;

}
function lekermuhely(){
    if ( !($conn = dbConnect()) ) {
        return false;
    }
    $szam = oci_parse($conn, 'SELECT MAX(MuhelyId) FROM Muhely');
    return  $szam;
}
function insertMuhely($muhelyNev, $muhelyVaros) {


    if ( !($conn = dbConnect()) ) {
        return false;
    }
    $max =lekermuhely();
    oci_execute($max);
    $szam=0;
    while ( $row = oci_fetch_array($max, OCI_ASSOC + OCI_RETURN_NULLS)) {
        $szam=$row["szam"]+1;
    }
    $insert = oci_parse( $conn,"INSERT INTO uzlet VALUES (:muhelyid,:muhelyvaros,:muhelynev)");
    oci_bind_by_name($insert,":muhelyid",$szam  );
    oci_bind_by_name($insert,":muhelynev",$muhelyNev  );
    oci_bind_by_name($insert,":muhelyvaros",$muhelyVaros  );
    $result = oci_execute($insert);

    oci_close($conn);
    return $result;

}
function insertSzerelo($SzereloIgszam,$SzereloNev, $Felhasznalonev, $Jelszo) {


    if ( !($conn = dbConnect()) ) {
        return false;
    }
    $insert = oci_parse( $conn,"INSERT INTO uzlet VALUES (:szereloIgszam,Null,:szerelonev,:Felhasznalonev,:Jelszo)");
    oci_bind_by_name($insert,":szereloIgszam",$SzereloIgszam  );
    oci_bind_by_name($insert,":szerelonev",$SzereloNev  );
    oci_bind_by_name($insert,":Felhasznalonev",$Felhasznalonev  );
    oci_bind_by_name($insert,":Jelszo",$Jelszo  );
    $result = oci_execute($insert);

    oci_close($conn);
    return $result;

}
function insertElado($EladoIgszam,$EladoNev, $Felhasznalonev, $Jelszo) {


    if ( !($conn = dbConnect()) ) {
        return false;
    }
    $insert = oci_parse( $conn,"INSERT INTO uzlet VALUES (:eladoIgszam,NULL,:eladonev,:Felhasznalonev,:Jelszo)");
    oci_bind_by_name($insert,":eladoIgszam",$EladoIgszam  );
    oci_bind_by_name($insert,":eladonev",$EladoNev  );
    oci_bind_by_name($insert,":Felhasznalonev",$Felhasznalonev  );
    oci_bind_by_name($insert,":Jelszo",$Jelszo  );
    $result = oci_execute($insert);

    oci_close($conn);
    return $result;

}
function insertUgyfel($UgyfelIgszam,$UgyfelNev, $Felhasznalonev, $Jelszo) {


    if ( !($conn = dbConnect()) ) {
        return false;
    }
    $insert = oci_parse( $conn,"INSERT INTO uzlet VALUES (:ugyfelIgszam,:ugyfelnev,:Felhasznalonev,:Jelszo)");
    oci_bind_by_name($insert,":ugyfelIgszam",$UgyfelIgszam  );
    oci_bind_by_name($insert,":ugyfelnev",$UgyfelNev  );
    oci_bind_by_name($insert,":Felhasznalonev",$Felhasznalonev  );
    oci_bind_by_name($insert,":Jelszo",$Jelszo  );
    $result = oci_execute($insert);

    oci_close($conn);
    return $result;

}
function insertVasarol($Alvazszam,$UzletId, $UgyfelIgszam) {


    if ( !($conn = dbConnect()) ) {
        return false;
    }
    $insert = oci_parse( $conn,"INSERT INTO uzlet VALUES (:Alvazszam,:UzletId,:ugyfelIgszam)");
    oci_bind_by_name($insert,":ugyfelIgszam",$UgyfelIgszam  );
    oci_bind_by_name($insert,":Alvazszam",$Alvazszam  );
    oci_bind_by_name($insert,":UzletId",$UzletId  );
    $result = oci_execute($insert);

    oci_close($conn);
    return $result;

}
function insertSzerel($Alvazszam,$Idopont, $MuhelyId, $SzereltAlkatresz) {


    if ( !($conn = dbConnect()) ) {
        return false;
    }
    $insert = oci_parse( $conn,"INSERT INTO uzlet VALUES (:Alvazszam,:Idopont,:MuhelyId,:Jelszo)");
    oci_bind_by_name($insert,":Alvazszam",$Alvazszam  );
    oci_bind_by_name($insert,":Idopont",$Idopont  );
    oci_bind_by_name($insert,":MuhelyId",$MuhelyId  );
    oci_bind_by_name($insert,":SzereltAlkatresz",$SzereltAlkatresz  );
    $result = oci_execute($insert);

    oci_close($conn);
    return $result;

}