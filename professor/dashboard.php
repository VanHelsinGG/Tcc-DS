<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../main/lib/css/universal.css">
    <link rel="stylesheet" href="../main/lib/images/bootstrap-icons-1.10.4/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body class="m-0 p-0 border-0">

    <div class="container-fluid">
        <div class="row">
            <nav class="escuro col-md-2 m-0 col-lg-2 d-md-block text-white p-0 vh-100 sidebar fixed-top" id="navbar">
                <h1 class="text-center fs-3 bg-laranja py-4">OlympiaWorkout</h1>
                <ul class="list-unstyled list-group h-100 pt-4">
                    <li class="active my-1"><a href="#" class="text-white btn my-2"><i class="bi bi-house-fill me-3"></i>Geral</a></li>
                    <li class="my-1"><a href="#" class="text-white btn my-2"><i class="bi bi-bullseye me-3"></i>Exercicios</a></li>
                    <li class="my-1"><a href="#" class="text-white btn my-2"><i class="bi bi-basket3-fill me-3"></i>Dieta</a></li>
                    <li class="my-1"><a href="#" class="text-white btn my-2"><i class="bi bi-clipboard2-data-fill me-3"></i>Relatorios</a></li>
                    <li class="my-1" style="border-top: 1px solid #363330;"><a href="" class="text-white btn my-2"><i class="bi bi-person-circle me-3"></i>Olympia Workout</a></li>
                </ul>
            </nav>
            <main class="col-10 ms-auto col-lg-10 vh-100">
                <header class="container-fluid mt-4 text-dark">
                    <div class="row text-center">
                        <div class="col">
                            <h1 class="fs-2">OlympiaWorkout -<span class="fs-3 text-dark"> Dashboard</span></h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <span class="text-danger">Sessão ativa: <span class="text-dark">{user}</span></span>
                        </div>
                    </div>
                </header>

                <div class="container-fluid mt-3 p-5" style="border-top:2px solid #d3d3d3;border-bottom:2px solid #d3d3d3;">
                    <div class="row">
                        <h2><i class="bi bi-arrow-right-circle me-3"></i>Dados Gerais</h2>
                    </div>
                    <div class="row text-center">
                        <div class="col-md-3">
                            <div class="card bg-primary text-white square-card">
                                <div class="card-body d-flex flex-column align-items-center">
                                    <i class="bi bi-people display-4"></i>
                                    <span>Número de usuários</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card bg-success text-white square-card">
                                <div class="card-body d-flex flex-column align-items-center">
                                    <i class="bi bi-database display-4"></i>
                                    <span>Exercícios no banco de dados</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card bg-warning text-white square-card">
                                <div class="card-body d-flex flex-column align-items-center">
                                    <i class="bi bi-person-video2 display-4"></i>
                                    <span>Professores</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card bg-danger text-white square-card">
                                <div class="card-body d-flex flex-column align-items-center">
                                    <i class="bi bi-gear-fill display-4"></i>
                                    <span>Administradores</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>