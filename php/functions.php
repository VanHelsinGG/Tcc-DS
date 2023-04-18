<?php
    // Cria um cookie
    function setarCookie($nome,$valor,$tempo){
        setcookie($nome,$valor,converterTempoDias($tempo),"/",$_SERVER['HTTP_HOST'],false,false);
    }

    // Converte o tempo inserido para dias. $tempo = 1 == 1 dia.
    function converterTempoDias($tempo){
        return time() + ($tempo * 24 * 60 * 60);
    }

    function verificarLogado(){
        return ((isset($_COOKIE['logado']) && $_COOKIE['logado'])) ? true : false;
    }
?>