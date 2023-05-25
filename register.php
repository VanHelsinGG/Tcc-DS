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
    <script src="javascript/main.js" defer></script>
    <script src="./javascript/register.js" defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans|Roboto|Montserrat&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="style/universal.css">
    <link rel="stylesheet" href="./style/register.css">
    <link rel="stylesheet" href="./images/bootstrap-icons-1.10.4/font/bootstrap-icons.css">
</head>

<body style="background-color: #131211;">
    <!-- Corpo do site -->
    <div class="container-fluid fs-5 h-100">
        <!-- Parte laranja decorativa -->
        <div class="row h-100">
            <div class="col-12 col-md-6 d-flex text-center align-items-center justify-content-center title text-white position-relative titulo a" style="background: #ff9f1a url('data:image/svg+xml,%3Csvg width=&quot;6&quot; height=&quot;6&quot; viewBox=&quot;0 0 6 6&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot;%3E%3Cg fill=&quot;%23ca7f16&quot; fill-opacity=&quot;1&quot; fill-rule=&quot;evenodd&quot;%3E%3Cpath d=&quot;M5 0h1L0 6V5zM6 5v1H5z&quot;/&gt;%3C/g%3E%3C/svg%3E');">
                <a href="index.php" class="btn text-white"><i class="bi bi-x display-4" style="position:absolute; left:0; top:0;"></i></a>
                <div class="col-7">
                    <h2 class="font-weight-bold fs-1">Já possui uma conta?</h2>
                    <p class="text-white text-opacity-75">Faça login e aproveite todos os recursos exclusivos!</p>
                    <a href="login.php" class="btn btn-outline-light w-100 btn-lg" style="border-radius:20px;">Conectar-se</a>
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
                <form action="register_action.php" method="post">
                    <div class="row">
                        <div class="col-12">
                            <h1 class="display-4 text-center">Inscreva-se</h1>
                        </div>
                    </div>
                    <!-- Aparece o box de erro caso já existir conta no mesmo email - ERRO DE RETORNO -->
                    <?php
                    $emailDuplicado = isset($_GET['emailerror']) ? $_GET['emailerror'] : null; // Caso email error tiver setado = 1 caso não = null
                    if ($emailDuplicado) {
                        echo '<div class="row py-3">
                                <div class="col-12">
                                    <div class="alert alert-danger mb-0">
                                        Já existe uma conta vinculado à esse email. Deseja <a href="login.php" class="text-primary">Logar-se</a>?
                                    </div>
                                </div>
                            </div>';
                    }
                    ?>
                    <div class="row py-3 sumir-logado">
                        <div class="col-12 ">
                            <div class="form-group">
                                <label for="nome" class="form-label">NOME</label>
                                <input type="text" class="form-control" id="nome" name="nome" autocomplete="off" placeholder="Digite seu nome" required maxlength="50">
                            </div>
                        </div>
                    </div>
                    <div class="row py-3 sumir-logado">
                        <div class="col-8">
                            <div class="form-group">
                                <label for="email" class="form-label">EMAIL</label>
                                <input type="text" class="form-control" id="email" name="email" autocomplete="off" placeholder="Digite seu email" required maxlength="50">
                            </div>
                        </div>
                        <div class="col-4">
                            <p class="form-label">SEXO</p>
                            <select id="sexo" name="sexo" tabindex="-1" class="form-control" style="box-shadow:none;background-color: #131211;border-radius: 0;border: 1px solid rgba(255, 255, 255, 0.4);outline: none;color: white;">
                                <option value="Masculino">Masculino</option>
                                <option value="Feminino">Feminino</option>
                                <option value="Outro">Outro</option>
                            </select>
                        </div>
                    </div>
                    <div class="row py-3 sumir-logado">
                        <div class="col-lg-6 col-12">
                            <div class="form-group">
                                <label for="senha" class="form-label">SENHA</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="senha" name="senha" autocomplete="off" placeholder="Digite sua senha" required maxlength="12" minlength="4" oninput="checkCampos()">
                                    <button class="btn toggleSenha" tabindex="-1" style="border:none; border-radius:0; border-bottom: 1px solid rgba(255, 255, 255, 0.4); margin-left:0.01rem; color:rgba(255, 255, 255, 0.5);" type="button" id="toggleSenha" onclick="mudarVisibilidadeSenha('senha');">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12 mt-sm-4 mt-md-0">
                            <div class="form-group">
                                <label for="senha2" class="form-label">CONFIRME SUA SENHA</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="senha2" name="senha2" autocomplete="off" placeholder="Repita sua senha" required maxlength="12" minlength="4" oninput="checkCampos()">
                                    <button class="btn toggleSenha" tabindex="-1" style="border:none; border-radius:0; border-bottom: 1px solid rgba(255, 255, 255, 0.4); margin-left:0.01rem; color:rgba(255, 255, 255, 0.5);" type="button" id="toggleSenha2" onclick="mudarVisibilidadeSenha('senha2');">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Data -->
                            <input type="hidden" name="data" id="data">
                            <!-- IP -->
                            <input type="hidden" name="ip" id="ip">
                        </div>
                    </div>
                    <div class="row py-1" id="sumir-senha-certa" style="display: none;">
                        <div class="alert p-1 alert-danger mb-0 text-center">
                            As senhas inseridas não são iguais!
                        </div>
                    </div>
                    <div class="row py-1" id="sumir-email-certo" style="display: none;">
                        <div class="alert p-1 alert-danger mb-0 text-center">
                            O email está em um formato inválido!
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <p class="text-white text-opacity-75" style="font-size:17px;"><span class="text-danger">**</span>Ao se registrar, você concorda com nossos termos de
                                uso.
                            <p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <?php
                            if ($func->verificarLogado()) {
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
                                echo '<button class="btn text-light mt-2 w-100 btn-lg" style="background-color: #005cb2;border:none;border-radius:20px;" id="continuar">Inscrever-se</button>';
                            }
                            ?>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Aviso de uso de cookies -->
    <div id="aviso-cookies" class="alert alert-info fixed-bottom mb-0 rounded-0 text-dark" style="display: none;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <p class="text-dark">Este site utiliza cookies para melhorar a sua experiência de navegação. Ao continuar
                        navegando, você concorda com o uso de cookies.</p>
                </div>
                <div class="col-md-4 text-end">
                    <button id="aceitar-cookies" class="btn btn-primary" onclick="aceitarCookies();">Aceitar</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>