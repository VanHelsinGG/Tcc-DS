<?php 
include("./main/lib/php/include.php");
if(isset($_POST['nome'])){
    $nome = $_POST["nome"];
$musculo = $_POST["musculo"];

$gif_tmp_name = $_FILES["gif"]["tmp_name"];
$gif_content = file_get_contents($gif_tmp_name);

$stmt = $db->prepare("INSERT INTO exercicios (nomeExercicio, grupoMuscular, exercicio) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $nome, $musculo, $gif_content);

$stmt->execute();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="gif" id="gif">
        <input type="text" name="nome" id="nome" placeholder="nome">
        <input type="text" name="musculo" id="musculo" placeholder="musculo que pega">
        <input type="submit" value="Cadastrar"> 
    </form>
</body>
</html>