
// Atribui a data atual e o criador da postagem
$("#postagem").on("input", () => {
    $("#data").val(data());
    $("#criador").val(userid);
});

// Previne postagens em branco
$('#postagem-icon').on('submit', (event) => {
    if ($('#postagem').val().trim() === '') {
        event.preventDefault();
    }
});

$('#requisitar-treino').click((event) => {
    if (event.target === document.getElementById('requisitar-treino')) {
        let professor = $('#professor').val();

        var currentDate = new Date();
        var mysqlDateTime = currentDate.toISOString().slice(0, 19).replace('T', ' ');

        $.post('/tcc/user/actions/requisitar_treino_action.php', {
            user: userid,
            professor: professor,
            data: mysqlDateTime
        }, function (data) {
            if (data == 1) {
                $('#aviso-requisicao-treino-sucesso').show();
                $('#requisitar-treino').hide();
            } else {
                $('#aviso-requisicao-treino-fracasso').show();
            }
        }).fail(function () {
            $('#aviso-requisicao-treino-fracasso').show();
        });
    }
});
