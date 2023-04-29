<?php
include_once('common/navigation.php');
include_once('common/dbfunctions.php');
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Regisztráció</title>
    <link rel="stylesheet" type="text/css" href="css/alap.css">
    <link rel="icon" href="image/icon.png" type="image/icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
    <meta charset="utf-8" />
</head>
<body>
<?php
include_once "common/header.php";
navi();
?>
<h1 class="kozepre">Regisztráció</h1>
<span class="kozepre">Ahoz, hogy regisztráljon kérem töltse ki az álábbi űrlapot</span>
<form method="POST" action="Insert/register.php" accept-charset="utf-8">
    <label>Kérem válassza ki, hogy milyen szerepkörbe szeretne regisztrálni:</label>
    <select name="szerepkor">
        <option value="ugyfel">Ügyfel</option>
        <option value="elado">Eladó</option>
        <option value="szerelo">Szerelő</option>
    </select>
    <br />
    <label>Igazolvány száma:</label>
    <input type="number" name="igszam" placeholder="123456">
    <br />
    <label>Teljes neve:</label>
    <input type="text" name="nev" placeholder="Idul Zsombor">
    <br />
    <label>Felhasználó neve:</label>
    <input type="text" name="felhasznalonev" placeholder="zsombii">
    <br />
    <label>Jelszava:</label>
    <input type="text" name="jelszo" placeholder="Semmi123">
    <br />
    <input type="submit" value="Feltöltés">
</form>
<?php
include_once "common/footer.php";
?>
</body>
</html>