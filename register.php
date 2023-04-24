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
    <link rel="stylesheet" href="./style/register.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="./javascript/main.js" defer></script>
    <script src="./javascript/register.js" defer></script>

</head>

<body style="background-color: #131211;">
    <!-- Corpo do site -->
    <div class="container-fluid fs-5 h-100">
        <!-- Parte laranja decorativa -->
        <div class="row h-100">
            <div class="col-12 col-md-6 bg-white d-flex text-center align-items-center justify-content-center title text-white position-relative titulo" style="background-color: #ff9f1a !important;">
                <div class="col-6">
                    <h1>Inscrever-se</h1>
                </div>
                <!-- Setinha redonda -->
                <div class="col-6 d-lg-flex d-none justify-content-end position-absolute top-50 end-0 p-2 rounded-circle d-flex align-items-center justify-content-center" id="circulo">
                    <a href="login.php" class="btn">
                        <span class="bi bi-caret-right-fill"></span>
                    </a>
                </div>
            </div>
            <!-- Formulario -->
            <div class="col-md-6 col-12 d-flex align-items-center justify-content-center text-white">
                <form action="./register_action.php" method="post">
                    <!-- Aparece o box de erro caso já existir conta no mesmo email - ERRO DE RETORNO -->
                    <?php
                    $emailDuplicado = isset($_GET['emailerror']) ? $_GET['emailerror'] : null; // Caso email error tiver setado = 1 caso não = null
                    if ($emailDuplicado) {
                        echo '<div class="row py-3">
                                <div class="col-12">
                                    <div class="alert alert-danger mb-0">
                                        Já existe uma conta vinculado à esse email. Deseja <a href="login.php">Logar-se</a>?
                                    </div>
                                </div>
                            </div>';
                    }
                    ?>
                    <div class="row py-3 sumir-logado">
                        <div class="col-12 ">
                            <div class="form-group">
                                <label for="nome" class="form-label">NOME</label>
                                <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite seu nome" required maxlength="50">
                            </div>
                        </div>
                    </div>
                    <div class="row py-3 sumir-logado">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="email" class="form-label">EMAIL</label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="Digite seu email" required maxlength="50">
                            </div>
                        </div>
                    </div>
                    <div class="row py-3 sumir-logado">
                        <div class="col-lg-6 col-12">
                            <div class="form-group">
                                <label for="senha" class="form-label">SENHA</label>
                                <input type="password" class="form-control" id="senha" name="senha" placeholder="Digite sua senha" required maxlength="12" minlength="4">
                            </div>
                        </div>
                        <div class="col-lg-6 col-12 mt-sm-4 mt-md-0">
                            <div class="form-group">
                                <label for="senha2" class="form-label">CONFIRME SUA SENHA</label>
                                <input type="password" class="form-control" id="senha2" name="senha2" placeholder="Repita sua senha" required maxlength="12" minlength="4">
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
                                echo '<button class="btn text-light mt-5" style="background-color: #005cb2;border:none;" id="continuar" onclick="return checkCampos()">INSCREVER-SE</button>';
                            }
                            ?>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>