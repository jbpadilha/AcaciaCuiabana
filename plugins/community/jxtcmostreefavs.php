<?php
/*
	JoomlaXTC mosTRee Favorites plugin for JomSocial

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

if(!class_exists('plgCommunityjxtcmostreefavs')) {
	class plgCommunityjxtcmostreefavs extends CApplications {
		var $name 		= "My Favorites";
		var $_name		= 'favorites';
		var $_path		= '';
		var $_user		= '';
		var $_my		= '';
	
		function onProfileDisplay() {
		
			$cache =& JFactory::getCache('community');
			$callback = array('plgCommunityjxtcmostreefavs', '_buildHTML');
			$content = $cache->call($callback, $this);
			
			return $content; 		
		}
		
		function _buildHTML($that) {
			global $database, $_MT_LANG, $mosConfig_offset, $links;

			$live_site = JURI::base();
			$db =& JFactory::getDBO();

			$user =& CFactory::getActiveProfile();
			$maxqty = $that->params->get('maxqty',20);
			$template = $that->params->get('template','{name}<br/>');
			$that->loadUserParams();
	    $qty = $that->userparams->get('qty', 5);

			$limit = ($maxqty > $qty) ? $maxqty : $qty;
			
			$db->setQuery( "SELECT l.*,f.fav_date FROM #__mt_links AS l, #__mt_favourites AS f
				WHERE l.link_published='1' AND l.link_approved='1' AND l.link_id = f.link_id AND f.user_id='".$user->id."' 
				ORDER BY l.link_featured DESC, l.ordering ASC LIMIT ".$limit);
			$links = $db->loadObjectList();

			if (empty($links)) {
				$html = "There are no entries.";
			}
			else {
				$db->setQuery("SELECT MAX(id) FROM #__menu WHERE link = 'index.php?option=com_mtree' AND published <> '-2' AND componentid > 0");
				$itemid = $db->loadResult();
				if (!empty($itemid)) { $itemid = '&Itemid='.$itemid; }

				$html = '';
				foreach($links AS $item) {
					$starOn = mosAdminMenus::ImageCheck( 'rating_star.png', '/images/M_images/' );
					$starOff = mosAdminMenus::ImageCheck( 'rating_star_blank.png', '/images/M_images/' );
					$stars="";
					for ($j=0; $j < $item->link_rating; $j++) {
						$stars .= $starOn;
					}
					for ($j=$item->link_rating; $j < 5; $j++) {
						$stars .= $starOff;
					}
					
					$url = JRoute::_($live_site.'index.php?option=com_mtree&task=viewlink&link_id='.$item->link_id.$itemid);
	
					$link = $template;
					$link = str_replace( "{name}", $item->link_name, $link );				
					$link = str_replace( "{desc}", $item->link_desc, $link );				
					$link = str_replace( "{hits}", $item->link_votes, $link );				
					$link = str_replace( "{votes}", $item->link_votes, $link );				
					$link = str_replace( "{rating}", $stars, $link );				
					$link = str_replace( "{email}", $item->email, $link );				
					$link = str_replace( "{website}", $item->website, $link );				
					$link = str_replace( "{price}", $item->price, $link );
					$link = str_replace( "{url}", $url, $link );
					$link = str_replace( "{cdate}", mosFormatDate($item->link_created), $link );				
					$link = str_replace( "{fdate}", mosFormatDate($item->fav_date), $link );				
		
					$html .= '<div>'.$link.'</div>';
				}
			}
			return $html;
		}
	}
}


