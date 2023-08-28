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
                    <li class="active my-1 option ps-2"><a href="index.php" class="text-white btn my-2 w-100 text-start"><i
                                class="bi bi-house-fill me-3"></i>Inicio</a></li>
                    <li class="my-1 option ps-2"><a href="createtraining.php"
                            class="text-white btn my-2 w-100 text-start"><i class="bi bi-fire me-3"></i>Criar
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
                    <h1>OlympiaWorkout - Painel do Professor</h1>
                </header>

                <div class="container-fluid p-5" style="border-top:1px solid #d3d3d3;border-bottom:1px solid #d3d3d3;">
                    <div class="row mb-2">
                        <h2><i class="bi bi-arrow-right-circle me-3"></i>Seu Relatório Geral</h2>
                    </div>
                    <div class="row text-center">
                        <div class="col-md-3">
                            <div class="card bg-primary text-white square-card">
                                <div class="card-body d-flex flex-column align-items-center">
                                    <i class="bi bi-people display-4"></i>
                                    <?php
                                    if (isset($_COOKIE['logado'])) {
                                        $userToken = $_COOKIE['logado'];

                                        $numUsers = $training->getNumOfStudent_byToken($userToken);

                                        echo '<span class="display-5">' . $numUsers . '</span>';
                                    }
                                    ?>
                                    <span>Alunos</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card bg-success text-white square-card">
                                <div class="card-body d-flex flex-column align-items-center">
                                    <i class="bi bi-bookmark display-4"></i>
                                    <span class="display-5">0</span>
                                    <span>Treinos Criados</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card bg-warning text-white square-card">
                                <div class="card-body d-flex flex-column align-items-center">
                                    <i class="bi bi-star display-4"></i>
                                    <span class="display-5">0</span>
                                    <span>Avaliações</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card bg-danger text-white square-card">
                                <div class="card-body d-flex flex-column align-items-center">
                                    <i class="bi bi-exclamation display-4"></i>
                                    <span class="display-5">0</span>
                                    <span>Treinos Vencidos</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container-fluid mt-3 p-5">
                    <div class="row">
                        <div class="col-5">
                            <div class="row mb-2">
                                <h2><i class="bi bi-arrow-right-circle me-3"></i>Alunos</h2>
                            </div>
                            <div class="row text-center">
                                <table class="table-dark table-striped table text-center">
                                    <?php
                                    // Supondo que você já tenha estabelecido a conexão com o banco de dados ($db)
                                    
                                    $query = "SELECT t.aluno, u.nome, t.nome AS treino, t.duracao, t.vezes_feito FROM treinos AS t
                                            JOIN users AS u ON t.aluno = u.userid
                                            WHERE t.professor = ?";

                                    $userToken = $_COOKIE["logado"];
                                    $userId = $user->getUserID_byToken($userToken);

                                    $stmt = mysqli_prepare($db, $query);
                                    mysqli_stmt_bind_param($stmt, "s", $userId);
                                    mysqli_stmt_execute($stmt);

                                    $resultados = mysqli_stmt_get_result($stmt);

                                    if (!mysqli_num_rows($resultados)) {
                                        echo "Não há alunos cadastrados!";
                                    } else {
                                        echo "<tr>
                                                <th>Nome</th>
                                                <th>Treino</th>
                                                <th>Vencimento</th>
                                            </tr>";

                                        while ($row = mysqli_fetch_assoc($resultados)) {
                                            echo "<tr>
                                                <td>" . $row['nome'] . "</td>
                                                <td>" . $row['treino'] . "</td>
                                                <td>" . $row['vezes_feito'] . '/' . $row['duracao'] . "</td>
                                            </tr>";
                                        }

                                        echo "</table>";
                                    }


                                    ?>
                                </table>
                            </div>
                        </div>
                        <div class="col-6 ms-auto">
                            <div class="row mb-2">
                                <h2><i class="bi bi-arrow-right-circle me-3"></i>Solicitações Pendentes</h2>
                            </div>
                            <div class="row text-center">
                                <table class="table-dark table-striped table text-center">
                                    <tr>
                                        <th>Data</th>
                                        <th>Aluno</th>
                                        <th></th>
                                    </tr>
                                    <tr>
                                        <td>00/00/0000</td>
                                        <td>Victor</td>
                                        <td><a href="" class="btn btn-primary w-100 h-100">Criar Treino</a></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
</body>

</html>