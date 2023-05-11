<?php

// Cria um cookie

function setarCookie($nome, $valor, $tempo)
{
    setcookie($nome, $valor, converterTempoDias($tempo), "/", $_SERVER['HTTP_HOST'], true, true);
}

// Converte o tempo inserido para dias. $tempo = 1 == 1 dia.
function converterTempoDias($tempo)
{
    return time() + ($tempo * 24 * 60 * 60);
}

function verificarLogado()
{
    return ((isset($_COOKIE['logado']) && $_COOKIE['logado'])) ? true : false;
}

function generateRandomToken()
{
    include("connector.php");
    // Gerar um salt aleatório de 32 bytes
    $salt = bin2hex(random_bytes(16));

    // Definir a chave secreta
    $secret_key = 'schadenfreude';

    // Obter o endereço IP do usuário
    $ip_address = $_SERVER['REMOTE_ADDR'];

    // Definir o tempo de expiração em 30 minutos
    $expiry_time = converterTempoDias(1);

    // Concatenar o salt, endereço IP e tempo de expiração
    $token_data = $salt . $ip_address;

    // Gerar o hash usando SHA-256
    $token = hash('sha256', $secret_key . $token_data);

    // Adicionar o salt e o tempo de expiração ao token
    $token .= ':' . $salt . ':' . $expiry_time;

    return $token;
}

function generateTokenWithSalt($salt)
{
    // Definir a chave secreta
    $secret_key = 'schadenfreude';

    // Obter o endereço IP do usuário
    $ip_address = $_SERVER['REMOTE_ADDR'];

    // Definir o tempo de expiração em 30 minutos
    $expiry_time = converterTempoDias(1);

    // Concatenar o salt, endereço IP e tempo de expiração
    $token_data = $salt . $ip_address;

    // Gerar o hash usando SHA-256
    $token = hash('sha256', $secret_key . $token_data);

    // Adicionar o salt e o tempo de expiração ao token
    $token .= ':' . $salt . ':' . $expiry_time;

    // Retornar o token
    return $token;
}

function getTokenSalt($token){
    $token_partes = explode(":",$token);
    return $token_partes[1];
}

function getTokenExpiration($token){
    $token_partes = explode(":",$token);
    $expiration = $token_partes[2];
    return $expiration;
}

function validToken($token){
    $expiration = getTokenExpiration($token);

    if(time()  > $expiration){
        return 0;
    }else {
        return 1;
    }
}

function getUserID_byName($nome){
    include ("connector.php");

    $query = "SELECT * FROM users WHERE nome = ?";
    $stmt = mysqli_prepare($db, $query);
    mysqli_stmt_bind_param($stmt, "s", $nome);
    mysqli_stmt_execute($stmt);

    $resultados = mysqli_stmt_get_result($stmt);

    if(mysqli_num_rows($resultados) > 0){
        $row = mysqli_fetch_assoc($resultados);
        return $row["userid"];
    }
    return -1;
}

function getUserName_byID($id){
    include ("connector.php");

    $query = "SELECT * FROM users WHERE userid = ?";
    $stmt = mysqli_prepare($db, $query);
    mysqli_stmt_bind_param($stmt, "s", $id);
    mysqli_stmt_execute($stmt);

    $resultados = mysqli_stmt_get_result($stmt);

    if(mysqli_num_rows($resultados) > 0){
        $row = mysqli_fetch_assoc($resultados);
        return $row["nome"];
    }
    return -1;
}