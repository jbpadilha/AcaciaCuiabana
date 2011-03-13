<?php
/*
  osCommerce Online Merchant $osCommerce-SIG$
  Copyright (c) 2010 osCommerce (http://www.oscommerce.com)

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License v2 (1991)
  as published by the Free Software Foundation.
*/

  function osc_cfg_set_shipping_methods_checkbox_field($default, $key = null) {
    global $osC_Database;


    $name = (empty($key)) ? 'configuration_value' : 'configuration[' . $key . '][]';

    $shipping_array = array();

    $Qshipping = $osC_Database->query('select code, title from :table_templates_boxes where modules_group = :shipping order by title');
    $Qshipping->bindTable(':table_templates_boxes', TABLE_TEMPLATES_BOXES);
    $Qshipping->bindValue(':shipping', 'shipping');
    $Qshipping->execute();

    while ( $Qshipping->next() ) {
      $shipping_array[] = array('id' => $Qshipping->value('code') . '_' . $Qshipping->value('code'),
                                'text' => $Qshipping->value('title'));
    }

    return osc_draw_checkbox_field($name, $shipping_array,  explode(',', $default), null, '<br />');
  }
?>