direitosAutorais();
verificarPreferenciaCookies();

// Muda automaticamente a data do copyright
function direitosAutorais() {
    document.getElementById("data").textContent = new Date().getFullYear();
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
        document.getElementById('aviso-cookies').style.display = 'none'; // Deixa a caixa invisivel
    } else {
        // Não aceitou
        document.getElementById('aviso-cookies').style.display = 'block'; // Deixa a caixa visível
    }
}

// Salva os cookies aceitos
function aceitarCookies() {
    salvarPreferenciaCookies(true);
    document.getElementById('aviso-cookies').style.display = 'none';
}

