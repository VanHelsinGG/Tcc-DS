<?php
include("../main/lib/php/include.php");

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    if (isset($_GET['treinoid'])) {
        echo "<title>Treino • " . $training->getTrainingsTrated($_GET['treinoid'], $_GET['treino']) . " • OlympiaWorkout</title>";
    } else {
        echo "<title>OlympiaWorkout: Promovendo Saúde e Bem-Estar</title>";
    }
    ?>
    <link rel="stylesheet" href="../main/lib/css/universal.css">
    <link rel="stylesheet" href="../main/lib/images/bootstrap-icons-1.10.4/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./lib/css/main.css">
    <link rel="stylesheet" href="./lib/css/treino.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../main/lib/js/main.js" defer></script>
    <script src="lib/js/mainUser.js" defer></script>
    <script src="./lib/js/treinos.js" defer></script>
</head>

<body class="bg-escuro-principal">
    <header class="container-fluid d-md-none d-block bg-laranja p-2">
        <div class="row">
            <div class="col-12 p-2 text-center">
                <h1 class="text-white">OlympiaWorkout</h1>
            </div>
        </div>
    </header>

    <!-- Inicio header/navbar -->
    <header class="header container-fluid bg-laranja" id="header">
        <div class="row">
            <div class="col-3 pt-1 d-flex ps-5 align-items-center">
                <div class="col-6">
                    <h1 class="fs-4 text-white" id="title">OlympiaWorkout</h1>
                </div>
            </div>
            <div class="col-3 align-items-center d-md-flex d-none">
                <form action="#" method="get">
                    <div class="input-group rounded" id="pesquisa-div">
                        <span class="input-group-text" id="pesquisa-icon"><i class="bi bi-search"></i></span>
                        <input type="text" class="form-control" id="pesquisa" name="pesquisa" autocomplete="off" placeholder="Pesquisar exercícios, dietas, pessoas...">
                    </div>
                </form>
            </div>
            <div class="col-6 d-flex justify-content-end pe-2">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon text-white" style="filter: invert(1);"></span>
                    </button>
                    <div class="collapse navbar-collapse">
                        <ul class="navbar-nav">
                            <li class="active nav-item nav-item-hover mx-2 rounded">
                                <a href="main.php" class="nav-link text-white active bolder">Inicio</a>
                            </li>
                            <li class="nav-item nav-item-hover mx-2 rounded">
                                <a href="#contact" id="contact" class="nav-link text-white">Exercícios</a>
                            </li>
                            <li class="nav-item nav-item-hover mx-2 rounded">
                                <a href="posts.php" class="nav-link text-white">Postagens</a>
                            </li>
                            <li class="nav-item nav-item-hover mx-2 rounded">
                                <ul class="navbar-nav d-flex align-items center justify-content-center">
                                    <li class="nav-item dropdown">
                                        <a href="#" class="nav-link text-white d-flex align-items-center nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="bi bi-boxes me-2"></i>Utilitários</a>
                                        <div class="dropdown-menu p-0" id="dropdown-menu" style="width:200px;background-color:var(--laranja-secundario);">
                                            <a href="./imc/index.php?return=1" class="dropdown-item dropdown-item-hover text-white py-2"><i class="bi bi-calculator-fill me-2"></i>Calculadora IMC</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item mx-2 not-hover" style="border-left: 1px solid white;">
                                <?php
                                // Verifica se a variável $GLOBALS['userNome'] está definida
                                if (isset($_SESSION['nome'])) {
                                    // Exibe o menu para usuários logados
                                    echo '<ul class="navbar-nav ms-3 d-flex align-items-center justify-content-center">';
                                    // Verifica se o usuário possui acesso de professor
                                    if ($user->getUserAccess_byName($_SESSION['nome']) > 0) {
                                        // Exibe o link para o painel do professor
                                        echo '<li class="nav-item">
                                                <a class="painel btn btn-outline-light me-2" href="../professor/dashboard/dashboard.php">Professor</a>
                                            </li>';
                                    }
                                    // Exibe o menu dropdown com o nome do usuário logado
                                    echo '<li class="nav-item dropdown">
                                            <a href="#" id="profile" class="nav-link text-white d-flex align-items-center nav-link dropdown-toggle" data-bs-toggle="dropdown">
                                                ' . $_SESSION['nome'] . '
                                            </a>
                                            <div class="dropdown-menu p-0" id="dropdown-menu" style="width:200px;background-color:var(--azul-complementar);">
                                                <a class="dropdown-item dropdown-item-hover text-light py-2" href="#"><i class="bi bi-person-circle me-2"></i>Perfil</a>
                                                <a class="dropdown-item dropdown-item-hover text-light py-2" href="#"><i class="bi bi-gear-fill me-2"></i>Configurações</a>
                                                <a class="dropdown-item text-white dropdown-item-deslogar py-2" href="./actions/deslogar.php?redirect=../login.php" style="margin-bottom: 0;"><i class="bi bi-power me-2"></i>Deslogar-se</a>
                                            </div>
                                        </li>
                                    </ul>';
                                } else {
                                    // Exibe o menu para usuários não logados
                                    echo '<ul class="navbar-nav d-md-block d-none ms-3">
                                        <li class="nav-item">
                                            <a href="login.php" id="profile" class="nav-link text-white d-flex align-items-center nav-link">
                                                Conectar-se
                                            </a>
                                        </li>
                                    </ul>';
                                }
                                ?>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </header>
    <!-- Fim header/navbar -->
    <div class="container p-4 rounded mt-4 shadow bg-escuro-secundario container-treino">
        <div class="row">

            <?php
            $exercicios = $training->getExercisesTrated($_GET['treinoid'], $_GET['treino']);
            foreach ($exercicios as $e => $ee) {
                $series = $training->getSeriesTrated($_GET['treinoid'], $_GET['treino'], $e);

                echo '<div class="col-md-4 col-12 p-2">
            <div class="card bg-escuro-terciario shadow">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                    <i class="bi bi-caret-down fs-3"></i><h5 class="mt-2 ms-2 card-title">' . $ee .'</h5>                   
                    </div>
                    <table class="table table-striped d-none text-center">
                        <thead>
                            <tr class="w-100">
                                <th>Série</th>
                                <th>Repetições</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>';
                foreach ($series as $s => $se) {
                    echo '<tr class="w-100">
                <td>' . ($s + 1) . '</td>
                <td>' . $se . '</td>
                <td><a class="btn btn-outline-primary w-100 finalizar-serie">Finalizar</a></td>
              </tr>';
                }
                echo '</tbody>
        </table>
        <div class="d-flex justify-content-between">
            <a class="btn btn-outline-warning pular-exercicio d-none w-100 d-flex align-items-center justify-content-center">Pular Exercício</a>
            <a class="btn btn-outline-success completar-exercicio d-none w-100 ms-1 text-center d-flex align-items-center justify-content-center">Completar Exercício</a>
        </div>    
    </div></div></div>';
            }
            ?>

        </div>
    </div>

    <!-- Barra Footer -->
    <div class="container-fluid fixed-bottom p-4 bg-escuro-secundario">
        <div class="row">
            <div class="col-4 d-flex align-items-center ps-4">
                <span class="me-2 d-none d-md-block">Tempo decorrido</span>
                <div class="bg-white p-2 rounded" id="tempo-decorrido">
                    <span class="text-black" id="hour">00 :</span>
                    <span class="text-black" id="minute">00 :</span>
                    <span class="text-black" id="secound">00</span>
                </div>
            </div>
            <div class="col-4 d-flex align-items-center justify-content-center pe-4">
                <?php
                    $trainingName = $training->getTrainingName($_GET['treinoid']);
                    $trainingFocus = $training->getTrainingFocus($_GET['treinoid']);
                    $trainingFocus = $training->deStrcatFocus($trainingFocus,$_GET['treino']);

                    echo '<span>'.$trainingName.' - '. $trainingFocus .'</span>';
                ?>
            </div>
            <div class="col-4 d-flex justify-content-end pe-4">
                <a href="" class="btn btn-success">Encerrar Treino</a>
            </div>
        </div>
    </div>
    <!-- Aviso de uso de cookies -->
    <div id="aviso-cookies" class="alert alert-info fixed-bottom mb-0 rounded-0 text-dark" style="display: none;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <p class="text-dark">Este site utiliza cookies para melhorar a sua experiência de navegação. Ao
                        continuar
                        navegando, você concorda com o uso de cookies.</p>
                </div>
                <div class="col-md-4 text-end">
                    <button id="aceitar-cookies" class="btn btn-primary" onclick="aceitarCookies();">Aceitar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>