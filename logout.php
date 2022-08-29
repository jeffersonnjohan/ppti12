<?php 

session_start();
session_destroy();
unset($_COOKIE['login']);
unset($_COOKIE['username']);
setcookie("login", "", time()-3600);
setcookie("username", "", time()-3600);
header("Location: login.php");

?>