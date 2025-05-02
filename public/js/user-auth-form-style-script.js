document.addEventListener("DOMContentLoaded", function () {
    var loginForm = document.getElementById("login");
    var registerForm = document.getElementById("register");
    var loginBtn = document.getElementById("loginBtn");
    var registerBtn = document.getElementById("registerBtn");

    window.login = function () {
        loginForm.style.left = "0";
        registerForm.style.left = "100%";
        loginForm.style.opacity = "1";
        registerForm.style.opacity = "0";

        loginBtn.classList.add("white-btn");
        registerBtn.classList.remove("white-btn");
    };

    window.register = function () {
        loginForm.style.left = "-100%";
        registerForm.style.left = "0";
        loginForm.style.opacity = "0";
        registerForm.style.opacity = "1";

        registerBtn.classList.add("white-btn");
        loginBtn.classList.remove("white-btn");
    };
});
