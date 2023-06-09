<?php
session_start();
function dbConnect(){
    $conn=0;
    if (!isset($_SESSION["felhasz"])){
        $_SESSION["role"]="vendeg";
        $conn = oci_pconnect("C##vendeg", "vendeg", "localhost/XE",'UTF8') or die("HIBA! Nem sikerült csaltakozni az adatbázishoz!");
    }else if($_SESSION["felhasz"]=="vezeto") {
        $_SESSION["role"]="vezeto";
        $conn = oci_pconnect("C##vezeto", "vezeto", "localhost/XE", 'UTF8') or die("HIBA! Nem sikerült csaltakozni az adatbázishoz!");
    }else{
        $loginHelp=LoginHelp($_SESSION["felhasz"]);
        if ($loginHelp==1){
            $conn = oci_pconnect("C##".$_SESSION["felhasz"], $_SESSION["jelsz"], "localhost/XE", 'UTF8') or die("HIBA! Nem sikerült csaltakozni az adatbázishoz!");
            $_SESSION["role"]="szerelo";
        } else if ($loginHelp==2){
            $conn = oci_pconnect("C##".$_SESSION["felhasz"], $_SESSION["jelsz"], "localhost/XE", 'UTF8') or die("HIBA! Nem sikerült csaltakozni az adatbázishoz!");
            $_SESSION["role"]="elado";
        } else if ($loginHelp==3){
            $conn = oci_pconnect("C##".$_SESSION["felhasz"], $_SESSION["jelsz"], "localhost/XE", 'UTF8') or die("HIBA! Nem sikerült csaltakozni az adatbázishoz!");
            $_SESSION["role"]="ugyfel";
        }
    }
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
    if($_SESSION["role"]=="elado"){
        $result = oci_parse($conn, 'SELECT alvazszam AS "alvazszam", marka AS "marka", modell AS "modell", uzemanyag_tipus AS "uzemanyag", teljesitmeny AS "teljesitmeny", szin AS "szin", ar AS "ar",autok.telepid AS "telepid", eladva AS "eladva", telephely.telep_nev AS "telepnev" FROM C##admin.Autok, C##admin.telephely WHERE autok.telepid=telephely.telepid AND autok.eladva=0 order by telephely.telep_nev');

    }else{
        $result = oci_parse($conn, 'SELECT alvazszam AS "alvazszam", marka AS "marka", modell AS "modell", uzemanyag_tipus AS "uzemanyag", teljesitmeny AS "teljesitmeny", szin AS "szin", ar AS "ar",autok.telepid AS "telepid", eladva AS "eladva", telephely.telep_nev AS "telepnev" FROM C##admin.Autok, C##admin.telephely WHERE autok.telepid=telephely.telepid AND autok.eladva=0 order by autok.marka, autok.modell');

    }

    oci_close($conn);
    return $result;

}
function getMuhelyList()
{

    if (!($conn = dbConnect())) {
        return false;
    }

    $result = oci_parse($conn, 'SELECT muhely_nev AS "nev", muhely_varos AS "varos", muhelyid AS "muhelyid" FROM C##admin.Muhely WHERE muhelyid!=30');

    oci_close($conn);
    return $result;

}
function getUzletList()
{

    if (!($conn = dbConnect())) {
        return false;
    }

    $result = oci_parse($conn, 'SELECT uzlet_nev AS "nev", uzlet_varos AS "varos", uzletid AS "uzletid"  FROM C##admin.Uzlet WHERE uzletid!=30');

    oci_close($conn);
    return $result;

}
function getTelephelyList()
{

    if (!($conn = dbConnect())) {
        return false;
    }

    $result = oci_parse($conn, 'SELECT telep_nev AS "nev", telep_varos AS "varos", telepid AS "telepid" FROM C##admin.Telephely WHERE telepid!=30');

    oci_close($conn);
    return $result;

}
function getEladoList()
{

    if (!($conn = dbConnect())) {
        return false;
    }

    $result = oci_parse($conn, 'SELECT eladoigszam AS "igsz", elado_nev AS "nev", elado.felhasznalonev AS "felhasznalonev", elado.uzletid AS "uzletid", uzlet_nev AS "uzletnev" FROM C##admin.Elado, C##admin.uzlet WHERE uzlet.uzletid=elado.uzletid');

    oci_close($conn);
    return $result;

}
function getUgyfelList()
{

    if (!($conn = dbConnect())) {
        return false;
    }

    $result = oci_parse($conn, 'SELECT ugyfeligszam AS "igsz", ugyfel_nev AS "nev", ugyfel.felhasznalonev AS "felhasznalonev" FROM C##admin.Ugyfel');

    oci_close($conn);
    return $result;

}
function getSzereloList()
{

    if (!($conn = dbConnect())) {
        return false;
    }

    $result = oci_parse($conn, 'SELECT szereloigszam AS "igsz", szerelo_nev AS "nev", szerelo.felhasznalonev AS "felhasznalonev", szerelo.muhelyid AS "muhelyid", muhely_nev AS "muhelynev" FROM C##admin.Szerelo, C##admin.Muhely WHERE muhely.muhelyid=szerelo.muhelyid');

    oci_close($conn);
    return $result;

}
function getSzerelList()
{

    if (!($conn = dbConnect())) {
        return false;
    }
    $datesess = oci_parse($conn, 'ALTER SESSION SET NLS_DATE_FORMAT = "YYYY-MM-DD HH24:MI:SS"');
    oci_execute($datesess);
    $result = oci_parse($conn, 'SELECT szerel.alvazszam AS "alvazszam", marka AS "marka", modell AS "modell", muhely_nev AS "muhelynev", szerelt_alkatresz AS "alkatresz",idopont AS "idopont"  FROM C##admin.Szerel, C##admin.muhely, C##admin.autok WHERE autok.alvazszam=szerel.alvazszam AND muhely.muhelyid=szerel.muhelyid AND szerel.muhelyid='.HolSzerel($_SESSION["felhasz"]));

    oci_close($conn);
    return $result;

}
function getVasarolList()
{

    if (!($conn = dbConnect())) {
        return false;
    }

    $result = oci_parse($conn, 'SELECT vasarol.alvazszam AS "alvazszam", marka AS "marka", modell AS "modell", uzlet_nev AS "uzletnev", vasarol.ugyfeligszam AS "igsz", ugyfel_nev AS "nev",vasarol.uzletid AS "uzletid"  FROM C##admin.vasarol, C##admin.uzlet, C##admin.autok, C##admin.ugyfel WHERE autok.alvazszam=vasarol.alvazszam AND uzlet.uzletid=vasarol.uzletid AND ugyfel.ugyfeligszam=vasarol.ugyfeligszam AND vasarol.uzletid='.HolElad($_SESSION["felhasz"]));

    oci_close($conn);
    return $result;

}
//
// ---------------------------------------------- Táblákból törlés ----------------------------------------------
//
function deleteAuto($id)
{

    if (!($conn = admincon())) {
        return false;
    }

    $delete = oci_parse($conn, "DELETE FROM C##admin.autok WHERE alvazszam = ".$id);
    $result = oci_execute($delete);

    oci_close($conn);
    return $result;

}
function deleteUzlet($id)
{

    if (!($conn = dbConnect())) {
        return false;
    }

    $delete = oci_parse($conn, "DELETE FROM C##admin.uzlet WHERE uzletid = ".$id);
    $result = oci_execute($delete);

    oci_close($conn);
    return $result;

}
function deleteMuhely($id)
{

    if (!($conn = dbConnect())) {
        return false;
    }

    $delete = oci_parse($conn, "DELETE FROM C##admin.muhely WHERE muhelyid = ".$id);
    $result = oci_execute($delete);

    oci_close($conn);
    return $result;
}
function deleteTelephely($id)
{

    if (!($conn = dbConnect())) {
        return false;
    }

    $delete = oci_parse($conn, "DELETE FROM C##admin.telephely WHERE telepid = ".$id);
    $result = oci_execute($delete);

    oci_close($conn);
    return $result;
}
function deleteElado($id,$id2)
{
    if (!($conn = admincon())) {
        return false;
    }

    $delete = oci_parse($conn, "drop user C##".$id2);
    oci_execute($delete);

    oci_close($conn);
    if (!($conn = dbConnect())) {
        return false;
    }
    if (!($conn = dbConnect())) {
        return false;
    }

    $delete = oci_parse($conn, "DELETE FROM C##admin.elado WHERE eladoigszam = ".$id);
    $result = oci_execute($delete);

    oci_close($conn);
    return $result;
}
function deleteUgyfel($id1,$id2)
{
    if (!($conn = admincon())) {
        return false;
    }

    $delete = oci_parse($conn, "drop user C##".$id2);
    oci_execute($delete);

    oci_close($conn);
    if (!($conn = dbConnect())) {
        return false;
    }

    $delete = oci_parse($conn, "DELETE FROM C##admin.ugyfel WHERE ugyfeligszam = ".$id1);
    $result = oci_execute($delete);

    oci_close($conn);
    return $result;
}
function deleteSzerelo($id,$id2)
{
    if (!($conn = admincon())) {
        return false;
    }

    $delete = oci_parse($conn, "drop user C##".$id2);
    oci_execute($delete);

    oci_close($conn);
    if (!($conn = dbConnect())) {
        return false;
    }

    $delete = oci_parse($conn, "DELETE FROM C##admin.szerelo WHERE szereloigszam = ".$id);
    $result = oci_execute($delete);

    oci_close($conn);
    return $result;
}
function deleteVasarol($id1,$id2,$id3)
{

    if (!($conn = dbConnect())) {
        return false;
    }

    $delete = oci_parse($conn, "DELETE FROM C##admin.vasarol WHERE vasarol.alvazszam =:id1");
    oci_bind_by_name($delete,":id1",$id1);
    $result = oci_execute($delete);

    oci_close($conn);
    return $result;
}
function deleteSzerel($id1,$id2)
{

    if (!($conn = dbConnect())) {
        return false;
    }
    $datesess = oci_parse($conn, 'ALTER SESSION SET NLS_DATE_FORMAT = "YYYY-MM-DD HH24:MI:SS"');
    oci_execute($datesess);
    $delete = oci_parse($conn, "DELETE FROM C##admin.szerel WHERE szerel.alvazszam =:alvazszam AND szerel.idopont =:ido ");
    oci_bind_by_name($delete,":alvazszam",$id1);
    oci_bind_by_name($delete,":ido",$id2);
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
    $szam = oci_parse($conn, 'SELECT MAX(UzletId) AS "szam" FROM C##admin.Uzlet');

    oci_close($conn);
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
    $insert = oci_parse( $conn,"INSERT INTO C##admin.uzlet VALUES (:telepid,:uzletnev,:uzletvaros)");
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

    $insert = oci_parse( $conn,"INSERT INTO C##admin.autok VALUES (:alvazszam,:telepid,:marka,:uzemanyag,:modell,:teljesitmeny,:szin,:ar,0)");
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
    $szam = oci_parse($conn, 'SELECT MAX(TelepId) AS "szam" FROM C##admin.Telephely');

    oci_close($conn);
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
    $insert = oci_parse( $conn,"INSERT INTO C##admin.telephely VALUES (:telepid,:telepvaros,:telepnev)");
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
    $szam = oci_parse($conn, 'SELECT MAX(MuhelyId) AS "szam" FROM C##admin.Muhely');

    oci_close($conn);
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
    $insert = oci_parse( $conn,"INSERT INTO C##admin.muhely VALUES (:muhelyid,:muhelyvaros,:muhelynev)");
    oci_bind_by_name($insert,":muhelyid",$szam  );
    oci_bind_by_name($insert,":muhelynev",$muhelyNev  );
    oci_bind_by_name($insert,":muhelyvaros",$muhelyVaros  );
    $result = oci_execute($insert);

    oci_close($conn);
    return $result;

}
function insertSzerelo($SzereloIgszam,$SzereloNev, $Felhasznalonev, $Jelszo) {


    if ( !($conn = admincon()) ) {
        return false;
    }

    $insert = oci_parse( $conn,"INSERT INTO C##admin.szerelo VALUES (:szereloIgszam,30,:szerelonev,:Felhasznalonev,:Jelszo)");
    oci_bind_by_name($insert,":szereloIgszam",$SzereloIgszam  );
    oci_bind_by_name($insert,":szerelonev",$SzereloNev  );
    oci_bind_by_name($insert,":Felhasznalonev",$Felhasznalonev  );
    oci_bind_by_name($insert,":Jelszo",$Jelszo  );
    $result = oci_execute($insert);

    oci_close($conn);
    return $result;

}
function insertElado($EladoIgszam,$EladoNev, $Felhasznalonev, $Jelszo) {


    if ( !($conn = admincon()) ) {
        return false;
    }
    $insert = oci_parse( $conn,"INSERT INTO C##admin.elado VALUES (:eladoIgszam,30,:eladonev,:Felhasznalonev,:Jelszo)");
    oci_bind_by_name($insert,":eladoIgszam",$EladoIgszam  );
    oci_bind_by_name($insert,":eladonev",$EladoNev  );
    oci_bind_by_name($insert,":Felhasznalonev",$Felhasznalonev  );
    oci_bind_by_name($insert,":Jelszo",$Jelszo  );
    $result = oci_execute($insert);

    oci_close($conn);
    return $result;

}
function insertUgyfel($UgyfelIgszam,$UgyfelNev, $Felhasznalonev, $Jelszo) {


    if ( !($conn = admincon()) ) {
        return false;
    }
    $insert = oci_parse( $conn,"INSERT INTO C##admin.ugyfel VALUES (:ugyfelIgszam,:ugyfelnev,:Felhasznalonev,:Jelszo)");
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
    $insert = oci_parse( $conn,"INSERT INTO C##admin.vasarol VALUES (:Alvazszam,:UzletId,:ugyfelIgszam)");
    oci_bind_by_name($insert,":ugyfelIgszam",$UgyfelIgszam  );
    oci_bind_by_name($insert,":Alvazszam",$Alvazszam  );
    oci_bind_by_name($insert,":UzletId",$UzletId  );
    $result = oci_execute($insert);

    oci_close($conn);
    return $result;

}
function insertSzerel($Alvazszam, $MuhelyId, $SzereltAlkatresz) {


    if ( !($conn = dbConnect()) ) {
        return false;
    }
    $datesess = oci_parse($conn, 'ALTER SESSION SET NLS_DATE_FORMAT = "YYYY-MM-DD HH24:MI:SS"');
    oci_execute($datesess);
    $insert = oci_parse( $conn,"INSERT INTO C##admin.szerel VALUES (:Alvazszam,sysdate,:MuhelyId,:SzereltAlkatresz)");
    oci_bind_by_name($insert,":Alvazszam",$Alvazszam  );
    oci_bind_by_name($insert,":MuhelyId",$MuhelyId);
    oci_bind_by_name($insert,":SzereltAlkatresz",$SzereltAlkatresz);
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
    $update = oci_parse($conn, "UPDATE C##admin.autok set telepid=:telepID, teljesitmeny=:autoTeljesitmeny, szin=:autoSzin, ar=:autoAr WHERE alvazszam=:autoAlvazszam");
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
    $update = oci_parse($conn, "UPDATE C##admin.elado set uzletid=:uzletID WHERE eladoigszam=:eladoIgszam");
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
    $update = oci_parse($conn, "UPDATE C##admin.muhely set muhely_varos=:muhelyVaros, muhely_nev=:muhelyNev WHERE muhelyid=:muhelyID");
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
    $update = oci_parse($conn, "UPDATE C##admin.szerelo set muhelyid=:muhelyID WHERE szereloigszam=:szereloIgszam");
    oci_bind_by_name($update, ":muhelyID", $muhelyID);
    oci_bind_by_name($update, ":szereloIgszam", $szereloIgszam);
    $result = oci_execute($update);

    oci_close($conn);
    return $result;
}
function UpdateUgyfel($UgyfelIgszam,$UgyfelNev, $Felhasznalonev, $Jelszo)
{
    if (!($conn = dbConnect())) {
        return false;
    }
    $update = oci_parse($conn, "UPDATE C##admin.ugyfel set ugyfel_nev=:ugyfelnev, Felhasznalonev=:felh, Jelszo=:jel WHERE UgyfelIgszam=:ugyfelIgszam");
    oci_bind_by_name($update, ":ugyfelnev", $UgyfelNev);
    oci_bind_by_name($update, ":felh", $Felhasznalonev);
    oci_bind_by_name($update, ":jel", $Jelszo);
    oci_bind_by_name($update, ":ugyfelIgszam", $UgyfelIgszam);
    $result = oci_execute($update);

    oci_close($conn);
    return $result;
}
function UpdateTelephely($telepID, $telepVaros, $telepNev)
{


    if (!($conn = dbConnect())) {
        return false;
    }
    $update = oci_parse($conn, "UPDATE C##admin.telephely SET telep_varos=:telepVaros, telep_nev=:telepNev WHERE telepid=:telepID");
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
    $update = oci_parse($conn, "UPDATE C##admin.uzlet SET uzlet_varos=:uzletVaros, uzlet_nev=:uzletNev WHERE uzletid=:uzletID");
    oci_bind_by_name($update, ":uzletID", $uzletID);
    oci_bind_by_name($update, ":uzletVaros", $uzletVaros);
    oci_bind_by_name($update, ":uzletNev", $uzletNev);
    $result = oci_execute($update);

    oci_close($conn);
    return $result;
}
//
// ---------------------------------------------- Egyedi funkciók ----------------------------------------------
//
function CountAutokInTelephely($telepid){
    if (!($conn = dbConnect())) {
        return false;
    }
    $count = oci_parse($conn, 'begin :szam:=C##admin.autoklistaz(:telepid); end;');
    oci_bind_by_name($count, ':szam',$szam);
    oci_bind_by_name($count, ':telepid',$telepid);

    oci_execute($count);

    oci_close($conn);
    return $szam;
}


function CountUzemanyag(){
    if (!($conn = dbConnect())) {
        return false;
    }
    $count = oci_parse($conn, 'SELECT COUNT(Autok.Uzemanyag_tipus) AS "szam",Autok.Uzemanyag_tipus AS "tipus" FROM C##admin.Autok WHERE autok.eladva=1 GROUP BY Autok.Uzemanyag_tipus ORDER BY COUNT(Autok.Uzemanyag_tipus) DESC fetch first 1 row only');

    oci_close($conn);
    return $count;
}
function AcceptVasarol($alvazszam){
    if (!($conn = dbConnect())) {
        return false;
    }
    $accept = oci_parse($conn, 'begin C##admin.vasarolelfogad(:alvazszam); end;');
    oci_bind_by_name($accept, ':alvazszam',$alvazszam);

    oci_execute($accept);

    oci_close($conn);
    return $accept;
}
function TotalCarCount(){
    if (!($conn = dbConnect())) {
        return false;
    }
    $db = oci_parse($conn, 'begin :szam:=C##admin.TotalCarCount(); end;');
    oci_bind_by_name($db, ':szam',$szam);
    oci_execute($db);
    oci_close($conn);
    return $szam;
}

function CountSoldCars(){
    if (!($conn = dbConnect())) {
        return false;
    }
    $db = oci_parse($conn, 'begin :szam:=C##admin.CountSoldCars(); end;');
    oci_bind_by_name($db, ':szam',$szam);
    oci_execute($db);
    oci_close($conn);
    return $szam;
}

function CountUzlet(){
    if (!($conn = dbConnect())) {
        return false;
    }
    $db = oci_parse($conn, 'begin :szam:=C##admin.CountUzlet(); end;');
    oci_bind_by_name($db, ':szam',$szam);
    oci_execute($db);
    oci_close($conn);
    return $szam;
}
function HolElad()
{
    if (!($conn = dbConnect())) {
        return false;
    }
    $db = oci_parse($conn, 'begin :szam:=C##admin.holelad(:felhasz); end;');
    oci_bind_by_name($db, ':szam',$szam);
    oci_bind_by_name($db, ':felhasz',$_SESSION["felhasz"]);
    oci_execute($db);
    oci_close($conn);
    return $szam;
}
function HolSzerel()
{
    if (!($conn = dbConnect())) {
        return false;
    }
    $db = oci_parse($conn, 'begin :szam:=C##admin.holszerel(:felhasz); end;');
    oci_bind_by_name($db, ':szam',$szam);
    oci_bind_by_name($db, ':felhasz',$_SESSION["felhasz"]);
    oci_execute($db);
    oci_close($conn);
    return $szam;
}
function FelhasznalonevVan($felhasznalonev)
{
    if (!($conn = dbConnect())) {
        return false;
    }
    $db = oci_parse($conn, 'begin :szam:=C##admin.felhasznaloegyezzes(:felhasz); end;');
    oci_bind_by_name($db, ':szam',$szam);
    oci_bind_by_name($db, ':felhasz',$felhasznalonev);
    oci_execute($db);
    oci_close($conn);
    return $szam;
}
function LoginHelp($felhasz)
{
    if (!($conn = admincon())) {
        return false;
    }
    $db = oci_parse($conn, 'begin :szam:=C##admin.kivagyte(:felhasz); end;');
    oci_bind_by_name($db, ':szam',$szam);
    oci_bind_by_name($db, ':felhasz',$felhasz);
    oci_execute($db);
    oci_close($conn);
    return $szam;
}
function kivagyte($igsz)
{
    if (!($conn = admincon())) {
        return false;
    }
    $db = oci_parse($conn, 'begin :szam:=C##admin.irathamititoe(:felhasz); end;');
    oci_bind_by_name($db, ':szam',$szam);
    oci_bind_by_name($db, ':felhasz',$igsz);
    oci_execute($db);
    oci_close($conn);
    return $szam;
}
function Lekapar($alvazszam)
{
    if (!($conn = admincon())) {
        return false;
    }
    $db = oci_parse($conn, 'begin :szam:=C##admin.lekapartad(:felhasz); end;');
    oci_bind_by_name($db, ':szam',$szam);
    oci_bind_by_name($db, ':felhasz',$alvazszam);
    oci_execute($db);
    oci_close($conn);
    return $szam;
}
function AVGeladott(){
    if (!($conn = admincon())) {
        return false;
    }
    $joazoci = oci_parse($conn, 'SELECT AVG(Autok.Ar) AS "jooci" FROM Autok WHERE Autok.Eladva=1');

    oci_close($conn);
    return $joazoci; //nem
}
function MuhelyDolgozoi(){
    if (!($conn = dbConnect())) {
        return false;
    }
    $count = oci_parse($conn, 'SELECT Count(*) AS "szam", muhely.muhelyid AS "muhelyid" FROM C##admin.muhely, C##admin.szerelo WHERE szerelo.muhelyid=muhely.muhelyid GROUP BY muhely.muhelyid');

    oci_close($conn);
    return $count; //nem
}
function UzletDolgozoi(){
    if (!($conn = dbConnect())) {
        return false;
    }
    $count = oci_parse($conn, 'SELECT Count(*) AS "szam", uzlet.uzletid AS "uzletid" FROM C##admin.uzlet, C##admin.elado WHERE elado.uzletid=uzlet.uzletid GROUP BY uzlet.uzletid');

    oci_close($conn);
    return $count; //nem
}
function TelephelyAutoi(){
    if (!($conn = dbConnect())) {
        return false;
    }
    $count = oci_parse($conn, 'SELECT Count(*) AS "szam", telephely.telepid AS "telepid" FROM C##admin.telephely, C##admin.autok WHERE autok.telepid=telephely.telepid AND autok.eladva=0 GROUP BY telephely.telepid');

    oci_close($conn);
    return $count; //nem
}
function LegrosszabbModell(){
    if (!($conn = dbConnect())) {
        return false;
    }
    $count = oci_parse($conn, 'SELECT autok.marka AS "marka", autok.modell AS "modell", Count(*) AS "szam" FROM C##admin.autok, C##admin.szerel WHERE autok.alvazszam=szerel.alvazszam GROUP BY autok.marka, autok.modell order by COUNT(*) desc fetch first 1 row only');

    oci_close($conn);
    return $count; //nem
}
function VarakozoVasarlas(){
    if (!($conn = admincon())) {
        return false;
    }
    $count = oci_parse($conn, 'SELECT COUNT(Vasarol.Alvazszam) AS "db", Uzlet.Uzlet_nev AS "nev" FROM Vasarol, Uzlet WHERE Vasarol.UzletId=Uzlet.UzletId GROUP BY Uzlet.Uzlet_nev ORDER BY COUNT(Vasarol.Alvazszam)');
    oci_close($conn);
    return $count; //nem
}
function MuhelySzerel(){
    if (!($conn = admincon())) {
        return false;
    }
    $count = oci_parse($conn, 'SELECT Muhely.Muhely_nev AS "nev", COUNT(Szerel.Alvazszam) AS "db" FROM Szerel, Muhely WHERE Szerel.Muhelyid=Muhely.MuhelyId GROUP BY muhely.Muhely_nev ORDER BY COUNT(Szerel.Alvazszam)');
    oci_close($conn);
    return $count; //nem
}
//
// ---------------------------------------------- Felhasználó létrehozása funkciók ----------------------------------------------
//

function admincon(){
    $conn = oci_pconnect("C##admin", "admin123", "localhost/XE", 'UTF8') or die("HIBA! Nem sikerült csaltakozni az adatbázishoz!");
    return $conn;
}

function eladoletre($eladofelh, $eladojelsz){
    if (!($conn = admincon())) {
        return false;
    }
    $test = 'CREATE USER C##' . $eladofelh . ' IDENTIFIED BY ' . $eladojelsz;
    echo $test;
    $siker = oci_parse($conn, $test);

    oci_execute($siker);
    $siker2 = oci_parse($conn, "GRANT connect TO C##".$eladofelh);
    oci_execute($siker2);
    $siker3 = oci_parse($conn, "GRANT select, insert, update, delete on C##admin.autok to C##".$eladofelh);
    oci_execute($siker3);
    $siker4 = oci_parse($conn, "GRANT select on C##admin.telephely to C##".$eladofelh);
    oci_execute($siker4);
    $siker5 = oci_parse($conn, "GRANT select on C##admin.uzlet to C##".$eladofelh);
    oci_execute($siker5);
    $siker6 = oci_parse($conn, "GRANT select, delete on C##admin.vasarol to C##".$eladofelh);
    oci_execute($siker6);
    $siker7 = oci_parse($conn, "GRANT select on C##admin.ugyfel to C##".$eladofelh);
    oci_execute($siker7);

    if($siker && $siker2 && $siker3 && $siker4 && $siker5 && $siker6 && $siker7){
        return true;
    }else{
        return false;
    }
}
function ugyfelletre($ugyfelfelh, $ugyfeljelsz){
    if (!($conn = admincon())) {
        return false;
    }
    $test = 'CREATE USER C##' . $ugyfelfelh . ' IDENTIFIED BY ' . $ugyfeljelsz;
    echo $test;
    $siker = oci_parse($conn, $test);

    oci_execute($siker);
    $siker2 = oci_parse($conn, "GRANT connect TO C##".$ugyfelfelh);
    oci_execute($siker2);
    $siker3 = oci_parse($conn, "GRANT select, update on C##admin.ugyfel to C##".$ugyfelfelh);
    oci_execute($siker3);
    $siker4 = oci_parse($conn, "GRANT select on C##admin.telephely to C##".$ugyfelfelh);
    oci_execute($siker4);
    $siker5 = oci_parse($conn, "GRANT select on C##admin.autok to C##".$ugyfelfelh);
    oci_execute($siker5);
    $siker6 = oci_parse($conn, "GRANT insert on C##admin.vasarol to C##".$ugyfelfelh);
    oci_execute($siker6);
    $siker7 = oci_parse($conn, "GRANT select on C##admin.uzlet to C##".$ugyfelfelh);
    oci_execute($siker7);

    if($siker && $siker2 && $siker3 && $siker4 && $siker5 && $siker6 && $siker7){
        return true;
    }else{
        return false;
    }
}
function szereloletre($szerelofelh, $szerelojelsz){
    if (!($conn = admincon())) {
        return false;
    }
    $test = 'CREATE USER C##' . $szerelofelh . ' IDENTIFIED BY ' . $szerelojelsz;
    echo $test;
    $siker = oci_parse($conn, $test);

    oci_execute($siker);
    $siker2 = oci_parse($conn, "GRANT connect TO C##".$szerelofelh);
    oci_execute($siker2);
    $siker3 = oci_parse($conn, "GRANT select on C##admin.autok to C##".$szerelofelh);
    oci_execute($siker3);
    $siker4 = oci_parse($conn, "GRANT select, insert, delete on C##admin.szerel to C##".$szerelofelh);
    oci_execute($siker4);
    $siker5 = oci_parse($conn, "GRANT select on C##admin.muhely to C##".$szerelofelh);
    oci_execute($siker5);
    $siker6 = oci_parse($conn, "GRANT select on C##admin.telephely to C##".$szerelofelh);
    oci_execute($siker6);

    if($siker && $siker2 && $siker3 && $siker4 && $siker5 && $siker6){
        return true;
    }else{
        return false;
    }
}
function geteladojelszo(){
    if (!($conn = admincon())) {
        return false;
    }

    $result = oci_parse($conn,'SELECT elado.jelszo AS "jelszo", elado.felhasznalonev as "felhasznalo" FROM C##admin.elado');
    oci_close($conn);
    return $result;

}
function getugyfeljelszo(){
    if (!($conn = admincon())) {
        return false;
    }

    $result = oci_parse($conn,'SELECT ugyfel.jelszo AS "jelszo", ugyfel.felhasznalonev as "felhasznalo" FROM C##admin.ugyfel');

    oci_close($conn);
    return $result;
}

function getszerelojelszo(){
    if (!($conn = admincon())) {
        return false;
    }

    $result = oci_parse($conn,'SELECT szerelo.jelszo AS "jelszo", szerelo.felhasznalonev as "felhasznalo" FROM C##admin.szerelo');

    oci_close($conn);
    return $result;
}