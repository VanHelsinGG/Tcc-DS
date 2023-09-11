const btnRedirect = document.querySelectorAll('.btn[data-bs-dismiss="modal"]');

btnRedirect.forEach(botao => {
    botao.addEventListener("click", function () {
        window.location.href = 'deslogar.php';
    });
});
