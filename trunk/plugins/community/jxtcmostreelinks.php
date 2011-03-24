<?php
/*
	JoomlaXTC mosTRee user entries plugin for JomSocial

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

if (!defined( '_JEXEC' )) die( 'Direct Access to this location is not allowed.' );

require_once JPATH_ROOT.DS.'components'.DS.'com_community'.DS.'libraries'.DS.'core.php';

if(!class_exists('plgCommunityjxtcmostreelinks')) {
	class plgCommunityjxtcmostreelinks extends CApplications {
		var $name 		= "My Entries";
		var $_name		= 'entries';
		var $_path		= '';
		var $_user		= '';
		var $_my		= '';
	
		function onProfileDisplay() {
		
			$cache =& JFactory::getCache('community');
			$callback = array('plgCommunityjxtcmostreelinks', '_buildHTML');
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

			$db->setQuery( "SELECT * FROM #__mt_links "
			.	"WHERE link_published='1' AND link_approved='1' AND user_id='".$user->id."' "
			.	"ORDER BY link_featured DESC, ordering ASC LIMIT ".$limit);

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
					$starOn = '<img src="'.$live_site.'/images/M_images/rating_star.png" border="0" />';
					$starOff = '<img src="'.$live_site.'/images/M_images/rating_star_blank.png" border="0" />';
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
					$link = str_replace( "{cdate}", JHTML::_('date', $item->link_created, JText::_('DATE_FORMAT_LC1')), $link );				
					$html .= '<div>'.$link.'</div>';
				}
			}
			return $html;
		}
	}
}


