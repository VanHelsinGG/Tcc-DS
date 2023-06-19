<?php
include("../main/lib/php/include.php");

$GLOBALS['erro'] = 0;

if ($func->verificarLogado()) {

    $cookieToken = $_COOKIE["logado"];

    if ($id = $user->getUserID_byToken($cookieToken)) {

        $user_token = $user->getUserToken_byID($id);
        if ($user_token == -1) {
            $GLOBALS['erro'];
        }

        if (!strcmp($user_token, $cookieToken)) {
            if ($userToken->validToken($user_token)) {
                $GLOBALS['userNome'] = $user->getUserName_byToken($user_token);

                $func->setarCookie("autenticado", 1, 1);

                // Verifica se já escolheu o objetivo
                if ($user->getUserObjective_byID($id) === -1) {
                    echo $user->getUserObjective_byID($id);

                    $redirectUrl = urlencode("objetivo.php");
                    header("Location: $redirectUrl");
                    exit();
                }
            } else {
                $GLOBALS['erro'] = 1;
            }
        } else {
            $GLOBALS['erro'] = 1;
        }
    } else {
        $GLOBALS['erro'] = 1;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OlympiaWorkout: Promovendo Saúde e Bem-Estar</title>
    <!-- <script src="./javascript/scroll.js" defer></script> -->
    <script src="./lib/js/switcher.js" defer></script>
    <script src="../main/lib/js/main.js" defer></script>
    <script src="./lib/js/index.js" defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans|Roboto|Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./lib/css/index.css">
    <link rel="stylesheet" href="../main/lib/css/universal.css">
    <link rel="stylesheet" href="../main/lib/images/bootstrap-icons-1.10.4/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>
    <!-- Header / NavBar -->
    <!-- <header class="header container my-3 rounded shadow fixed-top" id="header">
        <div class="row h-100 d-flex">
            <div class="col-6 bg-white d-flex justify-content-center h-100 align-items-center">
                <div class="col-6">
                    <h1 class="fs-4 text-center" id="title">Olympia<span style="color:#005cb2;">Workout</span></h1>
                </div>
                <div class="col-6 text-end" style="margin-right: -1.5rem;">
                    <img src="../main/lib/images/Tcc Header laranja.jpg" alt="" id="diagonal-bars-header" class="img-fluid">
                </div>
            </div>
            <div class="col-6">
                <nav class="navbar navbar-expand-md navbar-light ms-auto" id="navbar">
                    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon text-white" style="filter: invert(1);"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item">
                                <a href="./index.html" id="home" class="nav-link text-white fw-bolder active">Inicio</a>
                            </li>
                            <li class="nav-item d-md-none d-block">
                                <a href="#contact" id="contact" class="nav-link text-white">Conta</a>
                            </li>
                        </ul>
                        <?php
                        if (isset($GLOBALS["userNome"])) {
                            echo '<ul class="navbar-nav d-md-block d-none ms-3">
                    <li class="nav-item dropdown">
                        <a href="#" id="profile" class="nav-link text-white d-flex align-items-center nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle fs-2 me-2"></i>
                            ' . $GLOBALS["userNome"] . '
                        </a>
                        <div class="dropdown-menu p-0" id="dropdown-menu" style="width:200px;background-color:var(--azul-complementar);">
                            <a class="dropdown-item dropdown-item-hover text-light py-2" href="#"><i class="bi bi-person-circle me-2"></i>Perfil</a>
                            <a class="dropdown-item dropdown-item-hover text-light py-2" href="#"><i class="bi bi-gear-fill me-2"></i>Configurações</a>
                            <a class="dropdown-item text-white dropdown-item-deslogar py-2" href="./actions/deslogar.php" style="margin-bottom: 0;"><i class="bi bi-power me-2"></i>Deslogar-se</a>
                        </div>
                    </li>
                </ul>';
                        } else {
                            echo '<ul class="navbar-nav d-md-block d-none ms-3">
                    <li class="nav-item">
                        <a href="register.php" id="profile" class="nav-link text-white d-flex align-items-center nav-link">
                            <i class="bi bi-person-circle fs-2 me-2"></i>
                            Conectar-se
                        </a>
                    </li>
                </ul>';
                        }
                        ?>
                    </div>
                </nav>
            </div>
        </div>
    </header> -->

    <header class="header container-fluid bg-laranja shadow fixed-top" id="header">
        <div class="row">
            <div class="col-4 pt-1 d-flex justify-content-center align-items-center">
                <div class="col-6">
                    <h1 class="fs-4" id="title">OlympiaWorkout</h1>
                </div>
                <!-- <div class="col-6 text-end">
                    <img src="../main/lib/images/Tcc Header laranja.jpg" alt="" id="diagonal-bars-header" class="img-fluid" style="height:5rem; margin-right:-1rem;">
                </div> -->
            </div>
            <div class="col-8 p-2">
                <nav class="navbar navbar-expand-md navbar-light ms-auto">
                    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon text-white" style="filter: invert(1);"></span>
                    </button>
                    <div class="collapse navbar-collapse">
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item mx-3">
                                <a href="#contact" id="contact" class="nav-link text-white">Sobre Nós</a>
                            </li>
                            <li class="nav-item mx-3">
                                <a href="#contact" id="contact" class="nav-link text-white">Nossos Profissionais</a>
                            </li>
                            <li class="nav-item mx-3">
                                <a href="./register.php" id="registrar" class="nav-link text-white btn btn-azul px-3">Começar Agora</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </header>

    <!-- Slide-Show -->
    <div class="container-fluid image-switcher p-0 d-flex justify-content-center align-items-center">
        <div id="image-switcher" class="carousel slide" data-ride="carousel" data-wrap="false" data-interval="5000">
            <ol class="carousel-indicators">
                <li data-target="#image-switcher" data-slide-to="1" class=""></li>
                <li data-target="#image-switcher" data-slide-to="2" class=""></li>
                <li data-target="#image-switcher" data-slide-to="3"></li>
                <li data-target="#image-switcher" data-slide-to="4"></li>
                <li data-target="#image-switcher" data-slide-to="5"></li>
                <li data-target="#image-switcher" data-slide-to="6"></li>
                <li data-target="#image-switcher" data-slide-to="7"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="switcher-images" src="../main/lib/images/carousel-images/Carousel-Item-1.jpg" alt="First slide">
                </div>
                <div class="carousel-item">
                    <img class="switcher-images" src="../main/lib/images/carousel-images/Carousel-Item-2.jpg" alt="Second slide">
                </div>
                <div class="carousel-item">
                    <img class="switcher-images" src="../main/lib/images/carousel-images/Carousel-Item-3.jpg" alt="Third slide">
                </div>
                <div class="carousel-item">
                    <img class="switcher-images" src="../main/lib/images/carousel-images/Carousel-Item-4.jpg" alt="Fourth slide">
                </div>
                <div class="carousel-item">
                    <img class="switcher-images" src="../main/lib/images/carousel-images/Carousel-Item-5.jpg" alt="Fourth slide">
                </div>
                <div class="carousel-item">
                    <img class="switcher-images" src="../main/lib/images/carousel-images/Carousel-Item-6.jpg" alt="Fourth slide">
                </div>
                <div class="carousel-item">
                    <img class="switcher-images" src="../main/lib/images/carousel-images/Carousel-Item-7.jpeg" alt="Fourth slide">
                </div>
            </div>
            <!-- <button class="botao carousel-control-prev hidden-sm" href="" role="button" data-slide="prev" onclick="atualizarSwitcher(2);" style="background: linear-gradient(to right, rgb(0, 0, 1), rgba(0,0,0,0));">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            </button>
            <button class="botao carousel-control-next hidden-sm" href="" role="button" data-slide="next" onclick="atualizarSwitcher(1);" style="background: linear-gradient(to left, rgba(0,0,0,1), rgba(0,0,0,0));">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
            </button> -->
        </div>
        <div style="position: absolute; left:3rem;">
            <h2 id="image-title" class="display-3">Atividades físicas<br> para prevenir doenças!</h2>
        </div>
    </div>

    <!-- Primeira Section -->
    <div class="container-fluid background-escuro">
        <div class="row text-light d-flex justify-content-center align-items-center">
            <div class="col-md-6 px-5 fs-5" style="height: 100%;">
                <h4 class="fs-4 mb-4" style="font-weight: bold; color: #ff9f1a;">Descubra a
                    plataforma digital para uma vida ativa e saudável!</h4>
                <p>Oferecemos uma ampla gama de recursos, incluindo vídeos de exercícios inspiradores, conteúdo didático
                    de alta qualidade, um sistema nutricional inteligente e incentivos empolgantes para te manter
                    motivado. É a ferramenta perfeita para transformar seu estilo de vida. Venha se juntar a nós e cuide
                    de si mesmo de forma personalizada. Não espere mais, comece a sua jornada de bem-estar conosco
                    agora!</p>
                <a href="register.php" class="btn btn-danger my-3 mb-5 w-100">Começar gratuitamente</a>
            </div>
            <div class="col-md-6" style="height: 100%;">
                <img src="../main/lib/images/section-images/Section-Image-4.png" alt="" id="imagem-comecar" class="img-fluid my-5 pe-3 img-section" style="width: 100%;height: 100%;">
            </div>
        </div>
    </div>

    <!-- Numeros -->
    <div class="py-1 numero d-flex align-items-center">
        <div class="container">
            <div class="row py-4">
                <div class="col-md-4 col-sm-12">
                    <h3 class="px-3 fs-3 my-4">
                        Temos <span class="numeros">{x}</span> exercícios em nosso banco de dados
                    </h3>
                </div>
                <div class="col-md-4 col-sm-12">
                    <h3 class="px-3 fs-3 my-4">
                        Tenha contato com <span class="numeros">{x}</span> informações confiáveis
                    </h3>
                </div>
                <div class="col-md-4 col-sm-12">
                    <h3 class="px-3 fs-3 my-4">
                        <?php
                        $query = "SELECT * FROM users";
                        $resultados = mysqli_query($db, $query);

                        echo "Tenha contato com outros <span class='numeros'>" . mysqli_num_rows($resultados) . "</span> usuarios";
                        ?>
                    </h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Outras sections -->
    <div class="container-fluid m-0 p-5 background-escuro text-light fs-5 h-100">
        <div class="row py-5 d-flex align-items-center justify-content-center">
            <div class="col-12 col-md-6 justify-content-center align-items-center d-flex">
                <img src="../main/lib/images/section-images/Section-Image-1.png" alt="Imagem" class="img-fluid img-section">
            </div>
            <div class="col-12 col-md-6 col-sm-12">
                <h4 class="fs-4 mb-4 ms-md-4" style="font-weight: bold; color: #ff9f1a;">Descubra o Poder da Saúde e
                    Nutrição:
                    Transforme sua Vida!</h4>
                <p class="mb-4 ms-md-4">Tenha uma vida mais plena e saudável com o poder da saúde e nutrição! Nossa
                    plataforma é
                    sua aliada para descobrir como uma alimentação equilibrada, atividades físicas regulares e hábitos
                    saudáveis podem transformar sua vida para melhor. Oferecemos recursos valiosos, como conteúdo
                    informativo sobre práticas saudáveis, dicas nutricionais, sugestões de exercícios e muito mais.
                    Invista em sua saúde e bem-estar, e experimente os benefícios transformadores da saúde e nutrição em
                    sua jornada para uma vida mais vibrante e plena!</p>
                <?php
                echo ($func->verificarLogado()) ? '<a href="#" class="btn btn-success w-100 ms-md-4">Descubra agora!</a>' : '<a href="register.php" class="btn btn-success w-100 ms-md-4">Descubra agora!</a>';
                ?>
            </div>
        </div>
        <div class="py-5 row mt-5 d-flex align-items-center justify-content-center">
            <div class="col-12 col-md-6 col-sm-12">
                <h4 class="fs-4 mb-4 me-md-4" style="font-weight: bold; color: #ff9f1a;">Desvende os Segredos do
                    Conhecimento na
                    Atividade Física: Supere seus Limites!</h4>
                <p class="mb-4 me-md-4">Aprofunde-se no mundo do conhecimento relacionado à atividade física e desvende
                    os
                    segredos para atingir o melhor desempenho físico. Descubra as melhores práticas, estratégias de
                    treinamento, dicas de nutrição, técnicas de recuperação e muito mais para superar seus limites e
                    alcançar novos patamares em sua performance esportiva. Amplie seu entendimento sobre a ciência por
                    trás da atividade física e potencialize seus resultados, levando sua prática esportiva a um novo
                    nível!</p>
                <?php
                echo ($func->verificarLogado()) ? '<a href="#" class="btn btn-azul btn-primary" style="width: 97%;">Explore o mundo do conhecimento!</a>' : '<a href="register.php" class="btn btn-azul btn-primary" style="width: 97%;">Explore o mundo do conhecimento!</a>';
                ?>
            </div>
            <div class="col-12 col-md-6 d-flex align-items-center justify-content-center">
                <img src="../main/lib/images/section-images/Section-Image-2.png" alt="Imagem" class="img-fluid img-section">
            </div>
        </div>
        <div class="row py-5 mt-5 d-flex align-items-center justify-content-center">
            <div class="col-12 col-md-6 d-flex align-items-center justify-content-center">
                <img src="../main/lib/images/section-images/Section-Image-3.png" alt="Imagem" class="img-fluid img-section">
            </div>
            <div class="col-12 col-md-6 col-sm-12">
                <h4 class="fs-4 mb-4 ms-md-4" style="font-weight: bold; color: #ff9f1a;">Monitoramento Inteligente:
                    Acompanhe
                    suas Atividades Físicas Diárias com Facilidade!</h4>
                <p class="mb-4 ms-md-4">Acompanhe suas atividades físicas diárias de forma fácil e eficaz com nossa
                    plataforma
                    de monitoramento inteligente. Registre, analise e otimize seu progresso para transformar sua rotina
                    de exercícios em uma jornada gratificante de bem-estar. Descubra como nosso acompanhamento pode
                    impulsionar seu estilo de vida ativo e saudável!!</p>
                <?php
                echo ($func->verificarLogado()) ? '<a href="#" class="btn btn-success btn-roxo ms-md-4 w-100">Experimente Agora!</a>' : '<a href="register.php" class="btn btn-success btn-roxo ms-md-4 w-100">Experimente Agora!</a>';
                ?>
            </div>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
</body>

</html>

<?php
if ($GLOBALS['erro']) {
    $func->setarCookie("autenticado", 0, 0);
    $func->showAlert("Sessão expirada!", "Sua sessão foi encerrada. Para acessar sua conta, por favor faça login novamente.", "Continuar", "");
}
?>