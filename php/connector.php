<?php 
    ini_set('session.gc_maxlifetime', 86400);
    
    // Variaveis do banco
    $hostname = "localhost";
    $user = "root";
    $password = "";
    $database = "db_olympiaworkout";

    // Conecção
    $db = mysqli_connect($hostname,$user,$password,$database);

    // Tratamento de erros
    if(mysqli_connect_errno()){
        echo "MYSQL Error: " . mysqli_connect_error();
    }
    /* BANCO 
    CREATE TABLE `users` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `sexo` char(1) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 0,
  `peso` decimal(4,2) DEFAULT 0.00,
  `altura` decimal(3,2) DEFAULT 0.00,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

    CREATE DATABASE `db_olympiaworkout` */


?>