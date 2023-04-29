<?php
include_once('common/navigation.php');
include_once('common/dbfunctions.php');

?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Padama cars fő oldal</title>
        <link rel="stylesheet" type="text/css" href="css/alap.css">
        <link rel="icon" href="image/icon.png" type="image/icon">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>

        <meta charset="utf-8" />
    </head>
    <body>
    <?php
    include_once "common/header.php";
//    if (!($conn = dbConnect())) {
//        return false;
//    }
    navi();
    ?>
    <i class="fas fa-trash-alt"></i>
    <h2 id="mainh2">Üdvüzüljük a fő oldalon!</h2>
    <p class="kozepre" id="rolunk">Röviden rólunk: A Padama Cars egy magán kezekben lévő autó kereskedés, amit 3 barát alapított csupán az autók iránti érdeklődésükből. Mára ez egy ország szintű vállakozás lett. Ami <?php echo CountUzlet();?> üzlettel rendelkezik és jelenleg <?php echo TotalCarCount();?> darab autót értékesít.</p>
    <p class="kozepre" id="miert">Miért válassza a Padama Carst? Mert mi nem csak egyszerűen új és használt autókat értékesítünk hanem az autók állapotát felmérjük és a javításra szoruló autókat meg is szereljük. Eddig <?php echo CountSoldCars()?>elégedett vásárlónk van.</p>


    <p class="kozepre" id="ajanlatok">Tekintse meg most ajánlatainkat!</p>
    <p class="kozepre" id="regist">Csapatunk része szeretnél lenni? Egyszerűen csak regisztrájl eladónak vagy szerelőnek és mi felvesszük veled a kapcsolatot!</p>

    <?php
    include_once "common/footer.php";
    ?>
    </body>
</html>