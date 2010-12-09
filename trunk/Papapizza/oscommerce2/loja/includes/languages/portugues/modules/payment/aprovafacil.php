<?php

/*

  aprovafacil.php 09/03/2004

  M�dulo de Pagamento osCommerce 2.2 para aprovar Cart�es de Cr�dito atrav�s do servi�o Aprova F�cil

  O Aprova F�cil suporta atualmente as bandeiras Visa, Mastercard, Amex, Dinners, Sollo, Fininvest, Hipercard e JCB

  O Aprova F�cil permite vendas � vista ou parceladas utilizando cart�es internacionais ou nacionais (valid only in Brazil)

  O download do Aprova F�cil pode ser efetuado em http://www.aprovafacil.com

  Copyright (c) 2004 Cobre Bem Tecnologia <suporte@cobrebem.com>
  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License

*/

  define('MODULE_PAYMENT_APROVAFACIL_TEXT_TITLE', 'Cart�o de Cr�dito');
  define('MODULE_PAYMENT_APROVAFACIL_TEXT_DESCRIPTION', 'Autoriza��o de Cart�es de Cr�dito<br>utilizando o servi�o Aprova F�cil<br><a href=http://www.aprovafacil.com target=_blank>www.aprovafacil.com</a>');
  define('APROVAFACIL_ERROR_HEADING', 'N�o foi poss�vel processar o seu Cart�o de Cr�dito');
  define('APROVAFACIL_ERROR_MESSAGE', 'Por favor verifique os dados do Cart�o de Cr�dito!');
  define('MODULE_PAYMENT_APROVAFACIL_TEXT_CREDIT_CARD_NUMBER', 'N�mero do Cart�o de Cr�dito:');
  define('MODULE_PAYMENT_APROVAFACIL_TEXT_CREDIT_CARD_EXPIRES', 'Data de Validade do Cart�o de Cr�dito:');
  define('MODULE_PAYMENT_APROVAFACIL_TEXT_CREDIT_CARD_CHECKNUMBER', 'C�digo de Seguran�a:');
  define('MODULE_PAYMENT_APROVAFACIL_TEXT_CREDIT_CARD_CHECKNUMBER_LOCATION', '(3 a 5 d�gitos localizados no verso do cart�o ou na frente se Amex ou Sollo)');
  define('MODULE_PAYMENT_APROVAFACIL_TEXT_PARCELAS', 'Quantidade de Parcelas:');

  define('MODULE_PAYMENT_APROVAFACIL_TEXT_JS_CC_OWNER', '* The owner\'s name of the credit card must be at least ' . CC_OWNER_MIN_LENGTH . ' characters.\n');
  define('MODULE_PAYMENT_APROVAFACIL_TEXT_JS_CC_NUMBER', '* The credit card number must be at least ' . CC_NUMBER_MIN_LENGTH . ' characters.\n');
?>
