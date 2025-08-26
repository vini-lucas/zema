<?php

namespace Sts\Models;

/**
 * Caso o usuário tente acessar a página sem ser pelo arquivo index, acessa este if.
 */
if (!defined('L4bar3tTA!')) {
    header("Location: /");
}

/**
 * Models da controller RecPassword.
 */
class StsRecPassword
{
    private array|null $dataForm; // -> Recebe os dados que que a controller enviou.
    private bool $result; // -> Recebe o resultado da QUERY solicitada em 'login()'. 
    private array $emailData = []; // -> Recebe os dados do e-mail que foi cadastrado.
    private string $firstName = ""; // -> Recebe o primeiro nome do usuário.
    private array|null $dataDatabase;
    private array $data;

    public function getResult(): bool
    {
        return $this->result;
    }

    public function validateCpf(array $dataForm)
    {
        $this->dataForm = $dataForm;
        $valCpf = new \Sts\Models\helper\StsRead();
        $valCpf->fullRead("SELECT cpf, name, email, recover_password FROM sts_users WHERE cpf=:cpf", "cpf={$this->dataForm['cpf']}");
        if ($valCpf->getResultDb() == true) {
            $upPassword = new \Sts\Models\helper\StsUpdade();
            $this->data['recover_password'] = password_hash("1234", PASSWORD_DEFAULT);
            $upPassword->exeUpdate("sts_users", $this->data, "WHERE cpf=:cpf", "cpf={$valCpf->getResultDb()[0]['cpf']}");
            if ($upPassword->getResult()) {
                $this->dataDatabase = $valCpf->getResultDb();
                $this->dataDatabase[0]['recover_password'] = $this->dataDatabase[0]['recover_password'];
                //var_dump($this->dataDatabase);
                $this->sendEmail();
            } else {
                $_SESSION['msg'] = MSG_ERR_REC_PASS;
                $this->result = false;
            }
        } else {
            $_SESSION['msg'] = MSG_USER_NOT_ACCOUNT;
            $this->result = false;
        }
    }

    private function sendEmail()
    {
        $this->contentEmailHtml();
        $this->contentEmailText();
        $sendEmail = new \Sts\Models\helper\StsSendEmail();
        $sendEmail->sendEmail($this->emailData);

        if ($sendEmail->getResult()) {
            $_SESSION['msg'] = MSG_MSG_SEND_INST_REC_PASS;
            $this->result = true;
        } else {
            $_SESSION['msg'] = MSG_MSG_NOT_SEND_INST_REC_PASS;
            $this->result = false;
        }
    }

    private function contentEmailHtml()
    {
        $name = explode(" ", $this->dataDatabase[0]['name']);
        $this->firstName = $name[0];

        $this->emailData['toEmail'] = $this->dataDatabase[0]['email'];
        $this->emailData['toName'] = $this->dataDatabase[0]['name'];
        $this->emailData['subject'] = "Recuperar Acesso";

        $this->emailData['contentHtml'] = "Prezado(a) Sr(a). {$this->firstName},<br><br>";
        $this->emailData['contentHtml'] .= "Recebemos sua solicitação para recadastro de senha em nossa plataforma!<br>";
        $this->emailData['contentHtml'] .= "A fim de prosseguirmos com seu requerimento, solicitamos a gentileza de vossa confirmação junto ao link abaixo:<br><br>";
        $this->emailData['contentHtml'] .= '<a href="' . URL . 'new-password/index?key=' . $this->data['recover_password'] . '">Recuperar Acesso</a>';
        $this->emailData['contentHtml'] .= "<br><h3 style='color: red'>Atenção:</h3>";
        $this->emailData['contentHtml'] .= "Isto é uma mensagem automática, não responda-a!<br>";
        $this->emailData['contentHtml'] .= "Ela foi enviada à você pela empresa Zema Financeira, nenhum e-mail encaminhado pela mesma possui arquivos anexados ou solicita o preenchimento de senhas e informações cadastrais!<br><br>";
        $this->emailData['contentHtml'] .= "Atenciosamente,<br>";
        $this->emailData['contentHtml'] .= "Zema Financeira.";
    }

    private function contentEmailText()
    {
        $name = explode(" ", $this->dataDatabase[0]['name']);
        $this->firstName = $name[0];

        $this->emailData['toEmail'] = $this->dataDatabase[0]['email'];
        $this->emailData['toName']  = $this->dataDatabase[0]['name'];
        $this->emailData['subject'] = "Recuperar Acesso";

        $this->emailData['contentText']  = "Prezado(a) Sr(a). {$this->firstName},\n\n\n\n";
        $this->emailData['contentText'] .= "Recebemos sua solicitação para recadastro de senha em nossa plataforma!\n\n";
        $this->emailData['contentText'] .= "A fim de prosseguirmos com seu requerimento, solicitamos a gentileza de vossa confirmação junto ao link abaixo:\n\n";
        $this->emailData['contentText'] .= URL . 'new-password/index?key=' . $this->data['recover_password'];
        $this->emailData['contentText'] .= "\n\n\n\nAtenção:\n\n";
        $this->emailData['contentText'] .= "Isto é uma mensagem automática, não responda-a!\n\n";
        $this->emailData['contentText'] .= "Ela foi enviada à você pela empresa Zema Financeira, nenhum e-mail encaminhado pela mesma possui arquivos anexados ou solicita o preenchimento de senhas e informações cadastrais!\n\n\n\n";
        $this->emailData['contentText'] .= "Atenciosamente,\n\n";
        $this->emailData['contentText'] .= "Zema Financeira.";
    }
}
