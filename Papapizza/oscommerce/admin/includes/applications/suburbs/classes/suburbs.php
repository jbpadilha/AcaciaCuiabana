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

  class osC_Suburbs_Admin {
    const ACCESS_MODE_ADD = 'add';
    const ACCESS_MODE_SET = 'set';
    const ACCESS_MODE_REMOVE = 'remove';

    public static function get($id) {
      global $osC_Database;

      $Qsuburbs = $osC_Database->query('select * from :table_suburbs where suburbs_id = :id');
      $Qsuburbs->bindTable(':table_suburbs', TABLE_SUBURBS);
      $Qsuburbs->bindInt(':id', $id);
      $Qsuburbs->execute();
      return $Qsuburbs->toArray();
    }

    public static function getAll($pageset = 1) {
      global $osC_Database;

      if ( !is_numeric($pageset) || (floor($pageset) != $pageset) ) {
        $pageset = 1;
      }

      $result = array('entries' => array());

      $Qsuburbs = $osC_Database->query('select SQL_CALC_FOUND_ROWS * from :table_suburbs order by suburbs_name');
      $Qsuburbs->bindTable(':table_suburbs', TABLE_SUBURBS);

      if ( $pageset !== -1 ) {
        $Qsuburbs->setBatchLimit($_GET['page'], MAX_DISPLAY_SEARCH_RESULTS);
      }

      $Qsuburbs->execute();

      while ( $Qsuburbs->next() ) {
        $result['entries'][] = $Qsuburbs->toArray();
      }

      $result['total'] = $Qsuburbs->getBatchSize();

      $Qsuburbs->freeResult();

      return $result;
    }

    public static function find($search, $pageset = 1) {
      global $osC_Database;

      if ( !is_numeric($pageset) || (floor($pageset) != $pageset) ) {
        $pageset = 1;
      }

      $result = array('entries' => array());

      $Qadmins = $osC_Database->query('select SQL_CALC_FOUND_ROWS * from :table_suburbs where (suburbs_name like :suburbs_name) order by suburbs_name');
      $Qadmins->bindTable(':table_suburbs', TABLE_SUBURBS);
      $Qadmins->bindValue(':suburbs_name', '%' . $search . '%');

      if ( $pageset !== -1 ) {
        $Qadmins->setBatchLimit($pageset, MAX_DISPLAY_SEARCH_RESULTS);
      }

      $Qadmins->execute();

      while ( $Qadmins->next() ) {
        $result['entries'][] = $Qadmins->toArray();
      }

      $result['total'] = $Qadmins->getBatchSize();

      $Qadmins->freeResult();

      return $result;
    }

    public static function save($id = null, $data, $modules = null) {
      global $osC_Database;

      $error = false;

      $Qcheck = $osC_Database->query('select suburbs_id from :table_suburbs where suburbs_name = :suburbs_name');

      if ( is_numeric($id) ) {
        $Qcheck->appendQuery('and suburbs_id != :id');
        $Qcheck->bindInt(':id', $id);
      }

      $Qcheck->appendQuery('limit 1');
      $Qcheck->bindTable(':table_suburbs', TABLE_SUBURBS);
      $Qcheck->bindValue(':suburbs_name', $data['suburbs_name']);
      $Qcheck->execute();

      if ($Qcheck->numberOfRows() < 1) {
        $osC_Database->startTransaction();

        if ( is_numeric($id) ) {
          $Qadmin = $osC_Database->query('update :table_suburbs set suburbs_name = :suburbs_name, suburbs_price = :suburbs_price');
          $Qadmin->bindValue(':suburbs_name', trim($data['suburbs_name']));
          $Qadmin->bindValue(':suburbs_price', trim($data['suburbs_price']));
          $Qadmin->appendQuery('where suburbs_id = :suburbs_id');
          $Qadmin->bindInt(':suburbs_id', $id);
        } else {
          $Qadmin = $osC_Database->query('insert into :table_suburbs (suburbs_name, suburbs_price) values (:suburbs_name, :suburbs_price)');
          $Qadmin->bindValue(':suburbs_name', trim($data['suburbs_name']));
          $Qadmin->bindValue(':suburbs_price', trim($data['suburbs_price']));
        }

        $Qadmin->bindTable(':table_suburbs', TABLE_SUBURBS);
        $Qadmin->bindValue(':suburbs_name', $data['suburbs_name']);
        $Qadmin->setLogging($_SESSION['module'], $id);
        $Qadmin->execute();

        if ( !$osC_Database->isError() ) {
          if ( !is_numeric($id) ) {
            $id = $osC_Database->nextID();
          }
        } else {
          $error = true;
        }

        if ( $error === false ) {
          $osC_Database->commitTransaction();

          return 1;
        } else {
          $osC_Database->rollbackTransaction();

          return -1;
        }
      } else {
        return -2;
      }
    }

    public static function delete($id) {
      global $osC_Database;

      $osC_Database->startTransaction();

      if ( !$osC_Database->isError() ) {
        $Qdel = $osC_Database->query('delete from :table_suburbs where suburbs_id = :id');
        $Qdel->bindTable(':table_suburbs', TABLE_SUBURBS);
        $Qdel->bindInt(':id', $id);
        $Qdel->setLogging($_SESSION['module'], $id);
        $Qdel->execute();

        if ( !$osC_Database->isError() ) {
          $osC_Database->commitTransaction();

          return true;
        }
      }

      $osC_Database->rollbackTransaction();

      return false;
    }

  }
?>
