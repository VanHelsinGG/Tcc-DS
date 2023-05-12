const campoForm = document.getElementById("objetivo");
const form = document.querySelector("form");

document.querySelector('.hipertrofia').addEventListener('click', function (event) {
    campoForm.value = 1;
    form.submit();
});

document.querySelector('.manter-peso').addEventListener('click', function (event) {
    campoForm.value = 2;
    form.submit();
});

document.querySelector('.emagrecimento').addEventListener('click', function (event) {
    campoForm.value = 3;
    form.submit();
});