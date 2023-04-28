<?php
session_start();
session_unset();
$_SESSION["role"]="vendeg";
header("Location: index.php");

?>