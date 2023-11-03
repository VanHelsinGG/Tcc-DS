<?php
include("../../main/lib/php/include.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];
        if ($action === 'RESET' && isset($_POST['treinoID'])) {
            $treinoID = $_POST['treinoID'];

            $query = "DELETE FROM treinos_andamento WHERE idtreino = ?";
            $stmt = mysqli_prepare($db, $query);

            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "s", $treinoID);
                if (mysqli_stmt_execute($stmt) && mysqli_stmt_affected_rows($stmt) > 0) {
                    echo json_encode(['status' => 'success', 'message' => 'O treino em andamento foi resetado com sucesso.']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Erro ao resetar o treino em andamento.']);
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Erro na preparação da consulta.']);
            }
        } elseif ($action === 'SAVE' && isset($_POST['treinoID']) && isset($_POST['tempoDecorrido'])) {
            $treinoID = $_POST['treinoID'];
            $tempoDecorrido = $_POST['tempoDecorrido'];

            $query = "SELECT * FROM treinos_andamento WHERE idtreino = ?";
            $stmt = mysqli_prepare($db, $query);

            if ($stmt) {
                mysqli_stmt_bind_param($stmt, 's', $treinoID);
                if (mysqli_stmt_execute($stmt)) {
                    $result = mysqli_stmt_get_result($stmt);
                    if ($result && $row = mysqli_fetch_assoc($result)) {
                        $query = 'UPDATE treinos_andamento SET tempoDecorrido = ? WHERE idtreino = ?';
                        $stmt = mysqli_prepare($db, $query);
                        mysqli_stmt_bind_param($stmt, 'ss', $tempoDecorrido, $treinoID);
                        if (mysqli_stmt_execute($stmt)) {
                            echo json_encode(['status' => 'success', 'message' => 'Tempo decorrido atualizado com sucesso.']);
                        } else {
                            echo json_encode(['status' => 'error', 'message' => 'Erro ao atualizar o tempo decorrido.']);
                        }
                    } else {
                        $query = 'INSERT INTO treinos_andamento(idtreino, tempoDecorrido) VALUES (?, ?)';
                        $stmt = mysqli_prepare($db, $query);
                        mysqli_stmt_bind_param($stmt, 'ss', $treinoID, $tempoDecorrido);
                        if (mysqli_stmt_execute($stmt)) {
                            echo json_encode(['status' => 'success', 'message' => 'Tempo decorrido inserido com sucesso.']);
                        } else {
                            echo json_encode(['status' => 'error', 'message' => 'Erro ao inserir o tempo decorrido.']);
                        }
                    }
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Erro na preparação da consulta.']);
            }
        }elseif ($action === "FINISH" && isset($_POST['treinoID']) && isset($_POST['data']) && isset($_POST['tempoDecorrido'])){
            $treinoID = $_POST['treinoID'];
            $tempoDecorrido = $_POST['tempoDecorrido'];
            $data = $_POST['data'];

            $query = "INSERT INTO treinos_concluidos (treino, tempoDecorrido, dataConclusao) VALUES (?,?,?)";
            $stmt = mysqli_prepare($db, $query);

            if($stmt){
                mysqli_stmt_bind_param($stmt, 'sss', $treinoID,$tempoDecorrido,$data);
                if (mysqli_stmt_execute($stmt)) {
                    $query = "DELETE FROM treinos_andamento WHERE idtreino = ?";
                    $stmt = mysqli_prepare($db, $query);

                    if ($stmt) {
                        mysqli_stmt_bind_param($stmt, "s", $treinoID);
                        if (mysqli_stmt_execute($stmt) && mysqli_stmt_affected_rows($stmt) > 0) {
                            echo json_encode(['status' => 'success', 'message' => 'Treino finalizado com sucesso!']);
                        } else {
                            echo json_encode(['status' => 'error', 'message' => 'Erro ao finalizar o treino!']);
                        }
                    } else {
                        echo json_encode(['status' => 'error', 'message' => 'Erro na preparação da consulta.']);
                    }
                }else{
                    echo json_encode(['status' => 'error', 'message' => 'Erro ao finalizar o treino!']);
                }
            }else{
                echo json_encode(['status' => 'error', 'message' => 'Erro na preparação da consulta.']);
            }
        }else {
            echo json_encode(['status' => 'error', 'message' => 'Ação inválida ou parâmetros ausentes.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Ação ausente.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Método de requisição inválido.']);
}
?>
