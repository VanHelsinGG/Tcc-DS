<?php
include("../../main/lib/php/include.php");

$json_data = file_get_contents("php://input");

if (!$json_data) {
    echo "0";
    exit; // Termina a execução do script se não houver dados JSON válidos
}

$data = json_decode($json_data, true);

if (!$data) {
    echo "0";
    exit;
}

$nomeTreinamento = $data["nome"];
$aluno = $data["aluno"];
$professor = $data["professor"];
$duracao = $data["duracao"];

$professor = $user->getUserID_byName($professor);
$aluno = $user->getUserID_byName($aluno);

$serieString = "";
$exercicioString = "";
$focoString = "";

foreach ($data["treinos"] as $t => $treino) {
    $treinoNome = ucwords($treino["nome"]);

    $focoString .= $treinoNome;
    if ($t < count($data["treinos"])) {
        $focoString .= ";";
    }

    foreach ($treino["exercicios"] as $e => $exercicio) {
        $exercicioNome = $exercicio["nome"];

        $exercicioString .= $exercicioNome;

        if ($e < count($treino["exercicios"]) - 1) {
            $exercicioString .= ",";
        } else if ($t < count($data["treinos"])) {
            $exercicioString .= ";";
        }

        foreach ($exercicio["repeticoes"] as $r => $serie) {
            $serieString .= $serie;

            if ($r < count($exercicio["repeticoes"]) - 1) {
                $serieString .= ",";
            } else if ($e < count($treino["exercicios"]) - 1) {
                $serieString .= ";";
            } else if ($t < count($data["treinos"])) {
                $serieString .= ".";
            }
        }

    }
}

$query = "SELECT * FROM treinos WHERE aluno = ?";
$stmt = mysqli_prepare($db, $query);
mysqli_stmt_bind_param($stmt, "s", $aluno);
mysqli_stmt_execute($stmt);

if(mysqli_num_rows($stmt) > 0){
    $query = "UPDATE treinos SET status = 0 WHERE aluno = ? AND status = 1";
    $stmt = mysqli_prepare($db, $query);
    mysqli_stmt_bind_param($stmt, "s", $aluno);
    mysqli_stmt_execute($stmt);
}

$trainingData = [
    'nome' => $nomeTreinamento,
    'foco' => $focoString,
    'aluno' => $aluno,
    'professor' => $professor,
    'duracao' => $duracao,
    'exercicios' => $exercicioString,
    'series' => $serieString,
    'observacoes' => "",
];
$trainingID = $training->createTraining($trainingData);


$query = "DELETE FROM requisicoestreino WHERE user = ? ";
$stmt = mysqli_prepare($db, $query);
mysqli_stmt_bind_param($stmt, "s", $aluno);
mysqli_stmt_execute($stmt);

if ($trainingID) {
    echo "1";
} else {
    echo "0";
}
?>