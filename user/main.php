<?php
include("../main/lib/php/include.php");

$GLOBALS['erro'] = 0;

if ($func->verificarLogado()) {
    $cookieToken = $_COOKIE["logado"];

    if ($id = $user->getUserID_byToken($cookieToken)) {
        $user_token = $user->getUserToken_byID($id);

        if ($user_token == -1 || strcmp($user_token, $cookieToken) || !$userToken->validToken($user_token)) {
            $GLOBALS['erro'] = 1;
        } else {
            $GLOBALS['userNome'] = $user->getUserName_byToken($user_token);
            $func->setarCookie("autenticado", 1, 1);

            // Verifica se já escolheu o objetivo
            if ($user->getUserObjective_byID($id) === -1) {
                $redirectUrl = urlencode("objetivo.php");
                header("Location: $redirectUrl");
                exit();
            }

            echo '<script>var userName = "' . $GLOBALS['userNome'] . '"</script>';
        }
    } else {
        $GLOBALS['erro'] = 1;
    }
} else {

    $GLOBALS['erro'] = 1;
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    if (isset($GLOBALS['userNome'])) {
        echo "<title>" . $GLOBALS['userNome'] . " • OlympiaWorkout</title>";
    } else {
        echo "<title>OlympiaWorkout: Promovendo Saúde e Bem-Estar</title>";
    }
    ?>
    <script src="../main/lib/js/main.js" defer></script>
    <script src="./lib/js/mainUser.js" defer></script>
    <link rel="stylesheet" href="../main/lib/css/universal.css">
    <link rel="stylesheet" href="../main/lib/images/bootstrap-icons-1.10.4/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./lib/css/main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body style="background-color:#1d1c1a;">
    <!-- Inicio header/navbar -->
    <header class="header container-fluid bg-laranja fixed-top" id="header">
        <div class="row">
            <div class="col-3 pt-1 d-flex ps-5 align-items-center">
                <div class="col-6">
                    <h1 class="fs-4 text-white" id="title">OlympiaWorkout</h1>
                </div>
            </div>
            <div class="col-4 d-flex align-items-center">
                <form action="#" method="get">
                    <div class="input-group rounded" id="pesquisa-div">
                        <span class="input-group-text" id="pesquisa-icon"><i class="bi bi-search"></i></span>
                        <input type="text" class="form-control" id="pesquisa" name="pesquisa" autocomplete="off" placeholder="Pesquisar exercícios, dietas, pessoas...">
                    </div>
                </form>
            </div>
            <div class="col-5">
                <nav class="navbar navbar-expand-md navbar-light">
                    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon text-white" style="filter: invert(1);"></span>
                    </button>
                    <div class="collapse navbar-collapse">
                        <ul class="navbar-nav">
                            <li class="nav-item nav-item-hover mx-2 rounded">
                                <a href="#" class="nav-link text-white active bolder">Inicio</a>
                            </li>
                            <li class="nav-item nav-item-hover mx-2 rounded">
                                <a href="#contact" id="contact" class="nav-link text-white">Exercícios</a>
                            </li>
                            <li class="nav-item nav-item-hover mx-2 rounded">
                                <a href="#contact" id="contact" class="nav-link text-white">Dieta</a>
                            </li>
                            <li class="nav-item nav-item-hover mx-2 rounded">
                                <a href="#" class="nav-link text-white">Relatórios</a>
                            </li>
                            <li class="nav-item mx-2 not-hover" style="border-left: 1px solid white;">
                                <?php
                                if (isset($GLOBALS['userNome'])) {
                                    echo '<ul class="navbar-nav d-md-block d-none ms-3">
                                        <li class="nav-item dropdown">
                                            <a href="#" id="profile" class="nav-link text-white d-flex align-items-center nav-link dropdown-toggle" data-bs-toggle="dropdown">
                                                ' . $GLOBALS["userNome"] . '
                                            </a>
                                            <div class="dropdown-menu p-0" id="dropdown-menu" style="width:200px;background-color:var(--azul-complementar);">
                                                <a class="dropdown-item dropdown-item-hover text-light py-2" href="#"><i class="bi bi-person-circle me-2"></i>Perfil</a>
                                                <a class="dropdown-item dropdown-item-hover text-light py-2" href="#"><i class="bi bi-gear-fill me-2"></i>Configurações</a>
                                                <a class="dropdown-item text-white dropdown-item-deslogar py-2" href="./actions/deslogar.php?redirect=../login.php" style="margin-bottom: 0;"><i class="bi bi-power me-2"></i>Deslogar-se</a>
                                            </div>
                                        </li>
                                    </ul>';
                                } else {
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

    <!-- Inicio imagem cabeçalho -->
    <div class="container-fluid text-center d-flex justify-content-center align-items-center" id="image">
        <div class="row">
            <div class="col">
                <h1 class="text-white">OlympiaWorkout: Promovendo Saúde e Bem-Estar!</h1>
            </div>
        </div>
    </div>
    <!-- Fim imagem cabeçalho -->

    <!-- Inicio Container treino -->
    <div class="container-fluid p-4 text-white escuro">
        <!-- Titulo -->
        <div class="row mb-4" style="border-bottom: 1px solid #363330;">
            <h2 class="fs-4">Treino</h2>
        </div>
        <div class="row">
            <!-- Próximo treino -->
            <div class="col-6" style="border-right: 1px solid #363330;">
                <h3 class="fs-5">Próximo Treino</h3>
                <a href="" class="btn btn-azul text-white d-flex">
                    <div class="col-3 align-items-center justify-content-center">
                        <div class="row">
                            <span>{Nome do treino}</span>
                        </div>
                        <div class="row">
                            <span>{Professor}</span>
                        </div>
                    </div>
                    <div class="col-1 align-items-center justify-content-center pt-1 fs-3">
                        <i class="bi bi-caret-right-fill text-center"></i>
                    </div>
                    <div class="col-8 align-items-center justify-content-center">
                        <div class="row">
                            <span>{Tipo do treino}</span>
                        </div>
                        <div class="row">
                            <span>Tempo: Não iniciado</span>
                        </div>
                    </div>
                </a>
            </div>
            <!-- Fim próximo treino -->

            <!-- Histórico diário -->
            <div class="col-6">
                <h3 class="fs-5">Histórico Diario</h3>
                <!-- <a href="" class="btn btn-outline-success text-white d-flex">
                    <div class="col-3 align-items-center justify-content-center">
                        <div class="row">
                            <span>{Nome do treino}</span>
                        </div>
                        <div class="row">
                            <span>{Professor}</span>
                        </div>
                    </div>
                    <div class="col-1 align-items-center justify-content-center pt-1 fs-3">
                        <i class="bi bi-caret-right text-center"></i>
                    </div>
                    <div class="col-8 align-items-center justify-content-center">
                        <div class="row">
                            <span>{Tipo do treino}</span>
                        </div>
                        <div class="row">
                            <span>Tempo: 01:30:52</span>
                        </div>
                    </div>
                </a> -->
                <?php
                if ($func->verificarLogado()) {
                    $userToken = $_COOKIE['logado'];

                    $query = "SELECT exercicios_diarios.nome_treino, exercicios_diarios.foco, exercicios_diarios.tempo_decorrido, users.nome AS professor
                              FROM exercicios_diarios
                              INNER JOIN users ON exercicios_diarios.professor = users.userid
                              WHERE exercicios_diarios.aluno = ?";

                    $userID = $user->getUserID_byToken($userToken);

                    $stmt = mysqli_prepare($db, $query);
                    mysqli_stmt_bind_param($stmt, "s", $userID);
                    mysqli_stmt_execute($stmt);

                    $resultados = mysqli_stmt_get_result($stmt);

                    if (mysqli_num_rows($resultados) > 0) {
                        while ($row = mysqli_fetch_assoc($resultados)) {
                            echo '<a href="" class="btn btn-outline-success text-white d-flex my-2">
                                <div class="col-3 align-items-center justify-content-center">
                                    <div class="row">
                                        <span>' . $row["nome_treino"] . '</span>
                                    </div>
                                    <div class="row">
                                        <span>' . $row["professor"] . '</span>
                                    </div>
                                </div>
                                <div class="col-1 align-items-center justify-content-center pt-1 fs-3">
                                    <i class="bi bi-caret-right text-center"></i>
                                </div>
                                <div class="col-8 align-items-center justify-content-center">
                                    <div class="row">
                                        <span>' . $row["foco"] . '</span>
                                    </div>
                                    <div class="row">
                                        <span>' . $row["tempo_decorrido"] . '</span>
                                    </div>
                                </div>
                            </a>';
                        }
                    } else {
                        echo "<p>Não há treinos registrados hoje!</p>";
                    }
                }

                ?>
            </div>
            <!-- Fim histórico diário -->
        </div>
    </div>
    <!-- Fim container treino -->

    <!-- Inicio container informações gerais -->
    <div class="container-fluid p-4 escuro shadow text-white ">
        <!-- Titulo -->
        <div class="row mb-4" style="border-bottom: 1px solid #363330;">
            <h2 class="fs-4">Estatísticas Gerais</h2>
        </div>
        <div class="row">
            <!-- Inicio publicações recentes -->
            <div class="col-9" style="border-right: 1px solid #363330;">
                <div class="container my-2">
                    <div class="row mb-4" style="border-bottom: 1px solid #363330;">
                        <h3 class="fs-4">Ultimas Postagens</h2>
                    </div>
                    <div class="row">
                        <div class="col">
                            <form action="./actions/post_action.php" method="get">
                                <div class="input-group rounded" id="postagem-div">
                                    <input type="text" class="form-control p-3" id="postagem" name="postagem" autocomplete="off" placeholder="Diga-nos oque está pensando!">
                                    <input type="hidden" name="data" id="data">
                                    <input type="hidden" name="criador" id="criador">
                                    <button type="submit" class="input-group-text" id="postagem-icon"><i class="bi bi-send"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php

                    $query = "SELECT posts.*, users.imagem 
                            FROM posts 
                            INNER JOIN users ON posts.user = users.nome 
                            ORDER BY posts.postid DESC 
                            LIMIT 3";

                    $stmt = mysqli_prepare($db, $query);
                    mysqli_stmt_execute($stmt);
                    $resultado = mysqli_stmt_get_result($stmt);

                    $count = 0;

                    if (mysqli_num_rows($resultado) > 0) {
                        while ($rows = mysqli_fetch_assoc($resultado)) {
                            $imagemUsuario = $rows['imagem'];

                            echo '<div class="row mt-4 p-4 rounded bg-escuro-secundario" style="outline:1px solid #363330;">
                                <div class="col">
                                    <div class="row">
                                        <div class="col-1">
                                            <img src="data:image/jpeg;base64,' . base64_encode($imagemUsuario) . '" style="height:65px; width:65px;border-radius:50%;">
                                        </div>
                                        <div class="col-11">
                                            <div class="row"><span>' . $rows['user'] . '</span></div>
                                            <div class="row"><span>' . $rows['data'] . '</span></div>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <p>' . $rows['content'] . '</p>
                                    </div>
                                </div>
                            </div>';

                            $count++;
                            if ($count >= 3) {
                                break;
                            }
                        }

                        echo '<div class="row mt-4 p-4 rounded">
                            <div class="col">
                                <div class="row">
                                    <a href="#" class="btn btn-azul text-white">Veja mais publicações</a>
                                </div>
                            </div>
                        </div>';
                    } else {
                        echo "Não existem postagens recentes!";
                    }
                    ?>

                </div>
            </div>
            <!-- Fim publicações recentes -->

            <!-- Inicio Tops -->
            <div class="col-3">
                <div class="container my-2">
                    <div class="row mb-4" style="border-bottom: 1px solid #363330;">
                        <h3 class="fs-4">Tops</h2>
                    </div>
                    <div class="row">
                        <div class="col bg-escuro-secundario rounded p-3">
                            <h3 class="fs-5"><i class="bi bi-arrow-right me-2"></i>Top Diario</h3>
                            <table class="table-dark table-striped table text-center">
                                <tr>
                                    <th>Classificação</th>
                                    <th>Usuário</th>
                                    <th>Tempo diário</th>
                                </tr>
                                <?php
                                $query = "SELECT aluno, tempo_decorrido FROM exercicios_diarios ORDER BY tempo_decorrido DESC LIMIT 3";

                                $stmt = mysqli_prepare($db, $query);
                                mysqli_stmt_execute($stmt);

                                $resultados = mysqli_stmt_get_result($stmt);

                                $contador = 0;

                                while ($row = mysqli_fetch_assoc($resultados)) {
                                    $query_users = "SELECT nome FROM users WHERE userid = ?";

                                    $stmt_users = mysqli_prepare($db, $query_users);
                                    mysqli_stmt_bind_param($stmt_users, "s", $row['aluno']);
                                    mysqli_stmt_execute($stmt_users);

                                    $resultados_users = mysqli_stmt_get_result($stmt_users);
                                    $resultado = mysqli_fetch_assoc($resultados_users);

                                    $contador++;
                                ?>
                                    <tr>
                                        <th><?php echo $contador ?></th>
                                        <td><?php echo $resultado['nome'] ?></td>
                                        <td><?php echo $row['tempo_decorrido'] ?></td>
                                    </tr>

                                <?php
                                }

                                ?>

                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col bg-escuro-secundario p-3">
                            <h3 class="fs-5"><i class="bi bi-arrow-right me-2"></i>Top Semanal</h3>
                            <table class="table-dark table-striped table text-center">
                                <tr>
                                    <th>{posição}</th>
                                    <th>{nome}</th>
                                    <th>{tempo diario}</th>
                                </tr>
                                <tr>
                                    <th>1</th>
                                    <td>Victor</td>
                                    <td>10 minutos</td>
                                </tr>
                                <tr>
                                    <th>2</th>
                                    <td>Kauê</td>
                                    <td>12 minutos</td>
                                </tr>
                                <tr>
                                    <th>...</th>
                                    <td>...</td>
                                    <td>...</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col bg-escuro-secundario p-3">
                            <h3 class="fs-5"><i class="bi bi-arrow-right me-2"></i>Top Mensal</h3>
                            <table class="table-dark table-striped table text-center">
                                <tr>
                                    <th>{posição}</th>
                                    <th>{nome}</th>
                                    <th>{tempo diario}</th>
                                </tr>
                                <tr>
                                    <th>1</th>
                                    <td>Victor</td>
                                    <td>10 minutos</td>
                                </tr>
                                <tr>
                                    <th>2</th>
                                    <td>Kauê</td>
                                    <td>12 minutos</td>
                                </tr>
                                <tr>
                                    <th>...</th>
                                    <td>...</td>
                                    <td>...</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Fim tops -->
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center">
        <div class="container pt-5">
            <div class="row">
                <div class="col-3 d-flex flex-column">
                    <span>Logo</span>
                    <span>Telefone</span>
                    <span>Email</span>
                </div>
                <div class="col-3 d-flex">
                    <ul>
                        <li>Atalho 1</li>
                        <li>Atalho 2</li>
                        <li>Atalho 3</li>
                        <li>Atalho 4</li>
                    </ul>
                </div>
                <div class="col-3 d-flex">
                    <ul>
                        <li>Atalho 5</li>
                        <li>Atalho 6</li>
                        <li>Atalho 7</li>
                        <li>Atalho 8</li>
                    </ul>
                </div>
                <div class="col-3 d-flex">
                    Redes sociais
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12">
                    <p>&copy; <span id="data">{data}</span> OlympiaWorkout. Todos os direitos reservados.</p>
                </div>
            </div>
        </div>
    </footer>
    <!-- Fim footer -->

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

<?php
if ($GLOBALS['erro']) {
    $func->setarCookie("autenticado", 0, 0);
    $func->showAlert("Sessão expirada!", "Sua sessão foi encerrada. Para acessar sua conta, por favor faça login novamente.", "Continuar", "", "./actions/deslogar.php?redirect=../login.php");
}
?>