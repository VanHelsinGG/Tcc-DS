<?php
// Inclui a conexão com o banco
include("./php/connector.php");
include("./php/functions.php");

// Pega os valores do formulário
$nome = ucwords($_POST['nome']); // ucwords() = transforma a primeira letra de cada palavra em maiúscula
$email = $_POST['email'];
$senha = $_POST['senha'];
$sexo = $_POST['sexo'];
$hashedSenha = hash('sha256', $senha);
$data = $_POST['data'];
$ip = $_POST['ip'];

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

// Pegar o proximo ID

$query = "SELECT MAX(userid) AS id_max FROM users";
$resultados = mysqli_query($db, $query);
$value = mysqli_fetch_assoc($resultados);
$id = ($value['id_max'] == 0) ? 0 : $value['id_max'];

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
    $query = "INSERT INTO users(nome, email, senha, sexo, data_criacao, ip) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($db, $query);
    mysqli_stmt_bind_param($stmt, "ssssss", $nome, $email, $hashedSenha, $sexo, $data, $ip);
    mysqli_stmt_execute($stmt);

    header("Location: login.php");
    exit(); // Termina a execução do código após o redirecionamento
}
