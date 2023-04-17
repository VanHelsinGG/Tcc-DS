// Verifica se as senhas são compatíveis
function checkCampos() {
    // Verifica se o elemento com id "senha2" existe no documento
    const senha2Element = document.getElementById("senha2");
    if (senha2Element) {
        const senha = document.getElementById("senha").value;
        const confirmacaoSenha = senha2Element.value;

        if (senha !== confirmacaoSenha) {
            // Senhas diferentes
            // Modificar o modo de alerta
            alert("As senhas não conferem!");
            return false; // retorna falso
        } else {
            // Senhas iguais
            return true; // retorna verdadeiro
        }
    }
    return true; // retorna verdadeiro caso não haja elemento com id "senha2"
}

// Evento de clique no botão de cadastrar
document.getElementById('continuar').addEventListener('submit', function (event) {
    if (!checkCampos()) {
        // Impede a ação do botão caso as senhas não forem iguais
        event.preventDefault();
    }
});
