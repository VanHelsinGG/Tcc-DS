<?php
include('../../main/lib/php/include.php');

if (isset($_POST['user'], $_POST['professor'], $_POST['data'])) {
    $query = 'INSERT INTO requisicoestreino (user, professor, data_requisicao) VALUES (?, ?, ?)';
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
?>
