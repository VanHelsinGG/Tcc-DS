<?php
    include('./php/connector.php');

    $email = $_POST['email'];
    $senha =  $_POST['senha'];
    $hashedSenha = hash('sha256', $senha);

    $query = "SELECT * FROM users WHERE email = '$email'";
    $resultado = mysqli_query($db,$query);

    if(mysqli_num_rows($resultado) > 0){
        $rows = mysqli_fetch_assoc($resultado);

        echo $rows['senha'] ."<br>";
        echo $hashedSenha;
        if($hashedSenha === $rows['senha']){
            echo "conectado";

        } else {
            $referer = strtok($_SERVER['HTTP_REFERER'], '?'); 
            header("Location: $referer?usererror=1");
            exit;
        }

    } else {
        $referer = strtok($_SERVER['HTTP_REFERER'], '?'); 
        header("Location: $referer?usererror=1");
        exit;
    }
?>
