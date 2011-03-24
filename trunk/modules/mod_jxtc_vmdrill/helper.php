<?php
/*
	JoomlaXTC Virtuemart Drill-down module

	version 2.5.1
	
	Copyright (C) 2008,2009,2010  Monev Software LLC.	All Rights Reserved.
	
	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation; either version 2 of the License, or
	(at your option) any later version.
	
	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.
	
	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
	
	THIS LICENSE MIGHT NOT APPLY TO OTHER FILES CONTAINED IN THE SAME PACKAGE.
	
	See COPYRIGHT.php for more information.
	See LICENSE.php for more information.
	
	Monev Software LLC
	www.joomlaxtc.com
*/

define( '_JEXEC', 1 );
define('JPATH_BASE', realpath(dirname(__FILE__).'/../..') );
define( 'DS', DIRECTORY_SEPARATOR );
require_once ( JPATH_BASE.DS.'includes'.DS.'defines.php' );
require_once ( JPATH_BASE.DS.'includes'.DS.'framework.php' );
require_once ( JPATH_BASE.DS.'libraries'.DS.'joomla'.DS.'html'.DS.'parameter.php' );
require_once ( JPATH_SITE.DS.'components'.DS.'com_content'.DS.'helpers'.DS.'route.php');
jimport( 'joomla.environment.uri' );
$mainframe =& JFactory::getApplication('site');
$mainframe->initialise();

require_once(JPATH_ROOT.DS.'administrator'.DS.'components'.DS.'com_virtuemart'.DS.'virtuemart.cfg.php');

$db =&JFactory::getDBO();

$act = JRequest::getVar('act');
$cat = JRequest::getInt('cat');
$mf = JRequest::getInt('mf');
$prod = JRequest::getInt('prod');
$msg = JRequest::getVar('msg');
$err = JRequest::getVar('err');
$msg = trim(base64_decode($msg));
$err = trim(base64_decode($err));

switch ($act) {
	case 'm':
	$q = "SELECT distinct c.manufacturer_id,c.mf_name 
	FROM #__".VM_TABLEPREFIX."_product_category_xref as a,#__".VM_TABLEPREFIX."_product_mf_xref as b,#__".VM_TABLEPREFIX."_manufacturer as c,#__".VM_TABLEPREFIX."_product as d 
	WHERE a.category_id = ".$cat." and b.product_id = a.product_id and c.manufacturer_id = b.manufacturer_id and d.product_id = a.product_id and d.product_publish = 'Y' ORDER BY c.mf_name";
	$db->setQuery($q);
	$result = $db->loadObjectList();

	if (empty($result)) {
 		echo $err;
 	}
 	else {
  	echo '<select id="vmdMfSel" onchange="getMf()">';
		if (!empty($msg)) {echo '<option value="">'.$msg.'</option>';}
		foreach ($result as $row) {
			echo '<option value="'.$row->manufacturer_id.'">'.$row->mf_name.'</option>';
	  }
  	echo '</select>';
	}
	break;
	case 'p':
	$q = "SELECT distinct a.product_id,a.product_name 
	FROM #__".VM_TABLEPREFIX."_product as a,#__".VM_TABLEPREFIX."_product_category_xref b,#__".VM_TABLEPREFIX."_product_mf_xref as c 
	WHERE b.category_id = ".$cat." and c.manufacturer_id = ".$mf." and c.product_id = b.product_id and a.product_id = b.product_id and a.product_publish = 'Y' ORDER BY a.product_name";
	$db->setQuery($q);
	$result = $db->loadObjectList();
	if (empty($result)) {
 		echo $err;
 	}
 	else {
//		if (mysql_num_rows($result) == 1) { // Jump to single result, needs J15 compliance
//			$row = mysql_fetch_assoc($result);
//			$q = "select a.product_id, c.category_id, c.category_flypage, d.manufacturer_id from #__".VM_TABLEPREFIX."_product a, #__".VM_TABLEPREFIX."_product_category_xref b, #__".VM_TABLEPREFIX."_category c, #__".VM_TABLEPREFIX."_product_mf_xref d WHERE a.product_id=".$row['product_id']." and a.product_publish = 'Y' and b.product_id = a.product_id and c.category_id = b.category_id and c.category_publish = 'Y' and d.product_id = a.product_id ";
//			$result = mysql_query($q);
//			$row = mysql_fetch_assoc($result);
//			$flypage = (empty($row['category_flypage'])) ? FLYPAGE : $row['category_flypage'];
//			$url = JRoute::_(URL.'index.php?page=shop.product_details&flypage='.$flypage.'&product_id='.$row['product_id'].'&category_id='.$row['category_id'].'&manufacturer_id='.$row['manufacturer_id'].'&option=com_virtuemart'.$itemid);
//			echo '<script language="javascript">window.location="'.$url.'"</script>';
//			exit;
//		}
  	echo '<select id="vmdProdSel" onchange="getProd()">';
		if (!empty($msg)) {echo '<option value="">'.$msg.'</option>';}
		foreach ($result as $row) {
			echo '<option value="'.$row->product_id.'">'.$row->product_name.'</option>';
	  }
	  echo '</select>';
	}
	break;
	case 'i':
	require_once( JPATH_ROOT.DS.'includes'.DS.'joomla.php' );
	if (file_exists( JPATH_ROOT.DS.'components'.DS.'com_sef'.DS.'sef.php' )) {
		require_once( JPATH_ROOT.DS.'components'.DS.'com_sef'.DS.'sef.php' );
	} else {
		require_once( JPATH_ROOT.DS.'plugins'.DS.'system'.DS.'sef.php' );
	}
	
	$q="SELECT id FROM #__menu WHERE menutype='mainmenu' AND type='component' AND published='1' AND link='index.php?option=com_virtuemart'";
	$db->setQuery($q);
	$result=$db->loadResult();
	$itemid = empty($result) ? '' : '&Itemid='.$result; 

	$q = "select a.product_id, c.category_id, c.category_flypage, d.manufacturer_id 
	FROM #__".VM_TABLEPREFIX."_product a, #__".VM_TABLEPREFIX."_product_category_xref b, #__".VM_TABLEPREFIX."_category c, #__".VM_TABLEPREFIX."_product_mf_xref d 
	WHERE a.product_id=".$prod." and a.product_publish = 'Y' and b.product_id = a.product_id and c.category_id = b.category_id and c.category_publish = 'Y' and d.product_id = a.product_id ";
	$db->setQuery($q);
	$row = $db->loadObject();
	if (empty($row)) {
			echo $err;
	}
	else {	
		$flypage = (empty($row->category_flypage)) ? FLYPAGE : $row->category_flypage;
		echo JRoute::_(URL.'index.php?page=shop.product_details&flypage='.$flypage.'&product_id='.$row->product_id.'&category_id='.$row->category_id.'&manufacturer_id='.$row->manufacturer_id.'&option=com_virtuemart'.$itemid);
	}
  break;	
}	
