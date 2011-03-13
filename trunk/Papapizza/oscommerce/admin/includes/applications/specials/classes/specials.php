<?php
/*
  $Id: $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2009 osCommerce

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License v2 (1991)
  as published by the Free Software Foundation.
*/

  class osC_Specials_Admin {
    public static function getData($id) {
      global $osC_Database, $osC_Language;

      $Qspecial = $osC_Database->query('select p.products_id, pd.products_name, p.products_price, s.specials_id, s.specials_new_products_price, s.specials_date_added, s.specials_last_modified, s.expires_date, s.date_status_change, s.status from :table_products p, :table_specials s, :table_products_description pd where s.specials_id = :specials_id and s.products_id = p.products_id and p.products_id = pd.products_id and pd.language_id = :language_id limit 1');
      $Qspecial->bindTable(':table_specials', TABLE_SPECIALS);
      $Qspecial->bindTable(':table_products', TABLE_PRODUCTS);
      $Qspecial->bindTable(':table_products_description', TABLE_PRODUCTS_DESCRIPTION);
      $Qspecial->bindInt(':specials_id', $id);
      $Qspecial->bindInt(':language_id', $osC_Language->getID());
      $Qspecial->execute();

      $data = $Qspecial->toArray();

      $Qspecial->freeResult();

      return $data;
    }

    public static function save($id = null, $data) {
      global $osC_Database;

      $error = false;

      $Qproduct = $osC_Database->query('select has_children, products_price from :table_products where products_id = :products_id limit 1');
      $Qproduct->bindTable(':table_products', TABLE_PRODUCTS);
      $Qproduct->bindInt(':products_id', $data['products_id']);
      $Qproduct->execute();

	  $value = $data['specials_price'];
	  $specials_price = $data['specials_price'];
	  $percentage = false;
	  $variable = $Qproduct->valueInt('has_children') > 0;

      if ( substr($specials_price, -1) == '%' ) {
		$percentage = true;
        $specials_price = $Qproduct->valueDecimal('products_price') - (((double)$specials_price / 100) * $Qproduct->valueDecimal('products_price'));
      }

		if (($specials_price < '0.00' || $specials_price >= $Qproduct->valueDecimal('products_price')) && !$variable) {
        $error = true;

//HPDL        $osC_MessageStack->add($this->_module, ERROR_SPECIALS_PRICE, 'error');
      }

      if ( $data['expires_date'] < $data['start_date'] ) {
        $error = true;

//HPDL        $osC_MessageStack->add($this->_module, ERROR_SPECIALS_DATE, 'error');
      }

      if ( $error === false ) {
        if ( is_numeric($id) ) {
				$Qspecial = $osC_Database->query('update :table_specials set specials_new_products_price = :specials_new_products_price, specials_last_modified = now(), expires_date = :expires_date, start_date = :start_date, status = :status, value = :value, percentage = :percentage where specials_id = :specials_id');
          $Qspecial->bindInt(':specials_id', $id);
        } else {
		  $Qspecial = $osC_Database->query('insert into :table_specials (products_id, specials_new_products_price, specials_date_added, expires_date, start_date, status, value, percentage) values (:products_id, :specials_new_products_price, now(), :expires_date, :start_date, :status, :value, :percentage)');
          $Qspecial->bindInt(':products_id', $data['products_id']);
        }

        $Qspecial->bindTable(':table_specials', TABLE_SPECIALS);
		$Qspecial->bindValue(':specials_new_products_price', $specials_price);
		if($percentage)
			$Qspecial->bindInt(':value', $value);
		else
			$Qspecial->bindFloat(':value', $value);
		$Qspecial->bindInt(':percentage', $percentage);
        $Qspecial->bindDate(':expires_date', $data['expires_date']);
        $Qspecial->bindDate(':start_date', $data['start_date']);
        $Qspecial->bindInt(':status', $data['status']);
        $Qspecial->setLogging($_SESSION['module'], $id);
        $Qspecial->execute();

        if ( $osC_Database->isError() ) {
          $error = true;
        }
      }

	  if ($error === false && $variable)
	  {
		$Qspecial = $osC_Database->query('update :table_products set products_price = 0 where products_id = :products_id and products_price > 0');
		$Qspecial->bindTable(':table_products', TABLE_PRODUCTS);
		$Qspecial->bindInt(':products_id', $data['products_id']);
		$Qspecial->execute();
		
		if($osC_Database->isError())
			$error = true;
      }
	
	  if ($error === false)
		return true;

      return false;
    }

    public static function delete($id) {
      global $osC_Database;

      $Qspecial = $osC_Database->query('delete from :table_specials where specials_id = :specials_id');
      $Qspecial->bindTable(':table_specials', TABLE_SPECIALS);
      $Qspecial->bindInt(':specials_id', $id);
      $Qspecial->setLogging($_SESSION['module'], $id);
      $Qspecial->execute();

      if ( !$osC_Database->isError() ) {
        return true;
      }

      return false;
    }
  }
?>
