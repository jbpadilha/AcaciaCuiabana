<?php
/*
  $Id: advanced_search.php 1739 2007-12-20 00:52:16Z hpdl $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

define('NAVBAR_TITLE_1', 'Busca Avançada');
define('NAVBAR_TITLE_2', 'Resultados da Busca Avançada');

define('HEADING_TITLE_1', 'Busca Avançada');
define('HEADING_TITLE_2', 'Produtos que satisfazem os critérios de sua busca');

define('HEADING_SEARCH_CRITERIA', 'Busca Avançada');

define('TEXT_SEARCH_IN_DESCRIPTION', 'Pesquisar também na descrição dos produtos');
define('ENTRY_CATEGORIES', 'Categorias:');
define('ENTRY_INCLUDE_SUBCATEGORIES', 'Incluir Sub-categorias');
define('ENTRY_MANUFACTURERS', 'Fabricante:');
define('ENTRY_PRICE_FROM', 'Preço Mínimo:');
define('ENTRY_PRICE_TO', 'Preço Máximo:');
define('ENTRY_DATE_FROM', 'Desta Data:');
define('ENTRY_DATE_TO', 'Até Está Data:');

define('TEXT_SEARCH_HELP_LINK', '<u>Ajuda</u> [?]');

define('TEXT_ALL_CATEGORIES', 'Todas');
define('TEXT_ALL_MANUFACTURERS', 'Todos');

define('HEADING_SEARCH_HELP', 'Dicas de pesquisa avançada');
define('TEXT_SEARCH_HELP', 'O motor de busca permite que você faça uma pesquisa por palavras-chave no modelo, nome, descrição e fabricante dos produtos.<br><br>Quando você fizer uma pesquisa por palavras-chave ou frases, pode separá-las com operadores lógicos AND e OR. Por exemplo: pode fazer uma busca por <u>microsoft AND mouse</u>. Esta busca daria como resultado os produtos que carregam ambas as palavras. Já a pesquisa usando  <u>microsoft OR mouse</u>, mostrará como resultado qualquer produto que contenha apenas uma das palavras. Se você não separar as palavras por padrão a pesquisa será feita utilizando o operador lógico AND, <br><br>Você pode pesquisar palavras exatas entre aspas. Por exemplo, buscar <u>"computador intel"</u>, procura nos produtos a correspondência exata da busca.<br><br>Você pode utilizar parêntesis para controlar a ordem das operaçãoes lógicas. Por exemplo: Pode introduzir <u>microsoft and (teclado or mouse or "visual basic")</u>.');
define('TEXT_CLOSE_WINDOW', '<u>Fechar Janela</u> [x]');

define('TABLE_HEADING_IMAGE', '');
define('TABLE_HEADING_MODEL', 'Modelo');
define('TABLE_HEADING_PRODUCTS', 'Descrição');
define('TABLE_HEADING_MANUFACTURER', 'Fabricante');
define('TABLE_HEADING_QUANTITY', 'Unidades');
define('TABLE_HEADING_PRICE', 'Preço');
define('TABLE_HEADING_WEIGHT', 'Peso');
define('TABLE_HEADING_BUY_NOW', 'Compre Agora');

define('TEXT_NO_PRODUCTS', 'Não há nenhum produto que corresponda aos critérios de pesquisa.');

define('ERROR_AT_LEAST_ONE_INPUT', 'Utilize pelo menos um critério para a pesquisa');
define('ERROR_INVALID_FROM_DATE', 'Data de Início inválida');
define('ERROR_INVALID_TO_DATE', 'Data Final Inválida');
define('ERROR_TO_DATE_LESS_THAN_FROM_DATE', 'a data final deve ser maior que a data inicial');
define('ERROR_PRICE_FROM_MUST_BE_NUM', 'O preço minímo deve ser numérico');
define('ERROR_PRICE_TO_MUST_BE_NUM', 'O preço máximo deve ser numérico');
define('ERROR_PRICE_TO_LESS_THAN_PRICE_FROM', 'Preço máximo deve ser igual ou superior ao Preço Mínimo');
define('ERROR_INVALID_KEYWORDS', 'Palavra-Chave Inválida');
?>
