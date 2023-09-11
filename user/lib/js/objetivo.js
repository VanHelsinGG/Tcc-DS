$('.hipertrofia').on('click', function(event) {
    $('#objetivo').val(1);
    $('form').submit();
});

$('.manter-peso').on('click', function(event) {
    $('#objetivo').val(2);
    $('form').submit();
});

$('.emagrecimento').on('click', function(event) {
    $('#objetivo').val(3);
    $('form').submit();
});
