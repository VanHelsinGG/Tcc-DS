<?php
include("../../main/lib/php/include.php");

if (isset($_POST['exercicios'])) {
    $dados_json = json_decode($_POST['exercicios']);

    if ($dados_json !== null) {
        // Construir a consulta SQL com base nos nomes de exercício do JSON
        $placeholders = implode(',', array_fill(0, count($dados_json), '?'));
        $sql = "SELECT nomeExercicio, exercicio FROM exercicios WHERE nomeExercicio IN ($placeholders)";
        
        // Preparar a consulta
        $stmt = $db->prepare($sql);

        if ($stmt) {
            // Vincular os parâmetros
            $tipos = str_repeat('s', count($dados_json)); // Assume que todos os nomes são strings
            $stmt->bind_param($tipos, ...$dados_json);

            // Executar a consulta
            $executou = $stmt->execute();

            if ($executou) {
                // Vincular os resultados
                $stmt->bind_result($nomeExercicio, $exercicio);

                $exercicios_encontrados = [];

                // Processar os resultados
                while ($stmt->fetch()) {
                    // Adicionar os dados ao array de resultados
                    $exercicios_encontrados[] = [
                        'nomeExercicio' => $nomeExercicio,
                        'exercicio' => base64_encode($exercicio), // Convertendo o longblob para base64
                    ];
                }

                // Retornar o resultado como JSON
                echo json_encode($exercicios_encontrados);
                
                // Fechar o statement
                $stmt->close();
            } else {
                // A execução da consulta falhou
                echo json_encode(['erro' => 'Erro na execução da consulta SQL']);
            }
        } else {
            // A preparação da consulta falhou
            echo json_encode(['erro' => 'Erro na preparação da consulta SQL: ' . $conexao->error]);
        }
    } else {
        // Falha na decodificação JSON
        echo json_encode(['erro' => 'Falha na decodificação JSON']);
    }
} else {
    // Nenhum dado de exercícios recebido
    echo json_encode(['erro' => 'Nenhum dado de exercícios recebido']);
}
