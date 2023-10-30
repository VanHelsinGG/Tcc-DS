$('.card').on('click', function () {
    // Remove a classe 'exercise-active' de todos os cards
    $('.card').removeClass('exercise-active');

    // Adiciona a classe 'exercise-active' ao card clicado
    $(this).addClass('exercise-active');

    // Adiciona a classe 'd-none' a todas as tabelas
    $('table').addClass('d-none');

    // Remove a classe 'd-none' da tabela dentro do card clicado
    $(this).find('table').removeClass('d-none');
});

$(document).on('click', '.finalizar-serie', function () {
    var $tr = $(this).closest('tr');

    if ($(this).hasClass('maked')) {
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
    $button.removeClass('btn-success maked')
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

        // Atualiza o botão e as classes do botão
        $button.removeClass('btn-outline-primary text-white')
            .addClass('btn-success maked')
            .text('Realizado');

        if ($tr.siblings('.completed').length === $tr.siblings('tr').length) {
            $tr.closest('.card').addClass('bg-success text-white');
            $tr.closest('.card').find('th').addClass('text-white');
        }
    }
}
