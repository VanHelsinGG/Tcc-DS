<?php
    include ("./php/connector.php");
    include ("./php/functions.php");

    setarCookie("logado",0,0);

    $redirectUrl = urlencode("index.php");
    header("Location: $redirectUrl");
?>