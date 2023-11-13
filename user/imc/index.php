
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Calculadora de IMC</title>
</head>
<body>
    <main id="container">
        <?php
            if(isset($_GET['return'])){
                echo "<a id='returner' onclick='window.history.back();'><i class='fa-solid fa-arrow-left' style='margin-right:1rem;'></i>Voltar</a>";
            }
        ?>
        <section id="img">
            <img src="assets/imgs/illustration.svg">
        </section>

        <section id="calculator">
            <form id="form">
                <h1 id="title">
                    Calculadora - IMC
                </h1>

                <div class="input-box">
                    <label for="weight">
                        Peso em kg
                    </label>
                    <div class="input-field">
                        <i class="fa-solid fa-weight-hanging"></i>
                        <input type="number" id="weight" name="weight" required>
                        <span>
                            Kg
                        </span>
                    </div>
                </div>

                <div class="input-box">
                    <label for="height">
                        Altura em metros
                    </label>
                    <div class="input-field">
                        <i class="fa-solid fa-ruler"></i>
                        <input type="number" step="0.01" id="height" name="height" required>
                        <span>
                            m/cm
                        </span>
                    </div>
                </div>
                
                <button id="calculate">
                    Calcular
                </button>
            </form>    
            
            <div id="infos" class="hidden">
                <div id="result">
                    <div id="bmi">
                        <span id="value"></span>
                        <span>Seu IMC</span>
                    </div>
                    <div id="description">
                        <span></span>
                    </div>  
                </div>

                <div id="more_info">
                    <a href="https://mundoeducacao.uol.com.br/saude-bem-estar/imc.htm">
                        Mais informações sobre o IMC
                        <i class="fa-solid fa-arrow-up-right-from-square"></i>
                    </a>
                </div>
            </div>   
        </section>

        <div id="copyright">
            <p><a href="../index.php" style="color:var(--azul-complementar);">OlympiaWorkout</a> - Todos os direitos reservados</p>
        </div>
    </main>
    <script src="assets/js/script.js"></script>
</body>
</html>