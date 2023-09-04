'use strict';

var exercicio = [];
var treinos = [];
var numTraining = 1;
var trainingInfos = {
    1: {
        numExercises: 3,
        numSeries: 12
    },
}

var lis = document.querySelectorAll('li');
var activeLi = document.querySelector('li.active');

for (var i = 0; i < lis.length; i++) {
    lis[i].addEventListener('mouseenter', function () {
        if (activeLi) {
            activeLi.classList.remove('active');
        }
    });

    lis[i].addEventListener('mouseleave', function () {
        if (!activeLi.classList.contains('active')) {
            activeLi.classList.add('active');
        }
    });
}

function adicionarInput(button) {
    var divExercicio = button.closest(".container");
    var divExercicioID = divExercicio.className.split("-")[1];
    var divPai = button.closest('[class^="row"]');

    if (!divPai) {
        console.error("Elemento divPai não encontrado.");
        return;
    }

    // Crie um novo elemento input
    var novoInput = document.createElement("input");
    novoInput.type = "text";
    novoInput.className = "form-control my-1";
    novoInput.placeholder = "Nova Série";

    // Adicione o novo input antes do botão
    divPai.insertBefore(novoInput, button);

    refreshTrainingInfos(divExercicioID, 0, 1); // Atualize a contagem de séries
}

function criarNovoTreino() {
    if (numTraining < 7) {
        const treino = document.querySelector(`.treino-template`);
        const novoTreino = treino.cloneNode(true);

        numTraining++;

        novoTreino.classList.remove(`treino-${numTraining - 1}`);
        novoTreino.classList.remove("treino-template");
        novoTreino.classList.remove("d-none")
        novoTreino.classList.add(`treino-${numTraining}`);

        // Atualize os IDs dos exercícios no novo treino
        const exerciciosNoNovoTreino = novoTreino.querySelectorAll('[id^="exercicio-"]');
        exerciciosNoNovoTreino.forEach((exercicio, index) => {
            const divPaiID = numTraining;
            const novoNumero = index + 1;
            exercicio.id = `exercicio-${divPaiID}-${novoNumero}`;
        });

        const novoTreinoTitulo = novoTreino.querySelector("#titulo");
        novoTreinoTitulo.innerHTML = "Treino " + numTraining;

        const treinosContainer = document.getElementById('treinosContainer');
        treinosContainer.appendChild(novoTreino);

        // Atualize as informações do treino
        refreshTrainingInfos(numTraining, 1);

        console.log(trainingInfos[numTraining]);
    } else {
        alert("Número máximo de treinos: 7");
    }
}



function adicionarExercicio(button) {
    var divPai = button.closest('.container');
    var divPaiID = divPai.className.split("-")[1];

    var classB = `exercicio-${divPaiID}-3`;

    const ultimoExercicio = divPai.querySelector(`#${classB}`);
    const novoExercicio = ultimoExercicio.cloneNode(true);

    var novoNumero = trainingInfos[divPaiID]['numExercises'] + 1;

    novoExercicio.id = `exercicio-${divPaiID}-${novoNumero}`;
    const inputs = novoExercicio.querySelectorAll('input');
    inputs.forEach(element => {
        element.value = '';
    });

    var container = button.closest(".treinoContainer");

    container.appendChild(novoExercicio);

    refreshTrainingInfos(divPaiID, 1, 0);
}



function refreshTrainingInfos(training = -1, exercise = -1, serie = -1) {
    let counter = 0;
    for (let key in trainingInfos) {
        if (training && key === training.toString()) {
            if (exercise) {
                trainingInfos[key]['numExercises']++;
                trainingInfos[key]['numSeries'] += 4;
            }
            if (serie) {
                trainingInfos[key]['numSeries']++;
            }
        }
        counter++;
    }

    if (counter !== numTraining) {
        trainingInfos[numTraining] = {
            numExercises: 3,
            numSeries: 12
        };
    }
}

function criarTreino() {
    let series = document.querySelectorAll(".input-i");

    alert(series[12])
}