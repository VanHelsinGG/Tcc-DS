// Muda automaticamente a data do copyright
function direitosAutorais(){
    const dataElement = $("#data");
    
    if(dataElement){
        dataElement.text(new Date().getFullYear());
    }
}
// Volta uma página antes
function voltarPagina() { window.history.back() }

// Salva se o usuario aceitou os cookies
function salvarPreferenciaCookies(preferencia) {
    localStorage.setItem('aceitarCookies', preferencia);
}

// Verefica se o usuario aceitos os cookies
function verificarPreferenciaCookies() {
    const preferencia = localStorage.getItem('aceitarCookies');

    if (preferencia === 'true') {
        // Aceitou
        $('#aviso-cookies').hide(); // Deixa a caixa invisível
    } else {
        // Não aceitou
        $('#aviso-cookies').show(); // Deixa a caixa visível
    }
}
// Salva os cookies aceitos
function aceitarCookies() {
    salvarPreferenciaCookies(true);
    $('#aviso-cookies').hide();
}

function mudarVisibilidadeSenha(element) {
    var senhaInput = $(`#${element}`);
    
    if (senhaInput.attr("type") === "password") {
        senhaInput.attr("type", "text");
    } else {
        senhaInput.attr("type", "password");
    }
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

function getIPAddress(callback) {
    $.get('https://api.ipify.org?format=json', (response) =>{
        const ipAddress = response.ip;
        callback(ipAddress);
    });
}

function data(){
    return formatDate(new Date());
}

direitosAutorais();
verificarPreferenciaCookies();