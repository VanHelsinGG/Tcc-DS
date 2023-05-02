// Verifica se as senhas são compatíveis
function checkCampos() {
    const senha2Element = document.getElementById("senha2");
    if (senha2Element) {
        const senha = document.getElementById("senha").value;
        const confirmacaoSenha = senha2Element.value;
        const botao = document.getElementById("continuar");
        const aviso = document.getElementById("sumir-senha-certa");
        const data = document.getElementById("data");

        if (senha !== confirmacaoSenha) {
            // Senhas diferentes
            if (!botao.classList.contains("disabled")) {
                botao.classList.add("disabled");
                aviso.style.display = "block";
            }
            return false; // retorna falso
        } else {
            // Senhas iguais
            aviso.style.display = "none";

            // Seta a data para o protocolo POST
            data.value = formatDate(new Date());

            // Ativa o botão
            botao.classList.remove("disabled");
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

// Pegar IP desde cedo pra não demorar
document.getElementById('nome').addEventListener('input', function (event) {
    const ip = document.getElementById("ip");
    getIPAddress(function (e) {
        ip.value = e;
    });
});


function getIPAddress(callback) {
    // Requisição para a API
    const request = new XMLHttpRequest();
    const url = 'https://api.ipify.org?format=json';

    request.onreadystatechange = function () {
        if (request.readyState === 4 && request.status === 200) {
            const response = JSON.parse(request.responseText);
            const ipAddress = response.ip;
            callback(ipAddress);
        }
    };

    request.open('GET', url, true);
    request.send();
}


function padTo2Digits(num) {
    return num.toString().padStart(2, '0');
}

function formatDate(date) {
    return (
        [
            date.getFullYear(),
            padTo2Digits(date.getMonth() + 1),
            padTo2Digits(date.getDate()),
        ].join('-') +
        ' ' +
        [
            padTo2Digits(date.getHours()),
            padTo2Digits(date.getMinutes()),
            padTo2Digits(date.getSeconds()),
        ].join(':')
    );
}
