<?php
ini_set('session.gc_maxlifetime', 86400);

// Variaveis do banco
$hostname = "localhost";
$user = "root";
$password = "";
$database = "db_olympiaworkout";

// Conecção
$db = mysqli_connect($hostname, $user, $password, $database);

// Tratamento de erros
if (mysqli_connect_errno()) {
    echo "MYSQL Error: " . mysqli_connect_error();
}
    /* BANCO 
CREATE TABLE `users` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `sexo` char(1) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 0,
  `peso` decimal(4,2) DEFAULT 0.00,
  `altura` decimal(3,2) DEFAULT 0.00,
  `data_criacao` datetime NOT NULL,
  `ip` varchar(20) NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


    CREATE DATABASE `db_olympiaworkout` */
