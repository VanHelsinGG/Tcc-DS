<?php
    session_start();

    // Inclui a conexão com o banco
    include("./php/connector.php");

    // Pega os valores do formulário
    $_SESSION['nome'] = ucwords($_POST['nome']); // ucwords() = transforma a primeira letra de cada palavra em maiúscula
    $_SESSION['email'] = $_POST['email'];
    $senha = $_POST['senha'];
    $hashedSenha = hash('sha256', $senha);

    // Verifica se já existe uma conta criada com o mesmo email
    $query = "SELECT * FROM users WHERE email = ?";
    $stmt = mysqli_prepare($db, $query);
    mysqli_stmt_bind_param($stmt, "s", $_SESSION['email']);
    mysqli_stmt_execute($stmt);
    $resultados = mysqli_stmt_get_result($stmt);

    if(mysqli_num_rows($resultados) > 0){
        // Se já existe uma conta com o mesmo email
        $referer = strtok($_SERVER['HTTP_REFERER'], '?');
        $redirectUrl = urlencode($referer . '?emailerror=1'); // Usa urlencode para garantir a correta codificação do URL
        header("Location: $redirectUrl"); /* Retorna à página anterior (cadastro), passando o atributo 'emailerror=1'
                                            Caso a página anterior perceba esse atributo com valor 1, será exibido um
                                            box de erro, com a opção para login*/
        exit(); // Termina a execução do código após o redirecionamento
    } else {
        // Query preparada para evitar sql injection
        $query = "INSERT INTO users(nome, email, senha, sexo) VALUES (?, ?, ?, 'm')";
        $stmt = mysqli_prepare($db, $query);
        mysqli_stmt_bind_param($stmt, "sss", $_SESSION['nome'], $_SESSION['email'], $hashedSenha);
        mysqli_stmt_execute($stmt);

        header("Location: login.php");
        exit(); // Termina a execução do código após o redirecionamento
    }
