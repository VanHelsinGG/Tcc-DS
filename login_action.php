<?php
    session_start();

    // Conexão com o banco e com as funções
    include('./php/connector.php');
    include('./php/functions.php');

    // Verifica se a senha e o email foram enviadas
    if (isset($_POST['senha']) && isset($_POST['email'])) {
        // Se sim...
        
        // Retoma informações do formulario
        $senha = $_POST['senha'];
        $_SESSION['email'] = $_POST['email'];

        // Criptografa a senha inserida, para compara-la com a do banco
        $hashedSenha = hash('sha256', $senha);

        // Query preparado para evitar sqlinjection
        $query = "SELECT * FROM users WHERE email = ?";
        $stmt = mysqli_prepare($db, $query);
        mysqli_stmt_bind_param($stmt, "s", $_SESSION['email']);
        mysqli_stmt_execute($stmt);

        // Pega o resultado
        $resultado = mysqli_stmt_get_result($stmt);

        // Verifica se existe cadastro no email
        if (mysqli_num_rows($resultado) > 0) {
            $rows = mysqli_fetch_assoc($resultado);

            // Verifica se as senhas forem iguais
            if ($hashedSenha === $rows['senha']) {
                // Se sim...
                $_SESSION['nome'] = $rows['nome'];

                setarCookie("logado", 1, 1); // Define o cookie de logado para verdadeiro

                // Retorna ao index
                $redirectUrl = urlencode("index.php");
                header("Location: $redirectUrl");
                exit();
            } else {
                // Se não...
            
                // Retorna a tela de login com o atributo usererror=1, para exibir o box de erro
                $referer = strtok($_SERVER['HTTP_REFERER'], '?');
                $redirectUrl = urlencode($referer . '?usererror=1');
                header("Location: $redirectUrl");
                exit();
            }
        } else {
            // Se não existir cadastro no email, retorna erro
            $referer = strtok($_SERVER['HTTP_REFERER'], '?');
            $redirectUrl = urlencode($referer . '?usererror=1');
            header("Location: $redirectUrl");
            exit();
        }
    } else {
        // Se não...
        $referer = strtok($_SERVER['HTTP_REFERER'], '?');
        $redirectUrl = urlencode($referer . '?usererror=1');
        header("Location: $redirectUrl");
        exit();
    }
?>
