CREATE TABLE `exercicios_diarios` (
  `idexercicios_diarios` int(11) NOT NULL AUTO_INCREMENT,
  `nome_treino` varchar(45) NOT NULL,
  `professor` int(11) NOT NULL,
  `aluno` int(11) NOT NULL,
  `foco` varchar(45) NOT NULL,
  `tempo_decorrido` time NOT NULL,
  `exclusao` date DEFAULT NULL,
  PRIMARY KEY (`idexercicios_diarios`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `posts` (
  `postid` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(90) NOT NULL,
  `content` varchar(120) NOT NULL,
  `data` datetime NOT NULL,
  PRIMARY KEY (`postid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `treinos` (
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
  PRIMARY KEY (`idtreino`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `token` varchar(120) NOT NULL DEFAULT '-1',
  `objetivo` int(11) NOT NULL DEFAULT -1,
  `imagem` longblob NOT NULL,
  `idtreinoativo` int(11) DEFAULT -1,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
