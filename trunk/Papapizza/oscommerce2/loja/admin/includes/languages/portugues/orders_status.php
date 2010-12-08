<?php
/*
  $Id: orders_status.php 1739 2007-12-20 00:52:16Z hpdl $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2007 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Status do Pedido');

define('TABLE_HEADING_ORDERS_STATUS', 'Status do Pedido');
define('TABLE_HEADING_PUBLIC_STATUS', 'Status do Público');
define('TABLE_HEADING_DOWNLOADS_STATUS', 'Status do Downloads');
define('TABLE_HEADING_ACTION', 'Ação');

define('TEXT_INFO_EDIT_INTRO', 'Por favor faça as alterações necessárias');
define('TEXT_INFO_ORDERS_STATUS_NAME', 'Status do Pedido:');
define('TEXT_INFO_INSERT_INTRO', 'Por favor insira o novo status do pedido e as informaçõe srelacionadas');
define('TEXT_INFO_DELETE_INTRO', 'Tem certeza que quer eliminar este status de pedido?');
define('TEXT_INFO_HEADING_NEW_ORDERS_STATUS', 'Novo Status de Pedido');
define('TEXT_INFO_HEADING_EDIT_ORDERS_STATUS', 'Editar Status de Pedido');
define('TEXT_INFO_HEADING_DELETE_ORDERS_STATUS', 'Apagar Status de Pedido');

define('TEXT_SET_PUBLIC_STATUS', 'Mostrar status do pedido para o cliente');
define('TEXT_SET_DOWNLOADS_STATUS', 'Permitir downloads de produtos virtuais nesse nivél de status');

define('ERROR_REMOVE_DEFAULT_ORDER_STATUS', 'Erro: O Status de pedido padrão não pode ser removido.Selecione outro status de pedido como padrão e tente novamente.');
define('ERROR_STATUS_USED_IN_ORDERS', 'Erro: Este status está em uso em vários pedidos.');
define('ERROR_STATUS_USED_IN_HISTORY', 'Erro: Este status está em uso no histórico de status de pedidos.');
?>
