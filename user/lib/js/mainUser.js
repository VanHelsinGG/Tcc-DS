document.getElementById("postagem").addEventListener("input", () => {
    const data = document.getElementById("data");
    const user = document.getElementById("criador");

    data.value = formatDate(new Date());
    user.value = userName;
});

document.getElementById('postagem-icon').addEventListener('submit', function (event) {
    if (!checkText()) {
        // Impede a ação do botão caso as senhas não forem iguais
        event.preventDefault();
    }
});

function checkText() {
    const content = document.getElementById("postagem").value;
    return (content == "") ? 0 : 1;
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
