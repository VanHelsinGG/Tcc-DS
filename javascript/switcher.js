/*  Atualização 05/04/2023
    - Otimização de código
*/

let index = 0;
let timerId = setInterval(atualizarSwitcher, 2000);

function atualizarSwitcher(forcado = 0) {
    /*
        forcado = 0 -> Atualização 'natural'
        forcado = 1 -> Click na seta de 'avançar'
        forcado = 2 -> Click na seta de 'recuar'
    */

    // Seleção dos elementos através de um array
    var imagens = document.querySelectorAll('.carousel-item');
    var indicators = document.querySelectorAll('.carousel-indicators li');

    // Reset das classes bootstraap
    /* ------------------ Codigo antigo ------------------
        for(var i=0; i < imagens.lenght; i++){
            imagens[i].classlist.remove('active');
        }
        for(var i=0; i < indicators.lenght; i++){
            indicators[i].classlist.remove('active');
        }

    */
    imagens.forEach((imagem) => imagem.classList.remove('active'));
    indicators.forEach((indicator) => indicator.classList.remove('active'));

    // Verificação posição index + tipo de parâmetro
    /* ------------------ Codigo antigo ------------------
        (forcado == 2) ? Index-- : Index++;

        if (Index < 1) {
            Index = imagens.length;
        } else if (Index > imagens.length) {
            Index = 1;
        }  
    */
    index = (index + (forcado === 2 ? -1 : 1) + imagens.length) % imagens.length;

    // Atribuição da classe bootstraap aos elementos ativos
    imagens[index].classList.add('active');
    indicators[index].classList.add('active');

    // Set dos timers automaticos:
    /*
        forcado = 0 -> 5s = 5000ms
        forcado = 1 -> 25s = 25000ms
        forcado = 2 -> 25s = 25000ms
    */
    clearInterval(timerId);
    timerId = setInterval(atualizarSwitcher, forcado ? 25000 : 5000);
}