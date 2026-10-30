<?php

/**
 * Configuração de e-mail (SMTP).
 * IMPORTANTE: não envie este arquivo para o Git (adicione config/mail.php ao .gitignore).
 *
 * Gmail: ative a verificação em duas etapas e gere uma "Senha de app"
 * em https://myaccount.google.com/apppasswords e use ela em 'password'.
 */
return [
    'host'       => 'smtp.gmail.com',
    'port'       => 587,
    'encryption' => 'tls',
    'username'   => 'arturassisrf0@gmail.com',
    'password'   => 'vutsijlprwfiagjp',
    'from_email' => 'arturassisrf0@gmail.com',
    'from_name'  => 'Championship Manager',
];