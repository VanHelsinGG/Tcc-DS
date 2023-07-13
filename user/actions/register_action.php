<?php
// Inclui a conexão com o banco
include("../../main/lib/php/include.php");

// Pega os valores do formulário
$nome = ucwords($_POST['nome']); // ucwords() = transforma a primeira letra de cada palavra em maiúscula
$email = strtolower($_POST['email']);
$senha = $_POST['senha'];
$sexo = $_POST['sexo'];
$hashedSenha = hash('sha256', $senha);
$data = $_POST['data'];
$ip = $_POST['ip'];
$imagem = file_get_contents("../../main/lib/images/User circle.png");

// Correção do sexo
switch ($sexo) {
    case "Masculino":
        $sexo = "M";
        break;
    case "Feminino":
        $sexo = "F";
        break;
    case "Outro":
        $sexo = "I";
        break;
}

// Verifica se já existe uma conta criada com o mesmo email
$query = "SELECT * FROM users WHERE email = ?";
$stmt = mysqli_prepare($db, $query);
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
$resultados = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($resultados) > 0) {
    // Se já existe uma conta com o mesmo email
    $url_parts = parse_url($_SERVER['HTTP_REFERER']); // Analisa a URL atual
    $query = isset($url_parts['query']) ? $url_parts['query'] : ''; // Obtém a query string da URL, se existir
    $params = array(); // Inicializa um array para armazenar os parâmetros da query string
    parse_str($query, $params); // Separa os parâmetros da query string em um array associativo

    if (!isset($params['emailerror'])) { // Verifica se o parâmetro emailerror ainda não está presente
        $params['emailerror'] = 1; // Adiciona o parâmetro emailerror com valor 1
    }

    $new_query = http_build_query($params); // Reconstroi a query string com os parâmetros atualizados
    $new_url = $url_parts['scheme'] . '://' . $url_parts['host'] . $url_parts['path'] . '?' . $new_query; // Reconstroi a URL completa com a query string atualizada

    header("Location: $new_url"); // Redireciona o usuário de volta para a página de login com o parâmetro emailerror atualizado
    exit();
} else {
    // Query preparada para evitar sql injection
    $query = "INSERT INTO users(nome, email, senha, sexo, data_criacao, ip, imagem) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($db, $query);
    mysqli_stmt_bind_param($stmt, "sssssss", $nome, $email, $hashedSenha, $sexo, $data, $ip, $imagem);
    mysqli_stmt_execute($stmt);

    $txt = "[registro] Conta criada com o nome : $nome";
    $func->Log("contas",$txt);

    header("Location: ../login.php");
    exit(); // Termina a execução do código após o redirecionamento
}
