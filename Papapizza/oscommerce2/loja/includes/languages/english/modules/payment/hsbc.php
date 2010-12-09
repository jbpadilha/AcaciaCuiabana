<?php
/*
  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  HSBC Payment Module Copyright (c) 2003,2004,2005 qadram software
  http://www.qadram.com

  Module developed for FreeRangeKids
  http://www.freerangekids.co.uk

  Released under the GNU General Public License
*/

  define('MODULE_PAYMENT_HSBC_TEXT_TITLE', 'Buy On-Line with Credit / Debit Card via our secure connection to HSBC');
  define('MODULE_PAYMENT_HSBC_TEXT_DESCRIPTION', 'Credit Card Test Info:<br><br>CC#: 4111111111111111<br>Expiry: Any');
  define('MODULE_PAYMENT_HSBC_TEXT_TYPE', 'Type:');
  define('MODULE_PAYMENT_HSBC_TEXT_CREDIT_CARD_OWNER', 'Credit Card Owner:');
  define('MODULE_PAYMENT_HSBC_TEXT_CREDIT_CARD_NUMBER', 'Credit Card Number:');
  define('MODULE_PAYMENT_HSBC_TEXT_CREDIT_CARD_EXPIRES', 'Credit Card Expire Date:');
  define('MODULE_PAYMENT_HSBC_TEXT_JS_CC_OWNER', '* The owner\'s name of the credit card must be at least ' . CC_OWNER_MIN_LENGTH . ' characters.\n');
  define('MODULE_PAYMENT_HSBC_TEXT_JS_CC_NUMBER', '* The credit card number must be at least ' . CC_NUMBER_MIN_LENGTH . ' characters.\n');
  define('MODULE_PAYMENT_HSBC_TEXT_ERROR_MESSAGE', 'There has been an error processing your credit card. Please try again.');
  define('MODULE_PAYMENT_HSBC_TEXT_DECLINED_MESSAGE', 'Your credit card was declined. Please try another card or contact your bank for more info.');
  define('MODULE_PAYMENT_HSBC_TEXT_ERROR', 'Credit Card Error!');
  
define('MODULE_PAYMENT_HSBC_TEXT_ERROR1', 'You have cancelled\nthe transaction.');
define('MODULE_PAYMENT_HSBC_TEXT_ERROR2', 'The processor declined the transaction for an unknown reason.');
define('MODULE_PAYMENT_HSBC_TEXT_ERROR3', 'The transaction was declined because of a problem with the card. For example, an invalid card number or expiration date was specified.');
define('MODULE_PAYMENT_HSBC_TEXT_ERROR4', 'The processor did not return a response.');
define('MODULE_PAYMENT_HSBC_TEXT_ERROR5', 'The amount specified in the transaction was either too high or too low for the processor.');
define('MODULE_PAYMENT_HSBC_TEXT_ERROR6', 'The specified currency is not supported by either the processor or the card.');
define('MODULE_PAYMENT_HSBC_TEXT_ERROR7', 'The order is invalid because the order ID is a duplicate.');
define('MODULE_PAYMENT_HSBC_TEXT_ERROR8', 'The transaction was rejected by FraudShield.');
define('MODULE_PAYMENT_HSBC_TEXT_ERROR9', 'The transaction was placed in Review state by FraudShield.1');
define('MODULE_PAYMENT_HSBC_TEXT_ERROR10', 'The transaction failed because of invalid input data.');
define('MODULE_PAYMENT_HSBC_TEXT_ERROR11', 'The transaction failed because the CPI was configured incorrectly.');
define('MODULE_PAYMENT_HSBC_TEXT_ERROR12', 'The transaction failed because the Storefront was configured incorrectly.');
define('MODULE_PAYMENT_HSBC_TEXT_ERROR13', 'The connection timed out.');
define('MODULE_PAYMENT_HSBC_TEXT_ERROR14', 'The transaction failed because your browser refused a cookie.');
define('MODULE_PAYMENT_HSBC_TEXT_ERROR15', 'Your browser does not support 128-bit encryption.');
define('MODULE_PAYMENT_HSBC_TEXT_ERROR16', 'The CPI cannot communicate with the Secure ePayment engine.');
// max size of fields being sent to HSBC, prevents OSC sending extra data
define('MODULE_PAYMENT_HSBC_MAX_BILLINGADDRESS1', 60);
define('MODULE_PAYMENT_HSBC_MAX_BILLINGADDRESS2', 60); 
define('MODULE_PAYMENT_HSBC_MAX_BILLINGCITY', 25);
define('MODULE_PAYMENT_HSBC_MAX_BILLINGCOUNTRY', 25);
define('MODULE_PAYMENT_HSBC_MAX_BILLINGCOUNTY', 25);
define('MODULE_PAYMENT_HSBC_MAX_BILLINGFIRSTNAME', 32);
define('MODULE_PAYMENT_HSBC_MAX_BILLINGLASTNAME', 32);
define('MODULE_PAYMENT_HSBC_MAX_BILLINGPOSTAL', 20);
define('MODULE_PAYMENT_HSBC_MAX_SHOPPEREMAIL', 64);
define('MODULE_PAYMENT_HSBC_MAX_SHIPPINGADDRESS1', 60);
define('MODULE_PAYMENT_HSBC_MAX_SHIPPINGADDRESS2', 60);
define('MODULE_PAYMENT_HSBC_MAX_SHIPPINGCITY', 25);
define('MODULE_PAYMENT_HSBC_MAX_SHIPPINGCOUNTRY', 25);
define('MODULE_PAYMENT_HSBC_MAX_SHIPPINGCOUNTY', 25);
define('MODULE_PAYMENT_HSBC_MAX_SHIPPINGFIRSTNAME', 32);
define('MODULE_PAYMENT_HSBC_MAX_SHIPPINGLASTNAME', 32);
define('MODULE_PAYMENT_HSBC_MAX_SHIPPINGPOSTAL', 20);
?>
