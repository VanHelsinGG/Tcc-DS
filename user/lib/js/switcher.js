/*  Atualização 05/04/2023
    - Otimização de código

    Atualização 13/04/2023
    - Adição de textos rotativos
*/

let index = 0;
let timerId = setInterval(atualizarSwitcher, 20000);

function atualizarSwitcher(forcado = 0) {
    /*
        forcado = 0 -> Atualização 'natural'
        forcado = 1 -> Click na seta de 'avançar'
        forcado = 2 -> Click na seta de 'recuar'
    */

    // Seleção dos elementos através de um array
    var imagens = document.querySelectorAll('.carousel-item');
    var indicators = document.querySelectorAll('.carousel-indicators li');
    var titulo = document.getElementById("image-title");
    const textos = ["Atividades físicas para prevenir doenças!", 
    "Acompanhe seu progresso com facilidade!", 
    "Aprenda enquanto se exercita!", 
    "Alimentação equilibrada para uma vida saudável!", 
    "Ganhe pontos e recompensas por se exercitar!", 
    "Monitore sua saúde com a calculadora IMC!", 
    "Cuide de corpo e mente com hábitos saudáveis!"];

    // Reset das classes bootstraap
    imagens.forEach((imagem) => imagem.classList.remove('active'));
    indicators.forEach((indicator) => indicator.classList.remove('active'));

    // Verificação posição index + tipo de parâmetro
    index = (index + (forcado === 2 ? -1 : 1) + imagens.length) % imagens.length;

    // Atribuição da classe bootstraap aos elementos ativos
    imagens[index].classList.add('active');
    indicators[index].classList.add('active');

    //Rotatividade dos textos
    titulo.textContent = textos[index];

    // Set dos timers automaticos:
    /*
        forcado = 0 -> 5s = 5000ms
        forcado = 1 -> 25s = 25000ms
        forcado = 2 -> 25s = 25000ms
    */
    clearInterval(timerId);
    timerId = setInterval(atualizarSwitcher, forcado ? 25000 : 5000);
}