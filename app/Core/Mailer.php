<?php

namespace App\Core;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/**
 * Classe responsável pelo envio de e-mails.
 * Depende do PHPMailer: composer require phpmailer/phpmailer
 * As credenciais ficam em config/mail.php
 */
class Mailer
{
    private array $config;

    public function __construct()
    {
        $this->config = require __DIR__ . '/../../config/mail.php';
    }

    /**
     * Envia um e-mail HTML.
     * Retorna true em caso de sucesso e false em caso de falha.
     */
    public function send(string $to, string $subject, string $htmlBody, ?string $altBody = null): bool
    {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host       = $this->config['host'];
            $mail->SMTPAuth   = true;
            $mail->Username   = $this->config['username'];
            $mail->Password   = $this->config['password'];
            $mail->SMTPSecure = $this->config['encryption']; // 'tls' ou 'ssl'
            $mail->Port       = $this->config['port'];
            $mail->CharSet    = 'UTF-8';

            $mail->setFrom($this->config['from_email'], $this->config['from_name']);
            $mail->addAddress($to);

            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $htmlBody;
            $mail->AltBody = $altBody ?? strip_tags($htmlBody);

            $mail->send();
            return true;
        } catch (Exception $e) {
            // Não exponha o erro ao usuário; registre no log do PHP
            error_log('Erro ao enviar e-mail: ' . $mail->ErrorInfo);
            return false;
        }
    }

    /**
     * E-mail pronto para redefinição de senha.
     */
    public function sendPasswordReset(string $to, string $link): bool
    {
        $subject = 'Redefinição de senha - Championship Manager';

        $body = '
            <div style="font-family: Arial, sans-serif; max-width: 480px; margin: 0 auto;">
                <h2>Redefinição de senha</h2>
                <p>Recebemos um pedido para redefinir a senha da sua conta.</p>
                <p>
                    <a href="' . htmlspecialchars($link, ENT_QUOTES, 'UTF-8') . '"
                       style="display:inline-block;padding:12px 20px;background:#0d6efd;color:#fff;
                              text-decoration:none;border-radius:6px;">
                        Criar nova senha
                    </a>
                </p>
                <p>Este link vale por <strong>1 hora</strong> e só pode ser usado uma vez.</p>
                <p style="color:#666;font-size:13px;">
                    Se você não fez esse pedido, ignore este e-mail. Sua senha continuará a mesma.
                </p>
            </div>
        ';

        return $this->send($to, $subject, $body);
    }
}