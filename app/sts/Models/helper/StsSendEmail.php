<?php

namespace Sts\Models\helper;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'path/to/PHPMailer/src/Exception.php';
require 'path/to/PHPMailer/src/PHPMailer.php';
require 'path/to/PHPMailer/src/SMTP.php';

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
    private array $data; // Recebe as informações do conteúdo do e-mail.
    private array $dataInfoEmail; // -> Recebe as credencias do e-mail.
    private string $fromEmail; // -> Recebe o e-mail do remetente.

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
    public function sendEmail(): void
    {
        $this->dataInfoEmail['host'] = "sandbox.smtp.mailtrap.io"; // -> Local do servidor.
        $this->dataInfoEmail['fromEmail'] = "atendimento@zema.com"; // -> E-mail de quem está enviando.
        $this->fromEmail = $this->dataInfoEmail['fromEmail'];
        $this->dataInfoEmail['fromName'] = "Zema"; // -> Nome de quem está enviando.
        $this->dataInfoEmail['username'] = "8ac29ca061a315"; // -> Usuário do servidor.
        $this->dataInfoEmail['password'] = "****94c8"; // -> Senha do usuário do servidor.
        $this->dataInfoEmail['port'] = 2525; // -> Porta do servidor.

        $this->data['toEmail'] = "lucasvini269@gmail.com";
        $this->data['toName'] = "Lucas";
        $this->data['subject'] = "Confirmar E-mail";
        $this->data['contentHtml'] = "Olá, <b>Lucas</b>!<p>Seu cadastro foi realizado com sucesso!</p>";
        $this->data['contentText'] = "Olá, Lucas!\n\nSeu cadastro foi realizado com sucesso!</p>";
        $this->sendEmailPhpMailer();
    }

    /**
     * Função para enviar e-mails utilizando a bibliteca PHP Mailer.
     * @return void
     */
    private function sendEmailPhpMailer(): void
    {
        $mail = new PHPMailer(true);
        $mail->SMTPDebug  = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host       = $this->dataInfoEmail['host'];
        $mail->SMTPAuth   = true;
        $mail->Username   = $this->dataInfoEmail['username'];
        $mail->Password   = $this->dataInfoEmail['password'];
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = $this->dataInfoEmail['port'];

        $mail->setFrom($this->dataInfoEmail['fromEmail'], 'Mailer');
        $mail->addAddress('joe@example.net', 'Joe User');     //Add a recipient
        $mail->addAddress('ellen@example.com');               //Name is optional
        $mail->addReplyTo('info@example.com', 'Information');
        $mail->addCC('cc@example.com');
        $mail->addBCC('bcc@example.com');
    }
}
