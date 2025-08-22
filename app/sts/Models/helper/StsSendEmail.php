<?php

namespace Sts\Models\helper;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

/*require 'path/to/PHPMailer/src/Exception.php';
require 'path/to/PHPMailer/src/PHPMailer.php';
require 'path/to/PHPMailer/src/SMTP.php';*/

/**
 * Caso o usuário tente acessar a página sem ser pelo arquivo index, acessa este if.
 */
if (!defined('L4bar3tTA!')) {
    header("Location: /");
}

/**
 * Helper responsável em enviar o e-mail de recuperação de acesso para o usuário.
 */
class StsSendEmail
{
    private bool $result; // -> Recebe o resultado do "getResult()".
    private array $data = []; // Recebe as informações do conteúdo do e-mail.
    private array $dataInfoEmail; // -> Recebe as credencias do e-mail.
    private string $fromEmail; // -> Recebe o e-mail do remetente.
    private array $resultDb; // -> Recebe o resultado da QUERY.

    /**
     * Recebe true se enviou com sucesso ou false se não preencheu.
     * @return boolean
     */
    public function getResult(): bool
    {
        return $this->result;
    }

    /**
     * Método responsável em enviar o e-mail.
     * @return void
     */
    public function sendEmail(array $dataForm): void
    {
        $this->data['toEmail'] = $dataForm['toEmail'];
        $this->data['toName'] = $dataForm['toName'];
        $this->data['subject'] = $dataForm['subject'];
        $this->data['contentHtml'] = $dataForm['contentHtml'];
        $this->data['contentText'] = $dataForm['contentText'];
        $this->infoPhpMailer();
    }

    private function infoPhpMailer(): void
    {
        $readEmail = new \Sts\Models\helper\StsRead();
        $readEmail->fullRead("SELECT name, email, host, username, password, smtpsecure, port FROM sts_confs_emails WHERE id=:id LIMIT :limit", "id=1&limit=1");
        if ($readEmail->getResultDb()) {
            $this->dataInfoEmail['host'] = $readEmail->getResultDb()[0]['host']; // -> Local do servidor.
            $this->dataInfoEmail['fromEmail'] = $readEmail->getResultDb()[0]['email']; // -> E-mail de quem está enviando.
            $this->fromEmail = $this->dataInfoEmail['fromEmail'];
            $this->dataInfoEmail['fromName'] = $readEmail->getResultDb()[0]['name']; // -> Nome de quem está enviando.
            $this->dataInfoEmail['username'] = $readEmail->getResultDb()[0]['username']; // -> Usuário do servidor.
            $this->dataInfoEmail['password'] = $readEmail->getResultDb()[0]['password']; // -> Senha do usuário do servidor.
            $this->dataInfoEmail['port'] = $readEmail->getResultDb()[0]['port']; // -> Porta do servidor.
            $this->dataInfoEmail['smtpsecure'] = $readEmail->getResultDb()[0]['smtpsecure'];
            $this->sendEmailPhpMailer();
        } else {
            $this->result = false;
        }
    }

    /**
     * Função para enviar e-mails utilizando a bibliteca PHP Mailer.
     * @return void
     */
    private function sendEmailPhpMailer(): void
    {
        $mail = new PHPMailer(true);
        try {
            //$mail->SMTPDebug  = SMTP::DEBUG_SERVER;
            $mail->CharSet = 'UTF-8';
            $mail->isSMTP();
            $mail->Host       = $this->dataInfoEmail['host'];
            $mail->SMTPAuth   = true;
            $mail->Username   = $this->dataInfoEmail['username'];
            $mail->Password   = $this->dataInfoEmail['password'];
            $mail->SMTPSecure = $this->dataInfoEmail['smtpsecure'];
            $mail->Port       = $this->dataInfoEmail['port'];

            $mail->setFrom($this->dataInfoEmail['fromEmail'], $this->dataInfoEmail['fromName']);
            $mail->addAddress($this->data['toEmail'], $this->data['toName']);

            $mail->isHTML(true);
            $mail->Subject = $this->data['subject'];
            $mail->Body    = $this->data['contentHtml'];
            $mail->AltBody = $this->data['contentText'];

            $mail->send();
            $this->result = true;
        } catch (Exception $err) {
            $this->result = false;
        }
    }
}
