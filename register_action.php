<?php
    // Inclui a conexão com o banco
    include("./php/connector.php");

    // Pega os valores do formulario
    $nome = ucwords($_POST['nome']); // ucwords() = transforma 1 letra das palavras em maiuscula
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Verificação se já existe uma conta criada com o mesmo email
    $query = "SELECT * FROM users WHERE email = '$email'";
    $resultados = mysqli_query($db,$query);
    
    if(mysqli_num_rows($resultados) > 0){
        // Se tiver
        header("Location: {$_SERVER['HTTP_REFERER']}?emailerror=1"); /* Retorna à pagina anterior (cadastro), passando o atributo 'emailerror=1'
                                                                        Caso a pagina anterior perceba esse atributo com valor 1, será exibido um
                                                                        box de erro, com a opção para login*/
    }else{
        // Se não tiver

        // Insere as informações no banco
        $query = "INSERT INTO users(nome,email,senha,sexo) VALUES ('$nome','$email', SHA2('$senha', 256),'m')";

        if(mysqli_query($db,$query)){echo "boa";}
    }
?>