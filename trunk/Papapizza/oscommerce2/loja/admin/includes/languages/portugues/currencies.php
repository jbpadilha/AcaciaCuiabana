<?php
/*
  $Id: currencies.php 1739 2007-12-20 00:52:16Z hpdl $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Moedas');

define('TABLE_HEADING_CURRENCY_NAME', 'Moeda');
define('TABLE_HEADING_CURRENCY_CODES', 'Código');
define('TABLE_HEADING_CURRENCY_VALUE', 'Valor');
define('TABLE_HEADING_ACTION', 'Ação');

define('TEXT_INFO_EDIT_INTRO', 'Faça as mudanças necessárias');
define('TEXT_INFO_CURRENCY_TITLE', 'Titulo:');
define('TEXT_INFO_CURRENCY_CODE', 'Código:');
define('TEXT_INFO_CURRENCY_SYMBOL_LEFT', 'Simbolo da esquerda:');
define('TEXT_INFO_CURRENCY_SYMBOL_RIGHT', 'Simbolo da direita:');
define('TEXT_INFO_CURRENCY_DECIMAL_POINT', 'Ponto decimal:');
define('TEXT_INFO_CURRENCY_THOUSANDS_POINT', 'Separador de milhares:');
define('TEXT_INFO_CURRENCY_DECIMAL_PLACES', 'Casas decimais:');
define('TEXT_INFO_CURRENCY_LAST_UPDATED', 'Atualizado em:');
define('TEXT_INFO_CURRENCY_VALUE', 'Valor:');
define('TEXT_INFO_CURRENCY_EXAMPLE', 'Exemplo:');
define('TEXT_INFO_INSERT_INTRO', 'Insira os dados da nova moeda');
define('TEXT_INFO_DELETE_INTRO', 'Tem certeza que deseja apagar esta moeda?');
define('TEXT_INFO_HEADING_NEW_CURRENCY', 'Nova Moeda');
define('TEXT_INFO_HEADING_EDIT_CURRENCY', 'Editar Moeda');
define('TEXT_INFO_HEADING_DELETE_CURRENCY', 'Deletar Moeda');
define('TEXT_INFO_SET_AS_DEFAULT', TEXT_SET_DEFAULT . ' (requer atualização manual dos valores)');
define('TEXT_INFO_CURRENCY_UPDATED', 'A taxa de %s (%s) foi atualizada com sucesso para %s.');

define('ERROR_REMOVE_DEFAULT_CURRENCY', 'Erro: A moeda padrão não pode ser deletada. Por favor, defina outra moeda como padrão, e tente novamente.');
define('ERROR_CURRENCY_INVALID', 'Error: The exchange rate for %s (%s) was not updated via %s. Is it a valid currency code?');
define('WARNING_PRIMARY_SERVER_FAILED', 'Warning: The primary exchange rate server (%s) failed for %s (%s) - trying the secondary exchange rate server.');
?>
