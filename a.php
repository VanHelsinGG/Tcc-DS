<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="./javascript/mainUser.js" defer></script>
    <link rel="stylesheet" href="./main/lib/css/universal.css">
    <link rel="stylesheet" href="./main/lib/images/bootstrap-icons-1.10.4/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <style>
        .db {
            background: linear-gradient(to top,
                    rgb(0 0 0 / 1),
                    rgb(0 0 0 / 0.1),
                    rgb(0 0 0 / 0)),
                url("https://s2.glbimg.com/LpqJmTucEZeVc1LYjCG6V89Appc=/607x429/smart/e.glbimg.com/og/ed/f/original/2022/03/18/gettyimages-982409358.jpg");
        }

        .actions {
            background-repeat: no-repeat;
            background-size: cover;
        }

        .dieta {
            background: linear-gradient(to top,
                    rgb(0 0 0 / 1),
                    rgb(0 0 0 / 0.1),
                    rgb(0 0 0 / 0)),
                url("https://vitacheckup.com.br/wp-content/uploads/2019/07/alimenta%C3%A7%C3%A3o_900x600.png");
        }

        .relatorios {
            background: linear-gradient(to top,
                    rgb(0 0 0 / 1),
                    rgb(0 0 0 / 0.1),
                    rgb(0 0 0 / 0)),
                url("https://blog.phonetrack.com.br/wp-content/uploads/2018/11/relat%C3%B3rio-de-marketing-digital-blog.png");
        }

        .action {
            height: 500px;
        }

        #image {
            height: 500px;
            background: url("https://boaforma.abril.com.br/wp-content/uploads/sites/2/2017/08/thinkstockphotos-819906232.jpg?quality=90&strip=info&w=1280&h=720&crop=1");
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
</head>

<body style="background-color:#1d1c1a;">
    <header class="header container-fluid bg-laranja fixed-top" id="header">
        <div class="row">
            <div class="col-3 pt-1 d-flex ps-5 align-items-center">
                <div class="col-6">
                    <h1 class="fs-4 text-white" id="title">OlympiaWorkout</h1>
                </div>
                <!-- <div class="col-6 text-end">
                    <img src="../main/lib/images/Tcc Header laranja.jpg" alt="" id="diagonal-bars-header" class="img-fluid" style="height:5rem; margin-right:-1rem;">
                </div> -->
            </div>
            <div class="col-4 d-flex align-items-center">
                <form action="#" method="get">
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-search"></i></span>
                        <input type="text" class="form-control" id="pesquisa" name="pesquisa" autocomplete="off" placeholder="Pesquisar exercícios, dietas, pessoas...">
                    </div>
                </form>
            </div>
            <div class="col-5">
                <nav class="navbar navbar-expand-md navbar-light">
                    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon text-white" style="filter: invert(1);"></span>
                    </button>
                    <div class="collapse navbar-collapse">
                        <ul class="navbar-nav">
                            <li class="nav-item mx-3">
                                <a href="#contact" id="contact" class="nav-link text-white">Exercícios</a>
                            </li>
                            <li class="nav-item mx-3">
                                <a href="#contact" id="contact" class="nav-link text-white">Dieta</a>
                            </li>
                            <li class="nav-item mx-3">
                                <a href="#" class="nav-link text-white">Relatórios</a>
                            </li>
                            <li class="nav-item mx-3">
                                <a href="./register.php" class="nav-link text-white">{Nome usuario}</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </header>

    <div class="container-fluid text-center d-flex justify-content-center align-items-center" id="image">
        <div class="row">
            <div class="col">
                <h1 class="text-white">OlympiaWorkout: Promovendo Saúde e Bem-Estar!</h1>
            </div>
        </div>
    </div>

    <div class="container p-4 text-white escuro">
        <div class="row mb-4" style="border-bottom: 1px solid #363330;">
            <h2 class="fs-4">Treino</h2>
        </div>
        <div class="row">
            <div class="col-6" style="border-right: 1px solid #363330;">
                <h3 class="fs-5">Próximo Treino</h3>
                <a href="" class="btn btn-azul text-white d-flex">
                    <div class="col-3 align-items-center justify-content-center">
                        <div class="row">
                            <span>{Nome do treino}</span>
                        </div>
                        <div class="row">
                            <span>{Professor}</span>
                        </div>
                    </div>
                    <div class="col-1 align-items-center justify-content-center pt-1 fs-3">
                        <i class="bi bi-caret-right-fill text-center"></i>
                    </div>
                    <div class="col-8 align-items-center justify-content-center">
                        <div class="row">
                            <span>{Tipo do treino}</span>
                        </div>
                        <div class="row">
                            <span>Tempo: Não iniciado</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-6">
                <h3 class="fs-5">Histórico Diario</h3>
                <a href="" class="btn btn-outline-success text-white d-flex">
                    <div class="col-3 align-items-center justify-content-center">
                        <div class="row">
                            <span>{Nome do treino}</span>
                        </div>
                        <div class="row">
                            <span>{Professor}</span>
                        </div>
                    </div>
                    <div class="col-1 align-items-center justify-content-center pt-1 fs-3">
                        <i class="bi bi-caret-right text-center"></i>
                    </div>
                    <div class="col-8 align-items-center justify-content-center">
                        <div class="row">
                            <span>{Tipo do treino}</span>
                        </div>
                        <div class="row">
                            <span>Tempo: 01:30:52</span>
                        </div>
                    </div>
                </a>
                <a href="" class="btn btn-outline-success text-white d-flex my-2">
                    <div class="col-3 align-items-center justify-content-center">
                        <div class="row">
                            <span>{Nome do treino}</span>
                        </div>
                        <div class="row">
                            <span>{Professor}</span>
                        </div>
                    </div>
                    <div class="col-1 align-items-center justify-content-center pt-1 fs-3">
                        <i class="bi bi-caret-right text-center"></i>
                    </div>
                    <div class="col-8 align-items-center justify-content-center">
                        <div class="row">
                            <span>{Tipo do treino}</span>
                        </div>
                        <div class="row">
                            <span>Tempo: 01:30:52</span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <div class="container escuro shadow p-4 text-white">
        <div class="row mb-4" style="border-bottom: 1px solid #363330;">
            <h2 class="fs-4">Ultimas Postagens</h2>
        </div>
        <div class="row">
            <div class="col">
                <div class="input-group">
                    <input type="text" class="form-control p-3" id="postagem" name="postagem" autocomplete="off" placeholder="Diga-nos oque está pensando!">
                    <span class="input-group-text"><i class="bi bi-send"></i></span>
                </div>
            </div>
        </div>
        <?php
        include("./main/lib/php/include.php");

        $query = "SELECT * FROM posts ORDER BY postid DESC LIMIT 3";
        $stmt = mysqli_prepare($db, $query);
        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);

        $count = 0;

        if (mysqli_num_rows($resultado) > 0) {
            while ($rows = mysqli_fetch_assoc($resultado)) {
                echo '<div class="row mt-4 p-4 rounded" style="outline:1px solid #363330;">
                <div class="col">
                    <div class="row">
                        <div class="col-1">
                            <img src="https://w7.pngwing.com/pngs/178/595/png-transparent-user-profile-computer-icons-login-user-avatars-thumbnail.png" alt="" style="height: 65px; width:65px;">
                        </div>
                        <div class="col-11">
                            <div class="row"><span>' . $rows['user'] . '</span></div>
                            <div class="row"><span>' . $rows['data'] . '</span></div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <p>' . $rows['content'] . '</p>
                    </div>
                </div>
            </div>';

                $count++;
                if ($count >= 3) {
                    break;
                }
            }
            echo '<div class="row mt-4 p-4 rounded">
            <div class="col">
                <div class="row">
                    <a href="#" class="btn btn-azul text-white">Veja mais publicações</a>
                </div>
            </div>
        </div>';
        } else {
            echo "Não existem postagens recentes!";
        }
        ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    </div>
</body>

</html>