var Index = 0;
var TimerID = 0;

Atualizar_Switcher(0);

function Atualizar_Switcher(forcado) {
    var imagens = document.querySelectorAll('.carousel-item');
    var indicators = document.querySelectorAll('.carousel-indicators li');

    if (TimerID) {
        clearTimeout(TimerID);
        TimerID = 0;
    }

    imagens.forEach(function (imagem) {
        imagem.classList.remove('active');
    });


    (forcado == 2) ? Index-- : Index++;

    if (Index < 1) {
        Index = imagens.length;
    } else if (Index > imagens.length) {
        Index = 1;
    }

    imagens[Index - 1].classList.add('active');

    indicators.forEach(function (indicator) {
        indicator.classList.remove('active');
    });

    indicators[Index - 1].classList.add('active');

    if (forcado > 0) {
        TimerID = setTimeout(Atualizar_Switcher, 25000, 0);
    } else {
        TimerID = setTimeout(Atualizar_Switcher, 2000, 0);
    }
}
