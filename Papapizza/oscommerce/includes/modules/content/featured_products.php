<?php
/*
  $Id: $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2006 osCommerce

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License v2 (1991)
  as published by the Free Software Foundation.
*/

  class osC_Content_featured_products extends osC_Modules {
    var $_title,
        $_code = 'featured_products',
        $_author_name = 'osCommerce',
        $_author_www = 'http://www.oscommerce.com',
        $_group = 'content';

/* Class constructor */

    function osC_Content_featured_products() {
      global $osC_Language;

      $this->_title = $osC_Language->get('featured_products_title');
    }

    function initialize() {
      global $osC_Database, $osC_Cache, $osC_Language, $osC_Currencies, $osC_Image, $current_category_id;

      $data = array();
		$sql="select f.products_id,pd.products_name,pd.products_description from featured as f,products_description as pd where f.products_id=pd.products_id";
		$r=$osC_Database->query($sql);
		while ( $r->next() ) {
		
          $osC_Product = new osC_Product($r->valueInt('products_id'));

          $abc[$osC_Product->getID()] = $osC_Product->getData();
          $abc[$osC_Product->getID()]['display_price'] = $osC_Product->getPriceFormated(true);
          $abc[$osC_Product->getID()]['display_image'] = $osC_Product->getImage();
		  
        }
		//print_r($abc);
		/*while($row=mysql_fetch_array())
		{
		echo $row['products_name'];
		}*/
      if ( (MODULE_CONTENT_NEW_PRODUCTS_CACHE > 0) && $osC_Cache->read('featured_products-' . $osC_Language->getCode() . '-' . $osC_Currencies->getCode() . '-' . $current_category_id, MODULE_CONTENT_NEW_PRODUCTS_CACHE) ) {
        $data = $osC_Cache->getCache();
    
	  } else {
        if ( $current_category_id < 1 ) {
          $Qproducts = $osC_Database->query('select products_id from :table_products where products_status = :products_status and parent_id = :parent_id order by products_date_added desc limit :max_display_new_products');
	  
        } else {
         $Qproducts = $osC_Database->query('select distinct p2c.products_id from :table_products p, :table_products_to_categories p2c, :table_categories c where c.parent_id = :category_parent_id and c.categories_id = p2c.categories_id and p2c.products_id = p.products_id and p.products_status = :products_status and p.parent_id = :parent_id order by p.products_date_added desc limit :max_display_new_products');
          $Qproducts->bindTable(':table_products_to_categories', TABLE_PRODUCTS_TO_CATEGORIES);
          $Qproducts->bindTable(':table_categories', TABLE_CATEGORIES);
          $Qproducts->bindInt(':category_parent_id', $current_category_id);
       		}

        $Qproducts->bindTable(':table_products', TABLE_PRODUCTS);
        $Qproducts->bindInt(':products_status', 1);
        $Qproducts->bindInt(':parent_id', 0);
        $Qproducts->bindInt(':max_display_new_products', MODULE_CONTENT_NEW_PRODUCTS_MAX_DISPLAY);
        $Qproducts->execute();

        while ( $Qproducts->next() ) {
		
          $osC_Product = new osC_Product($Qproducts->valueInt('products_id'));

          $data[$osC_Product->getID()] = $osC_Product->getData();
          $data[$osC_Product->getID()]['display_price'] = $osC_Product->getPriceFormated(true);
          $data[$osC_Product->getID()]['display_image'] = $osC_Product->getImage();
		  
        }

        $osC_Cache->write($abc);

      }


	if ( !empty($abc) ) {
        $this->_content = '';

        foreach ( $abc as $product ) {
    $this->_content .= '<div class="prod_div"> <div class="prod_pic"><center>' .
                             osc_link_object(osc_href_link(FILENAME_PRODUCTS, $product['keyword']), $osC_Image->show($product['display_image'], $product['name'])) . '</center></div><h2>' .
                             osc_link_object(osc_href_link(FILENAME_PRODUCTS, $product['keyword']), $product['name']) . '</h2>' .
                             $product['display_price'] . '<p>&nbsp;</p>' . 
							 osc_link_object(osc_href_link(FILENAME_PRODUCTS, $product['keyword']), osc_draw_image_button('button_in_cart.gif', $osC_Language->get('button_add_to_cart'))) .
							 ' </div>';
        }

        $this->_content .= '<div class="clear"></div>';
		
		

      }
    }
	
	
	
	

    function install() {
      global $osC_Database;

      parent::install();

      $osC_Database->simpleQuery("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Maximum Entries To Display', 'MODULE_CONTENT_NEW_PRODUCTS_MAX_DISPLAY', '9', 'Maximum number of new products to display', '6', '0', now())");
      $osC_Database->simpleQuery("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Cache Contents', 'MODULE_CONTENT_NEW_PRODUCTS_CACHE', '60', 'Number of minutes to keep the contents cached (0 = no cache)', '6', '0', now())");
    }

    function getKeys() {
      if (!isset($this->_keys)) {
        $this->_keys = array('MODULE_CONTENT_NEW_PRODUCTS_MAX_DISPLAY', 'MODULE_CONTENT_NEW_PRODUCTS_CACHE');
      }

      return $this->_keys;
    }
  }
?>
