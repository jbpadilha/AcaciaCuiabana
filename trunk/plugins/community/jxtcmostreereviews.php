<?php
/*
	JoomlaXTC mosTRee user entries plugin for JomSocial

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

if(!class_exists('plgCommunityjxtcmostreereviews')) {
	class plgCommunityjxtcmostreereviews extends CApplications {
		var $name 		= "My Reviews";
		var $_name		= 'reviews';
		var $_path		= '';
		var $_user		= '';
		var $_my		= '';
	
		function onProfileDisplay() {
		
			$cache =& JFactory::getCache('community');
			$callback = array('plgCommunityjxtcmostreereviews', '_buildHTML');
			$content = $cache->call($callback, $this);
			
			return $content; 		
		}
		
		function _buildHTML(&$that) {
			global $database, $_MT_LANG, $mosConfig_offset, $links;
			$live_site = JURI::base();
			$db =& JFactory::getDBO();

			$user =& CFactory::getActiveProfile();
			$maxqty = $that->params->get('maxqty',20);
			$template = $that->params->get('template','{name}<br/>');
			$that->loadUserParams();
	    $qty = $that->userparams->get('qty', 5);

			$limit = ($maxqty > $qty) ? $maxqty : $qty;

			$db->setQuery("SELECT r.*, l.* FROM #__mt_reviews AS r, #__mt_links AS l 
			WHERE r.link_id = l.link_id AND l.link_published='1' AND l.link_approved='1' AND r.rev_approved='1' AND r.user_id='".$user->id."'
			 ORDER BY r.rev_date DESC LIMIT ".$limit);

			$items = $db->loadObjectList();

			if (empty($items)) {
				$html = "There are no entries.";
			}
			else {
				$db->setQuery("SELECT MAX(id) FROM #__menu WHERE link = 'index.php?option=com_mtree' AND published <> '-2' AND componentid > 0");
				$itemid = $db->loadResult();
				if (!empty($itemid)) { $itemid = '&Itemid='.$itemid; }

				$html = '';
				foreach($items AS $item) {
					$url = JRoute::_($live_site.'index.php?option=com_mtree&task=viewlink&link_id='.$item->link_id.$itemid);
	
					$link = $template;
					$link = str_replace( "{title}", $item->rev_title, $link );				
					$link = str_replace( "{text}", $item->rev_text, $link );				
					$link = str_replace( "{url}", $url, $link );
					$link = str_replace( "{date}", mosFormatDate($item->rev_date), $link );				
		
					$html .= '<div>'.$link.'</div>';
				}
			}
			return $html;
		}
	}
}


