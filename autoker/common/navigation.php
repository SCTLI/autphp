<?php
function navi()
{
    echo '<nav><ul>';
    echo '<li><a href="index.php"><i class="fa fa-fw fa-home"></i>Kezdő Oldal</a></li>';
    echo '<li><a href="autok.php"><i class="fas fa-car"></i>Autók tábla</a></li>';
    if ($_SESSION["role"] == "vezeto") {
        echo '<li><a href="telephely.php"><i class="fas fa-building"></i>Telephelyek tábla</a></li>';
    }
    if ($_SESSION["role"] == "vezeto") {
        echo '<li><a href="muhely.php"><i class="fas fa-wrench"></i>Műhelyek tábla</a></li>';
    }
    if ($_SESSION["role"] == "vezeto") {
        echo '<li><a href="uzlet.php"><i class="fas fa-wallet"></i>Üzletek tábla</a></li>';
    }
    if ($_SESSION["role"] == "vezeto") {
        echo '<li><a href="elado.php"><i class="fa fa-fw fa-user"></i>Eladók tábla</a></li>';
    }
    if ($_SESSION["role"] == "vezeto") {
        echo '<li><a href="szerelo.php"><i class="fas fa-wrench"></i>Szerelők tábla</a></li> ';
    }
    if ($_SESSION["role"] == "vezeto") {
        echo '<li><a href="ugyfel.php"><i class="fa fa-fw fa-user"></i>Ügyfelek tábla</a></li>';
    }
    if ($_SESSION["role"] == "elado") {
        echo '<li><a href="vasarol.php"><i class="fas fa-shopping-cart"></i>Vásárlások tábla</a></li>';
    }
    if ($_SESSION["role"] == "vendeg") {
        echo '<li><a href="regisztracio.php"><i class="fas fa-registered"></i>Regisztáció</a></li>';
    }
    if ($_SESSION["role"] == "szerelo") {
        echo '<li><a href="szerel.php"><i class="fas fa-wrench"></i>Szerelések tábla</a></li>';
    }
    if ($_SESSION["role"] == "vendeg") {
        echo '<li><a href="bejelentkezes.php"><i class="fas fa-sign-in-alt"></i>Bejelentkezés</a></li>';
    }
    if ($_SESSION["role"] != "vendeg") {
        echo '<li><a href="logout.php"><i class="fas fa-sign-out-alt"></i>Kijelentkezés</a></li>';
    }
    if($_SESSION["role"] != "vendeg"){
        echo '<li><a href="#" style="pointer-events: none"><i class="fa fa-fw fa-user"></i>';
        echo $_SESSION["felhasz"];
        echo '</a></li>';
    }
    echo '</ul></nav>';
}
?>






