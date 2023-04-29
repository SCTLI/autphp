<?php
include_once ('common/dbfunctions.php');
include_once('common/navigation.php');
$szerelAlvazszam = $_POST['alvazszam'];
$muhelyid = $_POST['muhely'];
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Kiválaszott autó lefogalála</title>
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
<h2>Új Szerelés felvitele az adatbázisba</h2>
<p class="kozepre">Ahoz, hogy egy új szerelés vigyen fel az adatbázisba kérem töltse ki az alábbi űrlapot.(minden mező kitöltése kötelező)</p>
<form method="POST" action="Insert/szerelInsert.php" accept-charset="utf-8">
    <label>Szerelt Autó alvázszáma: <?php echo $szerelAlvazszam ?></label>
    <br />
    <label>Szerelt alkatrész:</label>
    <input type="text" name="alkatresz" placeholder="motor">
    <input type="hidden" name="muhelyid" value="<?php echo $muhelyid ?>">
    <input type="hidden" name="alvazszam" value="<?php echo $szerelAlvazszam ?>">
    <br />
    <input type="submit" value="Feltöltés">
</form>
<?php
include_once "common/footer.php";
?>
</body>
</html>
