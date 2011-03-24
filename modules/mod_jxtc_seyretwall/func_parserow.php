<?php
/*
	JoomlaXTC Seyret Wall Module
	
	version 1.3
	
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

defined('_JEXEC') or die('Restricted access');

$videourl = JRoute::_("index.php?option=com_seyret&task=videodirectlink&id=".$item->id."&Itemid=".$itemid);
$authorurl= JRoute::_("index.php?option=com_seyret&task=uservideoslist&from=0&userid=".$item->addedby."&Itemid=".$itemid);
$categoryurl= JRoute::_("index.php?option=com_seyret&catid=".$item->cid."&Itemid=".$itemid);
$intro=strip_tags($item->itemcomment);
if (!empty($maxintro)) $intro = trim(substr($intro,0,$maxintro)).'...';
$pictureurl = $item->picturelink;
if ($pictureurl=="") $pictureurl=$live_site."components/com_seyret/localplayer/nothumbnail.png";
$video = '<div class="videothumbnailinmodule">'.embedthisvideo($item->id, $videow,$videoh).'</div>';

$itemhtml = str_replace( '{categoryurl}', $categoryurl, $itemhtml );
$itemhtml = str_replace( '{categoryname}', $item->categoryname, $itemhtml );
$itemhtml = str_replace( '{categoryinfo}', $item->categoryinfo, $itemhtml );
$itemhtml = str_replace( '{width}', $videow, $itemhtml );
$itemhtml = str_replace( '{height}', $videoh, $itemhtml );
$itemhtml = str_replace( '{video}', $video, $itemhtml );
$itemhtml = str_replace( '{videourl}', $videourl, $itemhtml );
$itemhtml = str_replace( '{title}', htmlspecialchars($item->title), $itemhtml );
$itemhtml = str_replace( '{comment}', $intro, $itemhtml );
$itemhtml = str_replace( '{pictureurl}', $pictureurl, $itemhtml );
$itemhtml = str_replace( '{date}', date($dateformat,strtotime($item->addeddate)), $itemhtml );
$itemhtml = str_replace( '{username}', $item->username, $itemhtml );
$itemhtml = str_replace( '{name}', $item->name, $itemhtml );
$itemhtml = str_replace( '{tags}', $item->videotags, $itemhtml );
$itemhtml = str_replace( '{userurl}', $authorurl, $itemhtml );
$itemhtml = str_replace( '{index}', $index, $itemhtml );
?>