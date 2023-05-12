<?php

include("connector.php");
// Cria um cookie

class Functions
{
    /**
     * Define um cookie HTTPs.
     * @param string $nome Nome do cookie.
     * @param mixed $valor Conteúdo do cookie.
     * @param int $tempo Define a vida util do cookie (em dias).
     * @return void
     */
    public function setarCookie($nome, $valor, $tempo)
    {
        setcookie($nome, $valor, $this->converterTempoDias($tempo), "/", $_SERVER['HTTP_HOST'], true, true);
    }

    /**
     * Converte o tempo atual, adicionando $tempo a ele.
     * @param mixed $tempo Número de dias a serem adicionados
     * @return int
     */
    public function converterTempoDias($tempo)
    {
        return time() + ($tempo * 24 * 60 * 60);
    }

    /**
     * Verifica se o usuario está com uma sessão ativa através da existencia do Cookie "logado".
     * @return bool
     */
    public function verificarLogado()
    {
        return ((isset($_COOKIE['logado']) && $_COOKIE['logado'])) ? true : false;
    }
}


class UserSessionToken extends Functions
{
    private const SECRET_KEY = "schadenfreude";
    private $ip_address, $salt, $expiry_time;
    
    function __construct()
    {
        $this->ip_address = $_SERVER['REMOTE_ADDR'];
        $this->salt = bin2hex(random_bytes(16));
        $this->expiry_time = self::converterTempoDias(1);
    }

    /**
     * Gera um token aleatorio, com salt aleatorio, no padrão "hash:salt:expiration".
     * @return string
     */
    public function generateRandomToken()
    {
        // Concatenar o salt, endereço IP e tempo de expiração
        $token_data = $this->salt . $this->ip_address;

        // Gerar o hash usando SHA-256
        $token = hash('sha256', self::SECRET_KEY . $token_data);

        // Adicionar o salt e o tempo de expiração ao token
        $token .= ':' . $this->salt . ':' . $this->expiry_time;

        return $token;
    }

    /**
     * Gera um token aleatorio, com um salt pré-definido, no padrão "hash:salt:expiration". Com isso, é possivel refazer um token gerado previamente.
     * @param string $salt salt utilizado para gerar o token.
     * @return string
     */
    public function generateTokenWithSalt($salt)
    {
        // Concatenar o salt, endereço IP e tempo de expiração
        $token_data = $salt . $this->ip_address;

        // Gerar o hash usando SHA-256
        $token = hash('sha256', self::SECRET_KEY . $token_data);

        // Adicionar o salt e o tempo de expiração ao token
        $token .= ':' . $salt . ':' . $this->expiry_time;

        // Retornar o token
        return $token;
    }

    // Continua daqui
    public function getTokenPart($token, $part_index)
    {
        $token_parts = explode(":", $token);
        return $token_parts[$part_index];
    }

    public function validToken($token)
    {
        // Token completo
        $token_parts = explode(":", $token);
        if (!count($token_parts) === 3) {
            return 0;
        }

        // Token expirado
        $expiration = $this->getTokenPart($token, 2);

        if (time()  > $expiration) {
            return 0;
        }

        return 1;
    }
}

class User
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getUserID_byName($nome)
    {
        $stmt = $this->db->prepare("SELECT userid FROM users WHERE nome = ?");
        $stmt->bind_param("s", $nome);
        $stmt->execute();
        $resultados = $stmt->get_result();
        $row = $resultados->fetch_assoc();
        return $row ? $row["userid"] : null;
    }

    public function getUserName_byID($id)
    {
        $stmt = $this->db->prepare("SELECT nome FROM users WHERE userid = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $resultados = $stmt->get_result();
        $row = $resultados->fetch_assoc();
        return $row ? $row["nome"] : null;
    }

    public function getUserName_byToken($token)
    {
        $stmt = $this->db->prepare("SELECT nome FROM users WHERE token = ?");
        $stmt->bind_param("s", $token);
        $stmt->execute();
        $resultados = $stmt->get_result();
        $row = $resultados->fetch_assoc();
        return $row ? $row["nome"] : null;
    }

    public function getUserToken_byName($nome)
    {
        $stmt = $this->db->prepare("SELECT token FROM users WHERE nome = ?");
        $stmt->bind_param("s", $nome);
        $stmt->execute();
        $resultados = $stmt->get_result();
        $row = $resultados->fetch_assoc();
        return $row ? $row["token"] : null;
    }
}

$userToken = new UserSessionToken();
$user = new User($db);
$func = new Functions();
