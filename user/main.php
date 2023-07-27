<?php
    include("../main/lib/php/include.php");
    if(isset($_SESSION["id"])){
        echo "<script>var userid =". $_SESSION['id']."</script>";
    }

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    if (isset($_SESSION['nome'])) {
        echo "<title>" . $_SESSION['nome'] . " • OlympiaWorkout</title>";
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
            <div class="col-3 d-flex align-items-center">
                <form action="#" method="get">
                    <div class="input-group rounded" id="pesquisa-div">
                        <span class="input-group-text" id="pesquisa-icon"><i class="bi bi-search"></i></span>
                        <input type="text" class="form-control" id="pesquisa" name="pesquisa" autocomplete="off" placeholder="Pesquisar exercícios, dietas, pessoas...">
                    </div>
                </form>
            </div>
            <div class="col-6 d-flex justify-content-end pe-2">
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
                                // Verifica se a variável $GLOBALS['userNome'] está definida
                                if (isset($_SESSION['nome'])) {
                                    // Exibe o menu para usuários logados
                                    echo '<ul class="navbar-nav ms-3 d-flex align-items-center justify-content-center">';
                                    // Verifica se o usuário possui acesso de professor
                                    if ($user->getUserAccess_byName($_SESSION['nome']) > 0) {
                                        // Exibe o link para o painel do professor
                                        echo '<li class="nav-item">
                                                <a class="painel btn btn-outline-light me-2" href="../professor/dashboard/index.php">Professor</a>
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
                <h3 class="fs-5 pb-2" style="border-bottom: 1px solid #363330;">Próximo Treino</h3>
                <?php
                if ($func->verificarLogado()) {
                    $userToken = $_COOKIE['logado'];
                    $userID = $user->getUserID_byToken($userToken);

                    $query = "SELECT t.*, u.nome AS professor_nome 
                              FROM treinos t 
                              INNER JOIN users u ON t.professor = u.userid 
                              WHERE t.aluno = ?";

                    $stmt = mysqli_prepare($db, $query);
                    mysqli_stmt_bind_param($stmt, "s", $userID);
                    mysqli_stmt_execute($stmt);

                    $resultado = mysqli_stmt_get_result($stmt);

                    if (mysqli_num_rows($resultado) == 0) {
                        echo "<p>Não há treinos cadastrados para você!</p>";
                    } else {
                        $row = mysqli_fetch_assoc($resultado);
                        $proxTreino = $training->deStrcatFocus($row['foco'], $row['proximo_treino']);
                        $treinos = $training->deStrcatFocus_all($row['foco']);
                        $treinoid = $row['idtreino'];
                ?>
                        <form method="get" action="treino.php" class="btn btn-azul text-white d-flex align-items-center justify-content-center" id="form-treino" style="cursor: default;">
                            <?php echo "<input name='treinoid' type='hidden' value='$treinoid'?>"; ?>
                            <div class="col-3">
                                <div class="row">
                                    <span><?php echo $row['nome']; ?></span>
                                </div>
                                <div class="row">
                                    <span><?php echo $row['professor_nome']; ?></span>
                                </div>
                            </div>
                            <div class="col-1 align-items-center justify-content-center pt-1 fs-3">
                                <i class="bi bi-plus-lg text-center"></i>
                            </div>
                            <div class="col-7">
                                <div class="row justify-content-center">
                                    <div class="input-group">
                                        <select id="treino" name="treino" tabindex="-1" class="form-control text-center" style="cursor:pointer;outline: 0; background-color: transparent; color: white; border: 0; border-bottom: 1px solid white; border-radius: 0;">
                                            <?php foreach ($treinos as $t => $tc) {
                                                if (!strcmp($tc, $proxTreino)) {
                                                    echo "<option value='$t' selected class='text-black'>Treino " . ($t + 1) . " - $tc</option>";
                                                } else {
                                                    echo "<option value='$t' class='text-black'>Treino " . ($t + 1) . " - $tc</option>";
                                                }
                                            } ?>
                                        </select>
                                        <div class="input-group-append" style="border-bottom: 1px solid white;">
                                            <span class="input-group-text bg-transparent border-0 text-white">
                                                <i class="bi bi-caret-down-fill"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-1 justify-content-center">
                                    <span><?php echo $row["vezes_feito"] . '/' . $row['duracao']; ?></span>
                                </div>
                            </div>
                            <div class="col-2">
                                <button type="submit" class="btn"><i class="bi bi-play text-white fs-2"></i></button>
                            </div>
                        </form>
                <?php
                    }
                }
                ?>


            </div>
            <!-- Fim próximo treino -->

            <!-- Histórico diário -->
            <div class="col-6">
                <h3 class="fs-5 pb-2" style="border-bottom: 1px solid #363330;">Histórico Diario</h3>
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
                            INNER JOIN users ON posts.user = users.userid 
                            ORDER BY posts.postid DESC 
                            LIMIT 3";

                    $stmt = mysqli_prepare($db, $query);
                    mysqli_stmt_execute($stmt);
                    $resultado = mysqli_stmt_get_result($stmt);

                    $count = 0;

                    if (mysqli_num_rows($resultado) > 0) {
                        while ($rows = mysqli_fetch_assoc($resultado)) {
                            $imagemUsuario = $rows['imagem'];
                            $userNome = $user->getUserName_byID($rows['user']);

                            echo '<div class="row mt-4 p-4 rounded bg-escuro-secundario" style="outline:1px solid #363330;">
                                <div class="col">
                                    <div class="row">
                                        <div class="col-1">
                                            <img src="data:image/jpeg;base64,' . base64_encode($imagemUsuario) . '" style="height:65px; width:65px;border-radius:50%;">
                                        </div>
                                        <div class="col-11">
                                            <div class="row"><span>' . $userNome . '</span></div>
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
                        echo "<p class='text-center mt-5'>Não existem postagens recentes!</p>";
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
                            <h3 class="fs-5 py-2" style="border-bottom: 1px solid #363330;"><i class="bi bi-arrow-right me-2"></i>Top Diario</h3>
                            <table class="table-dark table-striped table text-center">
                                <?php
                                $query = "SELECT aluno, tempo_decorrido FROM exercicios_diarios ORDER BY tempo_decorrido DESC LIMIT 3";

                                $stmt = mysqli_prepare($db, $query);
                                mysqli_stmt_execute($stmt);

                                $resultados = mysqli_stmt_get_result($stmt);

                                if (!mysqli_num_rows($resultados)) {
                                    echo "Não há treinos recentes!";
                                } else {

                                    echo "<tr>
                                            <th>Classificação</th>
                                            <th>Usuário</th>
                                            <th>Tempo diário</th>
                                        </tr>";

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
                                }

                                ?>

                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col bg-escuro-secundario p-3">
                            <h3 class="fs-5 py-2" style="border-bottom: 1px solid #363330;"><i class="bi bi-arrow-right me-2"></i>Top Semanal</h3>
                            <table class="table-dark table-striped table text-center">
                                <?php
                                $query = "SELECT nome, tempo_semanal FROM users ORDER BY tempo_semanal DESC LIMIT 3";

                                $stmt = mysqli_prepare($db, $query);
                                mysqli_stmt_execute($stmt);

                                $resultados = mysqli_stmt_get_result($stmt);

                                if (!mysqli_num_rows($resultados)) {
                                    echo "Não há treinos recentes!";
                                } else {

                                    echo "<tr>
                                            <th>Classificação</th>
                                            <th>Usuário</th>
                                            <th>Tempo</th>
                                        </tr>";

                                    $contador = 0;

                                    while ($row = mysqli_fetch_assoc($resultados)) {
                                        $contador++;
                                ?>
                                        <tr>
                                            <th><?php echo $contador ?></th>
                                            <td><?php echo $row['nome'] ?></td>
                                            <td><?php echo $row['tempo_semanal'] ?></td>
                                        </tr>
                                <?php
                                    }
                                }

                                ?>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col bg-escuro-secundario p-3">
                            <h3 class="fs-5 py-2" style="border-bottom: 1px solid #363330;"><i class="bi bi-arrow-right me-2"></i>Top Mensal</h3>
                            <table class="table-dark table-striped table text-center">
                                <?php
                                $query = "SELECT nome, tempo_mensal FROM users ORDER BY tempo_mensal DESC LIMIT 3";

                                $stmt = mysqli_prepare($db, $query);
                                mysqli_stmt_execute($stmt);

                                $resultados = mysqli_stmt_get_result($stmt);

                                if (!mysqli_num_rows($resultados)) {
                                    echo "Não há treinos recentes!";
                                } else {

                                    echo "<tr>
                                            <th>Classificação</th>
                                            <th>Usuário</th>
                                            <th>Tempo</th>
                                        </tr>";

                                    $contador = 0;

                                    while ($row = mysqli_fetch_assoc($resultados)) {
                                        $contador++;
                                ?>
                                        <tr>
                                            <th><?php echo $contador ?></th>
                                            <td><?php echo $row['nome'] ?></td>
                                            <td><?php echo $row['tempo_mensal'] ?></td>
                                        </tr>
                                <?php
                                    }
                                }

                                ?>
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
session_abort();

?>