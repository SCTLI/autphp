<?php
function navigation() {
    $navigation  = '<nav><ul>';
    $navigation .= '<li><a href="index.php">Kezdő Oldal</a></li>';
    $navigation .= '<li><a href="autok.php">Autók tábla</a></li>';
    $navigation .= '<li><a href="telephely.php">Telephelyek tábla</a></li>';
    $navigation .= '<li><a href="elado.php">Eladók tábla</a></li>';
    $navigation .= '<li><a href="muhely.php">Műhelyek tábla</a></li>';
    $navigation .= '<li><a href="uzlet.php">Üzletek tábla</a></li>';
    $navigation .= '<li><a href="szerelo.php">Szerelők tábla</a></li> ';
    $navigation .= '<li><a href="ugyfel.php">Ügyfelek tábla</a></li>';
    $navigation .= '<li><a href="vasarol.php">Vásárlások tábla</a></li>';
    $navigation .= '<li><a href="szerel.php">Szerelések tábla</a></li>';
    $navigation .= '<li><a href="logout.php">Szerelések tábla</a></li>';
    $navigation .= '</ul></nav>';

    return $navigation;
}
?>