var Index = 0;

Atualizar_Switcher();

function Atualizar_Switcher(){
    var imagens = document.getElementsByClassName("switcher-images");
    
    for(var i=0;i < imagens.length; i++){
        imagens[i].style.display = "none";
    }

    Index++;

    if(Index > imagens.length){
        Index = 1;
    }

    imagens[Index-1].style.display = "block";
    setTimeout(Atualizar_Switcher,5000)
}