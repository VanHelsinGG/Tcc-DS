let allGood = [0, 0];

// Verifica se as senhas são compatíveis
function checkCampos() {
    if ($('#senha2').length > 0) {
        const senha = $('#senha').val();
        const confirmacaoSenha = $('#senha2').val();
        const avisoSenha = $('#sumir-senha-certa');

        if (senha !== confirmacaoSenha) {
            avisoSenha.css('display', 'block');
            return 0;
        } else {
            avisoSenha.css('display', 'none');
            $('#data').val(data());
            allGood[0] = 1;
            return 1;
        }
    }
    return 1;
}

// Evento de clique no botão de cadastrar
$('#continuar').on('submit', (event) => {
    if (!checkCampos()) {
        event.preventDefault();
    }
});

// Pegar IP desde cedo pra não demorar
$('#nome').on('input', () => {
    getIPAddress((e) => {
        $("#ip").val(e);
    });
});

function validarEmail(email) {
    const validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    const isValid = validRegex.test(email);
    allGood[1] = isValid ? 1 : 0;
    return isValid;
}

$("#email").on("focusout", () => {
    const email = $('#email').val();
    $("#sumir-email-certo").css("display", validarEmail(email) ? "none" : "block");
});

// Verifica e libera o botão periodicamente
setInterval(() => {
    const allGoodIndexes = allGood.every(item => item === 1);
    $('#continuar').toggleClass("disabled", !allGoodIndexes);
}, 1000);
