<?php
include("../main/lib/php/include.php");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OlympiaWorkout: Promovendo Saúde e Bem-Estar</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../main/lib/js/main.js" defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans|Roboto|Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../main/lib/css/universal.css">
    <link rel="stylesheet" href="../main/lib/images/bootstrap-icons-1.10.4/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./lib/css/login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

</head>

<body style="background-color: #131211;">
    <header class="container-fluid d-md-none d-block bg-laranja p-2">
        <div class="row">
            <div class="col-12 p-2 text-center">
                <h1 class="text-white">OlympiaWorkout</h1>
            </div>
        </div>
    </header>
    <div class="container-fluid fs-md-5 h-100" id="formulario">
        <div class="row h-100">
            <div class="col-md-6 col-12 d-flex align-items-md-center align-items-start justify-content-center text-white">
                <form action="actions/login_action.php" method="post">
                    <div class="row">
                        <div class="col-12">
                            <h1 class="display-4 text-center">Conectar-se</h1>
                            <p class="d-md-none d-block text-center">Ainda não é registrado? <a id="registro-mobile" href="register.php">Registrar-se</a></p>
                        </div>
                    </div>
                    <?php
                    $emailDuplicado = isset($_GET['usererror']) ? $_GET['usererror'] : null; // Caso email error tiver setado = 1 caso não = null
                    if ($emailDuplicado) {
                        echo '<div class="row py-3">
                                    <div class="col-12">
                                        <div class="alert alert-danger mb-0">
                                            Usuário ou senha inválidos. <a href="">Esqueceu a senha?</a>
                                        </div>
                                    </div>
                                </div>';
                    }
                    ?>
                    <div class="row py-3 sumir-logado">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="email" class="form-label">EMAIL</label>
                                <?php
                                    if(isset($_GET['register'])){
                                        session_start();

                                        echo '<input type="text" class="form-control" id="email" name="email" autocomplete="off"
                                        placeholder="Digite seu email" required maxlength="50" value="'.$_SESSION['userEmail'].'">';
                                        
                                        session_abort();
                                    }else{
                                        echo '<input type="text" class="form-control" id="email" name="email" autocomplete="off"
                                        placeholder="Digite seu email" required maxlength="50">';
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="row py-3 sumir-logado">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="senha" class="form-label">SENHA</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="senha" name="senha"
                                        autocomplete="off" placeholder="Digite sua senha" required maxlength="12"
                                        minlength="4">
                                    <button class="btn toggleSenha" tabindex="-1"
                                        style="border:none; border-radius:0; border-bottom: 1px solid rgba(255, 255, 255, 0.4); color:rgba(255, 255, 255, 0.5);"
                                        type="button" id="toggleSenha" onclick="mudarVisibilidadeSenha('senha');">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <?php
                        if (isset($_GET['registro']) && $_GET['registro'] == 1) {
                            echo "<input type='hidden' id='registro' name='registro' value='1'>";
                        }
                        ?>
                    </div>
                    <div class="row">
                        <div class="col">
                            <?php
                            if ($func->verificarLogado()) {
                                echo '<div class="row py-3">
                                        <div class="col-12">
                                            <div class="alert alert-danger mb-0">
                                                Você já está logado!
                                                <a href="./actions/deslogar.php?redirect=../login.php">Deslogar-se</a>
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
            <div class="col-12 col-md-6 d-md-flex d-none text-center align-items-center justify-content-center text-white position-relative titulo"
                style="background: #ff9f1a url('data:image/svg+xml,%3Csvg width=&quot;6&quot; height=&quot;6&quot; viewBox=&quot;0 0 6 6&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot;%3E%3Cg fill=&quot;%23ca7f16&quot; fill-opacity=&quot;1&quot; fill-rule=&quot;evenodd&quot;%3E%3Cpath d=&quot;M5 0h1L0 6V5zM6 5v1H5z&quot;/&gt;%3C/g%3E%3C/svg%3E');">
                <a href="index.php" class="btn text-white"><i class="bi bi-x display-4"
                        style="position:absolute; right:0; top:0;"></i></a>
                <div class="col-7">
                    <h2 class="font-weight-bold fs-1">Quer se tornar membro?</h2>
                    <p class="text-white text-opacity-75">Inscreva-se agora mesmo e aproveite todos os benefícios
                        exclusivos!</p>
                    <a href="register.php" class="btn btn-outline-light w-100 btn-lg"
                        style="border-radius:20px;">Inscrever-se</a>
                </div>
                <div class="col-6 d-lg-flex d-none position-absolute top-50 end-0 p-2 rounded-circle justify-content-center align-items-center"
                    id="circulo">
                    <a href="register.php" class="btn">
                        <span class="bi bi-caret-left-fill"></span>
                    </a>
                </div>
            </div>
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