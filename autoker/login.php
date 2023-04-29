<?php
include_once ("common/dbfunctions.php");
$felhasz = $_POST['felh'];
$jelsz = $_POST['jel'];
$szerepkor = $_POST['szerepkor'];
if (FelhasznalonevVan($felhasz) ==1){
    if ($szerepkor=="elado"){
        $jelszo = geteladojelszo();
        oci_execute($jelszo);
        while($row = oci_fetch_array($jelszo, OCI_ASSOC + OCI_RETURN_NULLS)){
            if($felhasz == $row["felhasznalo"]){
                $ezleszatenylegesjelszo = $row["jelszo"];
            }
        }
        if (password_verify($jelsz,$ezleszatenylegesjelszo)){
            $_SESSION["felhasz"]=$felhasz;
            $_SESSION["jelsz"]=$jelsz;
            $_SESSION["role"]="elado";
            header("Location: index.php");
        }
    }
    elseif ($szerepkor=="ugyfel"){
        $jelszo = getugyfeljelszo();
        oci_execute($jelszo);
        while($row = oci_fetch_array($jelszo, OCI_ASSOC + OCI_RETURN_NULLS)){
            if($felhasz == $row["felhasznalo"]){
                $ezleszatenylegesjelszo = $row["jelszo"];
            }
        }
        if (password_verify($jelsz,$ezleszatenylegesjelszo)){
            $_SESSION["felhasz"]=$felhasz;
            $_SESSION["jelsz"]=$jelsz;
            $_SESSION["role"]="ugyfel";
            header("Location: index.php");
        }
    }
    elseif ($szerepkor=="szerelo"){
        $jelszo = getszerelojelszo();
        oci_execute($jelszo);
        while($row = oci_fetch_array($jelszo, OCI_ASSOC + OCI_RETURN_NULLS)){
            if($felhasz == $row["felhasznalo"]){
                $ezleszatenylegesjelszo = $row["jelszo"];
            }
        }
        if (password_verify($jelsz,$ezleszatenylegesjelszo)){
            $_SESSION["felhasz"]=$felhasz;
            $_SESSION["jelsz"]=$jelsz;
            $_SESSION["role"]="szerelo";
            header("Location: index.php");
        }
    }elseif ($felhasz="vezeto" && $jelszo="vezeto" && $szerepkor="vezeto"){
        $_SESSION["felhasz"]=$felhasz;
        $_SESSION["jelsz"]=$jelsz;
        $_SESSION["role"]="vezeto";
        header("Location: index.php");
    }

}
?>