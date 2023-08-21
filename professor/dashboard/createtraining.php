<?php include("../../main/lib/php/include.php") ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel do Professor • OlympiaWorkout</title>
    <script src="../lib/js/dashboard.js" defer></script>
    <link rel="stylesheet" href="../../main/lib/css/universal.css">
    <link rel="stylesheet" href="../../main/lib/images/bootstrap-icons-1.10.4/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../lib/css/dashboard.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body class="m-0 p-0 border-0">

    <div class="container-fluid">
        <div class="row">
            <nav class="escuro col-md-2 m-0 col-lg-2 d-md-block text-white p-0 vh-100 sidebar fixed-top" id="navbar">
                <h1 class="text-center fs-3 bg-laranja py-4">OlympiaWorkout</h1>
                <ul class="list-unstyled list-group h-100">
                    <li class="my-1 option ps-2"><a href="#" class="text-white btn my-2"><i
                                class="bi bi-house-fill me-3"></i>Inicio</a></li>
                    <li class="active my-1 option ps-2"><a href="createtraining.php" class="text-white btn my-2"><i
                                class="bi bi-fire me-3"></i>Criar Treino</a></li>
                    <li class="my-1 option ps-2"><a href="#" class="text-white btn my-2"><i
                                class="bi bi-person-fill me-3"></i>Alunos</a></li>
                    <li class="my-1 option ps-2"><a href="#" class="text-white btn my-2"><i
                                class="bi bi-clipboard2-data-fill me-3"></i>Relatorios</a></li>
                    <li class="my-1 option ps-2" style="border-top: 1px solid #363330;" id="user-icon"><a href=""
                            class="text-white btn my-2"><i class="bi bi-person-circle me-3"></i>Olympia Workout</a></li>
                </ul>
            </nav>
            <main class="col-10 ms-auto col-lg-10 vh-100">
                <header class="container-fluid text-center my-4 pb-4 pt-4">
                    <h1>Criar Treino - Painel do Professor</h1>
                </header>
                <form action="" method="get">
                    <div class="container rounded shadow-lg">
                        <div class="row bg-primary rounded text-white p-3">
                            <h2>Informações Gerais</h2>
                        </div>
                        <div class="row my-3 p-3">
                            <div class="col-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" disabled readonly id="Professor"
                                        placeholder="Nome do Professor" value="Nome Professor">
                                    <label for="Professor">Professor</label>

                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="user" placeholder="Nome do Usuario"
                                        value="Nome Aluno">
                                    <label for="user">Aluno</label>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container rounded shadow-lg mt-5">
                        <div class="row bg-primary rounded text-white p-3">
                            <h2>Informações do Treino</h2>
                        </div>
                        <div class="row my-3 p-3">
                            <div class="col-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="nome-treino"
                                        placeholder="Nome do Treino" value="Nome do Treino">
                                    <label for="nome-treino">Nome do Treinamento</label>

                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="duracao" placeholder="Duração"
                                        value="0">
                                    <label for="duracao">Duração (treinos)</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <div class="container rounded shadow-lg mt-5" id="treinosContainer">
                                    <!-- Treino template -->
                                    <div class="row container treino-template d-none" id="treino-1">
                                        <div class="row bg-success rounded text-white p-3">
                                            <h2 class="treino">Treino 1</h2>
                                        </div>
                                        <div class="col-4 px-4 my-2" id="exercicio-1-1">
                                            <div class="row">
                                                <h3 class="bg-danger p-2 ps-3"><input type="text"
                                                        class="form-control my-1" placeholder="Exercício 1"></h3>
                                            </div>
                                            <div class="row">
                                                <input type="text" class="form-control my-1" placeholder="Serie 1">
                                                <input type="text" class="form-control my-1" placeholder="Serie 2">
                                                <input type="text" class="form-control my-1" placeholder="Serie 3">
                                                <input type="text" class="form-control my-1" placeholder="Serie 3">
                                                <button type="button" class="btn btn-success mt-1"
                                                    onclick="adicionarInput(this)">+</button>
                                            </div>
                                        </div>
                                        <div class="col-4 px-4 my-2" id="exercicio-1-2">
                                            <div class="row">
                                                <h3 class="bg-danger p-2 ps-3"><input type="text"
                                                        class="form-control my-1" placeholder="Exercício 1"></h3>
                                            </div>
                                            <div class="row">
                                                <input type="text" class="form-control my-1" placeholder="Serie 1">
                                                <input type="text" class="form-control my-1" placeholder="Serie 2">
                                                <input type="text" class="form-control my-1" placeholder="Serie 3">
                                                <input type="text" class="form-control my-1" placeholder="Serie 3">
                                                <button type="button" class="btn btn-success mt-1"
                                                    onclick="adicionarInput(this)">+</button>
                                            </div>
                                        </div>
                                        <div class="col-4 px-4 my-2" id="exercicio-1-3">
                                            <div class="row">
                                                <h3 class="bg-danger p-2 ps-3"><input type="text"
                                                        class="form-control my-1" placeholder="Exercício 1"></h3>
                                            </div>
                                            <div class="row">
                                                <input type="text" class="form-control my-1" placeholder="Serie 1">
                                                <input type="text" class="form-control my-1" placeholder="Serie 2">
                                                <input type="text" class="form-control my-1" placeholder="Serie 3">
                                                <input type="text" class="form-control my-1" placeholder="Serie 3">
                                                <button type="button" class="btn btn-success mt-1"
                                                    onclick="adicionarInput(this)">+</button>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <button type="button" id="btn-criar-exercicio" class="btn btn-primary my-1"
                                                onclick="adicionarExercicio(this)">+</button>
                                        </div>
                                    </div>
                                    <!-- Treino 1 -->
                                    <div class="row container treino-1" id="treino-1">
                                        <div class="row bg-success rounded text-white p-3">
                                            <h2 id="titulo">Treino 1</h2>
                                        </div>
                                        <div class="col-4 px-4 my-2" id="exercicio-1-1">
                                            <div class="row">
                                                <h3 class="bg-danger p-2 ps-3"><input type="text"
                                                        class="form-control my-1" placeholder="Exercício 1"></h3>
                                            </div>
                                            <div class="row">
                                                <input type="text" class="form-control my-1" placeholder="Serie 1">
                                                <input type="text" class="form-control my-1" placeholder="Serie 2">
                                                <input type="text" class="form-control my-1" placeholder="Serie 3">
                                                <input type="text" class="form-control my-1" placeholder="Serie 3">
                                                <button type="button" class="btn btn-success mt-1"
                                                    onclick="adicionarInput(this)">+</button>
                                            </div>
                                        </div>
                                        <div class="col-4 px-4 my-2" id="exercicio-1-2">
                                            <div class="row">
                                                <h3 class="bg-danger p-2 ps-3"><input type="text"
                                                        class="form-control my-1" placeholder="Exercício 1"></h3>
                                            </div>
                                            <div class="row">
                                                <input type="text" class="form-control my-1" placeholder="Serie 1">
                                                <input type="text" class="form-control my-1" placeholder="Serie 2">
                                                <input type="text" class="form-control my-1" placeholder="Serie 3">
                                                <input type="text" class="form-control my-1" placeholder="Serie 3">
                                                <button type="button" class="btn btn-success mt-1"
                                                    onclick="adicionarInput(this)">+</button>
                                            </div>
                                        </div>
                                        <div class="col-4 px-4 my-2" id="exercicio-1-3">
                                            <div class="row">
                                                <h3 class="bg-danger p-2 ps-3"><input type="text"
                                                        class="form-control my-1" placeholder="Exercício 1"></h3>
                                            </div>
                                            <div class="row">
                                                <input type="text" class="form-control my-1" placeholder="Serie 1">
                                                <input type="text" class="form-control my-1" placeholder="Serie 2">
                                                <input type="text" class="form-control my-1" placeholder="Serie 3">
                                                <input type="text" class="form-control my-1" placeholder="Serie 3">
                                                <button type="button" class="btn btn-success mt-1"
                                                    onclick="adicionarInput(this)">+</button>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <button type="button" id="btn-criar-exercicio" class="btn btn-primary my-1"
                                                onclick="adicionarExercicio(this)">+</button>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-success mt-1 criar-treino"
                                    onclick="criarNovoTreino()">+</button>
                            </div>
                        </div>
                    </div>

                    <div class="container-fluid my-4">
                        <div class="row">
                            <button type="button" class="btn btn-warning mt-1">+</button>
                        </div>
                    </div>
                </form>
            </main>
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


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
</body>

</html>