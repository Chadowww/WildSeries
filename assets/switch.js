function toggleForm() {
    var loginForm = document.getElementById("loginForm");
    var registerForm = document.getElementById("registerForm");
    var loginTitle = document.getElementById("loginTitle");
    var registerTitle = document.getElementById("registerTitle");


    if (loginForm.style.display === "none") {
        loginForm.style.display = "block";
        loginTitle.style.display = "block";
        registerForm.style.display = "none";
        registerTitle.style.display = "none";
    } else {
        loginForm.style.display = "none";
        loginTitle.style.display = "none";
        registerForm.style.display = "block";
        registerTitle.style.display = "block";
    }
}