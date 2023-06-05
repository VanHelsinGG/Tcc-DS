<?php

include("connector.php");
// Cria um cookie

class Functions
{
    /**
     * Aparece um alerta personalizado.
     * @param string $titulo Titulo do alerta.
     * @param string $conteudo Conteudo do alerta.
     * @param string $botaoConfirmar Conteúdo do botão de confirmação.
     * @param string $botaoCancelar Conteúdo do botão de cancelar.
     * @return null
     */
    public function showAlert($titulo, $conteudo, $botaoConfirmar = '', $botaoCancelar = '', $acaoConfirmar = "", $acaoCancelar = "")
    {
        // Background inutilizavel
        $modal = '<div class="modal-backdrop fade show" style="z-index: 9999;"></div>';
        echo $modal;

        // Alerta
        $mensagem = '<div id="aviso" class="sumir bg-escuro-secundario p-5 alert show position-fixed" style="z-index: 10000;color: white;height: auto;width: auto;top: 50%;left: 50%;transform: translate(-50%, -50%);border-radius: 15px;">
                <div class="row mb-4" style="border-bottom:2px dashed #ff9f1a;">
                    <div class="col">
                        <h3 class="text-center fs-1">' . $titulo . '</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col text-center">
                        <p class="fs-5">' . $conteudo . '</p>
                    </div>
                </div>';

        if ($botaoConfirmar || $botaoCancelar) {
            $mensagem .= '<div class="row">
                        <div class="col text-center mt-3">';

            if ($botaoConfirmar) {
                if ($acaoConfirmar) {
                    $mensagem .= '<a href="#" onclick="window.location.href=\'' . $acaoConfirmar . '\'" class="btn btn-laranja w-100" data-bs-dismiss="modal" aria-label="Close">' . $botaoConfirmar . '</a>';
                } else {
                    $mensagem .= '<button class="btn btn-laranja w-100" data-bs-dismiss="modal" aria-label="Close">' . $botaoConfirmar . '</a>';
                }
            }

            if ($botaoCancelar) {
                if ($acaoCancelar) {
                    $mensagem .= '<a href="#" onclick="window.location.href=\'' . $acaoCancelar . '\'" class="btn btn-danger w-100" data-bs-dismiss="modal" aria-label="Close">' . $acaoCancelar . '</a>';
                } else {
                    $mensagem .= '<button class="btn btn-danger w-100" data-bs-dismiss="modal" aria-label="Close">' . $acaoCancelar . '</a>';
                }
            }

            $mensagem .= '</div>
                </div>';
        }

        $mensagem .= '</div>';
        echo $mensagem;

        // Adicione o código JavaScript para fechar o modal e o aviso quando o botão for clicado
        echo '<script>
        const modal = document.querySelector(".modal-backdrop");
        const aviso = document.querySelector("#aviso");

        document.querySelectorAll("[data-bs-dismiss=\'modal\']").forEach((button) => {
            button.addEventListener("click", () => {
                modal.remove();
                aviso.remove();
            });
        });
      </script>';
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
     * Define um cookie HTTPs.
     * @param string $nome Nome do cookie.
     * @param mixed $valor Conteúdo do cookie.
     * @param int $tempo Define a vida util do cookie (em dias).
     * @return void
     */
    public function setarCookie($nome, $valor, $tempo)
    {
        setcookie($nome, $valor, $this->converterTempoDias($tempo), "/", $_SERVER['HTTP_HOST'], false, false);
    }

    /**
     * Verifica se o usuario está com uma sessão ativa através da existencia do Cookie "logado".
     * @return bool
     */
    public function verificarLogado()
    {
        return ((isset($_COOKIE['logado']) && $_COOKIE['logado'])) ? true : false;
    }

    public function redirect_withParams($paramKey, $paramValue, $destinationUrl)
    {
        $new_url = $destinationUrl . '?' . $paramKey . '=' . $paramValue;
        header("Location: $new_url");
        exit();
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

    /**
     * Retorna uma parte do token.
     * @param string $token Token.
     * @param int $part_index Parte desejada.
     * @return string 
     */
    public function getTokenPart($token, $part_index)
    {
        $token_parts = explode(":", $token);
        return $token_parts[$part_index];
    }

    /**
     * Verifica a validade do token.
     * @param string $token Token.
     * @return int
     */
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
        return $this->getUserInfo("userid", "nome", $nome);
    }

    public function getUserID_byToken($token)
    {
        return $this->getUserInfo("userid", "token", $token);
    }

    public function getUserName_byID($id)
    {
        return $this->getUserInfo("nome", "userid", $id);
    }

    public function getUserName_byToken($token)
    {
        return $this->getUserInfo("nome", "token", $token);
    }

    public function getUserToken_byName($nome)
    {
        return $this->getUserInfo("token", "nome", $nome);
    }

    public function getUserObjective_byID($id)
    {
        return $this->getUserInfo("objetivo", "userid", $id);
    }

    public function getUserToken_byID($id)
    {
        return $this->getUserInfo("token", "userid", $id);
    }

    public function userAuthenticated()
    {
        return isset($_COOKIE['autenticado']) ? 1 : 0;
    }

    public function getUserActiveTrainingID_byID($id)
    {
        return $this->getUserInfo("idtreinoativo", "userid", $id);
    }

    private function getUserInfo($columnName, $conditionColumn, $conditionValue)
    {
        $query = "SELECT $columnName FROM users WHERE $conditionColumn = ?";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $conditionValue);
        $stmt->execute();
        $resultados = $stmt->get_result();
        $row = $resultados->fetch_assoc();

        return $row ? $row[$columnName] : null;
    }
}

class Treino
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getTrainingTeacherName($trainingID)
    {
        $professorID = $this->getTrainingData($trainingID)["professor"];

        $user = new User($this->db);

        $nomeProfessor = $user->getUserName_byID($professorID);

        return $nomeProfessor;
    }

    public function getTrainingStudentName($trainingID){
        $studentID = $this->getTrainingData($trainingID)["aluno"];

        $user = new User($this->db);

        $nomeAluno = $user->getUserName_byID($studentID);
        
        return $nomeAluno;
    }

    private function getTrainingData($trainingID)
    {
        $stmt = $this->db->prepare("SELECT * FROM treinos WHERE idtreino = ?");
        $stmt->bind_param("s", $trainingID);
        $stmt->execute();
        $resultados = $stmt->get_result();
        $row = $resultados->fetch_assoc();
        return $row ? $row : null;
    }

    private function updateTrainingData($trainingID, $columnName, $conditionColumn, $conditionValue)
    {
        $query = "UPDATE treinos SET $columnName = ? WHERE idtreino = ?";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss", $conditionValue, $trainingID);
        $stmt->execute();
        $result = $stmt->affected_rows;

        return $result ? 1 : 0;
    }

    public function createTraining($trainingData)
    {
        $stmt = $this->db->prepare("INSERT INTO treinos (aluno, professor,nome, foco, duracao, exercicios, series, observacoes) VALUES (?,?,?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss", $trainingData['aluno'], $trainingData['professor'], $trainingData['nome'], $trainingData['foco'], $trainingData['duracao'], $trainingData['exercicios'], $trainingData['series'], $trainingData['observacoes']);
        return ($stmt->execute()) ? 1 : 0;
    }
    /*$trainingData = [
    'nome' => 'Treino A',
    'foco' => 'Força',
    'aluno' => 17,
    'professor' => 17,
    'duracao' => '60 minutos',
    'exercicios' => 'Supino, Agachamento, Remada',
    'series' => '3',
    'observacoes' => 'Descansar 1 minuto entre séries',
    ];

    $trainingID = $training->createTraining($trainingData);
    if ($trainingID) {
        echo "Treino criado com sucesso! ID: " . $trainingID;
    } else {
        echo "Erro ao criar treino.";
    }
    */

    public function getExercisesTrated($trainingID, $focusNum)
    {
        $exercises = $this->getTrainingExercises($trainingID);
        $exercises = $this->deStrcatExercises_all($exercises, $focusNum);
        $exercises = $this->deStrcatExercises_solo($exercises);
        return isset($exercises) ? $exercises : null;
    }

    private function deStrcatExercises_all($exercises, $focusNum)
    {
        $exercises = explode(";", $exercises);

        return isset($exercises[$focusNum]) ? $exercises[$focusNum] : null;
    }

    private function deStrcatExercises_solo($exercisesAll)
    {
        return explode(",", $exercisesAll);
    }

    public function getTrainingsTrated($trainingID)
    {
        $focuses = $this->getTrainingFocus($trainingID);
        return $this->deStrcatTrainings($focuses);
    }
    private function deStrcatTrainings($focus)
    {
        return explode(";", $focus);
    }

    public function getSeriesTrated($trainingID, $focusNum, $exerciseNum)
    {
        $series = $this->getTrainingSeries($trainingID);
        $series = $this->deStrcatSeries_all($series, $focusNum);
        $series = $this->deStrcatSeries_exercise($series, $exerciseNum);
        $series = $this->deStrcatSeries_solo($series);
        return $series;
    }

    private function deStrcatSeries_all($exercises, $focusNum)
    {
        $exercises = explode(".", $exercises);

        return isset($exercises[$focusNum]) ? $exercises[$focusNum] : null;
    }

    private function deStrcatSeries_exercise($exercises, $exerciseNum)
    {
        $series = explode(";", $exercises);
        return $series[$exerciseNum];
    }
    private function deStrcatSeries_solo($exercisesAll)
    {
        return explode(",", $exercisesAll);
    }

    public function getTrainingName($trainingID)
    {
        $trainingData = $this->getTrainingData($trainingID);
        return $trainingData ? $trainingData['nome'] : null;
    }

    public function getTrainingFocus($trainingID)
    {
        $trainingData = $this->getTrainingData($trainingID);
        return $trainingData ? $trainingData['foco'] : null;
    }

    public function getTrainingDuration($trainingID)
    {
        $trainingData = $this->getTrainingData($trainingID);
        return $trainingData ? $trainingData['duracao'] : null;
    }

    public function getTrainingExercises($trainingID)
    {
        $trainingData = $this->getTrainingData($trainingID);
        return $trainingData ? $trainingData['exercicios'] : null;
    }

    public function getTrainingSeries($trainingID)
    {
        $trainingData = $this->getTrainingData($trainingID);
        return $trainingData ? $trainingData['series'] : null;
    }

    public function getTrainingObservations($trainingID)
    {
        $trainingData = $this->getTrainingData($trainingID);
        return $trainingData ? $trainingData['observacoes'] : null;
    }
}

$userToken = new UserSessionToken();
$user = new User($db);
$func = new Functions();
$training = new Treino($db);
