<?php
/*
	JoomlaXTC Social GroupWall Module
	
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
	
	See COPYRIGHT.php for more information.
	See LICENSE.php for more information.
	
	Monev Software LLC
	www.joomlaxtc.com
*/

if (!empty($item)) {
	
	$description=$item->description;
	if ($maxdesclen) {
		$description=substr($description,0,$maxdesclen);
		$pos = strrpos($description,' ');
		if ($pos !== false) {
			$description=substr($description,0,$pos).'...';
		}
	}

	$groupurl = JRoute::_($live_site.'index.php?option=com_community&view=groups&task=viewgroup&groupid='.$item->id.$itemid);
	
	$itemhtml = str_replace( '{id}', $item->id, $itemhtml );
	$itemhtml = str_replace( '{ownerid}', $item->ownerid, $itemhtml );		
	$itemhtml = str_replace( '{name}', $item->name, $itemhtml );
	$itemhtml = str_replace( '{description}', $description, $itemhtml );		
	$itemhtml = str_replace( '{email}', $item->email, $itemhtml );
	$itemhtml = str_replace( '{website}', $item->website, $itemhtml );
	$itemhtml = str_replace( '{created}', date($dateformat,strtotime($item->created)), $itemhtml );
	$itemhtml = str_replace( '{groupavatar}', '<img src="'.$live_site.$item->avatar.'" border="0" width="'.$avatarw.'" height="'.$avatarh.'" />', $itemhtml );
	$itemhtml = str_replace( '{groupthumb}', '<img src="'.$live_site.$item->thumb.'" border="0" />', $itemhtml );
	$itemhtml = str_replace( '{groupurl}', $groupurl, $itemhtml );
	$itemhtml = str_replace( '{discusscount}', $item->discusscount, $itemhtml );
	$itemhtml = str_replace( '{wallcount}', $item->wallcount, $itemhtml );
	$itemhtml = str_replace( '{membercount}', $item->membercount, $itemhtml );
	$itemhtml = str_replace( '{categoryname}', $item->categoryname, $itemhtml );
	$itemhtml = str_replace( '{owneravatar}', '<img src="'.$live_site.$item->owneravatar.'" border="0" width="'.$avatarw.'" height="'.$avatarh.'" />', $itemhtml );
	$itemhtml = str_replace( '{ownerthumb}', '<img src="'.$live_site.$item->ownerthumb.'" border="0" />', $itemhtml );
	$itemhtml = str_replace( '{ownername}', $item->ownername, $itemhtml );
	$itemhtml = str_replace( '{owneruserid}', $item->owneruserid, $itemhtml );
	$itemhtml = str_replace( '{owneremail}', $item->owneremail, $itemhtml );
	$itemhtml = str_replace( '{index}', $index, $itemhtml );
}
?>
