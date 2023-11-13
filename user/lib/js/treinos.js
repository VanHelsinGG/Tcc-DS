let trainingCompleted = false;
let timeInterval;
$(document).ready(function () {
    timeInterval = setInterval(refreshTimePassed, 1000);
    const previousState = localStorage.getItem('exerciciosEstado');

    if (previousState && !continueTraining) {
        $.post('/tcc/user/actions/encerrar_treino_action.php', {
            action: 'RESET',
            treinoID: treinoID
        }, function (data) {
            try {
                const response = JSON.parse(data);
                if (response.status === "success") {
                    console.log(response.message);
                    localStorage.removeItem('exerciciosEstado');
                    location.reload();
                } else {
                    console.error(response.message);
                }
            } catch (error) {
                console.error("Error parsing the response:", error);
            }
        }).fail(function () {
            console.error("Failed to send the request to the server.");
        });
    }

    if (previousState) {
        const exercises = $('.card');
        const previousStateArray = JSON.parse(previousState);

        for (let i = 0; i < previousStateArray.length; i++) {
            if (previousStateArray[i] === 1) {
                $(exercises[i]).toggleClass('completed');
                toggleCompleted($(exercises[i]), 1);
            } else if (previousStateArray[i] === 2) {
                $(exercises[i]).toggleClass('skipped');
                toggleSkip($(exercises[i]), 1);
            }
        }
    }

    $(window).on('beforeunload', function () {
        if (!trainingCompleted) {
            let timePassed = getTrainingTime();

            $.post('/tcc/user/actions/encerrar_treino_action.php', {
                action: 'SAVE',
                treinoID: treinoID,
                tempoDecorrido: timePassed,
                foco: foco
            }, function (data) {
                const resposta = JSON.parse(data);

                if (resposta.status === "success") {
                    console.log(resposta.message);
                } else {
                    console.error(resposta.message);
                }
            }).fail(function () {
                console.error("Failed to send the request to the server.");
            });

            return 'Tem certeza que deseja sair?';
        }
    });
});


$('.encerrar-treino').click(function () {
    const timePassed = getTrainingTime();

    $.post('/tcc/user/actions/encerrar_treino_action.php', {
        action: 'FINISH',
        treinoID: treinoID,
        tempoDecorrido: timePassed,
        foco: foco
    }, function (data) {
        const resposta = JSON.parse(data);

        if (resposta.status === "success") {
            localStorage.removeItem('exerciciosEstado');
            trainingCompleted = true;
            window.location.href = 'main.php';
        } else {
            console.error(resposta.message);
        }
    }).fail(function () {
        console.error("Failed to send the request to the server.");
    });
});

$('.card').on('click', function () {
    if ($(this).hasClass('exercise-active')) {
        // $(this).removeClass('exercise-active');
        // $(this).find('table').addClass('d-none');
        // $(this).find('.pular-exercicio').addClass('d-none');
        // $(this).find('.completar-exercicio').addClass('d-none');
        // $(this).find('.bi-caret-down').show();
    } else {
        // activeCard($(this));
    }
    activeCard($(this));
});


$('.completar-exercicio').on('click', function () {
    const $card = $(this).closest('.card');

    if ($card.hasClass('skipped')) {
        $card.removeClass('skipped');
        toggleSkip($card);
    }

    $card.toggleClass('completed');

    toggleCompleted($card);

});


$('.pular-exercicio').on('click', function () {
    const $card = $(this).closest('.card');

    $card.toggleClass('skipped');

    toggleSkip($card);
});

$('.finalizar-serie').on('click', function () {
    var $tr = $(this).closest('tr');

    if ($(this).hasClass('completed')) {
        undoCompletion($tr, $(this));
    } else {
        startCompletion($tr, $(this));
    }
});

function refreshTimePassed() {
    let hour = parseInt($('#hour').text());
    let minute = parseInt($('#minute').text());
    let secound = parseInt($('#secound').text());

    secound++;

    if (secound === 60) {
        secound = 0;
        minute++;
    }

    if (minute === 60) {
        minute = 0;
        hour++;
    }

    $('#hour').text(hour.toString().padStart(2, '0') + ':');
    $('#minute').text(minute.toString().padStart(2, '0') + ':');
    $('#secound').text(secound.toString().padStart(2, '0'));

}

function getTrainingTime() {
    return $('#hour').text().trim() + $('#minute').text().trim() + $('#secound').text().trim();
}

function activeCard($card) {
    $('.card').removeClass('exercise-active');
    $card.addClass('exercise-active');

    $('table').addClass('d-none');
    $card.find('table').removeClass('d-none');

    $('.pular-exercicio').addClass('d-none');

    if (!$card.hasClass('completed')) {
        $card.find('.pular-exercicio').removeClass('d-none');
    }

    $('.completar-exercicio').addClass('d-none');
    $card.find('.completar-exercicio').removeClass('d-none');

    $('.card').find('.bi-caret-down').show();
    $card.find('.bi-caret-down').hide();
}

function toggleCompleted($card, option = 0) {
    let $cardElement = $card; // Garante que $card seja um objeto jQuery

    if ($cardElement.hasClass('completed')) {
        $cardElement.addClass('bg-success');
        $cardElement.find('td, th, .card-title').addClass('text-white');
        $cardElement.find('.pular-exercicio').addClass('d-none');
        $cardElement.find('.completar-exercicio').removeClass('btn-outline-success')
            .addClass('btn-success')
            .text('Desfazer Exercício');
        $cardElement.find('.finalizar-serie').removeClass('btn-outline-primary btn-success')
            .addClass('btn-primary disabled')
            .text('Realizado');
        $cardElement.find('tr').removeClass('bg-success bg-opacity-50');
    } else {
        $cardElement.removeClass('bg-success');
        $cardElement.find('td, th, .card-title').removeClass('text-white');
        $cardElement.find('.pular-exercicio').removeClass('d-none');
        $cardElement.find('.completar-exercício').addClass('btn-outline-success')
            .removeClass('btn-success')
            .text('Completar Exercício');
        $cardElement.find('.finalizar-serie').addClass('btn-outline-primary')
            .removeClass('btn-primary btn-success disabled')
            .text('Finalizar');
        $cardElement.find('tr').removeClass('bg-success bg-opacity-50');
    }

    if (!option) {
        refreshLocalStorage();
    }
}

function toggleSkip($card, option = 0) {
    if ($card.hasClass('skipped')) {
        $card.addClass('bg-warning');
        $card.find('td, th, .card-title').addClass('text-white');
        $card.find('.pular-exercicio').hide();
        $card.find('.completar-exercicio').removeClass('btn-outline-success')
            .addClass('btn-success');
        $card.find('.finalizar-serie').removeClass('btn-outline-primary btn-success completed')
            .addClass('btn-primary');
    } else {
        $card.removeClass('bg-warning');
        $card.find('td, th, .card-title').removeClass('text-white');
        $card.find('.pular-exercicio').show();
        $card.find('.completar-exercicio').addClass('btn-outline-success')
            .removeClass('btn-success');
        $card.find('.finalizar-serie').addClass('btn-outline-primary')
            .removeClass('btn-primary');
    }

    if (!option) {
        refreshLocalStorage();
    }
}

function startCompletion($tr, $button) {
    $tr.find('td').hide();
    $tr.append('<td colspan="3"><div class="progress w-100" role="progressbar" aria-label="Descanso" aria-valuenow="0" aria-valuemin="0" aria-valuemax="3"> <div class="progress-bar" style="width: 0%"></div></div></td>');

    var progressBar = $tr.find('.progress');
    var intervalId = setInterval(function () {
        incrementProgressBar(progressBar, intervalId, $tr, $button);
    }, 1000);
}


function undoCompletion($tr, $button) {
    $tr.removeClass('bg-success bg-opacity-primary text-white');
    $tr.find('td').removeClass('text-white');
    $button.removeClass('btn-success completed')
        .addClass('btn-outline-primary')
        .text('Finalizar');

}


function incrementProgressBar(element, intervalId, $tr, $button) {
    var progressValue = parseInt($(element).attr('aria-valuenow'));

    if (progressValue < 3) {
        progressValue++;
        $(element).attr('aria-valuenow', progressValue);
        $(element).find('.progress-bar').css('width', (progressValue / 3) * 100 + "%");
    } else {
        clearInterval(intervalId);

        $tr.find('td').show().addClass('text-white');
        $tr.find('.progress').remove();
        $tr.find('td[colspan="3"]').remove();

        $tr.addClass('bg-success bg-opacity-50 completed');

        $button.addClass('btn-success')
            .removeClass('btn-outline-primary')
            .text('Realizado');

        if ($tr.siblings('.completed').length === $tr.siblings('tr').length) {
            if ($tr.closest('.card').hasClass('skipped')) {
                $tr.closest('.card').removeClass('skipped');
                toggleSkip($tr.closest('.card'));
            }

            $tr.closest('.card').addClass('completed');
            toggleCompleted($tr.closest('.card'));

            refreshLocalStorage();
        }
    }
}


function refreshLocalStorage() {
    /**
     * 0 - Aberto
     * 1 - Completo
     * 2 - Pulado
     */

    let exercisesState = [];

    $('.card').each(function (index, element) {
        if ($(element).hasClass('completed')) {
            exercisesState.push(1);
        } else if ($(element).hasClass('skipped')) {
            exercisesState.push(2);
        } else {
            exercisesState.push(0);
        }
    });

    localStorage.setItem('exerciciosEstado', JSON.stringify(exercisesState));
}

