<?php
$select = tep_db_query("select * from `ps_status` where `order_id` = 0 AND  `status` = 2 AND `customer_id` = {$_SESSION['customer_id']}");
if (tep_db_num_rows($select)) {
  $result=tep_db_fetch_array($select);
  $old_session = unserialize($result['session']);
  $_SESSION['cart'] = $old_session['cart'];
  $_SESSION = $old_session;
  $payment = 'pagseguro';
  tep_session_register('payment');
  tep_redirect(tep_href_link(FILENAME_CHECKOUT_PROCESS, '', 'SSL'));
}

?>