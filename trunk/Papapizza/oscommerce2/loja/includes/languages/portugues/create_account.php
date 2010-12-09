<?php
/*
  $Id: create_account.php 1739 2007-12-20 00:52:16Z hpdl $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('NAVBAR_TITLE', 'Criar uma Conta');

define('HEADING_TITLE', 'Dados da Minha Conta');

define('TEXT_ORIGIN_LOGIN', '<font color="#FF0000"><small><b>NOTA:</b></font></small> Se você já possui uma conta por favor <a href="%s"><u>acesse-a</u></a>.');

define('EMAIL_SUBJECT', 'Bem Vindo à ' . STORE_NAME);
define('EMAIL_GREET_MR', 'Estimado ' . stripslashes($HTTP_POST_VARS['firstname']) . ',' . "\n\n");
define('EMAIL_GREET_MS', 'Estimada ' . stripslashes($HTTP_POST_VARS['firstname']) . ',' . "\n\n");
define('EMAIL_GREET_NONE', 'Estimado ' . stripslashes($HTTP_POST_VARS['firstname']) . ',' . "\n\n");
define('EMAIL_WELCOME', 'Bem Vindo à <b>' . STORE_NAME . '</b>.' . "\n\n");
define('EMAIL_TEXT', 'Agradecemos seu cadastro, agora você poderá desfrutar de uma forma melhor nossa loja. Alguns dos serviços que você dispõe:' . "\n\n" . '<li><b>Carrinho Permanente</b> - Qualquer produto adicionado ao seu carrinho permanecerá neste até que você o apague ou realize a compra.' . "\n" . '<li><b>Livro de Endereços</b> - Podemos entregar suas compras em outros endereços diferentes do seu. Isto é perfeito, por exemplo, para enviar o presente diretamente para a casa do aniversariante.' . "\n" . '<li><b>Histórico de Compras</b> - Veja a relação de todas suas compra realizadas em nossa loja.' . "\n" . '<li><b>Comentários</b> - Compartilhe sua opinião com outros clientes.' . "\n\n");
define('EMAIL_CONTACT', 'Para qualquer duvida sobre nossos serviços por favor envie um e-mail para: ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n\n");
define('EMAIL_WARNING', '<b>Nota:</b> seu endereço de e-mail foi dado a nós por um dos nossos clientes. Se seu email foi cadastrado sem sua autorização por favor nos comunique:  ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n");
?>
