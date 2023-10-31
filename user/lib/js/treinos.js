let timeInterval;

$(document).ready(function () {
    timeInterval = setInterval(refreshTimePassed, 1000);
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

    $('#hour').text(hour.toString().padStart(2, '0') + ' :');
    $('#minute').text(minute.toString().padStart(2, '0') + ' :');
    $('#secound').text(secound.toString().padStart(2, '0'));
}

$('.card').on('click', function () {
    activeCard($(this));
});

function activeCard($card) {
    $('.card').removeClass('exercise-active');
    $card.addClass('exercise-active');

    $('table').addClass('d-none');
    $card.find('table').removeClass('d-none');

    $('.pular-exercicio').addClass('d-none');
    $card.find('.pular-exercicio').removeClass('d-none');

    $('.completar-exercicio').addClass('d-none');
    $card.find('.completar-exercicio').removeClass('d-none');

    $('.card').find('.bi-caret-down').show();
    $card.find('.bi-caret-down').hide();
}

$('.completar-exercicio').on('click', function () {
    const $card = $(this).closest('.card');

    if ($card.hasClass('skipped')) {
        $card.removeClass('skipped');
        toggleSkip($card);
    }

    $card.toggleClass('completed');

    toggleCompleted($card);

});

function toggleCompleted($card) {
    if ($card.hasClass('completed')) {
        $card.addClass('bg-success');
        $card.find('td, th, .card-title').addClass('text-white');
        $card.find('.pular-exercicio').hide();
        $card.find('.completar-exercicio').removeClass('btn-outline-success')
            .addClass('btn-success')
            .text('Desfazer Exercício');
        $card.find('.finalizar-serie').removeClass('btn-outline-primary btn-success')
            .addClass('btn-primary disabled')
            .text('Realizado');
        $card.find('tr').removeClass('bg-success bg-opacity-50');
    } else {
        $card.removeClass('bg-success');
        $card.find('td, th, .card-title').removeClass('text-white');
        $card.find('.pular-exercicio').show();
        $card.find('.completar-exercicio').addClass('btn-outline-success')
            .removeClass('btn-success')
            .text('Completar Exercício');
        $card.find('.finalizar-serie').addClass('btn-outline-primary')
            .removeClass('btn-primary btn-success disabled')
            .text('Finalizar');
        $card.find('tr').removeClass('bg-success bg-opacity-50');
    }
}

$('.pular-exercicio').on('click', function () {
    const $card = $(this).closest('.card');

    $card.toggleClass('skipped');

    toggleSkip($card);
});

function toggleSkip($card) {
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
}

$('.finalizar-serie').on('click', function () {
    var $tr = $(this).closest('tr');

    if ($(this).hasClass('completed')) {
        undoCompletion($tr, $(this));
    } else {
        startCompletion($tr, $(this));
    }
});

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
        }
    }
}
