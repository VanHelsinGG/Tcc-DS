<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="javascript/objetivo.js" defer></script>
    <link rel="stylesheet" type="text/css" href="./style/universal.css">
    <link rel="stylesheet" type="text/css" href="./style/escolha.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans|Roboto|Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./images/bootstrap-icons-1.10.4/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <style>
        body {
            overflow: hidden;
        }

        .background {
            background-size: cover;
            background-repeat: no-repeat;
            filter: grayscale(100%);
            opacity: 0.4;
            height: 100vh;
            transition: all 0.5s ease-in-out;
        }

        .background:hover {
            filter: grayscale(0%);
            opacity: 1;
            cursor: pointer;
            transform: scale(1.04);
            z-index: 999;
        }

        .hipertrofia {
            background-image: url("https://s2.glbimg.com/RGikXR-60XyINwunHAuXUWAa3qg=/e.glbimg.com/og/ed/f/original/2021/01/08/jonathan-borba-lrqptqs7nqq-unsplash.jpg");
        }

        .manter-peso {
            background-image: url("https://static.mundoeducacao.uol.com.br/mundoeducacao/2019/07/alimentacao.jpg");
        }

        .emagrecimento {
            background-image: url("https://conteudo.imguol.com.br/blogs/235/files/2018/03/iStock-140465120-1024x681.jpg");
        }

        .container-fluid {
            background-color: black;
        }

        .alert.show+.container-fluid .background {
            pointer-events: none;
            opacity: 0.1;
        }

        h5 {
            background-color: var(--azul-complementar);
            color: white;
            font-family: var(--texto-secundario);
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-4 background hipertrofia d-flex justify-content-center align-items-center">
                <h5 class="fs-2 p-1">Hipertrofia</h5>
            </div>
            <div class="col-4 background manter-peso d-flex justify-content-center align-items-center">
                <h5 class="fs-2 p-1">Manter peso</h5>
            </div>
            <div class="col-4 background emagrecimento d-flex justify-content-center align-items-center">
                <h5 class="fs-2 p-1">Emagrecimento</h5>
            </div>
        </div>
    </div>

    <form method="get">
        <input type="hidden" name="objetivo" id="objetivo">
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
<?php
include("./php/connector.php");
include("./php/functions.php");

// if(!$user->userAuthenticated()){
//     $func->redirect_withParams("redirectpage","objetivo.php","./login.php");
//     return 0;
// }

if(!isset($_GET['objetivo'])){
    $func->showAlert("Aprimore sua experiência!","Seu cadastro foi um sucesso e agora você pode aproveitar ao máximo nossos recursos personalizados. Escolha seu objetivo e deixe que nossa equipe especializada o guie rumo à conquista de suas metas. Vamos juntos alcançar o sucesso!","Continuar");
}else {
    $query = "UPDATE users SET objetivo = ? WHERE token = ?";
    $stmt = mysqli_prepare($db, $query);
    mysqli_stmt_bind_param($stmt, "ss", $_GET['objetivo'], $_COOKIE['logado']);
    mysqli_stmt_execute($stmt);

    $func->showAlert("Estamos quase lá!","Em breve você estará na página principal e terá acesso a todo o nosso conteúdo incrível. Preparado para explorar o melhor que temos a oferecer? Vamos lá!");
    echo '<meta http-equiv="refresh" content="5; url=index.php">';
}
?>

</html>