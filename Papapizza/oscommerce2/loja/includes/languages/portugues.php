<?php
/*
  $Id: portugues.php 1743 2007-12-20 18:02:36Z hpdl $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2007 osCommerce

  Released under the GNU General Public License
*/

// look in your $PATH_LOCALE/locale directory for available locales
// or type locale -a on the server.
// Examples:
// on RedHat try 'pt_BR'
// on FreeBSD try 'pr_BR.ISO_8859-1'
// on Windows try 'br', or 'Português'
@setlocale(LC_TIME, 'pt_BR.ISO_8859-1');

define('DATE_FORMAT_SHORT', '%d/%m/%Y');  // this is used for strftime()
define('DATE_FORMAT_LONG', '%A %d %B, %Y'); // this is used for strftime()
define('DATE_FORMAT', 'd/m/Y');  // this is used for date()
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

// if USE_DEFAULT_LANGUAGE_CURRENCY is true, use the following currency, instead of the applications default currency (used when changing language)
define('LANGUAGE_CURRENCY', 'R$');

// Global entries for the <html> tag
define('HTML_PARAMS','dir="LTR" lang="br"');

// charset for web pages and emails
define('CHARSET', 'iso-8859-1');

// page title
define('TITLE', STORE_NAME);

// header text in includes/header.php
define('HEADER_TITLE_CREATE_ACCOUNT', 'Criar Conta');
define('HEADER_TITLE_MY_ACCOUNT', 'Minha Conta');
define('HEADER_TITLE_CART_CONTENTS', 'Meu Carrinho');
define('HEADER_TITLE_CHECKOUT', 'Realizar Pedido');
define('HEADER_TITLE_TOP', 'Início');
define('HEADER_TITLE_CATALOG', 'Loja');
define('HEADER_TITLE_LOGOFF', 'Sair');
define('HEADER_TITLE_LOGIN', 'Entrar');

// footer text in includes/footer.php
define('FOOTER_TEXT_REQUESTS_SINCE', 'visitas desde');

// text for gender
define('MALE', 'Masculino');
define('FEMALE', 'Feminino');
define('MALE_ADDRESS', 'Sr.');
define('FEMALE_ADDRESS', 'Sra.');

// text for date of birth example
define('DOB_FORMAT_STRING', 'dd/mm/aaaa');

// categories box text in includes/boxes/categories.php
define('BOX_HEADING_CATEGORIES', 'Categorias');

// manufacturers box text in includes/boxes/manufacturers.php
define('BOX_HEADING_MANUFACTURERS', 'Fabricantes');

// whats_new box text in includes/boxes/whats_new.php
define('BOX_HEADING_WHATS_NEW', 'Novidades');

// quick_find box text in includes/boxes/quick_find.php
define('BOX_HEADING_SEARCH', 'Busca Rápida');
define('BOX_SEARCH_TEXT', 'Use palavras chave para encontrar o produto que procura.');
define('BOX_SEARCH_ADVANCED_SEARCH', 'Busca Avançada');

// specials box text in includes/boxes/specials.php
define('BOX_HEADING_SPECIALS', 'Ofertas');

// reviews box text in includes/boxes/reviews.php
define('BOX_HEADING_REVIEWS', 'Comentários');
define('BOX_REVIEWS_WRITE_REVIEW', 'Escreva um comentário sobre esse produto');
define('BOX_REVIEWS_NO_REVIEWS', 'Nenhum comentário ainda');
define('BOX_REVIEWS_TEXT_OF_5_STARS', '%s de 5 Estrelas!');

// shopping_cart box text in includes/boxes/shopping_cart.php
define('BOX_HEADING_SHOPPING_CART', 'Compras');
define('BOX_SHOPPING_CART_EMPTY', '0 produtos');

// order_history box text in includes/boxes/order_history.php
define('BOX_HEADING_CUSTOMER_ORDERS', 'Meus Pedidos');

// best_sellers box text in includes/boxes/best_sellers.php
define('BOX_HEADING_BESTSELLERS', 'Top Mais Vendidos');
define('BOX_HEADING_BESTSELLERS_IN', 'Top Mais Vendidos em <br>&nbsp;&nbsp;');

// notifications box text in includes/boxes/products_notifications.php
define('BOX_HEADING_NOTIFICATIONS', 'Notificações');
define('BOX_NOTIFICATIONS_NOTIFY', 'Notifique-me de atualizações para <b>%s</b>');
define('BOX_NOTIFICATIONS_NOTIFY_REMOVE', 'Não me notifique de atualizações para <b>%s</b>');

// manufacturer box text
define('BOX_HEADING_MANUFACTURER_INFO', 'Fabricante');
define('BOX_MANUFACTURER_INFO_HOMEPAGE', 'Página de %s');
define('BOX_MANUFACTURER_INFO_OTHER_PRODUCTS', 'Outros produtos');

// languages box text in includes/boxes/languages.php
define('BOX_HEADING_LANGUAGES', 'Idioma');

// currencies box text in includes/boxes/currencies.php
define('BOX_HEADING_CURRENCIES', 'Moeda');

// information box text in includes/boxes/information.php
define('BOX_HEADING_INFORMATION', 'Informações');
define('BOX_INFORMATION_PRIVACY', 'Política de Privacidade');
define('BOX_INFORMATION_CONDITIONS', 'Condições de uso');
define('BOX_INFORMATION_SHIPPING', 'Fretes e Devoluções');
define('BOX_INFORMATION_CONTACT', 'Contato');

// tell a friend box text in includes/boxes/tell_a_friend.php
define('BOX_HEADING_TELL_A_FRIEND', 'Indique a um amigo');
define('BOX_TELL_A_FRIEND_TEXT', 'Fale sobre este produto para alguém que você conheça.');

// checkout procedure text
define('CHECKOUT_BAR_DELIVERY', 'Entrega');
define('CHECKOUT_BAR_PAYMENT', 'Pagamento');
define('CHECKOUT_BAR_CONFIRMATION', 'Confirmação');
define('CHECKOUT_BAR_FINISHED', 'Terminado!');

// pull down default text
define('PULL_DOWN_DEFAULT', 'Selecione');
define('TYPE_BELOW', 'Escreva um Desejo');

// javascript messages
define('JS_ERROR', 'Existem erros em seu formulário!\nPor favor, faça as seguintes correções:\n\n');

define('JS_REVIEW_TEXT', '* Seu \'Comentário\' deve ter pelo menos ' . REVIEW_TEXT_MIN_LENGTH . ' caracteres.\n');
define('JS_REVIEW_RATING', '* Deve avaliar o produto.\n');

define('JS_ERROR_NO_PAYMENT_MODULE_SELECTED', '* Por favor, selecione um método de pagamento para seu pedido.\n');

define('JS_ERROR_SUBMITTED', 'Você já enviou o formulário. Por favor, pressione "aceitar" e aguarde até que este processo seja concluído.');

define('ERROR_NO_PAYMENT_MODULE_SELECTED', 'Por favor, selecione um método de pagamento para seu pedido.');

define('CATEGORY_COMPANY', 'Empresa');
define('CATEGORY_PERSONAL', 'Dados Pessoais');
define('CATEGORY_ADDRESS', 'Endereço');
define('CATEGORY_CONTACT', 'Contato');
define('CATEGORY_OPTIONS', 'Opções');
define('CATEGORY_PASSWORD', 'Senha');

define('ENTRY_COMPANY', 'Empresa:');
define('ENTRY_COMPANY_ERROR', '');
define('ENTRY_COMPANY_TEXT', '');
define('ENTRY_GENDER', 'Sexo:');
define('ENTRY_GENDER_ERROR', 'Por favor selecione "Masculino" ou "Feminino".');
define('ENTRY_GENDER_TEXT', '*');
define('ENTRY_FIRST_NAME', 'Nome:');
define('ENTRY_FIRST_NAME_ERROR', 'Seu nome deve ter pelo menos ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' caracteres.');
define('ENTRY_FIRST_NAME_TEXT', '*');
define('ENTRY_LAST_NAME', 'Sobrenome:');
define('ENTRY_LAST_NAME_ERROR', 'Seu Sobrenome deve ter pelo menos ' . ENTRY_LAST_NAME_MIN_LENGTH . ' caracteres.');
define('ENTRY_LAST_NAME_TEXT', '*');
define('ENTRY_DATE_OF_BIRTH', 'Data de Nascimento:');
define('ENTRY_DATE_OF_BIRTH_ERROR', 'Sua data de nascimento deve ter esse formato: DD/MM/AAAA (p.ex. 21/05/1970)');
define('ENTRY_DATE_OF_BIRTH_TEXT', '* (Ex: 21/05/1970)');
define('ENTRY_EMAIL_ADDRESS', 'E-Mail:');
define('ENTRY_EMAIL_ADDRESS_ERROR', 'Seu endereço de email deve ter pelo menos ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' caracteres.');
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', 'Seu E-Mail não é válido - faça as mudanças necessárias.');
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', 'Este endereço de E-Mail já está cadastrado, você pode fazer o login na sua conta usando ele ou criar uma nova conta com outro endereço de E-mail');
define('ENTRY_EMAIL_ADDRESS_TEXT', '*');
define('ENTRY_STREET_ADDRESS', 'Endereço:');
define('ENTRY_STREET_ADDRESS_ERROR', 'Seu endereço deve ter pelo menos ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' caracteres.');
define('ENTRY_STREET_ADDRESS_TEXT', '*(rua, número, complemento, apartamento)');
define('ENTRY_SUBURB', 'Bairro:');
define('ENTRY_SUBURB_ERROR', '');
define('ENTRY_SUBURB_TEXT', '');
define('ENTRY_POST_CODE', 'CEP:');
define('ENTRY_POST_CODE_ERROR', 'Seu CEP deve ter pelo menos ' . ENTRY_POSTCODE_MIN_LENGTH . ' caracteres.');
define('ENTRY_POST_CODE_TEXT', '*');
define('ENTRY_CITY', 'Cidade:');
define('ENTRY_CITY_ERROR', 'O nome de sua cidade deve ter pelo menos ' . ENTRY_CITY_MIN_LENGTH . ' caracteres.');
define('ENTRY_CITY_TEXT', '*');
define('ENTRY_STATE', 'Estado:');
define('ENTRY_STATE_ERROR', 'O nome do seu estado deve ter pelo menos' . ENTRY_STATE_MIN_LENGTH . ' caracteres.');
define('ENTRY_STATE_ERROR_SELECT', 'Por favor selecione seu estado na lista .');
define('ENTRY_STATE_TEXT', '*');
define('ENTRY_COUNTRY', 'País:');
define('ENTRY_COUNTRY_ERROR', 'Por favor selecione seu país.');
define('ENTRY_COUNTRY_TEXT', '*');
define('ENTRY_TELEPHONE_NUMBER', 'Telefone (com DDD):');
define('ENTRY_TELEPHONE_NUMBER_ERROR', 'Seu número de telefone deve ter pelo menos ' . ENTRY_TELEPHONE_MIN_LENGTH . ' caracteres.');
define('ENTRY_TELEPHONE_NUMBER_TEXT', '*');
define('ENTRY_FAX_NUMBER', 'Fax (com DDD):');
define('ENTRY_FAX_NUMBER_ERROR', '');
define('ENTRY_FAX_NUMBER_TEXT', '');
define('ENTRY_NEWSLETTER', 'Receber Boletins de Notícias');
define('ENTRY_NEWSLETTER_TEXT', '');
define('ENTRY_NEWSLETTER_YES', 'assinar');
define('ENTRY_NEWSLETTER_NO', 'não assinar');
define('ENTRY_NEWSLETTER_ERROR', '');
define('ENTRY_PASSWORD', 'Senha:');
define('ENTRY_PASSWORD_ERROR', 'Sua senha dever conter pelo menos ' . ENTRY_PASSWORD_MIN_LENGTH . ' caracteres.');
define('ENTRY_PASSWORD_ERROR_NOT_MATCHING', 'A confirmação de senha e a senha não correspondem');
define('ENTRY_PASSWORD_TEXT', '*');
define('ENTRY_PASSWORD_CONFIRMATION', 'Confirme sua senha:');
define('ENTRY_PASSWORD_CONFIRMATION_TEXT', '*');
define('ENTRY_PASSWORD_CURRENT', 'Senha atual:');
define('ENTRY_PASSWORD_CURRENT_TEXT', '*');
define('ENTRY_PASSWORD_CURRENT_ERROR', 'Sua senha dever ter pelo menos ' . ENTRY_PASSWORD_MIN_LENGTH . ' caracteres.');
define('ENTRY_PASSWORD_NEW', 'Nova Senha:');
define('ENTRY_PASSWORD_NEW_TEXT', '*');
define('ENTRY_PASSWORD_NEW_ERROR', 'Sua nova senha de ter pelo menos ' . ENTRY_PASSWORD_MIN_LENGTH . ' caracteres.');
define('ENTRY_PASSWORD_NEW_ERROR_NOT_MATCHING', 'A confirmação de senha e a senha não correspondem');
define('PASSWORD_HIDDEN', '--OCULTO--');

define('FORM_REQUIRED_INFORMATION', '* Dados Obrigatórios');

// constants for use in tep_prev_next_display function
define('TEXT_RESULT_PAGE', 'Página de Resultados:');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS', 'Mostrando de <b>%d</b> até <b>%d</b> do total de <b>%d</b> produtos');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS', 'Mostrando de <b>%d</b> até <b>%d</b> do total de <b>%d</b> pedidos');
define('TEXT_DISPLAY_NUMBER_OF_REVIEWS', 'Mostrando de  <b>%d</b> até <b>%d</b> do total de <b>%d</b> comentários');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_NEW', 'Mostrando de <b>%d</b> até <b>%d</b> do total de <b>%d</b> produtos novos');
define('TEXT_DISPLAY_NUMBER_OF_SPECIALS', 'Mostrando de <b>%d</b> até <b>%d</b> do total de <b>%d</b> ofertas');

define('PREVNEXT_TITLE_FIRST_PAGE', 'Principal');
define('PREVNEXT_TITLE_PREVIOUS_PAGE', 'Anterior');
define('PREVNEXT_TITLE_NEXT_PAGE', 'Siguiente');
define('PREVNEXT_TITLE_LAST_PAGE', 'Final');
define('PREVNEXT_TITLE_PAGE_NO', 'Página %d');
define('PREVNEXT_TITLE_PREV_SET_OF_NO_PAGE', 'Anteriores %d Páginas');
define('PREVNEXT_TITLE_NEXT_SET_OF_NO_PAGE', 'Seguientes %d Páginas');
define('PREVNEXT_BUTTON_FIRST', '&lt;&lt;Inícío');
define('PREVNEXT_BUTTON_PREV', '[&lt;&lt;&nbsp;Anterior]');
define('PREVNEXT_BUTTON_NEXT', '[Siguiente&nbsp;&gt;&gt;]');
define('PREVNEXT_BUTTON_LAST', 'Final&gt;&gt;');

define('IMAGE_BUTTON_ADD_ADDRESS', 'Adicionar Endereços');
define('IMAGE_BUTTON_ADDRESS_BOOK', 'Endereços');
define('IMAGE_BUTTON_BACK', 'Voltar');
define('IMAGE_BUTTON_BUY_NOW', 'Compre Agora');
define('IMAGE_BUTTON_CHANGE_ADDRESS', 'Mudar Endereço');
define('IMAGE_BUTTON_CHECKOUT', 'Realizar Pedido');
define('IMAGE_BUTTON_CONFIRM_ORDER', 'Confirmar Pedido');
define('IMAGE_BUTTON_CONTINUE', 'Continuar');
define('IMAGE_BUTTON_CONTINUE_SHOPPING', 'Seguir Comprando');
define('IMAGE_BUTTON_DELETE', 'Deletar');
define('IMAGE_BUTTON_EDIT_ACCOUNT', 'Editar Conta');
define('IMAGE_BUTTON_HISTORY', 'Histórico de Pedidos');
define('IMAGE_BUTTON_LOGIN', 'Entrar');
define('IMAGE_BUTTON_IN_CART', 'Adicionar ao carrinho');
define('IMAGE_BUTTON_NOTIFICATIONS', 'Notificações');
define('IMAGE_BUTTON_QUICK_FIND', 'Busca Rápida');
define('IMAGE_BUTTON_REMOVE_NOTIFICATIONS', 'Remover Notificações');
define('IMAGE_BUTTON_REVIEWS', 'Comentários');
define('IMAGE_BUTTON_SEARCH', 'Buscar');
define('IMAGE_BUTTON_SHIPPING_OPTIONS', 'Opções de Envio');
define('IMAGE_BUTTON_TELL_A_FRIEND', 'Indique para um amigo');
define('IMAGE_BUTTON_UPDATE', 'Atualizar');
define('IMAGE_BUTTON_UPDATE_CART', 'Atualizar Carrinho');
define('IMAGE_BUTTON_WRITE_REVIEW', 'Escrever Comentário');

define('SMALL_IMAGE_BUTTON_DELETE', 'Deletar');
define('SMALL_IMAGE_BUTTON_EDIT', 'Modificar');
define('SMALL_IMAGE_BUTTON_VIEW', 'Ver');

define('ICON_ARROW_RIGHT', 'Adicionar');
define('ICON_CART', 'No Carrinho');
define('ICON_ERROR', 'Erro');
define('ICON_SUCCESS', 'Correto');
define('ICON_WARNING', 'Advertência');

define('TEXT_GREETING_PERSONAL', 'Bem Vindo Novamente <span class="greetUser">%s!</span> Gostaria de ver os <a href="%s"><u>novos produtos</u></a> disponíveis?');
define('TEXT_GREETING_PERSONAL_RELOGON', '<small>Se você não é %s, por favor <a href="%s"><u>click aqui</u></a> e coloque seus dados.</small>');
define('TEXT_GREETING_GUEST', 'Bem Vindo <span class="greetUser">Convidado!</span> Gostaria de <a href="%s"><u>fazer o login</u></a> ou prefere <a href="%s"><u>criar uma conta</u></a>?');

define('TEXT_SORT_PRODUCTS', 'Ordenar Produtos ');
define('TEXT_DESCENDINGLY', 'Ordem Decrescente');
define('TEXT_ASCENDINGLY', 'Ordem Crescente');
define('TEXT_BY', ' por ');

define('TEXT_REVIEW_BY', 'por %s');
define('TEXT_REVIEW_WORD_COUNT', '%s palavras');
define('TEXT_REVIEW_RATING', 'Taxa: %s [%s]');
define('TEXT_REVIEW_DATE_ADDED', 'Data Adicionada: %s');
define('TEXT_NO_REVIEWS', 'Não existem comentários');

define('TEXT_NO_NEW_PRODUCTS', 'No momento não há novidades');

define('TEXT_UNKNOWN_TAX_RATE', 'Imposto desconhecido');

define('TEXT_REQUIRED', '<span class="errorText">Obrigatório</span>');

define('ERROR_TEP_MAIL', '<font face="Verdana, Arial" size="2" color="#ff0000"><b><small>TEP ERROR:</small> Não foi possivél enviar o email com SMTP especificado. Configure seu servidor SMTP.</b></font>');
define('WARNING_INSTALL_DIRECTORY_EXISTS', 'Atenção: Por favor, remova o diretório de instalação por razões de segurança. "' . dirname($HTTP_SERVER_VARS['SCRIPT_FILENAME']) . '/install."');
define('WARNING_CONFIG_FILE_WRITEABLE', 'Atenção: Modifique as permissões do arquivo "' . dirname($HTTP_SERVER_VARS['SCRIPT_FILENAME']) . '\includes\configure.php" para somente leitura (CHMOD 444)');
define('WARNING_SESSION_DIRECTORY_NON_EXISTENT', 'Atenção: a pasta para guardar dados dessas sessões não existe ' . tep_session_save_path() . '. As seções não funcionaram enquanto este erro não for corrigido.');
define('WARNING_SESSION_DIRECTORY_NOT_WRITEABLE', 'Atenção: Sem permissão para escrever no diretório das sessões: ' . tep_session_save_path() . '. As seções não funcionaram enquanto este erro não for corrigido.');
define('WARNING_SESSION_AUTO_START', 'Atenção: A linha session.auto_start está ativada - desative esta característica do PHP em php.ini e reinicie seu servidor. ');
define('WARNING_DOWNLOAD_DIRECTORY_NON_EXISTENT', 'Atenção: o diretório onde ficam os produtos para download não existe ' . DIR_FS_DOWNLOAD . '. Os produtos para download não funcionaram enquanto este erro não for corrigido.');

define('TEXT_CCVAL_ERROR_INVALID_DATE', 'A data do cartão de crédito está incorreta. Por favor tente novamente');
define('TEXT_CCVAL_ERROR_INVALID_NUMBER', 'O número do cartão de credito está incorreto. Por favor tente novamente.');
define('TEXT_CCVAL_ERROR_UNKNOWN_CARD', 'Os primeiros quatro dígitos do seu cartão de crédito são: %s. Se este número está correto não podemos aceitar se cartão de credito. Se está errado por favor tente novamente.');

define('FOOTER_TEXT_BODY', 'Copyright &copy; ' . date('Y') . ' <a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . STORE_NAME . '</a><br>Fornecido por <a href="http://www.oscbr.com.br" target="_blank">osCommerce Brasil</a>');
?>
