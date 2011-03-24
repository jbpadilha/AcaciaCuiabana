<?php
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' ); 
/**
*
* @version $Id: english.php 1071 2007-12-03 08:42:28Z thepisu $
* @package VirtueMart
* @subpackage languages
* @copyright Copyright (C) 2004-2007 soeren - All rights reserved.
* @translator soeren
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See /administrator/components/com_virtuemart/COPYRIGHT.php for copyright notices and details.
* Translated by Mohammad Hosin Fazeli
* http://virtuemart.net
*/
global $VM_LANG;
$langvars = array (
	'CHARSET' => 'utf-8',
	'PHPSHOP_COUPON_EDIT_HEADER' => 'بروز رساني كوپن ',
	'PHPSHOP_COUPON_CODE_HEADER' => 'كد',
	'PHPSHOP_COUPON_PERCENT_TOTAL' => 'درصد يا كل',
	'PHPSHOP_COUPON_TYPE' => 'نوع كوپن ',
	'PHPSHOP_COUPON_TYPE_TOOLTIP' => 'كوپن  هديه بعد از اعمال تخفيف آن در سفارش حذف مي گردد ، ولي كوپن  دائمي به دفعات مورد دلخواه قابل استفاده مي باشد.',
	'PHPSHOP_COUPON_TYPE_GIFT' => 'كوپن  هديه',
	'PHPSHOP_COUPON_TYPE_PERMANENT' => 'كوپن  دائمي',
	'PHPSHOP_COUPON_VALUE_HEADER' => 'ارزش',
	'PHPSHOP_COUPON_PERCENT' => 'درصد',
	'PHPSHOP_COUPON_TOTAL' => 'كل',
); $VM_LANG->initModule( 'coupon', $langvars );
?>