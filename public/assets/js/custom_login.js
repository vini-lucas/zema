// Formulários:-----------------------------------------------------------------------------------------------
const formRegister = document.getElementById("form-register");
const formEditPass = document.getElementById("form-edit-pass");
const formLogin = document.getElementById("form-login");
const formAddLevelAccess = document.getElementById('form-add-level-access');
const formEditLevelAccess = document.getElementById('form-edit-level-access');
const formEditUser = document.getElementById('form-edit-user');
// -----------------------------------------------------------------------------------------------------------
// Variáveis:-------------------------------------------------------------------------------------------------
const msg = document.getElementById("msg");
const msgPass = document.getElementById("msg-pass");
const msgEmail = document.getElementById("msg-email");

const password = document.getElementById("password");
const val_password = document.getElementById("val-password");
const name = document.getElementById("name");
const cpf = document.getElementById("cpf");
const date_birth = document.getElementById("date_birth");
const gender = document.getElementById("gender");
const telephone = document.getElementById("telephone");
const email = document.getElementById("email");
// -----------------------------------------------------------------------------------------------------------
// Máscara do CPF:
if (cpf) {
    cpf.addEventListener('input', function () {
        let cpfValue = cpf.value.replace(/\D/g, "");
        cpfValue = cpfValue.slice(0, 11);

        cpfValue = cpfValue.replace(/(\d{3})(\d)/, "$1.$2");
        cpfValue = cpfValue.replace(/(\d{3})(\d)/, "$1.$2");
        cpfValue = cpfValue.replace(/(\d{3})(\d{1,2})$/, "$1-$2");

        cpf.value = cpfValue;
    });
}
// -----------------------------------------------------------------------------------------------------------
// Máscara do telefone:
if (telephone) {
    telephone.addEventListener('input', function () {
        let numbersTelephone = telephone.value.replace(/\D/g, "").slice(0, 11);
        let telephoneFormatted = "";

        if (numbersTelephone.length > 0) {
            telephoneFormatted += "(" + numbersTelephone.slice(0, 2) + ") ";
        }
        if (numbersTelephone.length > 2) {
            telephoneFormatted += numbersTelephone.slice(2, 3) + " ";
        }
        if (numbersTelephone.length > 3) {
            telephoneFormatted += numbersTelephone.slice(3, 7);
        }
        if (numbersTelephone.length > 7) {
            telephoneFormatted += "-" + numbersTelephone.slice(7, 11);
        }

        telephone.value = telephoneFormatted;
    });
}
// -----------------------------------------------------------------------------------------------------------
// Máscara do e-mail:
if (email) {
    email.addEventListener('input', function () {
        const valor = email.value;

        if (valor === "") {
            msgEmail.innerHTML = "";
        } else if (!/@/.test(valor)) {
            msgEmail.innerHTML = "<p style='color: red'>Informe o '@'!</p>";
        } else if (!/\.[a-z]{2,}$/i.test(valor)) {
            msgEmail.innerHTML = "<p style='color: red'>Informe o domínio!</p>";
        } else {
            msgEmail.innerHTML = "";
        }
    });
}

// -----------------------------------------------------------------------------------------------------------
// Calcula força da senha ------------------------------------------------------------------------------------
if (val_password) {
    password.addEventListener("input", function (e) {
        let strengthPass = 0;
        if (/^(?=(?:.*[A-Z]){2,}).*$/.test(password.value)) {
            strengthPass += 2;
        }
        if (/^(?=(?:.*[a-z]){2,}).*$/.test(password.value)) {
            strengthPass += 2;
        }
        if (/^(?=(?:.*\d){2,}).*$/.test(password.value)) {
            strengthPass += 2;
        }
        if (/^(?=(?:.*[^a-zA-Z0-9]){2,}).*$/.test(password.value)) {
            strengthPass += 2;
        }
        var newPass = strengthPass;

        if (newPass == 2) {
            e.preventDefault();
            msgPass.innerHTML = "<p style='color: red;'>Senha muito fraca!</p>";
        } else if (newPass == 4) {
            e.preventDefault();
            msgPass.innerHTML = "<p style='color: orange;'>Senha fraca!</p>";
        } else if (newPass == 6) {
            e.preventDefault();
            msgPass.innerHTML = "<p style='color: yellow;'>Senha média!</p>";
        } else if (newPass >= 8) {
            msgPass.innerHTML = "<p style='color: green;'>Senha boa!</p>";
        } else if (password.value == "") {
            msgPass.innerHTML = "";
        }
    });
}
// -----------------------------------------------------------------------------------------------------------
// Valida se preencheu os dados do formulário para editar senha e se os dois campos combinam.-----------------
if (formEditPass) {
    formEditPass.addEventListener("submit", function (e) {
        if (password.value == "") {
            e.preventDefault();
            msg.innerHTML = "<p style='color: red;'>Informe a nova SENHA!</p>";
        } else if (val_password.value == "") {
            e.preventDefault();
            msg.innerHTML = "<p style='color: red;'>Confirme-a</p>";
        } else if (val_password.value != password.value) {
            e.preventDefault();
            msg.innerHTML = "<p style='color: red;'>Senha deve combinar!</p>";
        } else {
            msg.innerHTML = "";
        }
    })
}
// -----------------------------------------------------------------------------------------------------------
// Valida se preencheu os campos do formulário para criar usuário, se as senhas combinam, calcula a força da senha e aplica a máscara no campo do CPF.
if (formRegister) {
    formRegister.addEventListener("submit", function (e) {
        if (name.value == "") {
            e.preventDefault();
            msg.innerHTML = "<p style='color: red'>Preencha o nome!</p>";
        } else if (cpf.value == "") {
            e.preventDefault();
            msg.innerHTML = "<p style='color: red'>Preencha o CPF!</p>";
        } else if (gender.value == 'Selecione:') {
            e.preventDefault();
            msg.innerHTML = "<p style='color: red'>Selecione o gênero!</p>";
        } else if (date_birth.value == "") {
            e.preventDefault();
            msg.innerHTML = "<p style='color: red'>Preencha a Data de Nascimento!</p>";
        } else if (telephone.value == "") {
            e.preventDefault();
            msg.innerHTML = "<p style='color: red'>Preencha o telefone!</p>";
        } else if (email.value == "") {
            e.preventDefault();
            msg.innerHTML = "<p style='color: red'>Preencha o e-mail!</p>";
        } else if (password.value == "") {
            e.preventDefault();
            msg.innerHTML = "<p style='color: red'>Preencha a senha!</p>";
        } else if (val_password.value == "") {
            e.preventDefault();
            msg.innerHTML = "<p style='color: red'>Confirme a senha!</p>";
        } else if (val_password.value != password.value) {
            e.preventDefault();
            msg.innerHTML = "<p style='color: red;'>Senha deve combinar!</p>";
        } else {
            msg.innerHTML = "";
        }
    })
}
// -----------------------------------------------------------------------------------------------------------
// Valida se preencheu todos os campos do formulário login.
if (formLogin) {
    formLogin.addEventListener('submit', function (e) {
        if (cpf.value == "") {
            e.preventDefault();
            msg.innerHTML = "<p style='color: red;'>Preencha o CPF!</p>";
        } else if (password.value == "") {
            e.preventDefault();
            msg.innerHTML = "<p style='color: red;'>Preencha a senha!</p>";
        } else {
            msg.innerHTML = "";
        }
    })
}
// -----------------------------------------------------------------------------------------------------------
// Valida se preencheu todos os campos do formulário para adicionar nível de acesso.
if (formAddLevelAccess) {
    formAddLevelAccess.addEventListener('submit', function (e) {
        if (name.value == "") {
            e.preventDefault();
            msg.innerHTML = "<p style='color: red;'>Preencha o nome do Nível de Acesso!</p>";
        } else {
            msg.innerHTML = "";
        }
    })
}
// -----------------------------------------------------------------------------------------------------------
// Valida se preencheu todos os campos do formulário para editar nível de acesso.
if (formEditLevelAccess) {
    formEditLevelAccess.addEventListener('submit', function (e) {
        if (name.value == "") {
            e.preventDefault();
            msg.innerHTML = "<p style='color: red;'>Preencha o nome do Nível de Acesso!</p>";
        } else {
            msg.innerHTML = "";
        }
    })
}
// -----------------------------------------------------------------------------------------------------------
// Valida se preencheu todos os campos do formulário para editar usuário.
if (formEditUser) {
    formEditUser.addEventListener('submit', function (e) {
        if (name.value == "") {
            e.preventDefault();
            msg.innerHTML = "<p style='color: red;'>Informe o nome!</p>";
        } else if (gender.value == "Selecione:") {
            e.preventDefault();
            msg.innerHTML = "<p style='color: red;'>Selecione o gênero!</p>";
        } else if (date_birth.value == "") {
            e.preventDefault();
            msg.innerHTML = "<p style='color: red;'>Informe a Data de Nascimento!</p>";
        } else if (telephone.value == "") {
            e.preventDefault();
            msg.innerHTML = "<p style='color: red;'>Informe o telefone!</p>";
        } else if (email.value == "") {
            e.preventDefault();
            msg.innerHTML = "<p style='color: red;'>Informe o e-mail!</p>";
        } else {
            msg.innerHTML = "";
        }
    })
}
// -----------------------------------------------------------------------------------------------------------