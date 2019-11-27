<?php
session_start();
$_SESSION["login"];
$_SESSION["id_status"];

unset($_SESSION["login"]);
unset($_SESSION["id_status"]);


session_unset();
session_destroy();

header("location:index.php");


?>
    