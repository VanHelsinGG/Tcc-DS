<?php
// Conexão com o banco e com as funções
include('./php/connector.php');
include('./php/functions.php');

// Verifica se a senha e o email foram enviadas
if (isset($_POST['senha']) && isset($_POST['email'])) {
    // Se sim...

    // Retoma informações do formulario
    $senha = $_POST['senha'];
    $email = $_POST['email'];

    // Criptografa a senha inserida, para compara-la com a do banco
    $hashedSenha = hash('sha256', $senha);

    // Query preparado para evitar sqlinjection
    $query = "SELECT * FROM users WHERE email = ?";
    $stmt = mysqli_prepare($db, $query);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    // Pega o resultado
    $resultado = mysqli_stmt_get_result($stmt);

    // Verifica se existe cadastro no email
    if (mysqli_num_rows($resultado) > 0) {
        $rows = mysqli_fetch_assoc($resultado);

        // Verifica se as senhas forem iguais
        if ($hashedSenha === $rows['senha']) {
            $nome = $rows['nome'];

            $token = $userToken->generateRandomToken();

            $func->setarCookie("logado", $token, 1); // Define o cookie de logado para verdadeiro

            $query = "UPDATE users SET token = ? WHERE userid = ?";
            $stmt = mysqli_prepare($db, $query);
            mysqli_stmt_bind_param($stmt, "ss", $token, $rows['userid']);
            mysqli_stmt_execute($stmt);

            // Retorna ao index
            $redirectUrl = urlencode("index.php");
            header("Location: $redirectUrl");
            exit();
        }
    }
}

$func->redirect_withParams("usererror", 1, "login.php");
