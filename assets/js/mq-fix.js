const mq = window.matchMedia("(min-width: 768px)");

var login = document.getElementById('login-col');
var main = document.getElementById('main-col');

if (mq.matches) {
    login.classList.remove('col-lg-3');
    login.classList.remove('col-sm-3');
    main.classList.remove('col-lg-9');
    login.classList.remove('col-sm-9');
}