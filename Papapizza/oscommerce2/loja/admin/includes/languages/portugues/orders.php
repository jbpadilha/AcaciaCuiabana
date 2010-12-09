<?php
/*
  $Id: orders.php 1739 2007-12-20 00:52:16Z hpdl $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Pedidos');
define('HEADING_TITLE_SEARCH', 'Número do Pedido:');
define('HEADING_TITLE_STATUS', 'Status:');

define('TABLE_HEADING_COMMENTS', 'Comentários');
define('TABLE_HEADING_CUSTOMERS', 'Clientes');
define('TABLE_HEADING_ORDER_TOTAL', 'Total do Pedido');
define('TABLE_HEADING_DATE_PURCHASED', 'Data de Compra');
define('TABLE_HEADING_STATUS', 'Status');
define('TABLE_HEADING_ACTION', 'Ação');
define('TABLE_HEADING_QUANTITY', 'Qtde.');
define('TABLE_HEADING_PRODUCTS_MODEL', 'Modelo');
define('TABLE_HEADING_PRODUCTS', 'Produtos');
define('TABLE_HEADING_TAX', 'Impostos');
define('TABLE_HEADING_TOTAL', 'Total');
define('TABLE_HEADING_PRICE_EXCLUDING_TAX', 'Preço (ex)');
define('TABLE_HEADING_PRICE_INCLUDING_TAX', 'Preço (inc)');
define('TABLE_HEADING_TOTAL_EXCLUDING_TAX', 'Total (ex)');
define('TABLE_HEADING_TOTAL_INCLUDING_TAX', 'Total (inc)');

define('TABLE_HEADING_CUSTOMER_NOTIFIED', 'Cliente Informado');
define('TABLE_HEADING_DATE_ADDED', 'Adicionado Em');

define('ENTRY_CUSTOMER', 'Cliente:');
define('ENTRY_SOLD_TO', 'VENDIDO PARA:');
define('ENTRY_DELIVERY_TO', 'Entregue Para:');
define('ENTRY_SHIP_TO', 'ENVIADO PARA:');
define('ENTRY_SHIPPING_ADDRESS', 'Endereço de Envio:');
define('ENTRY_BILLING_ADDRESS', 'Endereço de Cobrança:');
define('ENTRY_PAYMENT_METHOD', 'Forma de Pagamento:');
define('ENTRY_CREDIT_CARD_TYPE', 'Tipo do Cartão de Crédito:');
define('ENTRY_CREDIT_CARD_OWNER', 'Proprietário do Cartão:');
define('ENTRY_CREDIT_CARD_NUMBER', 'Número do Cartão de Crédito:');
define('ENTRY_CREDIT_CARD_EXPIRES', 'Validade do Cartão de Crédito:');
define('ENTRY_SUB_TOTAL', 'Sub-Total:');
define('ENTRY_TAX', 'Impostos:');
define('ENTRY_SHIPPING', 'Entrega:');
define('ENTRY_TOTAL', 'Total:');
define('ENTRY_DATE_PURCHASED', 'Data da Compra:');
define('ENTRY_STATUS', 'Status:');
define('ENTRY_DATE_LAST_UPDATED', 'Última Atualização:');
define('ENTRY_NOTIFY_CUSTOMER', 'Avisar ao Cliente:');
define('ENTRY_NOTIFY_COMMENTS', 'Adicionar Comentários:');
define('ENTRY_PRINTABLE', 'Imprimir Fatura');

define('TEXT_INFO_HEADING_DELETE_ORDER', 'Eliminar Pedido');
define('TEXT_INFO_DELETE_INTRO', 'Tem certeza que quer eliminar este pedido?');
define('TEXT_INFO_RESTOCK_PRODUCT_QUANTITY', 'Re-estocar a quantidade do produto');
define('TEXT_DATE_ORDER_CREATED', 'Criado Em:');
define('TEXT_DATE_ORDER_LAST_MODIFIED', 'Atualizado Em:');
define('TEXT_INFO_PAYMENT_METHOD', 'Forma de Pagamento:');

define('TEXT_ALL_ORDERS', 'Todos os Pedidos');
define('TEXT_NO_ORDER_HISTORY', 'Nenhum histórico de pedidos disponível');

define('EMAIL_SEPARATOR', '------------------------------------------------------');
define('EMAIL_TEXT_SUBJECT', 'Atualização do Pedido');
define('EMAIL_TEXT_ORDER_NUMBER', 'Número do Pedido:');
define('EMAIL_TEXT_INVOICE_URL', 'Fatura:');
define('EMAIL_TEXT_DATE_ORDERED', 'Data do Pedido:');
define('EMAIL_TEXT_STATUS_UPDATE', 'Seu pedido foi atualizado para o seguinte status.' . "\n\n" . 'Nova Condição: %s' . "\n\n" . 'Se tiver algum questionamento, basta responder a este e-mail.' . "\n");
define('EMAIL_TEXT_COMMENTS_UPDATE', 'Os comentários para o seu pedido são' . "\n\n%s\n\n");

define('ERROR_ORDER_DOES_NOT_EXIST', 'Erro: Pedido Inexistente.');
define('SUCCESS_ORDER_UPDATED', 'Sucesso: Pedido Atualizado.');
define('WARNING_ORDER_NOT_UPDATED', 'Atenção: Nada a Fazer. O pedido não foi alterado.');
?>
