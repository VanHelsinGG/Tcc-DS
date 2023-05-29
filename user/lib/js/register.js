let allGood = [0,0];

const botao = document.getElementById("continuar");

setInterval(liberarBotao, 1000);

// Verifica se as senhas são compatíveis
function checkCampos() {
    const senha2Element = document.getElementById("senha2");
    if (senha2Element) {
        const senha = document.getElementById("senha").value;
        const confirmacaoSenha = senha2Element.value;
        const avisoSenha = document.getElementById("sumir-senha-certa");

        if (senha !== confirmacaoSenha) {
            // Senhas diferentes

            avisoSenha.style.display = "block";

            return false; // retorna falso
        } else {
            // Senhas iguais
            avisoSenha.style.display = "none";

            // Seta a data para o protocolo POST
            data.value = formatDate(new Date());

            allGood[0] = 1;
            return true;
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


function validarEmail(email) {
    var validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;

    if (email.match(validRegex) || !email) {
        allGood[1] = 1;
        return 1;
    } else {
        return 0;
    }
}

document.getElementById("email").addEventListener("focusout", (e) => {
    const email = document.getElementById("email").value;
    const avisoEmail = document.getElementById("sumir-email-certo");

    avisoEmail.style.display = (validarEmail(email)) ? "none" : "block";
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

function liberarBotao() {

    let allGoodIndexes = true;
    for (let i = 0; i < allGood.length; i++) {
        if (allGood[i] !== 1) {
            allGoodIndexes = false;
            break;
        }
    }

    if (allGoodIndexes) {
        botao.classList.remove("disabled");
    } else {
        botao.classList.add("disabled");
    }
}