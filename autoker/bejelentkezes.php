<?php
include_once('common/dbfunctions.php');
include_once('common/navigation.php');

?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Bejelentkezes</title>
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
    <form action="login.php" method="post" accept-charset="utf-8">
        <input name="felh" type="text" placeholder="felh">
        <input name="jel" type="password" placeholder="jel">
        <input type="submit" value="igen">
    </form>
</body>