<?php
/*
  MultiCards Payment Module
  $Id: callback.php $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2004 osCommerce
                2005 MultiCards

  Released under the GNU General Public License
*/

  chdir('../../../../');
  require('includes/application_top.php');

  $multicards_processor_ips = array('72.32.75.194', '72.3.254.3'); // secure.multicards.com

  // set order_status_ids, with default order status as fallback
  $order_statuses = array('waiting', 'accepted', 'credited', 'creditrequested', 'declined', 'suspended', 'unknown', 'voided');
  foreach ($order_statuses as $key) {
    $key_constant = constant('MODULE_PAYMENT_MULTICARDS_' . strtoupper($key) . '_ORDER_STATUS_ID');
    $order_status_ids[$key] = ($key_constant > 0) ? $key_constant : DEFAULT_ORDERS_STATUS_ID;
  }

  // check if POST fields are set, their format is correct and if the notification
  // comes from the right place
  function tep_checkFields() {
    global $order_status_ids, $multicards_processor_ips, $HTTP_POST_VARS, $HTTP_SERVER_VARS;
    $error = '';

    // check for required post fields
    $required = array('order_num', 'status', 'reason', 'origin', 'pageid', 'notifyid', 'created',
                      'user2', 'user3', 'total_amount', 'valcode', 'NotificationPassword');
    foreach ($required as $key) {
      if (isset($HTTP_POST_VARS[$key]) == false) {
          $error.="Missing POST field: $key\n";
      }
    }
    if ($error) {
      return $error;
    }

    // check formats
    if (preg_match("/^\d{6}\.(\d{5}|\d{7})$/", $HTTP_POST_VARS['order_num']) == false) {
      $error.="Wrong format for order_num\n";
    }
    if (isset($order_status_ids[$HTTP_POST_VARS['status']]) == false) {
      $error.="Incorrect status\n";
    }
    // numeric fields should be numeric
    $numerics = array('pageid', 'notifyid', 'user2', 'user3');
    foreach ($numerics as $key) {
      if (is_numeric($HTTP_POST_VARS[$key]) == false) {
        $error.="Wrong format for $key\n";
      }
    }
    if ($error) {
      return $error;
    }

    // check if the merchant id is correct
    list($mer_id, $order_id) = explode('.', $HTTP_POST_VARS['order_num']);
    if ($mer_id != MODULE_PAYMENT_MULTICARDS_MERCHANT_ID) {
      $error.="Incorrect MerchantID\n";
    }
    // check if the page id is correct
    if ($HTTP_POST_VARS['pageid'] != MODULE_PAYMENT_MULTICARDS_PAGE_ID) {
      $error.="Incorrect PageID\n";
    }
    // check password
    if ($HTTP_POST_VARS['NotificationPassword'] != MODULE_PAYMENT_MULTICARDS_NOTIFICATION_PASSWORD) {
      $error.="Incorrect NotificationPassword\n";
    }
    // check IP
    $ip = tep_get_ip_address();
    if (in_array($ip, $multicards_processor_ips) == false) {
      $error.='Incorrect IP: '.$ip."\n";
    }
    return $error;
  }

  // main

  $error = tep_checkFields();
  if ($error == false) {
    // process notification

    $order_query = tep_db_query("select currency, currency_value from " . TABLE_ORDERS . " where orders_id = '" . (int)$HTTP_POST_VARS['user3'] . "' and customers_id = '" . (int)$HTTP_POST_VARS['user2'] . "'");
    if (tep_db_num_rows($order_query) > 0) {
      $order = tep_db_fetch_array($order_query);

      $total_query = tep_db_query("select value from " . TABLE_ORDERS_TOTAL . " where orders_id = '" . (int)$HTTP_POST_VARS['user3'] . "' and class = 'ot_total' limit 1");
      $total = tep_db_fetch_array($total_query);

      $order_status_id = $order_status_ids[$HTTP_POST_VARS['status']];

      // comment for order history
      $comment = 'order:  '. $HTTP_POST_VARS['order_num'] . "\n".
                 'amount: ' . $HTTP_POST_VARS['valcode'] . ' ' . $HTTP_POST_VARS['total_amount'] . "\n".
                 'status: ' . $HTTP_POST_VARS['status'] . "\n".
                 'reason: ' . $HTTP_POST_VARS['reason'] . "\n".
                 'origin: ' . $HTTP_POST_VARS['origin'] . "\n".
                 'notifyid: ' . $HTTP_POST_VARS['notifyid'] . "\n".
                 'created: ' . $HTTP_POST_VARS['created'] . "\n\n";

      if ($HTTP_POST_VARS['status'] == 'accepted') {
        // detect inconsistencies in amount / currency
        if ($HTTP_POST_VARS['valcode'] != $order['currency']) {
          $order_status_id = $order_status_ids['voided'];
          $comment.= "WARNING: currency doesn't match with order\n";
          echo("WARNING: currency doesn't match with order\n");
        }
        if ($HTTP_POST_VARS['total_amount'] != number_format($total['value'] * $order['currency_value'], $currencies->get_decimal_places($order['currency']))) {
          $order_status_id = $order_status_ids['voided'];
          $comment.= "WARNING: amount doesn't match with order\n";
          echo("WARNING: amount doesn't match with order\n");
        }
      }

      tep_db_query("update " . TABLE_ORDERS . " set orders_status = '" . $order_status_id . "', last_modified = now() where orders_id = '" . (int)$HTTP_POST_VARS['user3'] . "'");

      $sql_data_array = array('orders_id' => (int)$HTTP_POST_VARS['user3'],
                              'orders_status_id' => $order_status_id,
                              'date_added' => 'now()',
                              'customer_notified' => '0',
                              'comments' => 'MultiCards Notification:' . "\n" . tep_db_input($comment));

      tep_db_perform(TABLE_ORDERS_STATUS_HISTORY, $sql_data_array);
      echo("order status updated\n");
    } else {
      echo("order not found\n");
    }

  } else {
    echo("error(s):\n$error\n");
  }
    
  // for debugging mail POST/GET fields and error(s)
  if (tep_not_null(MODULE_PAYMENT_MULTICARDS_DEBUG_EMAIL)) {
    $email_body = '$HTTP_POST_VARS:' . "\n\n";
    foreach ($HTTP_POST_VARS as $key => $value) {
      $email_body .= $key . '=' . $value . "\n";
    }
    $email_body .= "\n" . '$HTTP_GET_VARS:' . "\n\n";
    foreach ($HTTP_GET_VARS as $key => $value) {
      $email_body .= $key . '=' . $value . "\n";
    }
    $email_subject = 'MultiCards Debug Notification';
    if($error) {
      $email_subject.= ' (errors)';
      $email_body .= "\nerror(s):\n" . $error . "\n";
    }

    tep_mail('', MODULE_PAYMENT_MULTICARDS_DEBUG_EMAIL, $email_subject, $email_body, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
  }

  require('includes/application_bottom.php');
?>
