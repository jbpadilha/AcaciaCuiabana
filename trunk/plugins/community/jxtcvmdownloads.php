<?php
/*
	JoomlaXTC Virtuemart purchases plugin for JomSocial

	version 1.0
	
	Copyright (C) 2009  Monev Software LLC.	All Rights Reserved.
	
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

if (!defined( '_JEXEC' )) die( 'Direct Access to this location is not allowed.' );

require_once JPATH_ROOT.DS.'components'.DS.'com_community'.DS.'libraries'.DS.'core.php';

if(!class_exists('plgCommunityjxtcvmdownloads')) {
	class plgCommunityjxtcvmdownloads extends CApplications {
		var $name 		= "My Downloads";
		var $_name		= 'downloads';
		var $_path		= '';
		var $_user		= '';
		var $_my		= '';
	
		function onProfileDisplay() {
		
			$cache =& JFactory::getCache('community');
			$callback = array('plgCommunityjxtcvmdownloads', '_buildHTML');
			$content = $cache->call($callback, $this);
			
			return $content; 		
		}
		
		function _buildHTML($that) {
			$user =& CFactory::getActiveProfile();

			$maxqty = $that->params->get('maxqty', 20);
			$template = $that->params->get('template','{product_name} - {download_url}<br/>');
			$that->loadUserParams();
	    $qty = $that->userparams->get('qty', 5);
	    
	    $limit = ($maxqty > $qty) ? $maxqty : $qty;

			global $sess;
			require_once JPATH_ROOT.DS.'components'.DS.'com_virtuemart'.DS.'virtuemart_parser.php';
			if (isset($sess)) {
				$itemid = '&Itemid='.$sess->getShopItemid();
			}
			else {
				$itemid = '';
			}
	
			$live_site = JURI::base();
			$db =& JFactory::getDBO();

			$sql = "SELECT a.product_name,a.product_thumb_image, b.*
							FROM #__".VM_TABLEPREFIX."_product a, #__".VM_TABLEPREFIX."_product_download b
							WHERE b.user_id=".$user->id."
							AND a.product_id = b.product_id ORDER BY end_date LIMIT ".$limit;
			$db->setQuery($sql);
			$items = $db->loadObjectList();
			if (count($items) > 0) {
				$html ='';
				foreach ($items as $item) {
					$product_url = JRoute::_($live_site.'index.php?option=com_virtuemart&page=shop.product_details&product_id='.$item->product_id.$itemid);
					$product_img = $live_site."components/com_virtuemart/show_image_in_imgtag.php?filename=".urlencode($item->product_thumb_image)."&newxsize=".PSHOP_IMG_WIDTH."&newysize=".PSHOP_IMG_HEIGHT."&fileout=";
					$order_url = JRoute::_($live_site.'index.php?option=com_virtuemart&page=account.order_details&order_id='.$item->order_id.$itemid);
					$download_url = JRoute::_($live_site.'index.php?option=com_virtuemart&page=shop.downloads&download_id='.$item->download_id.$itemid);
					$link = $template;
					$link = str_replace( "{product_name}", $item->product_name, $link );				
					$link = str_replace( "{product_url}", $product_url, $link );				
					$link = str_replace( "{product_img}", $product_img, $link );				
					$link = str_replace( "{order_id}", $item->order_id, $link );				
					$link = str_replace( "{order_url}", $order_url, $link );				
					$link = str_replace( "{download_left}", $item->download_max, $link );				
					$link = str_replace( "{download_url}", $download_url, $link );				
					$link = str_replace( "{end_date}", $item->end_date, $link );				
					$link = str_replace( "{file_name}", $item->file_name, $link );
					$link = str_replace( "{download_id}", $item->download_id, $link );
					$html .= '<div>'.$link.'</div>';
				}
			}
			else {
				$html = 'No downloads available.';
			}

			return $html;
		}
	}
}


