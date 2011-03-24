<?php
/*
	JoomlaXTC Social Wall Module
	
	version 1.4
	
	Copyright (C) 2009,2010  Monev Software LLC.	All Rights Reserved.
	
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
	
	See COPYRIGHT.php for more information.
	See LICENSE.php for more information.
	
	Monev Software LLC
	www.joomlaxtc.com
*/

if (!empty($item)) {
	$userlink = CRoute::_('index.php?option=com_community&view=profile&userid='.$item->id);
	$photoslink	= CRoute::_('index.php?option=com_community&view=photos&task=myphotos&userid=' . $item->id , false);
	$videoslink	= CRoute::_('index.php?option=com_community&view=videos&task=myvideos&userid=' . $item->id , false);

	$itemhtml = str_replace( '{id}', $item->id, $itemhtml );
	$itemhtml = str_replace( '{name}', $item->name, $itemhtml );
	$itemhtml = str_replace( '{username}', $item->username, $itemhtml );		
	$itemhtml = str_replace( '{email}', $item->email, $itemhtml );
	$itemhtml = str_replace( '{registerdate}', date($dateformat,strtotime($item->registerDate)), $itemhtml );
	$itemhtml = str_replace( '{lastvisitdate}', date($dateformat,strtotime($item->lastvisitDate)), $itemhtml );
	$itemhtml = str_replace( '{lastpost}', date($dateformat,strtotime($item->posted_on)), $itemhtml );
	$itemhtml = str_replace( '{avatarimage}', '<img src="'.$live_site.$item->avatar.'" border="0" width="'.$avatarw.'" height="'.$avatarh.'" />', $itemhtml );
	$itemhtml = str_replace( '{avatarurl}', $live_site.$item->avatar, $itemhtml );
	$itemhtml = str_replace( '{thumbimage}', '<img src="'.$live_site.$item->thumb.'" border="0" />', $itemhtml );
	$itemhtml = str_replace( '{thumburl}', $live_site.$item->thumb, $itemhtml );
	$itemhtml = str_replace( '{friendcount}', $item->friendcount, $itemhtml );
	$itemhtml = str_replace( '{userlink}', $userlink, $itemhtml );
	$itemhtml = str_replace( '{photoslink}', $photoslink, $itemhtml );
	$itemhtml = str_replace( '{videoslink}', $videoslink, $itemhtml );
	$itemhtml = str_replace( '{index}', $index, $itemhtml );
	
	// Custom fields:

	if (strpos($itemhtml,'{field_') !== false) { // Grab custom fields only when needed
		$query = "SELECT LOWER(a.fieldcode) as fieldcode,b.value FROM #__community_fields AS a, #__community_fields_values AS b WHERE b.user_id = '$item->id' AND a.id = b.field_id";
		$db->setQuery($query);
		$fields = $db->LoadObjectList('fieldcode');
		while (($ini=strpos($itemhtml,"{field_")) !== false) {
			$fin = strpos($itemhtml,"}",$ini);
			$filter=substr($itemhtml,$ini+1,$fin-$ini-1);
			list($filter,$length)=explode(' ',$filter);
			$value = empty($length) ? $fields[$filter]->value : substr($fields[$filter]->value,0,$length);
			$itemhtml = substr_replace($itemhtml,$value,$ini,$fin-$ini+1);
		}
	}

	// Include JXTC JomSocial Applications:
	
	// Xboxlive
	if (strpos($itemhtml,'{app_xboxlive}') !== false) {
		$query = "SELECT params FROM #__community_apps WHERE apps='jxtcxboxlive' AND privacy='' AND userid='$item->id'";
		$db->setQuery($query);
		$result = $db->LoadResult();
		if (empty($result)) {
			$apphtml = '';
		}
		else {
			$app = new JParameter($result);
			$value=$app->get('cardname');
			$apphtml = '<center><iframe src="http://gamercard.xbox.com/'.urlencode($value).'.card" scrolling="no" frameBorder="0" height="140" width="204">'.$value.'</iframe></center>';
		}
		$itemhtml = str_replace( '{app_xboxlive}', $apphtml, $itemhtml );
	}

	// PSN
	if (strpos($itemhtml,'{app_psn}') !== false) {
		$query = "SELECT params FROM #__community_apps WHERE apps='jxtcpsn' AND privacy='' AND userid='$item->id'";
		$db->setQuery($query);
		$result = $db->LoadResult();
		if (empty($result)) {
			$apphtml = '';
		}
		else {
			$app = new JParameter($result);
			$value=$app->get('cardname');
			$apphtml = '<center><a href="http://profiles.us.playstation.com/playstation/psn/visit/profiles/'.$value.'"><img src="http://fp.profiles.us.playstation.com/playstation/psn/pid/'.$value.'.png" width="230" height="155" border="0" /></a><br/><a href="http://www.us.playstation.com/PSN/SignUp">Get your Portable ID!</a></center>';
		}
		$itemhtml = str_replace( '{app_psn}', $apphtml, $itemhtml );
	}

}
?>