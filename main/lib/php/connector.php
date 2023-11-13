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
    die();
}

$query = "

  CREATE TABLE IF NOT EXISTS `treinos_concluidos`(
    `idtreinoconcluido` int(11) NOT NULL AUTO_INCREMENT,
    `treino` int(11) NOT NULL,
    `foco` int(11) NOT NULL,
    `tempoDecorrido` time NOT NULL,
    `dataConclusao` date NOT NULL,
    PRIMARY KEY (`idtreinoconcluido`)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

  CREATE TABLE IF NOT EXISTS `treinos_andamento`(
    `idtreino` int(11) NOT NULL,
    `dataInicio` date NOT NULL,
    `foco` int(11) NOT NULL,
    `tempoDecorrido` time NOT NULL,
    PRIMARY KEY (`idtreino`)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

  CREATE TABLE IF NOT EXISTS `exercicios` (
    `idexercicio` int(11) NOT NULL AUTO_INCREMENT,
    `nomeExercicio` varchar(90) NOT NULL,
    `grupoMuscular` varchar(45) NOT NULL,
    `exercicio` longblob NOT NULL,
    PRIMARY KEY (`idexercicio`)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

  CREATE TABLE IF NOT EXISTS `configs` (
    `idconfigs` int(11) NOT NULL AUTO_INCREMENT,
    `prox_att_semanal` date NOT NULL,
    PRIMARY KEY (`idconfigs`)
  ) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

  CREATE TABLE IF NOT EXISTS `posts` (
    `postid` int(11) NOT NULL AUTO_INCREMENT,
    `user` varchar(90) NOT NULL,
    `content` varchar(120) NOT NULL,
    `data` datetime NOT NULL,
    PRIMARY KEY (`postid`)
  ) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

  CREATE TABLE IF NOT EXISTS `treinos` (
    `idtreino` int(11) NOT NULL AUTO_INCREMENT,
    `aluno` int(11) NOT NULL,
    `professor` int(11) NOT NULL,
    `nome` varchar(45) NOT NULL,
    `foco` varchar(45) NOT NULL,
    `duracao` int(11) NOT NULL,
    `exercicios` varchar(900) NOT NULL,
    `series` varchar(120) NOT NULL,
    `observacoes` varchar(255) NOT NULL,
    `vezes_feito` int(11) DEFAULT 0,
    `proximo_treino` int(11) DEFAULT 0,
    `status` int(11) DEFAULT 0,
    PRIMARY KEY (`idtreino`)
  ) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

  CREATE TABLE IF NOT EXISTS `users` (
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
    `token` varchar(120) NOT NULL DEFAULT '-1',
    `objetivo` int(11) NOT NULL DEFAULT -1,
    `imagem` longblob NOT NULL,
    `idtreinoativo` int(11) DEFAULT -1,
    `tempo_semanal` time DEFAULT '00:00:00',
    `tempo_mensal` time DEFAULT '00:00:00',
    PRIMARY KEY (`userid`)
  ) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


  CREATE TABLE IF NOT EXISTS `requisicoes_treino` (
    `requisicaoid` int(11) NOT NULL AUTO_INCREMENT,
    `user` int(11) NOT NULL,
    `professor` int(11) DEFAULT '-1',
    `data_requisicao` datetime NOT NULL,
    PRIMARY KEY (`requisicaoid`)
  ) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

  ";

// Executa todas as consultas em um único bloco
if (mysqli_multi_query($db, $query)) {
    // Lê cada resultado (pode haver mensagens de erro)
    do {
        if ($result = mysqli_store_result($db)) {
            mysqli_free_result($result);
        }
    } while (mysqli_next_result($db));
} else {
    echo "Erro: " . mysqli_error($db);
}