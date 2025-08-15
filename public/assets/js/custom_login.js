const formRegister = document.getElementById("form-register");
const msg = document.getElementById("msg");
const formRecPass = document.getElementById("form-rec-pass");
const formLogin = document.getElementById("form-login");
const formAddLevelAccess = document.getElementById('form-add-level-access');
const formEditLevelAccess = document.getElementById('form-edit-level-access');
if (formRecPass) {
    formRecPass.addEventListener("submit", function (e) {
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

if (formRegister) {
    formRegister.addEventListener("submit", function (e) {
        var conf_pass = document.getElementById("conf-pass");
        var pass = document.getElementById("pass");
        var name_register = document.getElementById('name-register');
        var cpf_register = document.getElementById('cpf-register');
        var date_birth_register = document.getElementById('date_birth-register');
        var telephone_register = document.getElementById('telephone-register');
        var email_register = document.getElementById('email-register');

        if (name_register.value == "") {
            e.preventDefault();
            msg.innerHTML = "<p style='color: red'>Preencha o nome!</p>";
        } else if (cpf_register.value == "") {
            e.preventDefault();
            msg.innerHTML = "<p style='color: red'>Preencha o CPF!</p>";
        } else if (date_birth_register.value == "") {
            e.preventDefault();
            msg.innerHTML = "<p style='color: red'>Preencha a Data de Nascimento!</p>";
        } else if (telephone_register.value == "") {
            e.preventDefault();
            msg.innerHTML = "<p style='color: red'>Preencha o telefone!</p>";
        } else if (email_register.value == "") {
            e.preventDefault();
            msg.innerHTML = "<p style='color: red'>Preencha o e-mail!</p>";
        } else if (pass.value == "") {
            e.preventDefault();
            msg.innerHTML = "<p style='color: red'>Preencha a senha!</p>";
        } else if (conf_pass.value == "") {
            e.preventDefault();
            msg.innerHTML = "<p style='color: red'>Confirme a senha!</p>";
        } else if (conf_pass.value != pass.value) {
            e.preventDefault();
            msg.innerHTML = "<p style='color: red;'>Senha deve combinar!</p>";
        } else {
            msg.innerHTML = "";
        }
    })
}

if (formLogin) {
    formLogin.addEventListener('submit', function (e) {
        var cpf = document.getElementById('cpf-login');
        var pass = document.getElementById('password-login');
        if (cpf.value == "") {
            e.preventDefault();
            msg.innerHTML = "<p style='color: red;'>Preencha o CPF!</p>";
        } else if (pass.value == "") {
            e.preventDefault();
            msg.innerHTML = "<p style='color: red;'>Preencha a senha!</p>";
        } else {
            msg.innerHTML = "";
        }
    })
}

if (formAddLevelAccess) {
    formAddLevelAccess.addEventListener('submit', function (e) {
        var name_add_level_access = document.getElementById('name-add-level-access');
        if (name_add_level_access.value == "") {
            e.preventDefault();
            msg.innerHTML = "<p style='color: red;'>Preencha o nome do Nível de Acesso!</p>";
        } else {
            msg.innerHTML = "";
        }
    })
}

if (formEditLevelAccess) {
    formEditLevelAccess.addEventListener('submit', function (e) {
        var name_edit_level_access = document.getElementById('name-edit-level-access');
        if (name_edit_level_access.value == "") {
            e.preventDefault();
            msg.innerHTML = "<p style='color: red;'>Preencha o nome do Nível de Acesso!</p>";
        } else {
            msg.innerHTML = "";
        }
    })
}