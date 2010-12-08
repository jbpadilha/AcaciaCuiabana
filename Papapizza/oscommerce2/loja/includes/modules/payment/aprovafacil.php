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

  class aprovafacil {
    var $code, $title, $description, $enabled;

// class constructor
    function aprovafacil() {
      global $order;

      $this->code = 'aprovafacil';
      $this->title = MODULE_PAYMENT_APROVAFACIL_TEXT_TITLE;
      $this->description = MODULE_PAYMENT_APROVAFACIL_TEXT_DESCRIPTION;
      $this->sort_order = MODULE_PAYMENT_APROVAFACIL_SORT_ORDER;
      $this->enabled = ((MODULE_PAYMENT_APROVAFACIL_STATUS == 'True') ? true : false);

      if ((int)MODULE_PAYMENT_APROVAFACIL_ORDER_STATUS_ID > 0) {
        $this->order_status = MODULE_PAYMENT_APROVAFACIL_ORDER_STATUS_ID;
      }

      if (is_object($order)) $this->update_status();

      $this->form_action_url = tep_href_link(FILENAME_CHECKOUT_PROCESS, '', 'SSL', true);
    }

// class methods
    function update_status() {
      global $order;

      if ( ($this->enabled == true) && ((int)MODULE_PAYMENT_APROVAFACIL_ZONE > 0) ) {
        $check_flag = false;
        $check_query = tep_db_query("select zone_id from " . TABLE_ZONES_TO_GEO_ZONES . " where geo_zone_id = '" . MODULE_PAYMENT_APROVAFACIL_ZONE . "' and zone_country_id = '" . $order->billing['country']['id'] . "' order by zone_id");
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
      $js = '  if (payment_value == "' . $this->code . '") {' . "\n" .
            '    var cc_owner = document.checkout_payment.ipayment_cc_owner.value;' . "\n" .
            '    var cc_number = document.checkout_payment.ipayment_cc_number.value;' . "\n" .
            '    if (cc_owner == "" || cc_owner.length < ' . CC_OWNER_MIN_LENGTH . ') {' . "\n" .
            '      error_message = error_message + "' . MODULE_PAYMENT_APROVAFACIL_TEXT_JS_CC_OWNER . '";' . "\n" .
            '      error = 1;' . "\n" .
            '    }' . "\n" .
            '    if (cc_number == "" || cc_number.length < ' . CC_NUMBER_MIN_LENGTH . ') {' . "\n" .
            '      error_message = error_message + "' . MODULE_PAYMENT_APROVAFACIL_TEXT_JS_CC_NUMBER . '";' . "\n" .
            '      error = 1;' . "\n" .
            '    }' . "\n" .
            '  }' . "\n";

      return $js;
    }

    function selection() {
      global $order;

      for ($i=1; $i < 13; $i++) {
        $expires_month[] = array('id' => sprintf('%02d', $i), 'text' => sprintf('%02d', $i));
      }

      $today = getdate(); 
      for ($i=$today['year']; $i < $today['year']+10; $i++) {
        $expires_year[] = array('id' => strftime('%y',mktime(0,0,0,1,1,$i)), 'text' => strftime('%Y',mktime(0,0,0,1,1,$i)));
      }

      for ($i=1; $i <= MODULE_PAYMENT_APROVAFACIL_MAXPARCELAS; $i++) {
        $parcelas[] = array('id' => sprintf('%02d', $i), 'text' => sprintf('%02d', $i));
      }

      $selection = array('id' => $this->code,
                         'module' => $this->title,
                         'fields' => array(array('title' => MODULE_PAYMENT_APROVAFACIL_TEXT_CREDIT_CARD_NUMBER,
                                                 'field' => tep_draw_input_field('NumeroCartao')),
                                           array('title' => MODULE_PAYMENT_APROVAFACIL_TEXT_CREDIT_CARD_EXPIRES,
                                                 'field' => tep_draw_pull_down_menu('MesValidade', $expires_month) . '&nbsp;' . tep_draw_pull_down_menu('AnoValidade', $expires_year)),
                                           array('title' => MODULE_PAYMENT_APROVAFACIL_TEXT_CREDIT_CARD_CHECKNUMBER,
                                                 'field' => tep_draw_input_field('CodigoSeguranca', '', 'size="6" maxlength="5"') . '&nbsp;<small>' . MODULE_PAYMENT_APROVAFACIL_TEXT_CREDIT_CARD_CHECKNUMBER_LOCATION . '</small>'),
                                           array('title' => MODULE_PAYMENT_APROVAFACIL_TEXT_PARCELAS,
                                                 'field' => tep_draw_pull_down_menu('QuantidadeParcelas', $parcelas))));

      return $selection;
    }

    function pre_confirmation_check() {
      global $HTTP_POST_VARS;

      include(DIR_WS_CLASSES . 'cc_validation.php');

      $cc_validation = new cc_validation();
      $result = $cc_validation->validate($HTTP_POST_VARS['NumeroCartao'], $HTTP_POST_VARS['MesValidade'], $HTTP_POST_VARS['AnoValidade']);

      $error = '';
      switch ($result) {
        case -1:
          $error = sprintf(TEXT_CCVAL_ERROR_UNKNOWN_CARD, substr($cc_validation->cc_number, 0, 4));
          break;
        case -2:
        case -3:
        case -4:
          $error = TEXT_CCVAL_ERROR_INVALID_DATE;
          break;
        case false:
          $error = TEXT_CCVAL_ERROR_INVALID_NUMBER;
          break;
      }

      if ( ($result == false) || ($result < 1) ) {
        $payment_error_return = 'payment_error=' . $this->code . '&error=' . urlencode($error) . '&MesValidade=' . $HTTP_POST_VARS['MesValidade'] . '&AnoValidade=' . $HTTP_POST_VARS['AnoValidade'] . '&CodigoSeguranca=' . $HTTP_POST_VARS['CodigoSeguranca'] . '&QuantidadeParcelas=' . $HTTP_POST_VARS['QuantidadeParcelas'];

        tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, $payment_error_return, 'SSL', true, false));
      }

      $this->cc_card_type = $cc_validation->cc_type;
      $this->cc_card_number = $cc_validation->cc_number;
      $this->cc_expiry_month = $cc_validation->cc_expiry_month;
      $this->cc_expiry_year = $cc_validation->cc_expiry_year;
    }

    function confirmation() {
      global $HTTP_POST_VARS;

      $confirmation = array('title' => $this->title . ': ' . $this->cc_card_type,
                            'fields' => array(array('title' => MODULE_PAYMENT_APROVAFACIL_TEXT_CREDIT_CARD_NUMBER,
                                                    'field' => substr($this->cc_card_number, 0, 4) . str_repeat('X', (strlen($this->cc_card_number) - 8)) . substr($this->cc_card_number, -4)),
                                              array('title' => MODULE_PAYMENT_APROVAFACIL_TEXT_CREDIT_CARD_EXPIRES,
                                                    'field' => strftime('%B, %Y', mktime(0,0,0,$HTTP_POST_VARS['MesValidade'], 1, '20' . $HTTP_POST_VARS['AnoValidade']))),
                                              array('title' => MODULE_PAYMENT_APROVAFACIL_TEXT_CREDIT_CARD_CHECKNUMBER,
                                                    'field' => $HTTP_POST_VARS['CodigoSeguranca']),
                                              array('title' => MODULE_PAYMENT_APROVAFACIL_TEXT_PARCELAS,
                                                    'field' => $HTTP_POST_VARS['QuantidadeParcelas'])));

      return $confirmation;
    }

    function process_button() {
      global $HTTP_POST_VARS, $order, $currencies, $currency;

      $process_button_string = tep_draw_hidden_field('ValorDocumento', $order->info['total']) .
                               tep_draw_hidden_field('MesValidade', $HTTP_POST_VARS['MesValidade']) .
                               tep_draw_hidden_field('AnoValidade', $HTTP_POST_VARS['AnoValidade']) .
                               tep_draw_hidden_field('NumeroCartao', $HTTP_POST_VARS['NumeroCartao']) .
                               tep_draw_hidden_field('CodigoSeguranca', $HTTP_POST_VARS['CodigoSeguranca']) .
                               tep_draw_hidden_field('QuantidadeParcelas', $HTTP_POST_VARS['QuantidadeParcelas']);

      return $process_button_string;
    }

    function before_process() {
      global $HTTP_POST_VARS, $order;

      $urlapf = MODULE_PAYMENT_APROVAFACIL_CGI . "/APC?" . 'NumeroCartao=' . $HTTP_POST_VARS['NumeroCartao'] .
                                                           '&MesValidade=' . $HTTP_POST_VARS['MesValidade'] .
                                                           '&AnoValidade=' . $HTTP_POST_VARS['AnoValidade'] .
                                                           '&CodigoSeguranca=' . $HTTP_POST_VARS['CodigoSeguranca'] .
                                                           '&QuantidadeParcelas=' . $HTTP_POST_VARS['QuantidadeParcelas'] .
                                                           '&ValorDocumento=' . $HTTP_POST_VARS['ValorDocumento'];

      $resultadotransacao = file($urlapf);

      if (substr($resultadotransacao[2], 0, 4) == 'True') {
           $order->info['cc_number'] = substr($resultadotransacao[11], 0, 14);
           $order->info['cc_owner'] = substr($resultadotransacao[8], 0, 6);
      }
      else {
           tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, 'payment_error=' . $this->code, 'SSL', true));
      }

      return true;
    }

    function after_process() {
      global $HTTP_POST_VARS, $order;

      $urlapf = MODULE_PAYMENT_APROVAFACIL_CGI . "/CAP?" . 'Transacao=' . $order->info['cc_number'];

      $resultadotransacao = file($urlapf);

      return true;
    }

    function get_error() {
      global $HTTP_GET_VARS;

      $error = array('title' => APROVAFACIL_ERROR_HEADING,
                     'error' => ((isset($HTTP_GET_VARS['error'])) ? stripslashes(urldecode($HTTP_GET_VARS['error'])) : APROVAFACIL_ERROR_MESSAGE));

      return $error;
    }

    function check() {
      if (!isset($this->_check)) {
        $check_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_APROVAFACIL_STATUS'");
        $this->_check = tep_db_num_rows($check_query);
      }
      return $this->_check;
    }

    function install() {
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (".
                   "configuration_title, configuration_key, configuration_value, ".
                   "configuration_description, configuration_group_id, sort_order, ".
                   "set_function, date_added".
                   ") values (".
                   "'Aprovação de Cartões de Crédito - Aprova Fácil', 'MODULE_PAYMENT_APROVAFACIL_STATUS', 'True', ".
                   "'Você deseja aprovar cartões de crédito utilizando o Aprova Fácil?', '6', '1', ".
                   "'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");

      tep_db_query("insert into " . TABLE_CONFIGURATION . " (".
                   "configuration_title, configuration_key, configuration_value, ".
                   "configuration_description, configuration_group_id, sort_order, ".
                   "date_added".
                   ") values (".
                   "'URL CGI Aprova Fácil', 'MODULE_PAYMENT_APROVAFACIL_CGI', '" . HTTPS_CATALOG_SERVER . "/cgi-bin/CBEAPF', ".
                   "'Informar a URL do CGI do Aprova Fácil em seu site.', '6', '2', ".
                   "now())");

      tep_db_query("insert into " . TABLE_CONFIGURATION . " (".
                   "configuration_title, configuration_key, configuration_value, ".
                   "configuration_description, configuration_group_id, sort_order, ".
                   "set_function, date_added".
                   ") values (".
                   "'Quantidade Máxima Parcelas', 'MODULE_PAYMENT_APROVAFACIL_MAXPARCELAS', '1', ".
                   "'Você deseja efetuar vendas parceladas em até quantas parcelas?', '6', '3', ".
                   "'tep_cfg_select_option(array(\'1\', \'2\', \'3\', \'4\', \'5\', \'6\'), ', now())");

      tep_db_query("insert into " . TABLE_CONFIGURATION . " (".
                   "configuration_title, configuration_key, configuration_value, ".
                   "configuration_description, configuration_group_id, sort_order, ".
                   "use_function, set_function, date_added".
                   ") values (".
                   "'Zonas suportadas', 'MODULE_PAYMENT_APROVAFACIL_ZONE', '0', ".
                   "'Se uma zona for selecionada, somente este meio de pagamento estará disponível para esta zona.', '6', '4', ".
                   "'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes(', now())");

      tep_db_query("insert into " . TABLE_CONFIGURATION . " (".
                   "configuration_title, configuration_key, configuration_value, ".
                   "configuration_description, configuration_group_id, sort_order, ".
                   "use_function, set_function, date_added".
                   ") values (".
                   "'Status dos pedidos', 'MODULE_PAYMENT_APROVAFACIL_ORDER_STATUS_ID', '2', ".
                   "'Atualiza o status dos pedidos efetuados por este módulo de pagamento para este valor.', '6', '5', ".
                   "'tep_get_order_status_name', 'tep_cfg_pull_down_order_statuses(', now())");


      tep_db_query("insert into " . TABLE_CONFIGURATION . " (".
                   "configuration_title, configuration_key, configuration_value, ".
                   "configuration_description, configuration_group_id, sort_order, ".
                   "date_added".
                   ") values (".
                   "'Ordem de exibição', 'MODULE_PAYMENT_APROVAFACIL_SORT_ORDER', '0', ".
                   "'Determina a ordem de exibição do meio de pagamento.', '6', '6', ".
                   "now())");
    }

    function remove() {
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      return array('MODULE_PAYMENT_APROVAFACIL_STATUS', 'MODULE_PAYMENT_APROVAFACIL_CGI', 'MODULE_PAYMENT_APROVAFACIL_MAXPARCELAS',
                   'MODULE_PAYMENT_APROVAFACIL_ZONE', 'MODULE_PAYMENT_APROVAFACIL_ORDER_STATUS_ID', 
                   'MODULE_PAYMENT_APROVAFACIL_SORT_ORDER');
    }
  }
?>
