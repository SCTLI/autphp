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

    $result = oci_parse($conn, 'SELECT eladoigszam AS "igsz", elado_nev AS "nev", elado.felhasznalonev AS "felhasznalonev", elado.uzletid AS "uzletid", uzlet_nev AS "uzletnev" FROM Elado, uzlet WHERE uzlet.uzletid=elado.uzletid');

    oci_close($conn);
    return $result;

}
function getUgyfelList()
{

    if (!($conn = dbConnect())) {
        return false;
    }

    $result = oci_parse($conn, 'SELECT ugyfeligszam AS "igsz", ugyfel_nev AS "nev", ugyfel.felhasznalonev AS "felhasznalonev" FROM Ugyfel');

    oci_close($conn);
    return $result;

}
function getSzereloList()
{

    if (!($conn = dbConnect())) {
        return false;
    }

    $result = oci_parse($conn, 'SELECT szereloigszam AS "igsz", szerelo_nev AS "nev", szerelo.felhasznalonev AS "felhasznalonev", szerelo.muhelyid AS "muhelyid", muhely_nev AS "muhelynev" FROM Szerelo, Muhely WHERE muhely.muhelyid=szerelo.muhelyid');

    oci_close($conn);
    return $result;

}
function getSzerelList()
{

    if (!($conn = dbConnect())) {
        return false;
    }

    $result = oci_parse($conn, 'SELECT szerel.alvazszam AS "alvazszam", marka AS "marka", modell AS "modell", muhely_nev AS "muhelynev", szerelt_alkatresz AS "alkatresz", idopont AS "idopont"  FROM Szerel, muhely, autok WHERE autok.alvazszam=szerel.alvazszam AND muhely.muhelyid=szerel.muhelyid');

    oci_close($conn);
    return $result;

}
function getVasarolList()
{

    if (!($conn = dbConnect())) {
        return false;
    }

    $result = oci_parse($conn, 'SELECT vasarol.alvazszam AS "alvazszam", marka AS "marka", modell AS "modell", uzlet_nev AS "uzletnev", vasarol.ugyfeligszam AS "igsz", ugyfel_nev AS "nev"  FROM vasarol, uzlet, autok, ugyfel WHERE autok.alvazszam=vasarol.alvazszam AND uzlet.uzletid=vasarol.uzletid AND ugyfel.ugyfeligszam=vasarol.ugyfeligszam');

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
    $szam = oci_parse($conn, 'SELECT MAX(UzletId) AS "szam" FROM Uzlet');
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
    $szam = oci_parse($conn, 'SELECT MAX(TelepId) AS "szam" FROM Telephely');
    return  $szam;
}
function insertTelephely($telepNev, $telepVaros) {


    if ( !($conn = dbConnect()) ) {
        return false;
    }
    $max =lekertelep();
    oci_execute($max);
    $szam=0;
    while ( $row = oci_fetch_array($max, OCI_ASSOC + OCI_RETURN_NULLS)) {
        $szam=$row["szam"]+1;
    }
    $insert = oci_parse( $conn,"INSERT INTO telephely VALUES (:telepid,:telepvaros,:telepnev)");
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
    $szam = oci_parse($conn, 'SELECT MAX(MuhelyId) AS "szam" FROM Muhely');
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
    $insert = oci_parse( $conn,"INSERT INTO muhely VALUES (:muhelyid,:muhelyvaros,:muhelynev)");
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
    $insert = oci_parse( $conn,"INSERT INTO szerelo VALUES (:szereloIgszam,100,:szerelonev,:Felhasznalonev,:Jelszo)");
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
    $insert = oci_parse( $conn,"INSERT INTO elado VALUES (:eladoIgszam,100,:eladonev,:Felhasznalonev,:Jelszo)");
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
    $insert = oci_parse( $conn,"INSERT INTO ugyfel VALUES (:ugyfelIgszam,:ugyfelnev,:Felhasznalonev,:Jelszo)");
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
    $insert = oci_parse( $conn,"INSERT INTO vasarol VALUES (:Alvazszam,:UzletId,:ugyfelIgszam)");
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
    $insert = oci_parse( $conn,"INSERT INTO szerel VALUES (:Alvazszam,:Idopont,:MuhelyId,:Jelszo)");
    oci_bind_by_name($insert,":Alvazszam",$Alvazszam  );
    oci_bind_by_name($insert,":Idopont",$Idopont  );
    oci_bind_by_name($insert,":MuhelyId",$MuhelyId  );
    oci_bind_by_name($insert,":SzereltAlkatresz",$SzereltAlkatresz  );
    $result = oci_execute($insert);

    oci_close($conn);
    return $result;

}
//
// ---------------------------------------------- Rekord módosítás ----------------------------------------------
//
function UpdateAutok($autoAlvazszam, $telepID, $autoTeljesitmeny, $autoSzin, $autoAr)
{


    if (!($conn = dbConnect())) {
        return false;
    }
    $update = oci_parse($conn, "UPDATE autok set telepid=:telepID, teljesitmeny=:autoTeljesitmeny, szin=:autoSzin, ar=:autoAr WHERE alvazszam=:autoAlvazszam");
    oci_bind_by_name($update, ":telepID", $telepID);
    oci_bind_by_name($update, ":autoTeljesitmeny", $autoTeljesitmeny);
    oci_bind_by_name($update, ":autoSzin", $autoSzin);
    oci_bind_by_name($update, ":autoAr", $autoAr);
    oci_bind_by_name($update, ":autoAlvazszam", $autoAlvazszam);
    $result = oci_execute($update);

    oci_close($conn);
    return $result;
}
function UpdateElado($eladoIgszam, $uzletID)
{


    if (!($conn = dbConnect())) {
        return false;
    }
    $update = oci_parse($conn, "UPDATE elado set uzletid=:uzletID WHERE eladoigszam=:eladoIgszam");
    oci_bind_by_name($update, ":uzletID", $uzletID);
    oci_bind_by_name($update, ":eladoIgszam", $eladoIgszam);
    $result = oci_execute($update);

    oci_close($conn);
    return $result;
}
function UpdateMuhely($muhelyID, $muhelyVaros, $muhelyNev)
{


    if (!($conn = dbConnect())) {
        return false;
    }
    $update = oci_parse($conn, "UPDATE muhely set muhely_varos=:muhelyVaros, muhely_nev=:muhelyNev WHERE muhelyid=:muhelyID");
    oci_bind_by_name($update, ":muhelyID", $muhelyID);
    oci_bind_by_name($update, ":muhelyVaros", $muhelyVaros);
    oci_bind_by_name($update, ":muhelyNev", $muhelyNev);
    $result = oci_execute($update);

    oci_close($conn);
    return $result;
}
function UpdateSzerelo($szereloIgszam, $muhelyID)
{


    if (!($conn = dbConnect())) {
        return false;
    }
    $update = oci_parse($conn, "UPDATE szerelo set muhelyid=:muhelyID WHERE szereloigszam=:szereloIgszam");
    oci_bind_by_name($update, ":muhelyID", $muhelyID);
    oci_bind_by_name($update, ":szereloIgszam", $szereloIgszam);
    $result = oci_execute($update);

    oci_close($conn);
    return $result;
}
function UpdateTelephely($telepID, $telepVaros, $telepNev)
{


    if (!($conn = dbConnect())) {
        return false;
    }
    $update = oci_parse($conn, "UPDATE telephely SET telep_varos=:telepVaros, telep_nev=:telepNev WHERE telepid=:telepID");
    oci_bind_by_name($update, ":telepID", $telepID);
    oci_bind_by_name($update, ":telepVaros", $telepVaros);
    oci_bind_by_name($update, ":telepNev", $telepNev);
    $result = oci_execute($update);

    oci_close($conn);
    return $result;
}
function UpdateUzlet($uzletID,  $uzletNev, $uzletVaros)
{


    if (!($conn = dbConnect())) {
        return false;
    }
    $update = oci_parse($conn, "UPDATE uzlet SET uzlet_varos=:uzletVaros, uzlet_nev=:uzletNev WHERE uzletid=:uzletID");
    oci_bind_by_name($update, ":uzletID", $uzletID);
    oci_bind_by_name($update, ":uzletVaros", $uzletVaros);
    oci_bind_by_name($update, ":uzletNev", $uzletNev);
    $result = oci_execute($update);

    oci_close($conn);
    return $result;
}