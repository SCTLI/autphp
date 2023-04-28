<?php
include_once('common/dbfunctions.php');
session_start();
?>
<!DOCTYPE HTML>
<html>
<head>

</head>
<body>
    <form action="login.php" method="post" accept-charset="utf-8">
        <input name="felh" type="text" placeholder="felh">
        <input name="jel" type="password" placeholder="jel">
        <input type="submit" value="igen">
    </form>
</body>