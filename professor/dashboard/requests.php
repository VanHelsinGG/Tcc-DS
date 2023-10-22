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
                    <li class="my-1 option ps-2"><a href="dashboard.php" class="text-white btn my-2 w-100 text-start"><i
                                class="bi bi-house-fill me-3"></i>Inicio</a></li>
                    <li class="my-1 option ps-2"><a href="createtraining.php"
                            class="text-white btn my-2 w-100 text-start"><i class="bi bi-fire me-3"></i>Criar
                            Treino</a></li>
                    <li class="active my-1 option ps-2"><a href="requests.php"
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
                    <h1>Requisições de Treino - Painel do Professor</h1>
                </header>

                <div class="container-fluid">
                    <table class="table-dark table-striped table text-center">
                        <?php
                                    
                            $query = 'SELECT * FROM requisicoestreino';

                            $stmt = mysqli_prepare($db, $query);
                            mysqli_stmt_execute($stmt);

                            $resultados = mysqli_stmt_get_result($stmt);

                            if (!mysqli_num_rows($resultados)) {
                                echo "Não há requisições pendentes!";
                            } else {
                                echo "<tr>
                                        <th>Data</th>
                                        <th>ID</th>
                                        <th>Aluno</th>
                                        <th>Email</th>
                                        <th>Preferencia</th>
                                        <th></th>
                                    </tr>";

                                while ($row = mysqli_fetch_assoc($resultados)) {
                                    $alunoNome = $user->getUserName_byID($row['user']);
                                    $alunoEmail = $user->getUserEmail_byID($row['user']);

                                    if($row['professor'] == -1){
                                        $preferencia = "<span>Nenhuma</span>";
                                    }else{
                                        $preferencia = "<span class='text-success'>".$user->getUserName_byID($row['professor'])."</span>";
                                    }

                                    echo "<tr>
                                        <td>" . $row['data_requisicao'] . "</td>
                                        <td>" . $row['user'] . "</td>
                                        <td>" . $alunoNome . "</td>
                                        <td>" . $alunoEmail. "</td>
                                        <td>" .$preferencia. "</td>
                                        <td><a class='btn btn-outline-primary w-100' href='createtraining.php?userid=".$row['user']."'>Criar Treino</a></td>
                                    </tr>";
                                }
                                
                            }


                        ?>
                    </table>
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