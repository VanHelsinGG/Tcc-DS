<?php
include("../main/lib/php/include.php");

$func->preload();

if (isset($_SESSION["id"])) {
    echo "<script>var userid =" . $_SESSION['id'] . "</script>";
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
    <link rel="stylesheet" href="../main/lib/css/universal.css">
    <link rel="stylesheet" href="../main/lib/images/bootstrap-icons-1.10.4/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./lib/css/main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../main/lib/js/main.js" defer></script>
    <script src="lib/js/mainUser.js" defer></script>
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
            <div class="col-3 align-items-center d-md-flex d-none">
                <form action="#" method="get">
                    <div class="input-group rounded" id="pesquisa-div">
                        <span class="input-group-text" id="pesquisa-icon"><i class="bi bi-search"></i></span>
                        <input type="text" class="form-control" id="pesquisa" name="pesquisa" autocomplete="off"
                            placeholder="Pesquisar exercícios, dietas, pessoas...">
                    </div>
                </form>
            </div>
            <div class="col-6 d-flex justify-content-end pe-2">
            <nav class="navbar navbar-expand-lg navbar-light">
                    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon text-white" style="filter: invert(1);"></span>
                    </button>
                    <div class="collapse navbar-collapse">
                        <ul class="navbar-nav">
                            <li class="nav-item nav-item-hover mx-2 rounded">
                                <a href="main.php" class="nav-link text-white active bolder">Inicio</a>
                            </li>
                            <li class="nav-item nav-item-hover mx-2 rounded">
                                <a href="#contact" id="contact" class="nav-link text-white">Exercícios</a>
                            </li>
                            <li class="active nav-item nav-item-hover mx-2 rounded">
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

    <div class="container-fluid text-center d-flex justify-content-center align-items-center" id="image">
        <div class="row">
            <div class="col">
                <h1 class="text-white">OlympiaWorkout - Postagens</h1>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row my-2">
            <div class="col w-100">
                <form action="./actions/post_action.php?return=posts.php" method="get" class="w-50 mx-auto">
                    <div class="input-group rounded" id="postagem-div">
                        <input type="text" class="form-control p-3" id="postagem" name="postagem"
                            autocomplete="off" placeholder="Diga-nos oque está pensando!">
                        <input type="hidden" name="data" id="data">
                        <input type="hidden" name="criador" id="criador">
                        <button type="submit" class="input-group-text" id="postagem-icon"><i
                            class="bi bi-send"></i></button>
                    </div>
                </form>
            </div>
        </div>
        <?php

            $query = "SELECT posts.*, users.imagem 
            FROM posts 
            INNER JOIN users ON posts.user = users.userid 
            ORDER BY posts.postid DESC";

            $stmt = mysqli_prepare($db, $query);
            mysqli_stmt_execute($stmt);
            $resultado = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($resultado) > 0) {
                while ($rows = mysqli_fetch_assoc($resultado)) {
                            $imagemUsuario = $rows['imagem'];
                            $userNome = $user->getUserName_byID($rows['user']);

                            // $mensagemCensurada = $func->verificarPalavrao($rows['content']);
                    
                            echo '<div class="row mt-4 p-4 rounded bg-escuro" style="outline:1px solid #363330;">
                                <div class="col">
                                    <div class="row">
                                        <div class="col-1 d-md-block d-none">
                                            <img src="data:image/jpeg;base64,' . base64_encode($imagemUsuario) . '" style="height:65px; width:65px;border-radius:50%;">
                                        </div>
                                        <div class="col-11">
                                            <div class="row">
                                                <div class="col-11">
                                                    <span>' . $userNome . '</span>
                                                </div>
                                                <div class="col-1">
                                                    <a href="#" class="btn"><i class="bi bi-exclamation-triangle text-white"></i></a>
                                                </div>
                                            </div>
                                            <div class="row"><span>' . $rows['data'] . '</span></div>
                                            <input type="hidden" value="' . $rows['postid'] . '">
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <p>' . $rows['content'] . '</p>
                                    </div>
                                </div>
                            </div>';

                        }

                    } else {
                        echo "<p class='text-center mt-5'>Não existem postagens recentes!</p>";
                    }
                    ?>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center">
        <div class="container pt-5">
            <div class="row">
                <div class="col-lg-4 col-12 d-flex flex-column" style="border-right:1px solid #979090;">
                    <h5>Contato</h5>
                    <span>Telefone: +55 (17) 99657-5631</span>
                    <span>Email: olympiaworkout@gmail.com</span>
                </div>
                <div class="col-lg-4 col-12 mt-md-0 mt-4">
                    <h5 class="d-md-none d-block text-center">Links uteis</h5>
                    <ul>
                        <li class="footer-li"><a class="footer-a" href="about.html">Sobre Nós</a></li>
                        <li class="footer-li"><a class="footer-a" href="team.html">Nossa Equipe</a></li>
                        <li class="footer-li">Atalho 3</li>
                        <li class="footer-li">Atalho 4</li>
                    </ul>
                </div>
                <div class="col-lg-4 col-12">
                    <h5>Nossas redes sociais</h5>
                    <a class="footer-a fs-4 mx-1" href="https://instagram.com/olympia_workout?igshid=MzRIODBiNWFlZA"><i
                            class="bi bi-instagram"></i></a>
                    <a href="https://w.app/OlympiaWorkout" class="footer-a fs-4 mx-1"><i class="bi bi-whatsapp"></i></a>
                    <a href="#" class="footer-a fs-4 mx-1"><i class="bi bi-facebook"></i></a>
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
                <div class="col-lg-8">
                    <p class="text-dark">Este site utiliza cookies para melhorar a sua experiência de navegação. Ao
                        continuar
                        navegando, você concorda com o uso de cookies.</p>
                </div>
                <div class="col-lg-4 text-end">
                    <button id="aceitar-cookies" class="btn btn-primary" onclick="aceitarCookies();">Aceitar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
</body>

</html>
<?php

session_abort();

?>