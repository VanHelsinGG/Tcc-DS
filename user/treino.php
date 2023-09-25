<?php
include("../main/lib/php/include.php");

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    if (isset($_GET['treinoid'])) {
        echo "<title>Treino • " . $training->getTrainingsTrated($_GET['treinoid'],$_GET['treino']) . " • OlympiaWorkout</title>";
    } else {
        echo "<title>OlympiaWorkout: Promovendo Saúde e Bem-Estar</title>";
    }
    ?>
    <script src="../main/lib/js/main.js" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <link rel="stylesheet" href="../main/lib/css/universal.css">
    <link rel="stylesheet" href="./lib/css/treino.css">
    <link rel="stylesheet" href="../main/lib/images/bootstrap-icons-1.10.4/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body style="background-color:#1d1c1a;color:white;">

    <div class="container">
        <div class="row">
            
        <?php
            $exercicios = $training->getExercisesTrated($_GET['treinoid'], $_GET['treino']);
            foreach ($exercicios as $e => $ee) {
                $series = $training->getSeriesTrated($_GET['treinoid'], $_GET['treino'], $e);

                echo '<div class="col-4 p-2">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">'.$ee.'</h5>';
                foreach ($series as $s => $se) {
                    echo "<a class='btn rounded-circle' style='outline: 1px solid black;'></a> Serie " . ($s + 1) . ": " . $se . "<br>";
                }
                echo '</div></div></div>';
            }
        ?>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>
