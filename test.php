<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">>
    <title>Teste</title>
    <link rel="stylesheet" href="./images/bootstrap-icons-1.10.4/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="./style/universal.css">
    <link rel="stylesheet" href="./style/reseter.css">
    <link rel="stylesheet" href="./style/principal.css">
    <!-- <script src="./javascript/principal.js" defer></script> -->
</head>

<body>
    <header class="header container-fluid sticky-top" id="header">
        <div class="row h-100 d-flex">
            <div class="col-6 bg-white d-flex justify-content-center h-100 align-items-center">
                <div class="col-6">
                    <h1 class="fs-4 text-center" id="title">Olympia<span style="color:#005cb2;">Workout</span></h1>
                </div>
                <div class="col-6 text-end" style="margin-right: -1.5rem;">
                    <img src="./images/Tcc Header laranja.jpg" alt="" id="diagonal-bars-header" class="img-fluid">
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
                        session_start();
                        if (isset($_COOKIE['logado'])) {
                            echo '<ul class="navbar-nav d-md-block d-none ms-3">
                    <li class="nav-item dropdown">
                        <a href="#" id="profile" class="nav-link text-white d-flex align-items-center nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle fs-2 me-2"></i>
                            ' . $_COOKIE['logado'] . '
                        </a>
                        <div class="dropdown-menu p-0" id="dropdown-menu" style="width:200px;background-color:var(--azul-complementar);">
                            <a class="dropdown-item dropdown-item-hover text-light py-2" href="#"><i class="bi bi-person-circle me-2"></i>Perfil</a>
                            <a class="dropdown-item dropdown-item-hover text-light py-2" href="#"><i class="bi bi-gear-fill me-2"></i>Configurações</a>
                            <a class="dropdown-item text-white dropdown-item-deslogar py-2" href="deslogar.php" style="margin-bottom: 0;"><i class="bi bi-power me-2"></i>Deslogar-se</a>
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
    </header>

    <div class="container-fluid escuro noticias">
        <div class="row ">
            <div class="col-6">
                <div class="card h-100">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="https://static1.minhavida.com.br/articles/08/21/db/40/whey-orig-1.jpg" class="card-img" alt="...">
                        </div>
                        <div class="col-md-6">
                            <div class="card-body">
                                <h5 class="card-title">Card Title</h5>
                                <p class="card-text">Card description.</p>
                                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="row">
                                <div class="col-md-6">
                                    <img src="https://static1.minhavida.com.br/articles/08/21/db/40/whey-orig-1.jpg" class="card-img" alt="...">
                                </div>
                                <div class="col-md-6">
                                    <div class="card-body">
                                        <h5 class="card-title">Card Title</h5>
                                        <p class="card-text">Card description.</p>
                                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="row">
                                <div class="col-md-6">
                                    <img src="https://static1.minhavida.com.br/articles/08/21/db/40/whey-orig-1.jpg" class="card-img" alt="...">
                                </div>
                                <div class="col-md-6">
                                    <div class="card-body">
                                        <h5 class="card-title">Card Title</h5>
                                        <p class="card-text">Card description.</p>
                                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>