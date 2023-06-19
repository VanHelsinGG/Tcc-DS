<?php
include("../../main/lib/php/include.php");

$criador = $_GET["criador"];
$data = $_GET["data"];
$conteudo = $_GET["postagem"];

if($conteudo != ""){
    $query = "INSERT INTO posts(user,content,data) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($db, $query);
    mysqli_stmt_bind_param($stmt, "sss", $criador, $conteudo, $data);
    mysqli_stmt_execute($stmt);
}

header("Location: ../main.php");