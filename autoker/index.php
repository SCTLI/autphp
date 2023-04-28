<?php
include_once('common/navigation.php');
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Padama cars fő oldal</title>
        <link rel="stylesheet" type="text/css" href="css/alap.css">
        <link rel="icon" href="image/icon.png" type="image/icon">
        <meta charset="utf-8" />
    </head>
    <body>
    <?php
    include_once "common/header.php";
    echo navigation();
    ?>
    <h2 id="mainh2">Üdvüzüljük a fő oldalon!</h2>
    <span class="kozepre" id="rolunk">Röviden rólunk: A Padama Cars egy magán kezekben lévő autó kereskedés, amit 3 barát alapított csupán az autók iránti érdeklődésükből. Mára ez egy ország szintű vállakozás lett. Ami <?php $uzletszam = CountUzlet(); echo $uzletszam?> üzlettel rendelkezik és jelenleg <?php $autokszama = TotalCarCount(); echo $autokszama?> darab autót értékesít.</span>
    <span class="kozepre" id="miert">Miért válassza a Padama Carst? Mert mi nem csak egyszerűen új és használt autókat értékesítünk hanem az autók állapotát felmérjük és a javításra szoruló autókat meg is szereljük. Eddig <?php $eladott = CountSoldCars(); echo $eladott?> elégedett vásárlónk van.</span>

    <span class="kozepre" id="ajanlatok">Tekintse meg most ajánlatainkat!</span>
    <span class="kozepre" id="regist">Csapatunk része szeretnél lenni? Egyszerűen csak regisztrájl eladónak vagy szerelőnek és mi felvesszük veled a kapcsolatot!</span>

    <?php
    include_once "common/footer.php";
    ?>
    </body>
</html>