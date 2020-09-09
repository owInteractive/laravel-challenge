<?php
setcookie('adenX9Tro', null, -1);
setcookie('sinH3Nta', null, -1);
setcookie('emP3rsta', null, -1);
setcookie('aleatOLogin', null, -1);
setcookie('tementrapag', null, -1);

session_start();
session_unset();
session_destroy();
header("Location: teste_login.php");
?>