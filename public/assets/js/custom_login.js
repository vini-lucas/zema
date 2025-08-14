const formRegister = document.getElementById("form-register");
const msg = document.getElementById("msg");
const formRecPass = document.getElementById("form-rec-pass");
if (formRegister) {
    formRegister.addEventListener("submit", function (e) {
        var conf_pass = document.getElementById("conf-pass");
        var pass = document.getElementById("pass");
        if (conf_pass.value != pass.value) {
            e.preventDefault();
            msg.innerHTML = "<p style='color: red;'>Senha deve combinar!</p>";
        } else {
            msg.innerHTML = "";
        }
    })
}

if (formRecPass) {
    formRecPass.addEventListener("submit", function (e) {
        var conf_pass = document.getElementById("conf-pass");
        var pass = document.getElementById("pass");
        if (conf_pass.value != pass.value) {
            e.preventDefault();
            msg.innerHTML = "<p style='color: red;'>Senha deve combinar!</p>";
            console.log("acessou aqui");
        } else {
            msg.innerHTML = "";
        }
    })
}