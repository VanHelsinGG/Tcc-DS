<?php include("../../main/lib/php/include.php");

$func->preload();

$userNome = $_SESSION['nome'];
$userID = $_SESSION['id'];

session_abort();

if($user->getUserAccess_byID($userID) < 1){
    echo '<div class="container-fluid text-center">
           <div class="row">
                <div class="col w-100 text-center">
                    <h1>Opss... Vejo que você não possui permissão para acessar essa página!</h1>
                    <a class="btn btn-primary" href="../../user/main.php">Voltar</a>
                </div>
           </div>
    </div>';
    die();
}

$query = "SELECT nome FROM users";
$resultado = mysqli_query($db, $query);

$users = [];

while ($row = mysqli_fetch_assoc($resultado)) {
    $users[] = ucwords($row['nome']);
}

$users_json = json_encode($users);

echo "<script>var users = $users_json;</script>";
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel do Professor • OlympiaWorkout</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-scrollTo/2.1.3/jquery.scrollTo.min.js"></script>
    <script src="../../main/lib/js/main.js" defer></script>
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
                    <li class="my-1 option ps-2"><a href="dashboard.php" class="text-white btn my-2 w-100 text-start"><i
                                class="bi bi-house-fill me-3"></i>Inicio</a></li>
                    <li class="active my-1 option ps-2"><a href="createtraining.php"
                            class="text-white btn my-2 w-100 text-start"><i class="bi bi-fire me-3"></i>Criar
                            Treino</a></li>
                    <li class="my-1 option ps-2"><a href="requests.php"
                            class="text-white btn my-2 w-100 text-start"><i class="bi bi-archive-fill me-3"></i>Requisições de Treino</a></li>    
                    <li class="my-1 option ps-2"><a href="students.php" class="text-white btn my-2 w-100  text-start"><i
                                class="bi bi-person-fill me-3"></i>Seus Alunos</a></li>
                    <li class="my-1 option ps-2" style="border-top: 1px solid #363330;" id="user-icon"><a href="../../user/main.php"
                            class="text-white btn my-2"><i class="bi bi-person-circle me-3"></i><?php echo $userNome; ?></a></li>
                </ul>
            </nav>
            <main class="col-10 ms-auto col-lg-10 vh-100 p-0" style="overflow-x:hidden;">
                <header class="container-fluid text-center my-4 pb-4 pt-4">
                    <h1>Criar Treino - Painel do Professor</h1>
                </header>
                <form action="" method="post" class="p-4">
                    <div class="container rounded shadow-lg">
                        <div class="row bg-azul rounded text-white p-3">
                            <h2>Informações Gerais</h2>
                        </div>
                        <div class="row my-3 p-3">
                            <div class="col-6">
                                <div class="form-floating mb-3">
                                    <?php
                                    echo '<input type="text" class="form-control" disabled readonly id="Professor"
                                        placeholder="Professor" value="' . $userNome . '">';
                                    ?>
                                    <label for="Professor">Professor</label>

                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-floating mb-3">
                                    <?php
                                        if(isset($_GET['userid'])){
                                            $alunoNome = $user->getUserName_byID($_GET['userid']);
                                            echo '<input type="text" class="form-control" id="user" placeholder="Aluno" value="'.$alunoNome.'">';
                                        }else{
                                            echo '<input type="text" class="form-control" id="user" placeholder="Aluno">';
                                        }
                                    ?>
                                    <label for="user">Aluno</label>
                                </div>
                                <div class="sugestoes shadow-lg rounded" style="margin-top: -1rem;">

                                </div>
                                <div class="py-3" id="aviso-sugestao" style="display:none;">
                                    <div>
                                        <div class="alert alert-danger mb-0">
                                            Não há nenhum usuario cadastrado com esse nome.
                                        </div>
                                    </div>
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
                                    <input type="text" class="form-control" id="duracao" placeholder="Duração"
                                        inputmode="numeric" min="1" max="100">
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
                                    <div class="treinoContainer mt-5 row container d-none treino-template" id="treino-1"
                                        style="margin: 0 !important;margin-top: 2rem !important; padding: 0 !important;">
                                        <div class="row m-0 bg-azul rounded text-white p-3">
                                            <div class="col-2">
                                                <h2 id="titulo">Treino 1 - </h2>
                                            </div>
                                            <div class="col-10"><input type="text" class="form-control my-1 treino-i"
                                                    placeholder="Nome Treino"></div>
                                        </div>
                                        <div class="col-4 px-4 my-2 exercicio-c" id="exercicio-1-1">
                                            <div class="row">
                                                <h3 class="bg-escuro-terciario rounded p-2 px-3"><input type="text"
                                                        class="form-control my-1 exercicio-i" placeholder="Exercício 1">
                                                </h3>
                                            </div>
                                            <div class="row">
                                                <input type="text" class="form-control serie-i my-1 serie-1"
                                                    name="serie-i" placeholder="Serie 1" required max='100' min='1'
                                                    inputmode="numeric" pattern="[0-9]*">
                                                <input type="text" class="form-control serie-i my-1 serie-1"
                                                    name="serie-i" placeholder="Serie 2" required max='100' min='1'
                                                    inputmode="numeric" pattern="[0-9]*">
                                                <input type="text" class="form-control serie-i my-1 serie-1"
                                                    name="serie-i" placeholder="Serie 3" required max='100' min='1'
                                                    inputmode="numeric" pattern="[0-9]*">
                                                <input type="text" class="form-control serie-i my-1 serie-1"
                                                    name="serie-i" placeholder="Serie 4" required max='100' min='1'
                                                    inputmode="numeric" pattern="[0-9]*">
                                                <button type="button" class="btn btn-success mt-1"
                                                    onclick="adicionarInput(this)">Nova Serie</button>
                                            </div>
                                        </div>
                                        <div class="col-4 px-4 my-2 exercicio-c" id="exercicio-1-2">
                                            <div class="row">
                                                <h3 class="bg-escuro-terciario rounded p-2 px-3"><input type="text"
                                                        class="form-control my-1 exercicio-i" placeholder="Exercício 2">
                                                </h3>
                                            </div>
                                            <div class="row">
                                                <input type="text" class="form-control serie-i my-1 serie-1"
                                                    name="serie-i" placeholder="Serie 1" required max='100' min='1'
                                                    inputmode="numeric" pattern="[0-9]*">
                                                <input type="text" class="form-control serie-i my-1 serie-1"
                                                    name="serie-i" placeholder="Serie 2" required max='100' min='1'
                                                    inputmode="numeric" pattern="[0-9]*">
                                                <input type="text" class="form-control serie-i my-1 serie-1"
                                                    name="serie-i" placeholder="Serie 3" required max='100' min='1'
                                                    inputmode="numeric" pattern="[0-9]*">
                                                <input type="text" class="form-control serie-i my-1 serie-1"
                                                    name="serie-i" placeholder="Serie 4" required max='100' min='1'
                                                    inputmode="numeric" pattern="[0-9]*">
                                                <button type="button" class="btn btn-success mt-1"
                                                    onclick="adicionarInput(this)">Nova Serie</button>
                                            </div>
                                        </div>
                                        <div class="col-4 px-4 my-2 exercicio-c" id="exercicio-1-3">
                                            <div class="row">
                                                <h3 class="bg-escuro-terciario rounded p-2 px-3"><input type="text"
                                                        class="form-control my-1 exercicio-i" placeholder="Exercício 3">
                                                </h3>
                                            </div>
                                            <div class="row">
                                                <input type="text" class="form-control serie-i my-1 serie-1"
                                                    name="serie-i" placeholder="Serie 1" required max='100' min='1'
                                                    inputmode="numeric" pattern="[0-9]*">
                                                <input type="text" class="form-control serie-i my-1 serie-1"
                                                    name="serie-i" placeholder="Serie 2" required max='100' min='1'
                                                    inputmode="numeric" pattern="[0-9]*">
                                                <input type="text" class="form-control serie-i my-1 serie-1"
                                                    name="serie-i" placeholder="Serie 3" required max='100' min='1'
                                                    inputmode="numeric" pattern="[0-9]*">
                                                <input type="text" class="form-control serie-i my-1 serie-1"
                                                    name="serie-i" placeholder="Serie 4" required max='100' min='1'
                                                    inputmode="numeric" pattern="[0-9]*">
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
                                    <div class="treinoContainer mt-5 row container treino-1" id="treino-1"
                                        style="margin: 0 !important;margin-top: 2rem !important; padding: 0 !important;">
                                        <div class="row m-0 bg-azul rounded text-white p-3">
                                            <div class="col-2">
                                                <h2 id="titulo">Treino 1 - </h2>
                                            </div>
                                            <div class="col-10"><input type="text" class="form-control my-1 treino-i"
                                                    placeholder="Nome Treino"></div>
                                        </div>
                                        <div class="col-4 px-4 my-2 exercicio-c" id="exercicio-1-1">
                                            <div class="row">
                                                <h3 class="bg-escuro-terciario rounded p-2 px-3"><input type="text"
                                                        class="form-control my-1 exercicio-i" placeholder="Exercício 1">
                                                </h3>
                                            </div>
                                            <div class="row">
                                                <input type="text" class="form-control serie-i my-1 serie-1"
                                                    name="serie-i" placeholder="Serie 1" required max='100' min='1'
                                                    inputmode="numeric" pattern="[0-9]*">
                                                <input type="text" class="form-control serie-i my-1 serie-1"
                                                    name="serie-i" placeholder="Serie 2" required max='100' min='1'
                                                    inputmode="numeric" pattern="[0-9]*">
                                                <input type="text" class="form-control serie-i my-1 serie-1"
                                                    name="serie-i" placeholder="Serie 3" required max='100' min='1'
                                                    inputmode="numeric" pattern="[0-9]*">
                                                <input type="text" class="form-control serie-i my-1 serie-1"
                                                    name="serie-i" placeholder="Serie 4" required max='100' min='1'
                                                    inputmode="numeric" pattern="[0-9]*">
                                                <button type="button" class="btn btn-success mt-1"
                                                    onclick="adicionarInput(this)">Nova Serie</button>
                                            </div>
                                        </div>
                                        <div class="col-4 px-4 my-2 exercicio-c" id="exercicio-1-2">
                                            <div class="row">
                                                <h3 class="bg-escuro-terciario rounded p-2 px-3"><input type="text"
                                                        class="form-control my-1 exercicio-i" placeholder="Exercício 2">
                                                </h3>
                                            </div>
                                            <div class="row">
                                                <input type="text" class="form-control serie-i my-1 serie-1"
                                                    name="serie-i" placeholder="Serie 1" required max='100' min='1'
                                                    inputmode="numeric" pattern="[0-9]*">
                                                <input type="text" class="form-control serie-i my-1 serie-1"
                                                    name="serie-i" placeholder="Serie 2" required max='100' min='1'
                                                    inputmode="numeric" pattern="[0-9]*">
                                                <input type="text" class="form-control serie-i my-1 serie-1"
                                                    name="serie-i" placeholder="Serie 3" required max='100' min='1'
                                                    inputmode="numeric" pattern="[0-9]*">
                                                <input type="text" class="form-control serie-i my-1 serie-1"
                                                    name="serie-i" placeholder="Serie 4" required max='100' min='1'
                                                    inputmode="numeric" pattern="[0-9]*">
                                                <button type="button" class="btn btn-success mt-1"
                                                    onclick="adicionarInput(this)">Nova Serie</button>
                                            </div>
                                        </div>
                                        <div class="col-4 px-4 my-2 exercicio-c" id="exercicio-1-3">
                                            <div class="row">
                                                <h3 class="bg-escuro-terciario rounded p-2 px-3"><input type="text"
                                                        class="form-control my-1 exercicio-i" placeholder="Exercício 3">
                                                </h3>
                                            </div>
                                            <div class="row">
                                                <input type="text" class="form-control serie-i my-1 serie-1"
                                                    name="serie-i" placeholder="Serie 1" required max='100' min='1'
                                                    inputmode="numeric" pattern="[0-9]*">
                                                <input type="text" class="form-control serie-i my-1 serie-1"
                                                    name="serie-i" placeholder="Serie 2" required max='100' min='1'
                                                    inputmode="numeric" pattern="[0-9]*">
                                                <input type="text" class="form-control serie-i my-1 serie-1"
                                                    name="serie-i" placeholder="Serie 3" required max='100' min='1'
                                                    inputmode="numeric" pattern="[0-9]*">
                                                <input type="text" class="form-control serie-i my-1 serie-1"
                                                    name="serie-i" placeholder="Serie 4" required max='100' min='1'
                                                    inputmode="numeric" pattern="[0-9]*">
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
                        <div class="col-10">
                            <div class="py-3" id="aviso-erro" style="display:none;">
                                <div>
                                    <div class="alert alert-danger mb-0">
                                        Houve um erro ao processar o treinamento, contate um administrador!
                                    </div>
                                </div>
                            </div>
                            <div class="py-3" id="aviso-sucesso" style="display:none;">
                                <div>
                                    <div class="alert alert-success mb-0">
                                        Treino criado com sucesso!
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-2 text-end">
                            <button type="button" id="criar-treinamento" class="btn btn-roxo text-white my-2"
                                onclick="criarTreinamento();">Criar treino</button>
                        </div>
                    </div>
                </div>
                <div class="modal" id="loadingModal" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-body escuro p-5 rounded">
                                <div class="text-center">
                                    <div class="spinner-border text-white" role="status">
                                    </div>
                                    <p>Aguarde enquanto processamos sua solicitação...</p>
                                </div>
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
                                <a class="footer-a fs-4 mx-1"
                                    href="https://instagram.com/olympia_workout?igshid=MzRIODBiNWFlZA"><i
                                        class="bi bi-instagram"></i></a>
                                <a href="https://w.app/OlympiaWorkout" class="footer-a fs-4 mx-1"><i
                                        class="bi bi-whatsapp"></i></a>
                                <a href="#" class="footer-a fs-4 mx-1"><i class="bi bi-facebook"></i></a>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12">
                                <p>&copy; <span id="data">{data}</span> OlympiaWorkout. Todos os direitos reservados.
                                </p>
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