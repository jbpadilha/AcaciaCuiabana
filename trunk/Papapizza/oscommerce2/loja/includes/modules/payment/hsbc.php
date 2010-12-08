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

  class hsbc {
    var $code, $title, $description, $enabled;

// class constructor
    function hsbc() {
      global $order, $request_type;

      $this->code = 'hsbc';
      $this->title = MODULE_PAYMENT_HSBC_TEXT_TITLE;
      $this->description = MODULE_PAYMENT_HSBC_TEXT_DESCRIPTION;
      $this->enabled = ((MODULE_PAYMENT_HSBC_STATUS == 'True') ? true : false);
      $this->sort_order = MODULE_PAYMENT_HSBC_SORT_ORDER;

      if ((int)MODULE_PAYMENT_HSBC_ORDER_STATUS_ID > 0) {
        $this->order_status = MODULE_PAYMENT_HSBC_ORDER_STATUS_ID;
      }

      if (is_object($order)) $this->update_status();

      $this->form_action_url = MODULE_PAYMENT_HSBC_CPIURL;
    }

// class methods
    function update_status() {
      global $order;

      if ( ($this->enabled == true) && ((int)MODULE_PAYMENT_HSBC_ZONE > 0) ) {
        $check_flag = false;
        $check_query = tep_db_query("select zone_id from " . TABLE_ZONES_TO_GEO_ZONES . " where geo_zone_id = '" . MODULE_PAYMENT_HSBC_ZONE . "' and zone_country_id = '" . $order->billing['country']['id'] . "' order by zone_id");
        while ($check = tep_db_fetch_array($check_query)) {
          if ($check['zone_id'] < 1) {
            $check_flag = true;
            break;
          } elseif ($check['zone_id'] == $order->billing['zone_id']) {
            $check_flag = true;
            break;
          }
        }

        if ($check_flag == false) {
          $this->enabled = false;
        }
      }         
    }

    function javascript_validation() {
      return false;
    }

    function selection() {
      return array('id' => $this->code,
                   'module' => $this->title);
    }

    function pre_confirmation_check() {
      return false;
    }

    function confirmation() {
      return false;
    }
        
        //Function to generate a hash to perform the POST or to check received parameters
        function getHash($fields)
        {
                $cmd="";
                reset($fields);
                while(list($k,$v)=each($fields))
                {
                        $cmd.=" \"$v\" ";
                }
          
                //Path where the TestHash.e executable is located
                $path='/home/wakie/public_html/catalog/cgi-bin/hsbc';    
                
                putenv("LD_LIBRARY_PATH=$path");
                
                //Executes the TestHash to get the hash
                $cmd="$path/TestHash.e \"".MODULE_PAYMENT_HSBC_HASH."\" $cmd 2>&1";

                $ret=exec($cmd, $output);
                         
                $ret=split(':',$ret);
                
                //Returns the hash
                $hash=trim($ret[1]);                    
                return($hash);
        }

    function process_button() 
    {
      global $order, $currency;
      
$country_codes=array
(
'AF'=>'004',
'AL'=>'008',
'DZ'=>'012',
'AS'=>'016',
'AD'=>'020',
'AO'=>'024',
'AI'=>'660',
'AQ'=>'010',
'AG'=>'028',
'AR'=>'032',
'AM'=>'051',
'AW'=>'533',
'AU'=>'036',
'AT'=>'040',
'AZ'=>'031',
'BS'=>'044',
'BH'=>'048',
'BD'=>'050',
'BB'=>'052',
'BY'=>'112',
'BE'=>'056',
'BZ'=>'084',
'BJ'=>'204',
'BM'=>'060',
'BT'=>'064',
'BO'=>'068',
'BA'=>'070',
'BW'=>'072',
'BV'=>'074',
'BR'=>'076',
'IO'=>'086',
'BN'=>'096',
'BG'=>'100',
'BF'=>'854',
'BI'=>'108',
'KH'=>'116',
'CM'=>'120',
'CA'=>'124',
'CV'=>'132',
'KY'=>'136',
'CF'=>'140',
'TD'=>'148',
'CL'=>'152',
'CN'=>'156',
'CX'=>'162',
'CC'=>'166',
'CO'=>'170',
'KM'=>'174',
'CG'=>'178',
'CK'=>'184',
'CR'=>'188',
'CI'=>'384',
'HR'=>'191',
'CU'=>'192',
'CY'=>'196',
'CZ'=>'203',
'DK'=>'208',
'DJ'=>'262',
'DM'=>'212',
'DO'=>'214',
'TP'=>'626',
'EC'=>'218',
'EG'=>'818',
'SV'=>'222',
'GQ'=>'226',
'ER'=>'232',
'EE'=>'233',
'ET'=>'231',
'FK'=>'238',
'FO'=>'234',
'FJ'=>'242',
'FI'=>'246',
'FR'=>'250',
'GF'=>'254',
'PF'=>'258',
'TF'=>'260',
'GA'=>'266',
'GM'=>'270',
'GE'=>'268',
'DE'=>'276',
'GH'=>'288',
'GI'=>'292',
'GR'=>'300',
'GL'=>'304',
'GD'=>'308',
'GP'=>'312',
'GU'=>'316',
'GT'=>'320',
'GN'=>'324',
'GW'=>'624',
'GY'=>'328',
'HT'=>'332',
'HM'=>'334',
'HN'=>'340',
'HK'=>'344',
'HU'=>'348',
'IS'=>'352',
'IN'=>'356',
'ID'=>'360',
'IR'=>'364',
'IQ'=>'368',
'IE'=>'372',
'IL'=>'376',
'IT'=>'380',
'JM'=>'388',
'JP'=>'392',
'JO'=>'400',
'KZ'=>'398',
'KE'=>'404',
'KI'=>'296',
'KP'=>'408',
'KW'=>'414',
'KG'=>'417',
'LA'=>'418',
'LV'=>'428',
'LB'=>'422',
'LS'=>'426',
'LR'=>'430',
'LY'=>'434',
'LI'=>'438',
'LT'=>'440',
'LU'=>'442',
'MO'=>'446',
'MK'=>'807',
'MG'=>'450',
'MW'=>'454',
'MY'=>'458',
'MV'=>'462',
'ML'=>'466',
'MT'=>'470',
'MH'=>'584',
'MQ'=>'474',
'MR'=>'478',
'MU'=>'480',
'YT'=>'175',
'MX'=>'484',
'MD'=>'498',
'MC'=>'492',
'MN'=>'496',
'MS'=>'500',
'MA'=>'504',
'MZ'=>'508',
'MM'=>'104',
'NA'=>'516',
'NR'=>'520',
'NP'=>'524',
'AN'=>'530',
'NL'=>'528',
'NC'=>'540',
'NZ'=>'554',
'NI'=>'558',
'NE'=>'562',
'NG'=>'566',
'NU'=>'570',
'NF'=>'574',
'MP'=>'580',
'NO'=>'578',
'OM'=>'512',
'PK'=>'586',
'PW'=>'585',
'PA'=>'591',
'PG'=>'598',
'PY'=>'600',
'PE'=>'604',
'PH'=>'608',
'PN'=>'612',
'PL'=>'616',
'PT'=>'620',
'PR'=>'630',
'QA'=>'634',
'RE'=>'638',
'RO'=>'642',
'RU'=>'643',
'RW'=>'646',
'WS'=>'882',
'SM'=>'674',
'ST'=>'678',
'SA'=>'682',
'SN'=>'686',
'SC'=>'690',
'SL'=>'694',
'SG'=>'702',
'SK'=>'703',
'SI'=>'705',
'SB'=>'090',
'SO'=>'706',
'ZA'=>'710',
'GS'=>'239',
'ES'=>'724',
'LK'=>'144',
'SH'=>'654',
'KN'=>'659',
'LC'=>'662',
'PM'=>'666',
'VC'=>'670',
'SD'=>'736',
'SR'=>'740',
'SJ'=>'744',
'SZ'=>'748',
'SE'=>'752',
'CH'=>'756',
'SY'=>'760',
'TW'=>'158',
'TJ'=>'762',
'TZ'=>'834',
'TH'=>'764',
'TG'=>'768',
'TK'=>'772',
'TO'=>'776',
'TT'=>'780',
'TN'=>'788',
'TR'=>'792',
'TM'=>'795',
'TC'=>'796',
'TV'=>'798',
'VI'=>'850',
'UG'=>'800',
'UA'=>'804',
'AE'=>'784',
'GB'=>'826',
'UM'=>'581',
'US'=>'840',
'UY'=>'858',
'UZ'=>'860',
'VU'=>'548',
'VA'=>'336',
'VE'=>'862',
'VN'=>'704',
'WF'=>'876',
'EH'=>'732',
'YE'=>'887',
'YU'=>'891',
'ZM'=>'894',
'ZW'=>'716'
);
      

      
      //Currency code setup
      $currency_code = $currency;
      if (!in_array($currency_code, array('EUR', 'GBP', 'HKD', 'JPY', 'USD'))) {
        $currency_code = 'USD';
      }
      $curr=array('EUR'=>978,'HKD'=>344,'JPY'=>392,'GBP'=>826,'USD'=>840);
      
      $currency_code=$curr[$currency_code];
        
      //Total setup without .     
      $total=$order->info['total'];
          
      $total=round($total*$order->info['currency_value'],2);
      $total=number_format($total, 2, '.', '');
      

      //Generation of the order_id  
      srand ((float) microtime() * 10000000);
      $r1 = rand(100,999);
      $t1 = date("yz-his");

      //This sequence generation is valid only for Lynda's shop
      $sequence = $t1.$r1;
      
      //So just place some string here and that's all
      //Order ID will be generated when the order is made after payment
      $sequence = "Order $t1";
      
      

          
      //POST time
      $time=time();

      //Change the 0 if your server is located at a different GMT time  
      $time=($time+(0*3600));
      $time=$time*1000;
	     
if (! defined('MODULE_PAYMENT_HSBC_MAX_BILLINGADDRESS1'))   { define('MODULE_PAYMENT_HSBC_MAX_BILLINGADDRESS1', 60); }
if (! defined('MODULE_PAYMENT_HSBC_MAX_BILLINGADDRESS2'))   { define('MODULE_PAYMENT_HSBC_MAX_BILLINGADDRESS2', 60); }
if (! defined('MODULE_PAYMENT_HSBC_MAX_BILLINGCITY'))       { define('MODULE_PAYMENT_HSBC_MAX_BILLINGCITY', 25); }
if (! defined('MODULE_PAYMENT_HSBC_MAX_BILLINGCOUNTRY'))    { define('MODULE_PAYMENT_HSBC_MAX_BILLINGCOUNTRY', 25); }
if (! defined('MODULE_PAYMENT_HSBC_MAX_BILLINGCOUNTY'))     { define('MODULE_PAYMENT_HSBC_MAX_BILLINGCOUNTY', 25); }
if (! defined('MODULE_PAYMENT_HSBC_MAX_BILLINGFIRSTNAME'))  { define('MODULE_PAYMENT_HSBC_MAX_BILLINGFIRSTNAME', 32); }
if (! defined('MODULE_PAYMENT_HSBC_MAX_BILLINGLASTNAME'))   { define('MODULE_PAYMENT_HSBC_MAX_BILLINGLASTNAME', 32); }
if (! defined('MODULE_PAYMENT_HSBC_MAX_BILLINGPOSTAL'))     { define('MODULE_PAYMENT_HSBC_MAX_BILLINGPOSTAL', 20); }
if (! defined('MODULE_PAYMENT_HSBC_MAX_SHOPPEREMAIL'))      { define('MODULE_PAYMENT_HSBC_MAX_SHOPPEREMAIL', 64); }

if (! defined('MODULE_PAYMENT_HSBC_MAX_SHIPPINGADDRESS1'))  { define('MODULE_PAYMENT_HSBC_MAX_SHIPPINGADDRESS1', 60); }
if (! defined('MODULE_PAYMENT_HSBC_MAX_SHIPPINGADDRESS2'))  { define('MODULE_PAYMENT_HSBC_MAX_SHIPPINGADDRESS2', 60); }
if (! defined('MODULE_PAYMENT_HSBC_MAX_SHIPPINGCITY'))      { define('MODULE_PAYMENT_HSBC_MAX_SHIPPINGCITY', 25); }
if (! defined('MODULE_PAYMENT_HSBC_MAX_SHIPPINGCOUNTRY'))   { define('MODULE_PAYMENT_HSBC_MAX_SHIPPINGCOUNTRY', 25); }
if (! defined('MODULE_PAYMENT_HSBC_MAX_SHIPPINGCOUNTY'))    { define('MODULE_PAYMENT_HSBC_MAX_SHIPPINGCOUNTY', 25); }
if (! defined('MODULE_PAYMENT_HSBC_MAX_SHIPPINGFIRSTNAME')) { define('MODULE_PAYMENT_HSBC_MAX_SHIPPINGFIRSTNAME', 32); }
if (! defined('MODULE_PAYMENT_HSBC_MAX_SHIPPINGLASTNAME'))  { define('MODULE_PAYMENT_HSBC_MAX_SHIPPINGLASTNAME', 32); }
if (! defined('MODULE_PAYMENT_HSBC_MAX_SHIPPINGPOSTAL'))    { define('MODULE_PAYMENT_HSBC_MAX_SHIPPINGPOSTAL', 20); }


      $post_1=array(
                               'CpiDirectResultUrl'=>tep_href_link('checkout_process.php', '', 'SSL', false),
                               'CpiReturnUrl'=>tep_href_link('hsbc_return.php', '', 'SSL', false),
                               'OrderDesc'=>STORE_NAME . ' order',
                               'OrderId'=>$sequence,
                               'PurchaseAmount'=>preg_replace('/\./', '', $total),
                               'PurchaseCurrency'=>$currency_code,
                               'StorefrontId'=>MODULE_PAYMENT_HSBC_ID,
                               'TimeStamp'=>$time,
                               'TransactionType'=>'Capture',
                               'MerchantData'=>tep_session_id()
                               ,
                               'BillingAddress1'=>substr($order->billing['street_address'],0,MODULE_PAYMENT_HSBC_MAX_BILLINGADDRESS1),							   
                               'BillingCity'=>substr($order->billing['city'],0,MODULE_PAYMENT_HSBC_MAX_BILLINGCITY),							   
                               //'BillingCountry'=>$order->billing['country']['title'],							   
			       'BillingCountry'=>$country_codes[$order->billing['country']['iso_code_2']],
                               'BillingCounty'=>substr($order->billing['state'],0,MODULE_PAYMENT_HSBC_MAX_BILLINGCOUNTY),							   
                               'BillingFirstName'=>substr($order->billing['firstname'],0,MODULE_PAYMENT_HSBC_MAX_BILLINGFIRSTNAME),
                               'BillingLastName'=>substr($order->billing['lastname'],0,MODULE_PAYMENT_HSBC_MAX_BILLINGLASTNAME),
                               'BillingPostal'=>substr($order->billing['postcode'],0,MODULE_PAYMENT_HSBC_MAX_BILLINGPOSTAL),
                               'ShopperEmail'=>substr($order->customer['email_address'],0,MODULE_PAYMENT_HSBC_MAX_SHOPPEREMAIL),
                               'ShippingAddress1'=>substr($order->delivery['street_address'],0,MODULE_PAYMENT_HSBC_MAX_SHIPPINGADDRESS1),							   
                               'ShippingCity'=>substr($order->delivery['city'],0,MODULE_PAYMENT_HSBC_MAX_SHIPPINGCITY),							   
                               //'ShippingCountry'=>$order->delivery['country']['title'],							   
			       'ShippingCountry'=>$country_codes[$order->delivery['country']['iso_code_2']],							   
                               'ShippingCounty'=>substr($order->delivery['state'],0,MODULE_PAYMENT_HSBC_MAX_SHIPPINGCOUNTY),							   
                               'ShippingFirstName'=>substr($order->delivery['firstname'],0,MODULE_PAYMENT_HSBC_MAX_SHIPPINGFIRSTNAME),
                               'ShippingLastName'=>substr($order->delivery['lastname'],0,MODULE_PAYMENT_HSBC_MAX_SHIPPINGLASTNAME),
                               'ShippingPostal'=>substr($order->delivery['postcode'],0,MODULE_PAYMENT_HSBC_MAX_SHIPPINGPOSTAL)
                               
							   );							   
          
      //Test Order                         
      if (MODULE_PAYMENT_HSBC_TESTMODE == 'Test') $post_1['Mode']='T';
      else $post_1['Mode']='P';
                                                           
          reset($post_1);
          
  
      //Sets hidden fields on the form 
          $cmd="";
          $process_button_string='';
          while(list($k,$v)=each($post_1))
          {
                  $process_button_string.=tep_draw_hidden_field($k,$v);
          }
          
          
          //Gets the hash
          $hash=$this->getHash($post_1);
          
          $process_button_string.=tep_draw_hidden_field('OrderHash', $hash);

      return $process_button_string;

    }

    function before_process() 
    {
        global $order;

                reset($_POST);
                $post_2=array();
                
                while(list($k,$v)=each($_POST))
                {
                        if ($k!='OrderHash')
                        {
                                $post_2[$k]=$v;
                        }
                }
                
                //Gets the hash to see if there is a hacking atempt
                $order_hash=$_POST['OrderHash'];
                $hash=$this->getHash($post_2);
                
                if ($order_hash!=$hash) die ("Hacking atempt!");
                
        //Depending on the results code, process the POST
        $CpiResultsCode=$_POST['CpiResultsCode'];

        if ($CpiResultsCode=='0') 
        {
                return;
        }
        
        $codes=split(",",MODULE_PAYMENT_HSBC_PENDING_CODES);
        
        
        if (in_array($CpiResultsCode,$codes))
        {
                $order->info['order_status']=4;
                return;
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
        
        tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, 'error_message=' . urlencode($error), 'SSL', true, false));
      
        return false;
    }

    function after_process() {
      return false;
    }

    function output_error() {
      return false;
    }

    function check() {
      if (!isset($this->_check)) {
        $check_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_HSBC_STATUS'");
        $this->_check = tep_db_num_rows($check_query);
      }
      return $this->_check;
    }

    function install() {
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable HSBC Module', 'MODULE_PAYMENT_HSBC_STATUS', 'True', 'Do you want to accept HSBC payments?', '6', '0', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Client ID or Alias', 'MODULE_PAYMENT_HSBC_ID', 'none', 'The client ID or Alias used for the HSBC service.', '6', '0', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Hash Key', 'MODULE_PAYMENT_HSBC_HASH', 'none', 'The Hash key used to generate the HASH.', '6', '0', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Pending Error Codes', 'MODULE_PAYMENT_HSBC_PENDING_CODES', '', 'The error codes that will be treated as pending, instead error, so the order will be stored on the shop.', '6', '0', now())");      
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Transaction Mode', 'MODULE_PAYMENT_HSBC_TESTMODE', 'Test', 'Transaction mode used for processing orders.', '6', '0', 'tep_cfg_select_option(array(\'Test\', \'Production\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('CPI URL', 'MODULE_PAYMENT_HSBC_CPIURL', 'https://', 'The full URL of the CPI provided by HSBC.', '6', '0', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort order of display.', 'MODULE_PAYMENT_HSBC_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Payment Zone', 'MODULE_PAYMENT_HSBC_ZONE', '0', 'If a zone is selected, only enable this payment method for that zone.', '6', '2', 'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes(', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('Set Order Status', 'MODULE_PAYMENT_HSBC_ORDER_STATUS_ID', '0', 'Set the status of orders made with this payment module to this value.', '6', '0', 'tep_cfg_pull_down_order_statuses(', 'tep_get_order_status_name', now())");
    }

    function remove() {
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      return array('MODULE_PAYMENT_HSBC_STATUS', 'MODULE_PAYMENT_HSBC_ID', 'MODULE_PAYMENT_HSBC_HASH', 'MODULE_PAYMENT_HSBC_PENDING_CODES', 'MODULE_PAYMENT_HSBC_TESTMODE', 'MODULE_PAYMENT_HSBC_CPIURL', 'MODULE_PAYMENT_HSBC_SORT_ORDER', 'MODULE_PAYMENT_HSBC_ZONE', 'MODULE_PAYMENT_HSBC_ORDER_STATUS_ID');
    }
  }
?>
