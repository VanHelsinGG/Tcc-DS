<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="../lib/js/dashboard.js" defer></script>
    <link rel="stylesheet" href="../../main/lib/css/universal.css">
    <link rel="stylesheet" href="../../main/lib/images/bootstrap-icons-1.10.4/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../lib/css/dashboard.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body class="m-0 p-0 border-0">

    <div class="container-fluid">
        <div class="row">
            <nav class="escuro col-md-2 m-0 col-lg-2 d-md-block text-white p-0 vh-100 sidebar fixed-top" id="navbar">
                <h1 class="text-center fs-3 bg-laranja py-4">OlympiaWorkout</h1>
                <ul class="list-unstyled list-group h-100">
                    <li class="active my-1 option"><a href="#" class="text-white btn my-2"><i class="bi bi-house-fill me-3"></i>Inicio</a></li>
                    <li class="my-1 option"><a href="#" class="text-white btn my-2"><i class="bi bi-basket3-fill me-3"></i>Treino</a></li>
                    <li class="my-1 option"><a href="#" class="text-white btn my-2"><i class="bi bi-basket3-fill me-3"></i>Alunos</a></li>
                    <li class="my-1 option"><a href="#" class="text-white btn my-2"><i class="bi bi-clipboard2-data-fill me-3"></i>Relatorios</a></li>
                    <li class="my-1 option" style="border-top: 1px solid #363330;" id="user-icon"><a href="" class="text-white btn my-2"><i class="bi bi-person-circle me-3"></i>Olympia Workout</a></li>
                </ul>
            </nav>
            <main class="col-10 ms-auto col-lg-10 vh-100">
                <header class="container-fluid text-center my-4 pb-4">
                    <h1>OlympiaWorkout - Painel do Professor</h1>
                </header>

                <div class="container-fluid mt-3 p-5" style="border-top:1px solid #d3d3d3;border-bottom:1px solid #d3d3d3;">
                    <div class="row mb-2">
                        <h2><i class="bi bi-arrow-right-circle me-3"></i>Seu Relatório Geral</h2>
                    </div>
                    <div class="row text-center">
                        <div class="col-md-3">
                            <div class="card bg-primary text-white square-card">
                                <div class="card-body d-flex flex-column align-items-center">
                                    <i class="bi bi-people display-4"></i>
                                    <span class="display-5">0</span>
                                    <span>Alunos</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card bg-success text-white square-card">
                                <div class="card-body d-flex flex-column align-items-center">
                                    <i class="bi bi-bookmark display-4"></i>
                                    <span class="display-5">0</span>
                                    <span>Treinos Criados</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card bg-warning text-white square-card">
                                <div class="card-body d-flex flex-column align-items-center">
                                    <i class="bi bi-star display-4"></i>
                                    <span class="display-5">0</span>
                                    <span>Avaliações</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card bg-danger text-white square-card">
                                <div class="card-body d-flex flex-column align-items-center">
                                    <i class="bi bi-exclamation display-4"></i>
                                    <span class="display-5">0</span>
                                    <span>Treinos Vencidos</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container-fluid mt-3 p-5">
                    <div class="row">
                        <div class="col-5">
                            <div class="row mb-2">
                                <h2><i class="bi bi-arrow-right-circle me-3"></i>Alunos</h2>
                            </div>
                            <div class="row text-center">
                                <table class="table-dark table-striped table text-center">
                                    <tr>
                                        <th>Nome</th>
                                        <th>Próximo Treino</th>
                                        <th>Vencimento</th>
                                    </tr>
                                    <tr>
                                        <td>Victor</td>
                                        <td>Treino 1 - Peito</td>
                                        <td>0/60</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="col-6 ms-auto">
                            <div class="row mb-2">
                                <h2><i class="bi bi-arrow-right-circle me-3"></i>Solicitações Pendentes</h2>
                            </div>
                            <div class="row text-center">
                                <table class="table-dark table-striped table text-center">
                                    <tr>
                                        <th>Data</th>
                                        <th>Aluno</th>
                                        <th></th>
                                    </tr>
                                    <tr>
                                        <td>00/00/0000</td>
                                        <td>Victor</td>
                                        <td><a href="" class="btn btn-primary w-100 h-100">Criar Treino</a></td>
                                    </tr>
                                </table>
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