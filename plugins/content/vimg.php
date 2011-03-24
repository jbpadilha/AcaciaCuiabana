<?php
/*
	JoomlaXTC Virtuemart Simple Image Plugin

	version 1.1
	
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

if ( !defined('_JEXEC') ) die('Direct Access to this location is not allowed.');

// Import library dependencies
jimport('joomla.event.plugin');

class plgContentvimg extends JPlugin {

	function plgContentvimg( &$subject ) {
		parent::__construct( $subject );
		// load plugin parameters
		$this->_plugin = JPluginHelper::getPlugin( 'content', 'vimg' );
		$this->_params = new JParameter( $this->_plugin->params );
	}
	
	function onPrepareContent(&$row, &$params, $limitstart) {
		global $mainframe, $product_id, $ps_db;
		if (isset( $GLOBALS['jxtc_product_id'] )) $product_id = $GLOBALS['jxtc_product_id'];
	
		// checking
		$hits = substr_count(strtolower($row->text),'{vimg}');
		if ($hits == 0) {
			return;
		}

		$vm = new ps_DB;
		$mosConfig_absolute_path 	= JPATH_SITE;
		$mosConfig_live_site = $mainframe->isAdmin() ? $mainframe->getSiteURL() : JURI::base();
		if(substr($mosConfig_live_site, -1)!="/") $mosConfig_live_site .= '/';

		$plugin =& JPluginHelper::getPlugin('content', 'vimg');
		$pluginParams = new JParameter( $plugin->params );

		while ($hits > 0) {
			$hits--;
			$hold = strtolower($row->text);
			$ini = strpos($hold,"{vimg}");
			$fin = strpos($hold,"{/vimg}");
			$filter=substr($hold,$ini+6,$fin-$ini-6);
			$sql = "SELECT file_name,file_title FROM #__{vm}_product_files WHERE file_product_id='$product_id' AND file_is_image = '1' AND file_name LIKE '%$filter%' ORDER BY file_id";
			$vm->query($sql);
			$prods = $vm->loadObjectlist();
			switch (count($prods)) {
				case 0:
					$play='';
					break;
				default:
					$play='';
					foreach ($prods as $prod) {
						$play .= '<img src="'.$mosConfig_live_site.$prod->file_name.'" alt="'.$prod->file_title.'" />';
					}
					break;
			}
			$row->text = substr_replace($row->text,$play,$ini,$fin+7-$ini);
		}
	}
}
?>