<?php
include("../../main/lib/php/include.php");

$func->setarCookie("logado", 0, 0);
$func->setarCookie("autenticado", 0, 0);

header("Location: ../index.php");
