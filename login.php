<?php
include("./php/functions.php");

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OlympiaWorkout: Promovendo Saúde e Bem-Estar</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans|Roboto|Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./style/universal.css">
    <link rel="stylesheet" href="./images/bootstrap-icons-1.10.4/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./style/login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="./javascript/main.js" defer></script>

</head>

<body style="background-color: #131211;">
    <div class="container-fluid fs-5 h-100">
        <div class="row h-100">
            <div class="col-md-6 col-12 d-flex align-items-center justify-content-center text-white">
                <form action="login_action.php" method="post">
                    <div class="row">
                        <div class="col-12">
                            <h1 class="display-4 text-center">Conectar-se</h1>
                        </div>
                    </div>
                    <?php
                    $emailDuplicado = isset($_GET['usererror']) ? $_GET['usererror'] : null; // Caso email error tiver setado = 1 caso não = null
                    if ($emailDuplicado) {
                        echo '<div class="row py-3">
                                    <div class="col-12">
                                        <div class="alert alert-danger mb-0">
                                            Usuário ou senha inválidos.
                                        </div>
                                    </div>
                                </div>';
                    }
                    ?>
                    <div class="row py-3 sumir-logado">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="email" class="form-label">EMAIL</label>
                                <input type="text" class="form-control" id="email" name="email" autocomplete="off" placeholder="Digite seu email" required maxlength="50">
                            </div>
                        </div>
                    </div>
                    <div class="row py-3 sumir-logado">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="senha" class="form-label">SENHA</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="senha" name="senha" autocomplete="off" placeholder="Digite sua senha" required maxlength="12" minlength="4">
                                    <button class="btn toggleSenha" style="border:none; border-radius:0; border-bottom: 1px solid rgba(255, 255, 255, 0.4); color:rgba(255, 255, 255, 0.5);" type="button" id="toggleSenha" onclick="mudarVisibilidadeSenha('senha');">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <?php
                            if (verificarLogado()) {
                                echo '<div class="row py-3">
                                        <div class="col-12">
                                            <div class="alert alert-danger mb-0">
                                                Você já está logado!
                                                <a href="deslogar.php">Deslogar-se</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row py-3">
                                        <div class="col-12">
                                            <a href="index.php" class="btn btn-azul text-light">Página Inicial</a>
                                        </div>
                                    </div>
                                    <style>
                                        .sumir-logado{
                                            display:none;
                                        }
                                    </style>
                                    ';
                            } else {
                                echo '<button class="btn text-light mt-5 btn-lg w-100" style="background-color: #005cb2;border:none;border-radius:20px;" id="continuar">Conectar-se</button>';
                            }
                            ?>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-12 col-md-6 d-flex text-center align-items-center justify-content-center text-white position-relative titulo" style="background: #ff9f1a url('data:image/svg+xml,%3Csvg width=&quot;6&quot; height=&quot;6&quot; viewBox=&quot;0 0 6 6&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot;%3E%3Cg fill=&quot;%23ca7f16&quot; fill-opacity=&quot;1&quot; fill-rule=&quot;evenodd&quot;%3E%3Cpath d=&quot;M5 0h1L0 6V5zM6 5v1H5z&quot;/&gt;%3C/g%3E%3C/svg%3E');">
                <a href="index.php" class="btn text-white"><i class="bi bi-x display-4" style="position:absolute; right:0; top:0;"></i></a>
                <div class="col-7">
                    <h2 class="font-weight-bold fs-1">Quer se tornar membro?</h2>
                    <p class="text-white text-opacity-75">Inscreva-se agora mesmo e aproveite todos os benefícios exclusivos!</p>
                    <a href="register.php" class="btn btn-outline-light w-100 btn-lg" style="border-radius:20px;">Inscrever-se</a>
                </div>
                <div class="col-6 d-lg-flex d-none position-absolute top-50 end-0 p-2 rounded-circle justify-content-center align-items-center" id="circulo">
                    <a href="register.php" class="btn">
                        <span class="bi bi-caret-left-fill"></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>