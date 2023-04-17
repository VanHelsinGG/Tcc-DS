<?php
    function setarCookie($nome,$valor,$tempo){
        setcookie($nome,$valor,converterTempoDias($tempo),"/",$_SERVER['HTTP_HOST'],false,false);
    }

    function converterTempoDias($tempo){
        return time() + ($tempo * 24 * 60 * 60);
    }

?>