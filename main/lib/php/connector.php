<?php

// Variaveis do banco
$hostname = "localhost";
$user = "root";
$password = "";
$database = "db_olympiaworkout";

// Conexão
$db = mysqli_connect($hostname, $user, $password, $database);

// Tratamento de erros
if (mysqli_connect_errno()) {
    echo "MYSQL Error: " . mysqli_connect_error();
}
