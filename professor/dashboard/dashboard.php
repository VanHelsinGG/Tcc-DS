<?php include('../../main/lib/php/include.php');

$func->preload();

$userNome = $_SESSION['nome'];
$userID = $_SESSION['id'];

session_abort();

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel do Professor • OlympiaWorkout</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../../main/lib/js/main.js" defer></script>
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
                    <li class="active my-1 option ps-2"><a href="dashboard.php" class="text-white btn my-2 w-100 text-start"><i
                                class="bi bi-house-fill me-3"></i>Inicio</a></li>
                    <li class="my-1 option ps-2"><a href="createtraining.php"
                            class="text-white btn my-2 w-100 text-start"><i class="bi bi-fire me-3"></i>Criar
                            Treino</a></li>
                    <li class="my-1 option ps-2"><a href="requests.php"
                            class="text-white btn my-2 w-100 text-start"><i class="bi bi-archive-fill me-3"></i>Requisições de Treino</a></li>    
                    <li class="my-1 option ps-2"><a href="students.php" class="text-white btn my-2 w-100  text-start"><i
                                class="bi bi-person-fill me-3"></i>Seus Alunos</a></li>
                    <li class="my-1 option ps-2"><a href="#" class="text-white btn my-2 w-100  text-start"><i
                                class="bi bi-clipboard2-data-fill me-3"></i>Relatorios</a></li>
                    <li class="my-1 option ps-2" style="border-top: 1px solid #363330;" id="user-icon"><a href="../../user/main.php"
                            class="text-white btn my-2"><i class="bi bi-person-circle me-3"></i><?php echo $userNome; ?></a></li>
                </ul>
            </nav>
            <main class="col-10 ms-auto col-lg-10 vh-100 p-0" style="overflow-x:hidden;">
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
                                    <span>Alunos Ativos</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card bg-success text-white square-card">
                                <div class="card-body d-flex flex-column align-items-center">
                                    <i class="bi bi-bookmark display-4"></i>
                                    <span class="display-5"><?php
                                        $numCreated = $training->getNumOfTrainingCreated_byID($userID);
                                        echo $numCreated;
                                    ?></span>
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
                                    <span class="display-5"><?php
                                        $numExpired = $training->getNumOfTrainingExpired_byID($userID);
                                        echo $numExpired;
                                    ?></span>
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
                                    
                                    $query = 'SELECT t.aluno, u.nome, t.nome AS treino, t.duracao, t.vezes_feito FROM treinos AS t
                                            JOIN users AS u ON t.aluno = u.userid
                                            WHERE t.professor = ? LIMIT 3';

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

                                        echo "<tr><td colspan='3'><a class='btn btn-primary w-100 ' href='requests.php'>Acessar Todos alunos</a></td></tr>";
                                    }


                                    ?>
                                </table>
                            </div>
                        </div>
                        <div class="col-6 ms-auto">
                            <div class="row mb-2">
                                <h2><i class="bi bi-arrow-right-circle me-3"></i>Requisições Pendentes</h2>
                            </div>
                            <div class="row text-center">
                            <table class="table-dark table-striped table text-center">
                                    <?php
                                    
                                    $query = 'SELECT * FROM requisicoestreino WHERE professor = ? OR professor = -1 ORDER BY (professor = ?) DESC LIMIT 3';

                                    $userToken = $_COOKIE["logado"];
                                    $userId = $user->getUserID_byToken($userToken);

                                    $stmt = mysqli_prepare($db, $query);
                                    mysqli_stmt_bind_param($stmt, "ss", $userId,$userId);
                                    mysqli_stmt_execute($stmt);

                                    $resultados = mysqli_stmt_get_result($stmt);

                                    if (!mysqli_num_rows($resultados)) {
                                        echo "Não há requisições pendentes!";
                                    } else {
                                        echo "<tr>
                                                <th>Data</th>
                                                <th>ID</th>
                                                <th>Aluno</th>
                                                <th>Preferencia</th>
                                                <th></th>
                                            </tr>";

                                        while ($row = mysqli_fetch_assoc($resultados)) {
                                            $alunoNome = $user->getUserName_byID($row['user']);
                                            $preferencia = ($row['professor'] == $userId) ? '<span class="text-success">Sim</span>' : '<span class="text-danger">Não</span>';

                                            echo "<tr>
                                                <td>" . $row['data_requisicao'] . "</td>
                                                <td>" . $row['user'] . "</td>
                                                <td>" . $alunoNome . "</td>
                                                <td>".$preferencia."</td>
                                                <td><a class='btn btn-outline-primary w-100' href='createtraining.php?userid=".$row['user']."'>Criar Treino</a></td>
                                            </tr>";
                                        }

                                        echo "<tr><td colspan='5'><a class='btn btn-primary w-100 ' href='requests.php'>Acessar Todas Requisições</a></td></tr>";
                                    }


                                    ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <footer class="container-fluid bg-dark text-white text-center m-0 p-0">
                    <div class="pt-5 m-0">
                        <div class="row">
                            <div class="col-4 d-flex flex-column" style="border-right:1px solid #979090;">
                                <h5>Contato</h5>
                                <span>Telefone: +55 (17) 99657-5631</span>
                                <span>Email: olympiaworkout@gmail.com</span>
                            </div>
                            <div class="col-4">
                                <ul>
                                    <li class="footer-li"><a class="footer-a" href="about.html">Sobre Nós</a></li>
                                    <li class="footer-li"><a class="footer-a" href="team.html">Nossa Equipe</a></li>
                                    <li class="footer-li">Atalho 3</li>
                                    <li class="footer-li">Atalho 4</li>
                                </ul>
                            </div>
                            <div class="col-4">
                                <h5>Nossas redes sociais</h5>
                                <a class="footer-a fs-4 mx-1" href="https://instagram.com/olympia_workout?igshid=MzRIODBiNWFlZA"><i class="bi bi-instagram"></i></a>
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