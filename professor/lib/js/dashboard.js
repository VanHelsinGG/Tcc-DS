'use strict';

var numTraining = 1;

var treinamento = {
    nome: "",
    professor: "",
    duracao: 0,
    aluno: "",
    treinos:{
        1:{
            nome:"",
            exercicios:[
                //{"nome":"","repeticoes":[]}
            ]
        }
    }
};

$(".option").hover(
    function() {
        $(this).toggleClass("active");
    }
);

$('#user').on('input', function() {
    var inputText = $(this).val().trim().toLowerCase();
    var suggestions = [];

    if (inputText.length > 0) {
        suggestions = users.filter(function(nome) {
            return nome.toLowerCase().includes(inputText);
        });
    }

    $('.sugestoes').empty();

    if (suggestions.length === 0) {
        $('#criar-treinamento').addClass("disabled");
        $('#aviso-sugestao').show();
    } else {
        $('#criar-treinamento').removeClass("disabled");
        $('#aviso-sugestao').hide();
    }

    suggestions.forEach(function(suggestion) {
        $('.sugestoes').append('<li class="sugestao p-2">' + suggestion + '</li>');
    });
});

$(document).on('click', '.sugestoes li', function (){
    var selectedSuggestion = $(this).text();
    $('#user').val(selectedSuggestion);
    $('.sugestoes').empty(); 
});

$('.serie-i').on("focusout", function (){
    atualizarTreinamento($(this));
});

$('.serie-i').on("input",function (){
    verificarInput($(this));
})

$('#duracao').on("input",function (){
    verificarInput($(this));
})

function adicionarInput(button) {
    var $button = $(button);

    var $novoInput = $("<input>", {
        type: "text",
        inputmode: "numeric",
        class: "form-control my-1 serie-i",
        placeholder: "Nova Série",
        max: "100",
        required: true
    });

    $novoInput.on("focusout", function () {
        atualizarTreinamento($(this));
    });

    $novoInput.on("input",function (){
        verificarInput($(this));
    })

    $novoInput.insertBefore($button);
}

function criarNovoTreino() {
    if (numTraining < 7) {
        const $treino = $('.treino-template');
        const $novoTreino = $treino.clone(true);

        numTraining++;

        // Incrementa o objeto completo 'treinamento'
        if (numTraining > Object.keys(treinamento.treinos).length) {
            var novoTreinoID = numTraining;
            var novoTreino = { nome: "", exercicios: [] };
            treinamento.treinos[novoTreinoID] = novoTreino;
        }

        $novoTreino.removeClass(`treino-${numTraining - 1} treino-template d-none`);
        $novoTreino.addClass(`treino-${numTraining}`);

        $novoTreino.find('[id^="exercicio-"]').each(function(index) {
            const novoNumero = index + 1;
            this.id = `exercicio-${numTraining}-${novoNumero}`;
        });

        const $novoTreinoTitulo = $novoTreino.find("#titulo");
        $novoTreinoTitulo.html("Treino " + numTraining);

        $('#treinosContainer').append($novoTreino);

    } else {
        alert("Número máximo de treinos: 7");
    }
}

function adicionarExercicio(button) {
    var $button = $(button);
    var $divPai = $button.closest('.container');
    var divPaiID = $divPai.attr("class").split("-")[2];

    var classB = `exercicio-${divPaiID}-3`;

    const $ultimoExercicio = $divPai.find(`#${classB}`);
    const $novoExercicio = $ultimoExercicio.clone();

    $novoExercicio.attr("id", `exercicio-${divPaiID}-4`);
    const $inputs = $novoExercicio.find('input');
    $inputs.val('');

    $novoExercicio.find('.exercicio-i').attr("placeholder","Novo exercício");

    var $container = $button.closest(".treinoContainer");

    $container.append($novoExercicio);
}

function atualizarTreinamento($input) {
    var $exercicio = $input.closest(".exercicio-c");
    var exercicioNome = $exercicio.find('.exercicio-i').val().toLowerCase();

    var $Treino = $input.closest(".container");
    var treinoID = $Treino.attr('class').split('-')[2];

    var series = []; 

    $exercicio.find(".serie-i").each(function() {
        var valorCampo = $(this).val().trim();
        
        if (valorCampo !== "") {
            series.push(valorCampo);
        }
    });
    
    var treinoNome = $Treino.find(".treino-i").val().toLowerCase();

    var novoExercicio = { "nome": exercicioNome, "repeticoes": series };

    var treino = treinamento.treinos[treinoID];
    treino.nome = treinoNome;
    
    var exercicioExistente = treino.exercicios.find(exercicio => exercicio.nome.toLowerCase() === exercicioNome);

    if (!exercicioExistente) {
        treino.exercicios.push(novoExercicio);
    } else {
        const index = treino.exercicios.findIndex(exercicio => exercicio.nome.toLowerCase() === exercicioNome.toLowerCase());

        if (index !== -1) {
            treino.exercicios[index] = { "nome": exercicioNome, "repeticoes": series };
        }
    }
}

function criarTreinamento() {
    var professor = $('#Professor').val();
    var aluno = $('#user').val();
    var duracao = parseInt($('#duracao').val());
    var nomeTreinamento = $('#nome-treino').val();

    function removerExerciciosVazios(treino) {
        treino.exercicios = treino.exercicios.filter(function (exercicio) {
            return exercicio.nome.trim() !== "";
        });
    }

    var sair = false;

    $('.treino-i').each(function(index) {
        if(index > 0){
            if($(this).val().trim() === ""){
                $(this).focus().css("border", "1px solid red");
                alert("O nome do treino não pode estar em branco!");
                sair = true;
            }
        }
    });

    if(sair){
        return 0;
    }

    if (aluno.trim() === "") {
        $('#user').focus().css("border", "1px solid red");
        alert("O nome do aluno não pode estar em branco!");
        return 0;
    }

    if (!duracao) {
        $('#duracao').focus().css("border", "1px solid red");
        alert("A duração não pode estar em branco!");
        return 0;
    }

    if (nomeTreinamento.trim() === "") {
        $('#nome-treino').focus().css("border", "1px solid red");
        alert("O nome do treinamento não pode estar em branco!");
        return 0;
    }

    var peloMenosUmTreinoComExercicios = false;

    $.each(treinamento.treinos, function (index, treino) {
        if (treino.exercicios && treino.exercicios.length > 0) {
            peloMenosUmTreinoComExercicios = true;
            return 0;
        }
    });
    
    if (!peloMenosUmTreinoComExercicios) {
        alert("Pelo menos um treino deve ter exercícios.");
        return 0;
    }

    treinamento.aluno = aluno;
    treinamento.professor = professor;
    treinamento.duracao = duracao;
    treinamento.nome = nomeTreinamento;

    $.each(treinamento.treinos, function (index, treino) {
        $.each(treino.exercicios, function (i, exercicio) {
            if (exercicio.nome.trim() === "") {
                removerExerciciosVazios(treino);
            }
        });
    });

    var json = JSON.stringify(treinamento);

    $("#loadingModal").modal('show');

    $.post("../actions/criartreino.php", json)
        .done(function (data) {
            console.log(data);
            if (data === "1") {
                $("#aviso-sucesso").show();
    
                $("form").find("input").each(function (index, element) {
                    if ($(element).attr("id") !== "Professor") {
                        $(element).val(""); 
                    }
                });
            } else {
                $("#aviso-erro").show();
            }
        })
        .fail(function () {
            $("#aviso-erro").show();
        })
        .always(function () {
            window.scrollTo(0, 0);
            $("#loadingModal").modal('toggle');
        });
    return 1;
}

function verificarInput($input) {
    const entrada = $input.val();
    const regex = /^[0-9]*$/; 

    if (!regex.test(entrada)) {
        $input.val(entrada.replace(/[^0-9]/g, ''));
    }

    if (entrada > 100) {
        $input.val('100');
    }
}


