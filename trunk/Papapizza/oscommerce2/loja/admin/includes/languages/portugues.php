<?php
/*
  $Id: portugues.php 1739 2007-12-20 00:52:16Z hpdl $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2007 osCommerce

  Released under the GNU General Public License
*/

// look in your $PATH_LOCALE/locale directory for available locales..
// on RedHat6.0 I used 'pt_BR'
// on FreeBSD 4.0 I use 'pt_BR.ISO_8859-1'
// this may not work under win32 environments..
setlocale(LC_TIME, 'pt_BR.ISO_8859-1');
define('DATE_FORMAT_SHORT', '%d/%m/%Y');  // this is used for strftime()
define('DATE_FORMAT_LONG', '%A %d %B, %Y'); // this is used for strftime()
define('DATE_FORMAT', 'd/m/Y');  // this is used for date()
define('PHP_DATE_TIME_FORMAT', 'd/m/Y H:i:s'); // this is used for date()
define('DATE_TIME_FORMAT', DATE_FORMAT_SHORT . ' %H:%M:%S');

////
// Return date in raw format
// $date should be in format mm/dd/yyyy
// raw date is in format YYYYMMDD, or DDMMYYYY
function tep_date_raw($date, $reverse = false) {
  if ($reverse) {
    return substr($date, 0, 2) . substr($date, 3, 2) . substr($date, 6, 4);
  } else {
    return substr($date, 6, 4) . substr($date, 3, 2) . substr($date, 0, 2);
  }
}

// Global entries for the <html> tag
define('HTML_PARAMS','dir="ltr" lang="br"');

// charset for web pages and emails
define('CHARSET', 'iso-8859-1');

// page title
define('TITLE', 'osCommerce Online Merchant Ferramentas Administrativas');

// header text in includes/header.php
define('HEADER_TITLE_TOP', 'Administração');
define('HEADER_TITLE_SUPPORT_SITE', 'Suporte');
define('HEADER_TITLE_ONLINE_CATALOG', 'Catálogo Online');
define('HEADER_TITLE_ADMINISTRATION', 'Administração');

// text for gender
define('MALE', 'Masculino');
define('FEMALE', 'Feminino');

// text for date of birth example
define('DOB_FORMAT_STRING', 'dd/mm/aaaa');

// configuration box text in includes/boxes/configuration.php
define('BOX_HEADING_CONFIGURATION', 'Configuração');
define('BOX_CONFIGURATION_MYSTORE', 'Minha Loja');
define('BOX_CONFIGURATION_LOGGING', 'Registro');
define('BOX_CONFIGURATION_CACHE', 'Cache');
define('BOX_CONFIGURATION_ADMINISTRATORS', 'Administradores');

// modules box text in includes/boxes/modules.php
define('BOX_HEADING_MODULES', 'Módulos');
define('BOX_MODULES_PAYMENT', 'Pagamento');
define('BOX_MODULES_SHIPPING', 'Envio');
define('BOX_MODULES_ORDER_TOTAL', 'Total');

// categories box text in includes/boxes/catalog.php
define('BOX_HEADING_CATALOG', 'Catálogo');
define('BOX_CATALOG_CATEGORIES_PRODUCTS', 'Categorias/Produtos');
define('BOX_CATALOG_CATEGORIES_PRODUCTS_ATTRIBUTES', 'Atributos');
define('BOX_CATALOG_MANUFACTURERS', 'Fabricantes');
define('BOX_CATALOG_REVIEWS', 'Comentários');
define('BOX_CATALOG_SPECIALS', 'Ofertas');
define('BOX_CATALOG_PRODUCTS_EXPECTED', 'Em Breve');

// customers box text in includes/boxes/customers.php
define('BOX_HEADING_CUSTOMERS', 'Clientes');
define('BOX_CUSTOMERS_CUSTOMERS', 'Clientes');
define('BOX_CUSTOMERS_ORDERS', 'Compras');

// taxes box text in includes/boxes/taxes.php
define('BOX_HEADING_LOCATION_AND_TAXES', 'Região/Imposto');
define('BOX_TAXES_COUNTRIES', 'Países');
define('BOX_TAXES_ZONES', 'Estados');
define('BOX_TAXES_GEO_ZONES', 'Impostos e Zonas');
define('BOX_TAXES_TAX_CLASSES', 'Tipos de Impostos');
define('BOX_TAXES_TAX_RATES', 'Impostos');

// reports box text in includes/boxes/reports.php
define('BOX_HEADING_REPORTS', 'Relatórios');
define('BOX_REPORTS_PRODUCTS_VIEWED', 'Mais Populares');
define('BOX_REPORTS_PRODUCTS_PURCHASED', 'Mais Comprados');
define('BOX_REPORTS_ORDERS_TOTAL', 'Total por Cliente');

// tools text in includes/boxes/tools.php
define('BOX_HEADING_TOOLS', 'Ferramentas');
define('BOX_TOOLS_BACKUP', 'Cópia de Segurança');
define('BOX_TOOLS_BANNER_MANAGER', 'Banners');
define('BOX_TOOLS_CACHE', 'Controle de Cache');
define('BOX_TOOLS_DEFINE_LANGUAGE', 'Escolher Idiomas');
define('BOX_TOOLS_FILE_MANAGER', 'Arquivos');
define('BOX_TOOLS_MAIL', 'Enviar Email');
define('BOX_TOOLS_NEWSLETTER_MANAGER', 'Boletins e Informativos');
define('BOX_TOOLS_SERVER_INFO', 'Informações do Servidor');
define('BOX_TOOLS_WHOS_ONLINE', 'Usuários Conectados');

// localizaion box text in includes/boxes/localization.php
define('BOX_HEADING_LOCALIZATION', 'Localização');
define('BOX_LOCALIZATION_CURRENCIES', 'Moedas');
define('BOX_LOCALIZATION_LANGUAGES', 'Idiomas');
define('BOX_LOCALIZATION_ORDERS_STATUS', 'Status dos Pedidos');

// javascript messages
define('JS_ERROR', 'Houve erros ao processar o seu formulário!\nPor favor faça as seguintes alterações:\n\n');

define('JS_OPTIONS_VALUE_PRICE', '* O atributo precisa de um preço\n');
define('JS_OPTIONS_VALUE_PRICE_PREFIX', '* O atributo precisa de um prefixo para o preço\n');

define('JS_PRODUCTS_NAME', '* O produto precisa de um nome\n');
define('JS_PRODUCTS_DESCRIPTION', '* O produto precisa de uma descrição\n');
define('JS_PRODUCTS_PRICE', '* O produto precisa de um preço\n');
define('JS_PRODUCTS_WEIGHT', '* Deve especificar o peso do produto\n');
define('JS_PRODUCTS_QUANTITY', '* Deve especificar a quantidade\n');
define('JS_PRODUCTS_MODEL', '* Deve especificar o modelo\n');
define('JS_PRODUCTS_IMAGE', '* Deve enviar uma imagem\n');

define('JS_SPECIALS_PRODUCTS_PRICE', '* Um novo preço para este produto deve ser definido\n');

define('JS_GENDER', '* Deve definir o \'Sexo\'.\n');
define('JS_FIRST_NAME', '* O \'Nome\' deve ter pelo menos ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' caracteres.\n');
define('JS_LAST_NAME', '* O \'Sobrenome\' deve ter pelo menos ' . ENTRY_LAST_NAME_MIN_LENGTH . ' caracteres.\n');
define('JS_DOB', '* A \'Data de Nascimento\' deve ter o formato: xx/xx/xxxx (dia/mês/ano).\n');
define('JS_EMAIL_ADDRESS', '* O \'E-Mail\' deve ter pelo menos ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' caracteres.\n');
define('JS_ADDRESS', '* O \'Endereço\' deve ter pelos menos ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' caracteres.\n');
define('JS_POST_CODE', '* O \'CEP\' deve ter pelo menos ' . ENTRY_POSTCODE_MIN_LENGTH . ' caracteres.\n');
define('JS_CITY', '* A \'Cidade\' deve ter pelo menos ' . ENTRY_CITY_MIN_LENGTH . ' caracteres.\n');
define('JS_STATE', '* Deve Indicar o \'Estado\'.\n');
define('JS_STATE_SELECT', '-- Selecione Acima --');
define('JS_ZONE', '* O \'Estado\' se deve selecionar na lista.');
define('JS_COUNTRY', '* Deve selecionar \'País\'.\n');
define('JS_TELEPHONE', '* O \'Telefone\' Deve ter pelo menos ' . ENTRY_TELEPHONE_MIN_LENGTH . ' caracteres.\n');
define('JS_PASSWORD', '* Os campos \'Senha\' e a \'Confirme Sua Senha\' devem ser iguais e terem pelo menos ' . ENTRY_PASSWORD_MIN_LENGTH . ' caracteres.\n');

define('JS_ORDER_DOES_NOT_EXIST', 'O número do pedido %s não existe!');

define('CATEGORY_PERSONAL', 'Pessoal');
define('CATEGORY_ADDRESS', 'Endereço');
define('CATEGORY_CONTACT', 'Contato');
define('CATEGORY_COMPANY', 'Empresa');
define('CATEGORY_OPTIONS', 'Opções');

define('ENTRY_GENDER', 'Sexo:');
define('ENTRY_GENDER_ERROR', '&nbsp;<span class="errorText">obrigatório</span>');
define('ENTRY_FIRST_NAME', 'Nome:');
define('ENTRY_FIRST_NAME_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' caracteres</span>');
define('ENTRY_LAST_NAME', 'Sobrenome:');
define('ENTRY_LAST_NAME_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_LAST_NAME_MIN_LENGTH . ' caracteres</span>');
define('ENTRY_DATE_OF_BIRTH', 'Data de Nascimento:');
define('ENTRY_DATE_OF_BIRTH_ERROR', '&nbsp;<span class="errorText">(Ex.: 21/05/1970)</span>');
define('ENTRY_EMAIL_ADDRESS', 'E-Mail:');
define('ENTRY_EMAIL_ADDRESS_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' caracteres</span>');
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', '&nbsp;<span class="errorText">Esse email não é válido!</span>');
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', '&nbsp;<span class="errorText">Esse email já existe!</span>');
define('ENTRY_COMPANY', 'Empresa:');
define('ENTRY_STREET_ADDRESS', 'Endereço: ');
define('ENTRY_STREET_ADDRESS_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' caracteres</span>');
define('ENTRY_SUBURB', 'Bairro:');
define('ENTRY_POST_CODE', 'CEP:');
define('ENTRY_POST_CODE_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_POSTCODE_MIN_LENGTH . ' caracteres</span>');
define('ENTRY_CITY', 'Cidade:');
define('ENTRY_CITY_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_CITY_MIN_LENGTH . ' letras</span>');
define('ENTRY_STATE', 'Estado:');
define('ENTRY_STATE_ERROR', '&nbsp;<span class="errorText">obrigatório</span>');
define('ENTRY_COUNTRY', 'País:');
define('ENTRY_TELEPHONE_NUMBER', 'Telefone:');
define('ENTRY_TELEPHONE_NUMBER_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_TELEPHONE_MIN_LENGTH . ' caracteres</span>');
define('ENTRY_FAX_NUMBER', 'Fax:');
define('ENTRY_NEWSLETTER', 'Boletim de Notícias:');
define('ENTRY_NEWSLETTER_YES', 'receber');
define('ENTRY_NEWSLETTER_NO', 'não receber');

// images
define('IMAGE_ANI_SEND_EMAIL', 'Enviando E-Mail');
define('IMAGE_BACK', 'Voltar');
define('IMAGE_BACKUP', 'Copiar');
define('IMAGE_CANCEL', 'Cancelar');
define('IMAGE_CONFIRM', 'Confirmar');
define('IMAGE_COPY', 'Copiar');
define('IMAGE_COPY_TO', 'Copiar Para');
define('IMAGE_DETAILS', 'Detalhes');
define('IMAGE_DELETE', 'Apagar');
define('IMAGE_EDIT', 'Editar');
define('IMAGE_EMAIL', 'Email');
define('IMAGE_FILE_MANAGER', 'Arquivos');
define('IMAGE_ICON_STATUS_GREEN', 'Ativado');
define('IMAGE_ICON_STATUS_GREEN_LIGHT', 'Ativar');
define('IMAGE_ICON_STATUS_RED', 'Desativado');
define('IMAGE_ICON_STATUS_RED_LIGHT', 'Desativar');
define('IMAGE_ICON_INFO', 'Dados');
define('IMAGE_INSERT', 'Inserir');
define('IMAGE_LOCK', 'Bloqueado');
define('IMAGE_MODULE_INSTALL', 'Instalar Módulo');
define('IMAGE_MODULE_REMOVE', 'Remover Módulo');
define('IMAGE_MOVE', 'Mover');
define('IMAGE_NEW_BANNER', 'Novo Banner');
define('IMAGE_NEW_CATEGORY', 'Nova Categoria');
define('IMAGE_NEW_COUNTRY', 'Novo País');
define('IMAGE_NEW_CURRENCY', 'Nova Moeda');
define('IMAGE_NEW_FILE', 'Novo Aquivo');
define('IMAGE_NEW_FOLDER', 'Nova Pasta');
define('IMAGE_NEW_LANGUAGE', 'Novo Idioma');
define('IMAGE_NEW_NEWSLETTER', 'Novo Boletim de Notícias');
define('IMAGE_NEW_PRODUCT', 'Novo Produto');
define('IMAGE_NEW_TAX_CLASS', 'Novo Tipo de Imposto');
define('IMAGE_NEW_TAX_RATE', 'Novo Imposto');
define('IMAGE_NEW_TAX_ZONE', 'Novo Imposto de Zona');
define('IMAGE_NEW_ZONE', 'Nova Zona');
define('IMAGE_ORDERS', 'Pedidos');
define('IMAGE_ORDERS_INVOICE', 'Fatura');
define('IMAGE_ORDERS_PACKINGSLIP', 'Envio de Produto');
define('IMAGE_PREVIEW', 'Ver');
define('IMAGE_RESET', 'Resetear');
define('IMAGE_RESTORE', 'Restaurar');
define('IMAGE_SAVE', 'Salvar');
define('IMAGE_SEARCH', 'Buscar');
define('IMAGE_SELECT', 'Selecionar');
define('IMAGE_SEND', 'Enviar');
define('IMAGE_SEND_EMAIL', 'Enviar Email');
define('IMAGE_UNLOCK', 'Desbloqueado');
define('IMAGE_UPDATE', 'Atualizar');
define('IMAGE_UPDATE_CURRENCIES', 'Atualizar taxa de cambio');
define('IMAGE_UPLOAD', 'Subir');

define('ICON_CROSS', 'Falso');
define('ICON_CURRENT_FOLDER', 'Diretório Atual');
define('ICON_DELETE', 'Apagar');
define('ICON_ERROR', 'Erro');
define('ICON_FILE', 'Arquivo');
define('ICON_FILE_DOWNLOAD', 'Download');
define('ICON_FOLDER', 'Pasta');
define('ICON_LOCKED', 'Bloqueado');
define('ICON_PREVIOUS_LEVEL', 'Nivel Anterior');
define('ICON_PREVIEW', 'Ver');
define('ICON_STATISTICS', 'Estatísticas');
define('ICON_SUCCESS', 'Sucesso');
define('ICON_TICK', 'Verdadero');
define('ICON_UNLOCKED', 'Desbloqueado');
define('ICON_WARNING', 'Advertência');

// constants for use in tep_prev_next_display function
define('TEXT_RESULT_PAGE', 'Página %s de %d');
define('TEXT_DISPLAY_NUMBER_OF_BANNERS', 'Mostrando <b>%d</b> até <b>%d</b> do total de <b>%d</b> banners');
define('TEXT_DISPLAY_NUMBER_OF_COUNTRIES', 'Mostrando <b>%d</b> até <b>%d</b> do total de <b>%d</b> países');
define('TEXT_DISPLAY_NUMBER_OF_CUSTOMERS', 'Mostrando <b>%d</b> até <b>%d</b> do total de <b>%d</b> clientes');
define('TEXT_DISPLAY_NUMBER_OF_CURRENCIES', 'Mostrando <b>%d</b> até <b>%d</b> do total de <b>%d</b> moedas');
define('TEXT_DISPLAY_NUMBER_OF_LANGUAGES', 'Mostrando <b>%d</b> até <b>%d</b> do total de <b>%d</b> idiomas');
define('TEXT_DISPLAY_NUMBER_OF_MANUFACTURERS', 'Mostrando <b>%d</b> até <b>%d</b> do total de <b>%d</b> fabricantes');
define('TEXT_DISPLAY_NUMBER_OF_NEWSLETTERS', 'Mostrando <b>%d</b> até <b>%d</b> do total de <b>%d</b> boletins');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS', 'Mostrando <b>%d</b> até <b>%d</b> do total de <b>%d</b> pedidos');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS_STATUS', 'Mostrando <b>%d</b> até <b>%d</b> do total de <b>%d</b> status de pedidos');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS', 'Mostrando <b>%d</b> até <b>%d</b> do total de <b>%d</b> produtos');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_EXPECTED', 'Mostrando <b>%d</b> até <b>%d</b> do total de <b>%d</b> produtos em breve');
define('TEXT_DISPLAY_NUMBER_OF_REVIEWS', 'Mostrando <b>%d</b> até <b>%d</b> do total de <b>%d</b> comentários');
define('TEXT_DISPLAY_NUMBER_OF_SPECIALS', 'Mostrando <b>%d</b> até <b>%d</b> do total de <b>%d</b> ofertas');
define('TEXT_DISPLAY_NUMBER_OF_TAX_ZONES', 'Mostrando <b>%d</b> até <b>%d</b> do total de <b>%d</b> zonas de impostos');
define('TEXT_DISPLAY_NUMBER_OF_TAX_RATES', 'Mostrando <b>%d</b> até <b>%d</b> do total de <b>%d</b> taxas de impostos');
define('TEXT_DISPLAY_NUMBER_OF_TAX_CLASSES', 'Mostrando <b>%d</b> até <b>%d</b> do total de <b>%d</b> tipos de imposto');
define('TEXT_DISPLAY_NUMBER_OF_ZONES', 'Mostrando <b>%d</b> até <b>%d</b> do total de <b>%d</b> zonas');

define('PREVNEXT_BUTTON_PREV', '&lt;&lt;');
define('PREVNEXT_BUTTON_NEXT', '&gt;&gt;');

define('TEXT_DEFAULT', 'padrão');
define('TEXT_SET_DEFAULT', 'Definir como padrão');
define('TEXT_FIELD_REQUIRED', '&nbsp;<span class="fieldRequired">* Obrigatório</span>');

define('ERROR_NO_DEFAULT_CURRENCY_DEFINED', 'Erro: Não há moeda padrão. Por favor Definir uma em Administração->Localização->Moedas');

define('TEXT_CACHE_CATEGORIES', 'Categorias');
define('TEXT_CACHE_MANUFACTURERS', 'Fabricantes');
define('TEXT_CACHE_ALSO_PURCHASED', 'Também Compraram');

define('TEXT_NONE', '--nenhum--');
define('TEXT_TOP', 'Início');

define('ERROR_DESTINATION_DOES_NOT_EXIST', 'Erro: Destino não existe.');
define('ERROR_DESTINATION_NOT_WRITEABLE', 'Erro: O aquivo não pode ser salvo nesse destino.');
define('ERROR_FILE_NOT_SAVED', 'Erro: O arquivo não foi salvo.');
define('ERROR_FILETYPE_NOT_ALLOWED', 'Erro: Extensão de arquivo não permitida.');
define('SUCCESS_FILE_SAVED_SUCCESSFULLY', 'Sucesso: Arquivo salvo com sucesso.');
define('WARNING_NO_FILE_UPLOADED', 'Advertência: Nenhum arquivo carregado.');
define('WARNING_FILE_UPLOADS_DISABLED', 'Advertência: O carregamento de arquivos está desativado, verifique as configurações do php.ini.');
?>
