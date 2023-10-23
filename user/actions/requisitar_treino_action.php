<?php
include('../../main/lib/php/include.php');

if($_POST['action'] === "CREATE"){
    if (isset($_POST['user'], $_POST['professor'], $_POST['data'])) {
        $query = 'INSERT INTO requisicoes_treino (user, professor, data_requisicao) VALUES (?, ?, ?)';
        $stmt = $db->prepare($query);
        $stmt->bind_param("sss", $_POST['user'], $_POST['professor'], $_POST['data']);
    
        if ($stmt->execute()) {
            echo '1';
        } else {
            echo '0';
        }
    } else {
        echo '0';
    }
}else if($_POST['action'] === "DELETE"){
    if (isset($_POST['user'])) {
        $query = 'DELETE FROM requisicoes_treino WHERE user = ?';
        $stmt = $db->prepare($query);
        $stmt->bind_param("s", $_POST['user']);
    
        if ($stmt->execute()) {
            echo '1';
        } else {
            echo '0';
        }
    } else {
        echo '0';
    }
}

?>
