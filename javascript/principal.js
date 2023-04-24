let index = 0;
let timerId = setInterval(atualizarSwitcher, 2000);

function atualizarSwitcher(forcado = 0) {
    // Seleção dos elementos através de um array
    var noticias = document.querySelectorAll('.carousel-item');

    // Reset das classes bootstraap
    noticias.forEach((noticia) => noticia.classList.remove('active'));

    // Verificação posição index + tipo de parâmetro
    index = (index + (forcado === 2 ? -1 : 1) + noticias.length) % noticias.length;

    // Atribuição da classe bootstraap aos elementos ativos
    noticias[index].classList.add('active');
}