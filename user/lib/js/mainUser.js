$(document).ready(() => {
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


});