<?php include("../../main/lib/php/include.php")

    ?>
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

<body>
    <div class="container-fluid">
        <div class="row">
            <nav class="escuro col-md-2 m-0 col-lg-2 d-md-block text-white p-0 vh-100 sidebar fixed-top" id="navbar">
                <h1 class="text-center fs-3 bg-laranja py-4">OlympiaWorkout</h1>
                <ul class="list-unstyled list-group h-100">
                    <li class="my-1 option ps-2"><a href="index.php" class="text-white btn my-2 w-100 text-start"><i
                                class="bi bi-house-fill me-3"></i>Inicio</a></li>
                    <li class="active my-1 option ps-2"><a href="createtraining.php"
                            class="text-white btn my-2 w-100  text-start"><i class="bi bi-fire me-3"></i>Criar
                            Treino</a></li>
                    <li class="my-1 option ps-2"><a href="#" class="text-white btn my-2 w-100  text-start"><i
                                class="bi bi-person-fill me-3"></i>Alunos</a></li>
                    <li class="my-1 option ps-2"><a href="#" class="text-white btn my-2 w-100  text-start"><i
                                class="bi bi-clipboard2-data-fill me-3"></i>Relatorios</a></li>
                    <li class="my-1 option ps-2" style="border-top: 1px solid #363330;" id="user-icon"><a href=""
                            class="text-white btn my-2"><i class="bi bi-person-circle me-3"></i>Olympia Workout</a></li>
                </ul>
            </nav>
            <main class="col-10 ms-auto col-lg-10 vh-100">
                <header class="container-fluid text-center my-4 pb-4 pt-4">
                    <h1>Criar Treino - Painel do Professor</h1>
                </header>
                <form action="" method="get" class="py-4">
                    <div class="container rounded shadow-lg">
                        <div class="row bg-azul rounded text-white p-3">
                            <h2>Informações Gerais</h2>
                        </div>
                        <div class="row my-3 p-3">
                            <div class="col-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" disabled readonly id="Professor"
                                        placeholder="Professor">
                                    <label for="Professor">Professor</label>

                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="user" placeholder="Aluno">
                                    <label for="user">Aluno</label>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container rounded shadow-lg mt-5">
                        <div class="row bg-azul rounded text-white p-3">
                            <h2>Informações do Treino</h2>
                        </div>
                        <div class="row my-3 p-3">
                            <div class="col-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="nome-treino"
                                        placeholder="Nome do Treino">
                                    <label for="nome-treino">Nome do Treinamento</label>

                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control" id="duracao" placeholder="Duração">
                                    <label for="duracao">Duração (treinos)</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <div class="treinoContainer container rounded shadow-lg mt-5" id="treinosContainer"
                                    style="margin: 0 !important; padding: 0 !important;">
                                    <!-- Treino template -->
                                    <div class="treinoContainer row container d-none treino-template" id="treino-1"
                                        style="margin-top: 2rem;margin-bottom:2rem;margin: 0 !important; padding: 0 !important;">
                                        <div class="row m-0 bg-laranja rounded text-white p-3">
                                            <div class="col-2">
                                                <h2 id="titulo">Treino 1 - </h2>
                                            </div>
                                            <div class="col-10"><input type="text" class="form-control my-1 treino-i"
                                                    placeholder="Nome Treino"></div>
                                        </div>
                                        <div class="col-4 px-4 my-2 bg-" id="exercicio-1-1" class="exercicio">
                                            <div class="row">
                                                <h3 class="bg-escuro-terciario rounded p-2 px-3"><input type="text"
                                                        class="form-control my-1 exercicio-i" placeholder="Exercício 1">
                                                </h3>
                                            </div>
                                            <div class="row">
                                                <input type="text" class="form-control input-i my-1" name="input-i"
                                                    placeholder="Serie 1">
                                                <input type="text" class="form-control input-i my-1" name="input-i"
                                                    placeholder="Serie 2">
                                                <input type="text" class="form-control input-i my-1" name="input-i"
                                                    placeholder="Serie 3">
                                                <input type="text" class="form-control input-i my-1" name="input-i"
                                                    placeholder="Serie 3">
                                                <button type="button" class="btn btn-success mt-1"
                                                    onclick="adicionarInput(this)">Nova Serie</button>
                                            </div>
                                        </div>
                                        <div class="col-4 px-4 my-2" id="exercicio-1-2" class="exercicio">
                                            <div class="row">
                                                <h3 class="bg-escuro-terciario rounded p-2 px-3"><input type="text"
                                                        class="form-control my-1 exercicio-i" placeholder="Exercício 2">
                                                </h3>
                                            </div>
                                            <div class="row">
                                                <input type="text" class="form-control input-i my-1" name="input-i"
                                                    placeholder="Serie 1">
                                                <input type="text" class="form-control input-i my-1" name="input-i"
                                                    placeholder="Serie 2">
                                                <input type="text" class="form-control input-i my-1" name="input-i"
                                                    placeholder="Serie 3">
                                                <input type="text" class="form-control input-i my-1" name="input-i"
                                                    placeholder="Serie 3">
                                                <button type="button" class="btn btn-success mt-1"
                                                    onclick="adicionarInput(this)">Nova Serie</button>
                                            </div>
                                        </div>
                                        <div class="col-4 px-4 my-2 bg-" id="exercicio-1-3" class="exercicio">
                                            <div class="row">
                                                <h3 class="bg-escuro-terciario rounded p-2 px-3"><input type="text"
                                                        class="form-control my-1 exercicio-i" placeholder="Exercício 3">
                                                </h3>
                                            </div>
                                            <div class="row">
                                                <input type="text" class="form-control input-i my-1" name="input-i"
                                                    placeholder="Serie 1">
                                                <input type="text" class="form-control input-i my-1" name="input-i"
                                                    placeholder="Serie 2">
                                                <input type="text" class="form-control input-i my-1" name="input-i"
                                                    placeholder="Serie 3">
                                                <input type="text" class="form-control input-i my-1" name="input-i"
                                                    placeholder="Serie 3">
                                                <button type="button" class="btn btn-success mt-1"
                                                    onclick="adicionarInput(this)">Nova Serie</button>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col text-center">
                                                <button type="button" id="btn-criar-exercicio"
                                                    class="btn btn-primary my-2 rounded-circle btn-exercicio"
                                                    onclick="adicionarExercicio(this)">+</button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Treino 1 -->
                                    <div class="treinoContainer row container treino-1" id="treino-1"
                                        style="margin-top: 2rem;margin-bottom:2rem;margin: 0 !important; padding: 0 !important;">
                                        <div class="row m-0 bg-laranja rounded text-white p-3">
                                            <div class="col-2">
                                                <h2 id="titulo">Treino 1 - </h2>
                                            </div>
                                            <div class="col-10"><input type="text" class="form-control my-1 treino-i"
                                                    placeholder="Nome Treino"></div>
                                        </div>
                                        <div class="col-4 px-4 my-2 bg-" id="exercicio-1-1" class="exercicio">
                                            <div class="row">
                                                <h3 class="bg-escuro-terciario rounded p-2 px-3"><input type="text"
                                                        class="form-control my-1 exercicio-i" placeholder="Exercício 1">
                                                </h3>
                                            </div>
                                            <div class="row">
                                                <input type="text" class="form-control input-i my-1" name="input-i"
                                                    placeholder="Serie 1">
                                                <input type="text" class="form-control input-i my-1" name="input-i"
                                                    placeholder="Serie 2">
                                                <input type="text" class="form-control input-i my-1" name="input-i"
                                                    placeholder="Serie 3">
                                                <input type="text" class="form-control input-i my-1" name="input-i"
                                                    placeholder="Serie 3">
                                                <button type="button" class="btn btn-success mt-1"
                                                    onclick="adicionarInput(this)">Nova Serie</button>
                                            </div>
                                        </div>
                                        <div class="col-4 px-4 my-2" id="exercicio-1-2" class="exercicio">
                                            <div class="row">
                                                <h3 class="bg-escuro-terciario rounded p-2 px-3"><input type="text"
                                                        class="form-control my-1 exercicio-i" placeholder="Exercício 2">
                                                </h3>
                                            </div>
                                            <div class="row">
                                                <input type="text" class="form-control input-i my-1" name="input-i"
                                                    placeholder="Serie 1">
                                                <input type="text" class="form-control input-i my-1" name="input-i"
                                                    placeholder="Serie 2">
                                                <input type="text" class="form-control input-i my-1" name="input-i"
                                                    placeholder="Serie 3">
                                                <input type="text" class="form-control input-i my-1" name="input-i"
                                                    placeholder="Serie 3">
                                                <button type="button" class="btn btn-success mt-1"
                                                    onclick="adicionarInput(this)">Nova Serie</button>
                                            </div>
                                        </div>
                                        <div class="col-4 px-4 my-2 bg-" id="exercicio-1-3" class="exercicio">
                                            <div class="row">
                                                <h3 class="bg-escuro-terciario rounded p-2 px-3"><input type="text"
                                                        class="form-control my-1 exercicio-i" placeholder="Exercício 3">
                                                </h3>
                                            </div>
                                            <div class="row">
                                                <input type="text" class="form-control input-i my-1 my-1" name="input-i"
                                                    placeholder="Serie 1">
                                                <input type="text" class="form-control input-i my-1" name="input-i"
                                                    placeholder="Serie 2">
                                                <input type="text" class="form-control input-i my-1" name="input-i"
                                                    placeholder="Serie 3">
                                                <input type="text" class="form-control input-i my-1" name="input-i"
                                                    placeholder="Serie 3">
                                                <button type="button" class="btn btn-success mt-1"
                                                    onclick="adicionarInput(this)">Nova Serie</button>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col text-center">
                                                <button type="button" id="btn-criar-exercicio"
                                                    class="btn btn-primary my-2 rounded-circle btn-exercicio"
                                                    onclick="adicionarExercicio(this)">+</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="container">
                    <div class="row">
                        <div class="col text-center">
                            <button type="button" class="btn btn-laranja my-1 rounded-circle criar-treino"
                                onclick="criarNovoTreino()">+</button>
                        </div>
                    </div>
                    <div class="row my-5">
                        <div class="col text-end">
                            <button type="button" class="btn btn-roxo text-white my-2" onclick="criarTreino();">Criar treino</button>
                        </div>
                    </div>
                </div>
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