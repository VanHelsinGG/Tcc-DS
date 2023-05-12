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
                echo "<script>alert('setado')</script>";

                $query = "UPDATE users SET token = ? WHERE userid = ?";
                $stmt = mysqli_prepare($db, $query);
                mysqli_stmt_bind_param($stmt, "ss", $token,$rows['userid']);
                mysqli_stmt_execute($stmt);

                if($user->getUserObjective_byID($rows['userid']) === -1){
                    echo $user->getUserObjective_byID($rows['userid']);
                    
                    $redirectUrl = urlencode("objetivo.php");
                    header("Location: $redirectUrl");
                    exit();
                }
                // Retorna ao index
                $redirectUrl = urlencode("index.php");
                header("Location: $redirectUrl");
                exit();
            }
        }
    }
    $url_parts = parse_url($_SERVER['HTTP_REFERER']); // Analisa a URL atual
    $query = isset($url_parts['query']) ? $url_parts['query'] : ''; // Obtém a query string da URL, se existir
    $params = array(); // Inicializa um array para armazenar os parâmetros da query string
    parse_str($query, $params); // Separa os parâmetros da query string em um array associativo

    if (!isset($params['usererror'])) { // Verifica se o parâmetro usererror ainda não está presente
        $params['usererror'] = 1; // Adiciona o parâmetro usererror com valor 1
    }

    $new_query = http_build_query($params); // Reconstroi a query string com os parâmetros atualizados
    $new_url = $url_parts['scheme'] . '://' . $url_parts['host'] . $url_parts['path'] . '?' . $new_query; // Reconstroi a URL completa com a query string atualizada

    header("Location: $new_url"); // Redireciona o usuário de volta para a página de login com o parâmetro usererror atualizado
    exit();
