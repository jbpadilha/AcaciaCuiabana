<?php
/*
  $Id: checkout_success.php 1739 2007-12-20 00:52:16Z hpdl $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('NAVBAR_TITLE_1', 'Pedido');
define('NAVBAR_TITLE_2', 'Realizado com Êxito');

define('HEADING_TITLE', 'Seu pedido foi processado com sucesso!');

define('TEXT_SUCCESS', 'Seu pedido foi realizado com êxito! Assim que seu pagamento for processado sua compra será enviada. O tempo de de entrega demorará de acordo com o metódo de envio escolhido.');
define('TEXT_NOTIFY_PRODUCTS', 'Por favor notifique-me de atualizações realizadas nos produtos:');
define('TEXT_SEE_ORDERS', 'Você pode ver seus pedido na página <a href="' . tep_href_link(FILENAME_ACCOUNT, '', 'SSL') . '">\'Sua Conta\'</a> e clicando sobre <a href="' . tep_href_link(FILENAME_ACCOUNT_HISTORY, '', 'SSL') . '">\'Histórico\'</a>.');
define('TEXT_CONTACT_STORE_OWNER', 'Dirija suas perguntas para nossa <a href="' . tep_href_link(FILENAME_CONTACT_US) . '">administração</a>.');
define('TEXT_THANKS_FOR_SHOPPING', 'Obrigado por Comprar Conosco!');

define('TABLE_HEADING_COMMENTS', 'Escreva um comentário sobre sua compra');

define('TABLE_HEADING_DOWNLOAD_DATE', 'Data de Vencimento: ');
define('TABLE_HEADING_DOWNLOAD_COUNT', ' downloads restantes');
define('HEADING_DOWNLOAD', 'Baixe seus produtos aqui:');
define('FOOTER_DOWNLOAD', 'Pode baixar seus produtos mais tarde em \'%s\'');
?>
