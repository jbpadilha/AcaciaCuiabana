<?php
/*
  $Id: categories.php 1739 2007-12-20 00:52:16Z hpdl $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Categorias / Produtos');
define('HEADING_TITLE_SEARCH', 'Buscar:');
define('HEADING_TITLE_GOTO', 'Ir A:');

define('TABLE_HEADING_ID', 'ID');
define('TABLE_HEADING_CATEGORIES_PRODUCTS', 'Categorias / Produtos');
define('TABLE_HEADING_ACTION', 'Ação');
define('TABLE_HEADING_STATUS', 'Status');

define('TEXT_NEW_PRODUCT', 'Novo Produto em &quot;%s&quot;');
define('TEXT_CATEGORIES', 'Categorias:');
define('TEXT_SUBCATEGORIES', 'Sub-categorias:');
define('TEXT_PRODUCTS', 'Produtos:');
define('TEXT_PRODUCTS_PRICE_INFO', 'Preço:');
define('TEXT_PRODUCTS_TAX_CLASS', 'Tipo de Taxa:');
define('TEXT_PRODUCTS_AVERAGE_RATING', 'Média das Avaliações:');
define('TEXT_PRODUCTS_QUANTITY_INFO', 'Quantidade:');
define('TEXT_DATE_ADDED', 'Adicionado:');
define('TEXT_DATE_AVAILABLE', 'Data disponível:');
define('TEXT_LAST_MODIFIED', 'Modificado em:');
define('TEXT_IMAGE_NONEXISTENT', 'NÃO EXISTE IMAGEM');
define('TEXT_NO_CHILD_CATEGORIES_OR_PRODUCTS', 'Insirar uma nova categoria de produto.');
define('TEXT_PRODUCT_MORE_INFORMATION', 'Ser desejar mais informações visite a <a href="http://%s" target="blank"><u>página</u></a> deste produto.');
define('TEXT_PRODUCT_DATE_ADDED', 'Este produto foi adicionado em %s.');
define('TEXT_PRODUCT_DATE_AVAILABLE', 'Este produto está disponível em %s.');

define('TEXT_EDIT_INTRO', 'Faça as alterações necessárias');
define('TEXT_EDIT_CATEGORIES_ID', 'ID da Categoria:');
define('TEXT_EDIT_CATEGORIES_NAME', 'Nome da Categoria:');
define('TEXT_EDIT_CATEGORIES_IMAGE', 'Imagem da Categoria:');
define('TEXT_EDIT_SORT_ORDER', 'Ordenamento:');

define('TEXT_INFO_COPY_TO_INTRO', 'Escolhe a categoria de onde você deseja copiar este produto');
define('TEXT_INFO_CURRENT_CATEGORIES', 'Categorias:');

define('TEXT_INFO_HEADING_NEW_CATEGORY', 'Nova Categoria');
define('TEXT_INFO_HEADING_EDIT_CATEGORY', 'Editar Categoria');
define('TEXT_INFO_HEADING_DELETE_CATEGORY', 'Apagar Categoria');
define('TEXT_INFO_HEADING_MOVE_CATEGORY', 'Mover Categoria');
define('TEXT_INFO_HEADING_DELETE_PRODUCT', 'Apagar Produto');
define('TEXT_INFO_HEADING_MOVE_PRODUCT', 'Mover Produto');
define('TEXT_INFO_HEADING_COPY_TO', 'Copiar A');

define('TEXT_DELETE_CATEGORY_INTRO', 'Tem certeza que deseja apagar esta categoria?');
define('TEXT_DELETE_PRODUCT_INTRO', 'Tem certeza que deseja apagar este produto?');

define('TEXT_DELETE_WARNING_CHILDS', '<b>ADVERTÊNCIA:</b> Existem %s categorias dentro desta categoria!');
define('TEXT_DELETE_WARNING_PRODUCTS', '<b>ADVERTÊNCIA:</b> Existem %s produtos dentro desta categoria!');

define('TEXT_MOVE_PRODUCTS_INTRO', 'Selecione a categoria que você desejar <b>%s</b>');
define('TEXT_MOVE_CATEGORIES_INTRO', 'Selecione a categoria que você desejar <b>%s</b>');
define('TEXT_MOVE', 'Mover <b>%s</b> a:');

define('TEXT_NEW_CATEGORY_INTRO', 'Complete a seguinte informação para a nova categoria');
define('TEXT_CATEGORIES_NAME', 'Nome da Categoria:');
define('TEXT_CATEGORIES_IMAGE', 'Imagem da Categoria:');
define('TEXT_SORT_ORDER', 'Ordem:');

define('TEXT_PRODUCTS_STATUS', 'Status dos Produtos:');
define('TEXT_PRODUCTS_DATE_AVAILABLE', 'Data disponível:');
define('TEXT_PRODUCT_AVAILABLE', 'Disponível');
define('TEXT_PRODUCT_NOT_AVAILABLE', 'Esgotado');
define('TEXT_PRODUCTS_MANUFACTURER', 'Fabricante do produto:');
define('TEXT_PRODUCTS_NAME', 'Nome do Produto:');
define('TEXT_PRODUCTS_DESCRIPTION', 'Descrição do produto:');
define('TEXT_PRODUCTS_QUANTITY', 'Quantidade:');
define('TEXT_PRODUCTS_MODEL', 'Modelo:');
define('TEXT_PRODUCTS_IMAGE', 'Imagem:');
define('TEXT_PRODUCTS_URL', 'URL do Produto:');
define('TEXT_PRODUCTS_URL_WITHOUT_HTTP', '<small>(sem http://)</small>');
define('TEXT_PRODUCTS_PRICE_NET', 'Preço dos Produtos (Líquido):');
define('TEXT_PRODUCTS_PRICE_GROSS', 'Preço dos Produtos (Bruto):');
define('TEXT_PRODUCTS_WEIGHT', 'Peso:');

define('EMPTY_CATEGORY', 'Categoria Vazia');

define('TEXT_HOW_TO_COPY', 'Metódo de Copia:');
define('TEXT_COPY_AS_LINK', 'Copiar link produto');
define('TEXT_COPY_AS_DUPLICATE', 'Duplicar produto');

define('ERROR_CANNOT_LINK_TO_SAME_CATEGORY', 'Erro: Não é possível vincular os produtos na mesma categoria.');
define('ERROR_CATALOG_IMAGE_DIRECTORY_NOT_WRITEABLE', 'Erro:: Não foi possível salvar no diretório de imagens do catálogo ' . DIR_FS_CATALOG_IMAGES);
define('ERROR_CATALOG_IMAGE_DIRECTORY_DOES_NOT_EXIST', 'Erro: Não há imagens diretório catálogo: ' . DIR_FS_CATALOG_IMAGES);
define('ERROR_CANNOT_MOVE_CATEGORY_TO_PARENT', 'Erro: A categoria não pode ser movida para uma categoria filha.');
?>
