<?php
function navigation() {
    $navigation  = '<nav><ul>';
    $navigation .= '<li><a href="index.php">Kezdő Oldal</a></li>';
    $navigation .= '<li><a href="autok.php">Autók tábla</a></li>';
    if ($_SESSION["role"]=="vezeto"){$navigation .= '<li><a href="telephely.php">Telephelyek tábla</a></li>';}
    if ($_SESSION["role"]=="vezeto"){$navigation .= '<li><a href="elado.php">Eladók tábla</a></li>';}
    if ($_SESSION["role"]=="vezeto"){$navigation .= '<li><a href="muhely.php">Műhelyek tábla</a></li>';}
    if ($_SESSION["role"]=="vezeto"){$navigation .= '<li><a href="uzlet.php">Üzletek tábla</a></li>';}
    if ($_SESSION["role"]=="vezeto"){$navigation .= '<li><a href="szerelo.php">Szerelők tábla</a></li> ';}
    if ($_SESSION["role"]=="vezeto"){$navigation .= '<li><a href="ugyfel.php">Ügyfelek tábla</a></li>';}
    if ($_SESSION["role"]=="elado"){$navigation .= '<li><a href="vasarol.php">Vásárlások tábla</a></li>';}
    if ($_SESSION["role"]=="vendeg"){$navigation .= '<li><a href="regisztracio.php">Regisztáció</a></li>';}
    if ($_SESSION["role"]=="szerelo"){$navigation .= '<li><a href="szerel.php">Szerelések tábla</a></li>';}
    if ($_SESSION["role"]=="vendeg"){$navigation .= '<li><a href="bejelentkezes.php">Bejelentkezés</a></li>';}
    if ($_SESSION["role"]!="vendeg"){$navigation .= '<li><a href="logout.php">Kijelentkezés</a></li>';}
    $navigation .= '</ul>'.$_SESSION["felhasz"].'</nav>';

    return $navigation;
}
?>