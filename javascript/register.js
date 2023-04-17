// Verifica se as senhas são compatíveis
function checkCampos() {
    //  ***** Função criada para ser usada em outros casos, se caso não utilizar, remover o IF abaixo: *****
    if (document.body.contains(document.getElementById("senha2"))) {
        let senha = document.getElementById("senha").value;
        let confirmacaoSenha = document.getElementById("senha2").value;

        if (senha !== confirmacaoSenha) {
            // Senhas diferentes
            // ***** Modificar o modo de alerta ***** //
            alert("As senhas não conferem!");
            return false; // retorna falso
        } else {
            // Senhas iguais
            return true; // returna verdadeiro
        }
    }
}

// Evento de clique no botão de cadastrar
document.getElementById('continuar').addEventListener('submit', function (event) {
    if (!checkCampos()) {
        // Impede a ação do botão caso as senhas não forem iguais
        event.preventDefault();
    }
});

