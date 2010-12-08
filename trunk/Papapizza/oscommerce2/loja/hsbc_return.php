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

  if (isset($_POST['MerchantData'])) 
  {
        $_GET['osCsid']=$_POST['MerchantData'];
        $HTTP_GET_VARS['osCsid']=$_POST['MerchantData'];
  }
  include('includes/application_top.php');
  
  // load selected payment module
  require(DIR_WS_CLASSES . 'payment.php');
  $payment_modules = new payment($payment);
  
  
                reset($_POST);
                $post_2=array();
                
                while(list($k,$v)=each($_POST))
                {
                        if ($k!='OrderHash')
                        {
                                $post_2[$k]=$v;
                        }
                }
                
                $order_hash=$_POST['OrderHash'];
                $hsbc=$GLOBALS['hsbc'];
                $hash=$hsbc->getHash($post_2);
                
                
                if ($order_hash!=$hash) die ("Hacking attempt!");
                
        $CpiResultsCode=$_POST['CpiResultsCode'];

        if ($CpiResultsCode=='0') 
        {
                tep_redirect(tep_href_link(FILENAME_CHECKOUT_SUCCESS, '', 'SSL'));
        }
        
        
        $error=MODULE_PAYMENT_HSBC_TEXT_ERROR1;
        
        switch($CpiResultsCode)
        {
                case 1: $error=MODULE_PAYMENT_HSBC_TEXT_ERROR1; break;
                case 2: $error=MODULE_PAYMENT_HSBC_TEXT_ERROR2; break;
                case 3: $error=MODULE_PAYMENT_HSBC_TEXT_ERROR3; break;
                case 4: $error=MODULE_PAYMENT_HSBC_TEXT_ERROR4; break;
                case 5: $error=MODULE_PAYMENT_HSBC_TEXT_ERROR5; break;
                case 6: $error=MODULE_PAYMENT_HSBC_TEXT_ERROR6; break;
                case 7: $error=MODULE_PAYMENT_HSBC_TEXT_ERROR7; break;
                case 8: $error=MODULE_PAYMENT_HSBC_TEXT_ERROR8; break;
                case 9: $error=MODULE_PAYMENT_HSBC_TEXT_ERROR9; break;
                case 10: $error=MODULE_PAYMENT_HSBC_TEXT_ERROR10; break;
                case 11: $error=MODULE_PAYMENT_HSBC_TEXT_ERROR11; break;
                case 12: $error=MODULE_PAYMENT_HSBC_TEXT_ERROR12; break;
                case 13: $error=MODULE_PAYMENT_HSBC_TEXT_ERROR13; break;
                case 14: $error=MODULE_PAYMENT_HSBC_TEXT_ERROR14; break;
                case 15: $error=MODULE_PAYMENT_HSBC_TEXT_ERROR15; break;
                case 16: $error=MODULE_PAYMENT_HSBC_TEXT_ERROR16; break;                                                
                                                                                                                                                                                                                                
        }
        
        $codes=split(",",MODULE_PAYMENT_HSBC_PENDING_CODES);
        
        
        if (in_array($CpiResultsCode,$codes))
        {
                tep_redirect(tep_href_link(FILENAME_CHECKOUT_SUCCESS, 'error_message=' . urlencode($error), 'SSL', true, false));               
        }       
        
        tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, 'error_message=' . urlencode($error), 'SSL', true, false));
      
?>
