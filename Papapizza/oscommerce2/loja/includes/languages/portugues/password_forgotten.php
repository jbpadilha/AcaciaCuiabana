<?php
/*
  $Id: password_forgotten.php 1739 2007-12-20 00:52:16Z hpdl $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

define('NAVBAR_TITLE_1', 'Entrar');
define('NAVBAR_TITLE_2', 'Senha Esquecida');

define('HEADING_TITLE', 'Eu perdi minha senha!');

define('TEXT_MAIN', 'Se você esqueceu sua senha, digite seu e-mail e nós lhe enviaremos uma mensagem com uma nova senha.');

define('TEXT_NO_EMAIL_ADDRESS_FOUND', 'Erro: Esse E-Mail não consta em nossos dados, tente de novamente.');

define('EMAIL_PASSWORD_REMINDER_SUBJECT', STORE_NAME . ' - Nova Senha');
define('EMAIL_PASSWORD_REMINDER_BODY', 'Uma nova senha foi solicitada a' . $REMOTE_ADDR . '.' . "\n\n" . 'Sua nova senha para \'' . STORE_NAME . '\' é:' . "\n\n" . '   %s' . "\n\n");

define('SUCCESS_PASSWORD_SENT', 'Sucesso! Uma nova senha foi enviada para o seu endereço de e-mail.');
?>
