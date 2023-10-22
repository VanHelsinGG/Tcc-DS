<?php

include("connector.php");

class Functions
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }
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

    /**
     * Verifica se o usuario está com uma sessão ativa e autenticada
     * @return array [nome,resultado(bool),id]
     */
    public function verificarAutenticado()
    {
        if (!$this->verificarLogado()) {
            return ['resultado' => 0];
        }

        $user = new User($this->db);
        $userToken = new UserSessionToken();

        $tokenNavegador = $_COOKIE['logado'];

        $userID = $user->getUserID_byToken($tokenNavegador);
        if (!$userID) {
            return ['resultado' => 0];
        }

        $tokenDB = $user->getUserToken_byID($userID);
        if ($tokenDB === -1 || strcmp($tokenDB, $tokenNavegador) !== 0 || !$userToken->validToken($tokenDB)) {
            return ['resultado' => 0];
        }

        $userName = $user->getUserName_byToken($tokenDB);

        $this->setarCookie("autenticado", 1, 1);

        return [
            "nome" => $userName,
            "resultado" => 1,
            'id' => $userID,
        ];
    }
    /**
     * Cria um arquivo debug
     * @param string $file Arquivo para ser salvo
     * @param string @text Conteúdo
     * @return void
     */
    public function Log($file, $text)
    {
        if (ENABLE_LOG) {
            $file = fopen($_SERVER['DOCUMENT_ROOT'] . "/tcc/main/logs/$file.txt", "a") or die("erro");
            fwrite($file, "[" . date("d/m/Y h:i:sa") . "] - $text\n");
            fclose($file);
        }
    }

    public function refreshWeekRanks()
    {
        $query = "UPDATE users SET tempo_semanal = '00:00:00'";
        mysqli_query($this->db, "START TRANSACTION");
        mysqli_query($this->db, $query);
        $numRowsUpdated = mysqli_affected_rows($this->db);
        mysqli_query($this->db, "COMMIT");

        return $numRowsUpdated;
    }

    public function verificarPalavrao($index) {
        $filePath = "C:/xampp/htdocs/tcc/main/lib/docs/palavroes.txt";
        $fileContents = file_get_contents($filePath);
    
        if ($fileContents !== false) {
            $palavroes = explode("\n", $fileContents);
    
            foreach ($palavroes as $palavra) {
                $palavra = trim($palavra);
                if (stripos($index, $palavra) !== false) {
                    $substituicao = str_repeat("*", mb_strlen($palavra, 'utf-8'));
                    $index = str_ireplace($palavra, $substituicao, $index);
                }
            }
    
            return $index;
        }
    
        return false;
    }
    
    public function preload(){
    
        /** ATUALIZAÇÃO DOS RANKS */
        if (ENABLE_PRELOADFILE_ATT_RANKS) {
            $data_atual = date("Y-m-d"); // Obtém a data atual no formato Y-m-d
    
            // Seleciona todos os registros da tabela "exercicios_diarios"
            $query = "SELECT * FROM exercicios_diarios";
            $stmt = mysqli_prepare($this->db, $query); // Prepara a consulta SQL
            mysqli_stmt_execute($stmt); // Executa a consulta
            $resultado = mysqli_stmt_get_result($stmt); // Obtém o resultado da consulta
    
            // Verifica se existem registros retornados
            if (mysqli_num_rows($resultado) > 0) {
                // Deleta os registros da tabela "exercicios_diarios" que correspondem à data atual
                $query = "DELETE FROM exercicios_diarios WHERE exclusao = ?";
                $stmt = mysqli_prepare($this->db, $query); // Prepara a consulta SQL
                mysqli_stmt_bind_param($stmt, "s", $data_atual); // Define o valor do parâmetro
                mysqli_stmt_execute($stmt); // Executa a consulta
    
                // Obtém a quantidade de registros afetados pela exclusão
                $qnt = mysqli_affected_rows($this->db);
    
                // Verifica se registros foram deletados e registra um log
                if ($qnt) {
                    $string = "[exercicios_diarios] Foram deletados $qnt registros.";
                    self::Log('auto_delete', $string);
                }
            }
    
            // Obtém a próxima data de atualização semanal da tabela "configs"
            $query = "SELECT prox_att_semanal AS semanal FROM configs";
            $stmt = mysqli_prepare($this->db, $query); // Prepara a consulta SQL
            mysqli_stmt_execute($stmt); // Executa a consulta
            $resultado = mysqli_stmt_get_result($stmt); // Obtém o resultado da consulta
            $row = mysqli_fetch_assoc($resultado); // Obtém a linha de resultado como um array associativo
    
            if(!$row){
                $query = "UPDATE configs SET prox_att_semanal = ?";
                $stmt = mysqli_prepare($this->db, $query); // Prepara a consulta SQL
                mysqli_stmt_bind_param($stmt, "s", $data_atual); // Define o valor do parâmetro
                mysqli_stmt_execute($stmt);            
            }
    
            // Verifica se a data atual é igual à próxima data de atualização semanal
            else if ($data_atual === $row['semanal']) {
                // Realiza o reset dos registros semanais e registra um log
                $qnt = self::refreshWeekRanks();
                $string = "[users] Foram resetados $qnt registros.";
                self::Log('rank_semanal', $string);
    
                // Define a próxima data de atualização semanal como daqui a uma semana
                $proximaAtualizacao = strtotime('+1 week');
                $dataFormatada = date('Y-m-d', $proximaAtualizacao);
    
                // Atualiza a próxima data de atualização semanal na tabela "configs"
                $query = "UPDATE configs SET prox_att_semanal = ?";
                $stmt = mysqli_prepare($this->db, $query); // Prepara a consulta SQL
                mysqli_stmt_bind_param($stmt, "s", $dataFormatada); // Define o valor do parâmetro
                mysqli_stmt_execute($stmt); // Executa a consulta
            }
        }
    
        /* AUTENTICAÇÃO POR TOKEN */
    
        if (!in_array(basename($_SERVER['PHP_SELF']), ['login.php', 'register.php', 'index.php', 'deslogar.php', 'login_action.php', 'post_action.php', "register_action.php"])) {
            $resultadoAuth = self::verificarAutenticado();

            if (!$resultadoAuth['resultado']) {
                header("Location: /tcc/user/actions/deslogar.php?redirect=../login.php");
                die();
            }
            
            $user = new User($this->db);

            if(!$user->getUserObjective_byID($resultadoAuth['id'])){
                header("Location: objetivo.php");
                die();
            }
            
            session_start();
            $_SESSION['nome'] = $resultadoAuth["nome"];
            $_SESSION['id'] = $resultadoAuth['id'];
        }
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

        if (time() > $expiration) {
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

    public function getUserAccess_byID($id)
    {
        return $this->getUserInfo("estado", "userid", $id);
    }

    public function getUserAccess_byToken($token)
    {
        return $this->getUserInfo("estado", "token", $token);
    }

    public function getUserAccess_byName($name)
    {
        return $this->getUserInfo("estado", "nome", $name);
    }

    public function getUserEmail_byID($id)
    {
        return $this->getUserInfo("email","userid",$id);
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

    public function getNumOf_users()
    {
        $query = "SELECT * FROM users";

        $query = mysqli_query($this->db, $query);

        $numUsers = mysqli_num_rows($query);

        return $numUsers;
    }
    
    public function existsUserTrainingRequest_byID($id) {
        $query = "SELECT * FROM requisicoestreino WHERE user = ?";
        
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $id); 
        $stmt->execute();
        $resultados = $stmt->get_result(); 
    
        return ($resultados->num_rows > 0) ? true : false; 
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

    public function getTrainingStudentName($trainingID)
    {
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
        $stmt = $this->db->prepare("INSERT INTO treinos (aluno, professor,nome, foco, duracao, exercicios, series, observacoes, status) VALUES (?,?,?, ?, ?, ?, ?, ?, '1')");
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

    public function getTrainingsTrated($trainingID, $trainingNum)
    {
        $focuses = $this->getTrainingFocus($trainingID);
        return $this->deStrcatFocus($focuses, $trainingNum);
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

    public function deStrcatFocus($focus, $focusNum)
    {
        $focus = explode(";", $focus);

        return isset($focus[$focusNum]) ? $focus[$focusNum] : null;
    }

    public function deStrcatFocus_all($focus)
    {
        $index = explode(";", $focus);
        return isset($index) ? $index : null;
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

    public function getTrainingStatus($trainingID)
    {
        $trainingData = $this->getTrainingData($trainingID);
        return $trainingData ? $trainingData['status'] : null;
    }


    public function getTrainingObservations($trainingID)
    {
        $trainingData = $this->getTrainingData($trainingID);
        return $trainingData ? $trainingData['observacoes'] : null;
    }

    public function getNumOfStudent_byToken($token)
    {
        $user = new User($this->db);
        $userID = $user->getUserID_byToken($token);
        $query = "SELECT COUNT(*) as count FROM treinos WHERE professor = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $userID);
        $stmt->execute();
        $resultados = $stmt->get_result();
        $row = $resultados->fetch_assoc();
        return $row["count"];
    }

    public function getNumOfTrainingCreated_byID($id)
    {
        $query = "SELECT COUNT(*) as count FROM treinos WHERE professor = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $resultados = $stmt->get_result();
        $row = $resultados->fetch_assoc();
        return $row["count"];
    }

    public function getNumOfTrainingExpired_byID($id)
    {
        $query = "SELECT COUNT(*) as count FROM treinos WHERE professor = ? AND vezes_feito >= duracao";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $resultados = $stmt->get_result();
        $row = $resultados->fetch_assoc();
        return $row["count"];
    }
}

$userToken = new UserSessionToken();
$user = new User($db);
$func = new Functions($db);
$training = new Treino($db);