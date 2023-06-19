<?php
include("../main/lib/php/include.php");

$GLOBALS['erro'] = 0;

if ($func->verificarLogado()) {
    $cookieToken = $_COOKIE["logado"];

    if ($id = $user->getUserID_byToken($cookieToken)) {
        $user_token = $user->getUserToken_byID($id);

        if ($user_token == -1 || strcmp($user_token, $cookieToken) || !$userToken->validToken($user_token)) {
            $GLOBALS['erro'] = 1;
        } else {
            $GLOBALS['treinoID'] = $_GET['treinoid'];
            $GLOBALS['treino'] = $_GET['treino'];

            $GLOBALS['userNome'] = $user->getUserName_byToken($user_token);

            $func->setarCookie("autenticado", 1, 1);

            // Verifica se já escolheu o objetivo
            if ($user->getUserObjective_byID($id) === -1) {
                $redirectUrl = urlencode("objetivo.php");
                header("Location: $redirectUrl");
                exit();
            }

            echo '<script>var userName = "' . $GLOBALS['userNome'] . '"</script>';
        }
    } else {
        $GLOBALS['erro'] = 1;
    }
} else {

    $GLOBALS['erro'] = 1;
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    if (isset($GLOBALS['treinoID'])) {
        echo "<title>Treino • " . $training->getTrainingsTrated($GLOBALS['treinoID'],$GLOBALS['treino']) . " • OlympiaWorkout</title>";
    } else {
        echo "<title>OlympiaWorkout: Promovendo Saúde e Bem-Estar</title>";
    }
    ?>
    <script src="../main/lib/js/main.js" defer></script>
    <link rel="stylesheet" href="../main/lib/css/universal.css">
    <link rel="stylesheet" href="../main/lib/images/bootstrap-icons-1.10.4/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body style="background-color:#1d1c1a;color:white;">

    <?php

    $exercicios = $training->getExercisesTrated($GLOBALS['treinoID'], $GLOBALS['treino']);
    foreach ($exercicios as $e => $ee) {
        echo "Exercicio " . $ee . "<br>";

        $series = $training->getSeriesTrated($GLOBALS['treinoID'], $GLOBALS['treino'], $e);

        foreach ($series as $s => $se) {
            echo "Serie " . ($s + 1) . ": " . $se . "<br>";
        }
    }
    echo "<br><br>";
    ?>

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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>

<?php
if ($GLOBALS['erro']) {
    $func->setarCookie("autenticado", 0, 0);
    $func->showAlert("Sessão expirada!", "Sua sessão foi encerrada. Para acessar sua conta, por favor faça login novamente.", "Continuar", "", "./actions/deslogar.php?redirect=../login.php");
}
?>