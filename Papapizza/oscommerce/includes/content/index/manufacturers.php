<?php
/*
  $Id: password.php 64 2005-03-12 16:36:16Z hpdl $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2005 osCommerce

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License v2 (1991)
  as published by the Free Software Foundation.
*/

  class osC_Index_Manufacturers extends osC_Template {

/* Private variables */

    var $_module = 'manufacturers',
        $_group = 'index',
        $_page_title,
        $_page_contents = 'product_listing.php',
        $_page_image = 'table_background_list.gif';

/* Class constructor */

    function osC_Index_Manufacturers() {
      global $osC_Services, $osC_Language, $osC_Breadcrumb, $osC_Manufacturer;

      $this->_page_title = sprintf($osC_Language->get('index_heading'), STORE_NAME);

      if (is_numeric($_GET[$this->_module])) {
        include('includes/classes/manufacturer.php');
        $osC_Manufacturer = new osC_Manufacturer($_GET[$this->_module]);

        if ($osC_Services->isStarted('breadcrumb')) {
          $osC_Breadcrumb->add($osC_Manufacturer->getTitle(), osc_href_link(FILENAME_DEFAULT, $this->_module . '=' . $_GET[$this->_module]));
        }

        $this->_page_title = $osC_Manufacturer->getTitle();
        $this->_page_image = 'manufacturers/' . $osC_Manufacturer->getImage();

        $this->_process();
      } else {
        $this->_page_contents = 'index.php';
      }
    }

/* Private methods */

    function _process() {
      global $osC_Manufacturer, $osC_Products;

      include('includes/classes/products.php');
      $osC_Products = new osC_Products();
      $osC_Products->setManufacturer($osC_Manufacturer->getID());

      if (isset($_GET['filter']) && is_numeric($_GET['filter']) && ($_GET['filter'] > 0)) {
        $osC_Products->setCategory($_GET['filter']);
      }

      if (isset($_GET['sort']) && !empty($_GET['sort'])) {
        if (strpos($_GET['sort'], '|d') !== false) {
          $osC_Products->setSortBy(substr($_GET['sort'], 0, -2), '-');
        } else {
          $osC_Products->setSortBy($_GET['sort']);
        }
      }
    }
  }
?>
