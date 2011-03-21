<?php
/*
  $Id: $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2007 osCommerce

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License v2 (1991)
  as published by the Free Software Foundation.
*/

  class osC_Suburbs {
	
    public static function getSuburbs($id) {
    	global $osC_Database;  
          $Qsuburbs = $osC_Database->query('select suburbs_id as id, suburbs_name as name, suburbs_price as price from :table_suburbs where suburbs_id = :suburbs_id');
          $Qsuburbs->bindTable(':table_suburbs', TABLE_SUBURBS);
          $Qsuburbs->bindInt(':suburbs_id', $id);
          $Qsuburbs->execute();
          return $Qsuburbs->toArray();
    }
  }
?>
