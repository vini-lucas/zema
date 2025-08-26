<?php

namespace Sts\Models;

/**
 * Caso o usuário tente acessar a página sem ser pelo arquivo index, acessa este if.
 */
if (!defined('L4bar3tTA!')) {
    header("Location: /");
}

/**
 * Models da controller register.
 */
class StsRegister
{
    private array|null $dataForm; // -> Recebe os dados que que a controller enviou.
    private bool $result; // -> Recebe o resultado da QUERY solicitada em 'login()'. 
    private string $firstName = ""; // -> Recebe o primeiro nome do usuário.
    private array $emailData = []; // -> Recebe os dados do e-mail que foi cadastrado.

    public function getResult(): bool
    {
        return $this->result;
    }

    public function validadeCpf(array $dataForm)
    {
        $this->dataForm = $dataForm;
        $valCpf = new \Sts\Models\helper\StsRead();
        $valCpf->fullRead("SELECT cpf FROM sts_users WHERE cpf=:cpf", "cpf={$this->dataForm['cpf']}");
        if ($valCpf->getResultDb() == null) {
            $this->createUser();
        } else {
            $_SESSION['msg'] = MSG_CPF_TRUE_CAD;
            $this->result = false;
        }
    }

    private function createUser()
    {
        $createUser = new \Sts\Models\helper\StsCreate();
        $createUser->exeCreate("sts_users", $this->dataForm);
        if ($createUser->getResult()) {
            $this->sendEmail();
        } else {
            if (isset($_SESSION['msg-helper'])) {
                $this->result = false;
            } else {
                $_SESSION['msg'] = MSG_ALT_NOT_PERF_SUCCESS;
                $this->result = false;
            }
        }
    }

    private function sendEmail()
    {
        $this->contentEmailHtml();
        $this->contentEmailText();
        $sendEmail = new \Sts\Models\helper\StsSendEmail();
        $sendEmail->sendEmail($this->emailData);

        if ($sendEmail->getResult()) {
            $_SESSION['msg'] = MSG_USER_CREATED_SUCCESS;
            $this->result = true;
        } else {
            $_SESSION['msg'] = MSG_USER_CREATED_SUCCESS_NOT_EMAIL;
            $this->result = false;
        }
    }

    private function contentEmailHtml()
    {
        $name = explode(" ", $this->dataForm['name']);
        $this->firstName = $name[0];

        $this->emailData['toEmail'] = $this->dataForm['email'];
        $this->emailData['toName'] = $this->dataForm['name'];
        $this->emailData['subject'] = "Confirmar E-mail";

        $this->emailData['contentHtml'] = "Prezado(a) Sr(a). {$this->firstName},<br><br>";
        $this->emailData['contentHtml'] .= "Transbordamos de satisfação com a sua solicitação de cadastro em nossa plataforma!<br>";
        $this->emailData['contentHtml'] .= "A fim de prosseguirmos com seu requerimento, solicitamos a gentileza de vossa confirmação junto ao link abaixo:<br><br>";
        $this->emailData['contentHtml'] .= '<a href="' . URL . 'conf-email/index?key=' . $this->dataForm['conf_email'] . '">Confirmar E-mail</a>';
        $this->emailData['contentHtml'] .= "<br><h3 style='color: red'>Atenção:</h3>";
        $this->emailData['contentHtml'] .= "Isto é uma mensagem automática, não responda-a!<br>";
        $this->emailData['contentHtml'] .= "Ela foi enviada à você pela empresa Zema Financeira, nenhum e-mail encaminhado pela mesma possui arquivos anexados ou solicita o preenchimento de senhas e informações cadastrais!<br><br>";
        $this->emailData['contentHtml'] .= "Atenciosamente,<br>";
        $this->emailData['contentHtml'] .= "Zema Financeira.";
    }

    private function contentEmailText()
    {
        $name = explode(" ", $this->dataForm['name']);
        $this->firstName = $name[0];

        $this->emailData['toEmail'] = $this->dataForm['email'];
        $this->emailData['toName']  = $this->dataForm['name'];
        $this->emailData['subject'] = "Confirmar E-mail";

        $this->emailData['contentText']  = "Prezado(a) Sr(a). {$this->firstName},\n\n\n\n";
        $this->emailData['contentText'] .= "Transbordamos de satisfação com a sua solicitação de cadastro em nossa plataforma!\n\n";
        $this->emailData['contentText'] .= "A fim de prosseguirmos com seu requerimento, solicitamos a gentileza de vossa confirmação junto ao link abaixo:\n\n";
        $this->emailData['contentText'] .= URL . 'conf-email/index?key=' . $this->dataForm['conf_email'];
        $this->emailData['contentText'] .= "\n\n\n\nAtenção:\n\n";
        $this->emailData['contentText'] .= "Isto é uma mensagem automática, não responda-a!\n\n";
        $this->emailData['contentText'] .= "Ela foi enviada à você pela empresa Zema Financeira, nenhum e-mail encaminhado pela mesma possui arquivos anexados ou solicita o preenchimento de senhas e informações cadastrais!\n\n\n\n";
        $this->emailData['contentText'] .= "Atenciosamente,\n\n";
        $this->emailData['contentText'] .= "Zema Financeira.";
    }
}
