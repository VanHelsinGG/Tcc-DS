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
if ($trainingID) {
    echo "1";
    die();
} else {
    echo "0";
}
?>