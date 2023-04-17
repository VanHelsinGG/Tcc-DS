<?php
    session_start();
    include ("./php/connector.php");
    include ("./php/functions.php");

    setarCookie("logado",0,0);

    header("Location: index.php");
    session_destroy();
?>