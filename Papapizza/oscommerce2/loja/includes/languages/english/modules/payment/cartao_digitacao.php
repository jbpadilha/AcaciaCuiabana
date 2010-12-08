<?php

/*

  aprovafacil.php 09/03/2004

  Módulo de Pagamento osCommerce 2.2 para aprovar Cartões de Crédito através do serviço Aprova Fácil

  O Aprova Fácil suporta atualmente as bandeiras Visa, Mastercard, Amex, Dinners, Sollo, Fininvest, Hipercard e JCB

  O Aprova Fácil permite vendas à vista ou parceladas utilizando cartões internacionais ou nacionais (valid only in Brazil)

  O download do Aprova Fácil pode ser efetuado em http://www.aprovafacil.com

  Copyright (c) 2004 Cobre Bem Tecnologia <suporte@cobrebem.com>
  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License

*/

  define('MODULE_PAYMENT_CARTAO_DIGITACAO_TEXT_TITLE', 'Cartão de Crédito - Por Digitação');
  define('MODULE_PAYMENT_CARTAO_DIGITACAO_TEXT_DESCRIPTION', 'Autorização de Cartões de Crédito<br>');
  define('APROVAFACIL_ERROR_HEADING', '');
  define('APROVAFACIL_ERROR_MESSAGE', 'Por favor verifique os dados do Cartão de Crédito!');
  define('MODULE_PAYMENT_CARTAO_DIGITACAO_TEXT_CREDIT_CARD_NUMBER', 'Número do Cartão de Crédito:');
  define('MODULE_PAYMENT_CARTAO_DIGITACAO_TEXT_CREDIT_CARD_EXPIRES', 'Data de Validade do Cartão de Crédito:');
  define('MODULE_PAYMENT_CARTAO_DIGITACAO_TEXT_CREDIT_CARD_CHECKNUMBER', 'Código de Segurança:');
  define('MODULE_PAYMENT_CARTAO_DIGITACAO_TEXT_CREDIT_CARD_CHECKNUMBER_LOCATION', '(3 a 5 dígitos localizados no verso do cartão ou na frente se Amex ou Sollo)');
  define('MODULE_PAYMENT_CARTAO_DIGITACAO_TEXT_PARCELAS', 'Quantidade de Parcelas:');

  define('MODULE_PAYMENT_CARTAO_DIGITACAO_TEXT_JS_CC_OWNER', '* The owner\'s name of the credit card must be at least ' . CC_OWNER_MIN_LENGTH . ' characters.\n');
  define('MODULE_PAYMENT_CARTAO_DIGITACAO_TEXT_JS_CC_NUMBER', '* The credit card number must be at least ' . CC_NUMBER_MIN_LENGTH . ' characters.\n');
?>
