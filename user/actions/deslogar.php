<?php
include("../../main/lib/php/include.php");
$redirectUrl = $_GET['redirect'];

$func->setarCookie("logado", 0, 0);
$func->setarCookie("autenticado", 0, 0);

header("Location: $redirectUrl");
exit();