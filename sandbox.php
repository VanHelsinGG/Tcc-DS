<?php 
    include("./php/functions.php");

    $token = $user->getUserToken_byName("Victor");
    
    $func->setarCookie("a", "adbae951de34377f0d3bf052c794732a8e4b81d1550d8adb897a8e42ce13aa2b:ba64f8e33e23eda7646244a702034607:1683901911", 1);
    echo $_COOKIE["a"]; 
    echo "<br>"; 
    echo $token;
    echo "<br>";
    if($userToken->validToken($token)){
      echo "1";
    }else{echo "0";}
?>