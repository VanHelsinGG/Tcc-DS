<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./style/universal.css">
    <link rel="stylesheet" href="./style/main.css">
    <link rel="stylesheet" href="./images/bootstrap-icons-1.10.4/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body style="background-color: #ca7f16;">

    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 col-lg-2 d-md-block escuro text-white vh-100 sidebar">
                <ul class="list-unstyled list-group h-100 pt-4">
                    <li class="active my-1"><a href="#" class="text-white btn my-2"><i class="bi bi-house-fill me-3"></i>Inicio</a></li>
                    <li class="my-1"><a href="#" class="text-white btn my-2"><i class="bi bi-bullseye me-3"></i>Exercicios</a></li>
                    <li class="my-1"><a href="#" class="text-white btn my-2"><i class="bi bi-basket3-fill me-3"></i>Dieta</a></li>
                    <li class="my-1"><a href="#" class="text-white btn my-2"><i class="bi bi-clipboard2-data-fill me-3"></i>Relatorios</a></li>
                    <li class="mt-auto my-1"><a href="" class="text-white btn my-2 fs-5"><i class="bi bi-person-circle me-3"></i>Olympia Workout</a></li>
                </ul>
            </nav>
            
            <main class="col-10 ms-sm-auto col-lg-10 px-md-4">
                
                <div class="container-fluid mt-5">
                    <div class="row bg-dark w-auto">
                        <p class="text-white">Seus dados</p>
                    </div>
                    <div class="row">
                        <div class="col-4 bg-danger">
                            <div class="row bg-primary">
                                <div class="col-6">
                                    {imagem de perfil}
                                </div>
                                <div class="col-6">
                                    {nome}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 bg-success">
                                    Peso:<br>
                                    Altura:<br>
                                    Imc:<br>
                                    Ultimo treino:
                                </div>
                            </div>
                        </div>
                        <div class="col-4 bg-warning">
                            Próximos treinos
                        </div>
                        <div class="col-4 bg-secondary">
                            Seus dados semanais
                        </div>
                    </div>
                </div>

                <div class="container-fluid mt-5">
                    <div class="row bg-dark text-white">
                        Tops
                    </div>
                    <div class="row">
                        <div class="col-4 bg-success">
                            Diario
                        </div>
                        <div class="col-4 bg-danger">
                            Semanal
                        </div>
                        <div class="col-4 bg-primary">
                            Mensal
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>