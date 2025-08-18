const formRegister = document.getElementById("form-register");
const msg = document.getElementById("msg");
const formEditPass = document.getElementById("form-edit-pass");
const formLogin = document.getElementById("form-login");
const formAddLevelAccess = document.getElementById('form-add-level-access');
const formEditLevelAccess = document.getElementById('form-edit-level-access');
const formEditUser = document.getElementById('form-edit-user');
if (formEditPass) {
    formEditPass.addEventListener("submit", function (e) {
        var conf_pass = document.getElementById("conf-pass");
        var pass = document.getElementById("pass");

        if (pass.value == "") {
            e.preventDefault();
            msg.innerHTML = "<p style='color: red;'>Informe a nova SENHA!</p>";
        } else if (conf_pass.value == "") {
            e.preventDefault();
            msg.innerHTML = "<p style='color: red;'>Confirme-a</p>";
        } else if (conf_pass.value != pass.value) {
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
        var gender_register = document.getElementById("gender-register");
        var telephone_register = document.getElementById('telephone-register');
        var email_register = document.getElementById('email-register');

        if (name_register.value == "") {
            e.preventDefault();
            msg.innerHTML = "<p style='color: red'>Preencha o nome!</p>";
        } else if (cpf_register.value == "") {
            e.preventDefault();
            msg.innerHTML = "<p style='color: red'>Preencha o CPF!</p>";
        } else if (gender_register.value == 'Selecione:') {
            e.preventDefault();
            msg.innerHTML = "<p style='color: red'>Selecione o gênero!</p>";
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

    pass.addEventListener("input", function (e) {
        let strengthPass = 0;
        if (/^(?=(?:.*[A-Z]){2,}).*$/.test(pass.value)) {
            strengthPass += 2;
        }
        if (/^(?=(?:.*[a-z]){2,}).*$/.test(pass.value)) {
            strengthPass += 2;
        }
        if (/^(?=(?:.*\d){2,}).*$/.test(pass.value)) {
            strengthPass += 2;
        }
        if (/^(?=(?:.*[^a-zA-Z0-9]){2,}).*$/.test(pass.value)) {
            strengthPass += 2;
        }
        var newPass = strengthPass;

        if (newPass == 2) {
            e.preventDefault();
            document.getElementById('msg-pass').innerHTML = "<p style='color: red;'>Senha muito fraca!</p>";
        } else if (newPass == 4) {
            e.preventDefault();
            document.getElementById('msg-pass').innerHTML = "<p style='color: orange;'>Senha fraca!</p>";
        } else if (newPass == 6) {
            e.preventDefault();
            document.getElementById('msg-pass').innerHTML = "<p style='color: yellow;'>Senha média!</p>";
        } else if (newPass >= 8) {
            document.getElementById('msg-pass').innerHTML = "<p style='color: green;'>Senha boa!</p>";
        } else if (pass.value == "") {
            document.getElementById('msg-pass').innerHTML = "";
        }
    });
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

if (formEditUser) {
    formEditUser.addEventListener('submit', function (e) {
        var gender_edit_user = document.getElementById('gender-edit-user');
        var name_edit_user = document.getElementById("name-edit-user");
        var date_birth_edit_user = document.getElementById("date_birth-edit-user");
        var telephone_edit_user = document.getElementById("telephone-edit-user");
        var email_edit_user = document.getElementById("email-edit-user");

        if (name_edit_user.value == "") {
            e.preventDefault();
            msg.innerHTML = "<p style='color: red;'>Informe o nome!</p>";
        } else if (gender_edit_user.value == "Selecione:") {
            e.preventDefault();
            msg.innerHTML = "<p style='color: red;'>Selecione o gênero!</p>";
        } else if (date_birth_edit_user.value == "") {
            e.preventDefault();
            msg.innerHTML = "<p style='color: red;'>Informe a Data de Nascimento!</p>";
        } else if (telephone_edit_user.value == "") {
            e.preventDefault();
            msg.innerHTML = "<p style='color: red;'>Informe o telefone!</p>";
        } else if (email_edit_user.value == "") {
            e.preventDefault();
            msg.innerHTML = "<p style='color: red;'>Informe o e-mail!</p>";
        } else {
            msg.innerHTML = "";
        }
    })
}