var lis = document.querySelectorAll('li');
var activeLi = document.querySelector('li.active');

for (var i = 0; i < lis.length; i++) {
    lis[i].addEventListener('mouseenter', function() {
        if (activeLi) {
            activeLi.classList.remove('active');
        }
    });

    lis[i].addEventListener('mouseleave', function() {
        if (!activeLi.classList.contains('active')) {
            activeLi.classList.add('active');
        }
    });
}