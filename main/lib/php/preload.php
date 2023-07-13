<?php

/** O arquivo 'preload.php' faz as verificações necessárias para o funcionamento adequado do sistema, como:
 * - Atualização dos ranks semanais, diarios e mensais;
 * - Autenticação da sessão por Token.
 * Versão 08/07/23
 */


// Inclui os arquivos necessários
include("connector.php"); // Arquivo que realiza a conexão com o banco de dados
include_once("settings.php"); // Arquivo de configurações gerais
include("functions.php"); // Arquivo com funções auxiliares

/** ATUALIZAÇÃO DOS RANKS */
if (ENABLE_PRELOADFILE_ATT_RANKS) {
    $data_atual = date("Y-m-d"); // Obtém a data atual no formato Y-m-d

    // Seleciona todos os registros da tabela "exercicios_diarios"
    $query = "SELECT * FROM exercicios_diarios";
    $stmt = mysqli_prepare($db, $query); // Prepara a consulta SQL
    mysqli_stmt_execute($stmt); // Executa a consulta
    $resultado = mysqli_stmt_get_result($stmt); // Obtém o resultado da consulta

    // Verifica se existem registros retornados
    if (mysqli_num_rows($resultado) > 0) {
        // Deleta os registros da tabela "exercicios_diarios" que correspondem à data atual
        $query = "DELETE FROM exercicios_diarios WHERE exclusao = ?";
        $stmt = mysqli_prepare($db, $query); // Prepara a consulta SQL
        mysqli_stmt_bind_param($stmt, "s", $data_atual); // Define o valor do parâmetro
        mysqli_stmt_execute($stmt); // Executa a consulta

        // Obtém a quantidade de registros afetados pela exclusão
        $qnt = mysqli_affected_rows($db);

        // Verifica se registros foram deletados e registra um log
        if ($qnt) {
            $string = "[exercicios_diarios] Foram deletados $qnt registros.";
            $func->Log('auto_delete', $string);
        }
    }

    // Obtém a próxima data de atualização semanal da tabela "configs"
    $query = "SELECT prox_att_semanal AS semanal FROM configs";
    $stmt = mysqli_prepare($db, $query); // Prepara a consulta SQL
    mysqli_stmt_execute($stmt); // Executa a consulta
    $resultado = mysqli_stmt_get_result($stmt); // Obtém o resultado da consulta
    $row = mysqli_fetch_assoc($resultado); // Obtém a linha de resultado como um array associativo

    // Verifica se a data atual é igual à próxima data de atualização semanal
    if ($data_atual === $row['semanal']) {
        // Realiza o reset dos registros semanais e registra um log
        $qnt = $func->refreshWeekRanks();
        $string = "[users] Foram resetados $qnt registros.";
        $func->Log('rank_semanal', $string);

        // Define a próxima data de atualização semanal como daqui a uma semana
        $proximaAtualizacao = strtotime('+1 week');
        $dataFormatada = date('Y-m-d', $proximaAtualizacao);

        // Atualiza a próxima data de atualização semanal na tabela "configs"
        $query = "UPDATE configs SET prox_att_semanal = ?";
        $stmt = mysqli_prepare($db, $query); // Prepara a consulta SQL
        mysqli_stmt_bind_param($stmt, "s", $dataFormatada); // Define o valor do parâmetro
        mysqli_stmt_execute($stmt); // Executa a consulta
    }
}

/* AUTENTICAÇÃO POR TOKEN */

if (!in_array(basename($_SERVER['PHP_SELF']), ['login.php', 'register.php', 'index.php', 'deslogar.php', 'login_action.php', 'post_action.php', "register_action.php"])) {
    $resultadoAuth = $func->verificarAutenticado();

    if (!$resultadoAuth['resultado'] && $func->verificarLogado()) {
        $func->setarCookie("autenticado", 0, 0);
        $func->showAlert("Sessão expirada!", "Sua sessão foi encerrada. Para acessar sua conta, por favor faça login novamente.", "Continuar", "", "./actions/deslogar.php?redirect=../login.php");
        die();
    }else if(!$resultadoAuth['resultado'] && !$func->verificarLogado()){
        header("Location: login.php");
    }

    session_start();
    $_SESSION['nome'] = $resultadoAuth["nome"];
    $_SESSION['id'] = $resultadoAuth['id'];
}
