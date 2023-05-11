<?php
    include ("./php/connector.php");
    include ("./php/functions.php");

    $func->setarCookie("logado",0,0);

    $redirectUrl = urlencode("index.php");
    header("Location: $redirectUrl");
?>