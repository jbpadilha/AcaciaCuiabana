<?php
/*
	JoomlaXTC JomCom Wall Module
	
	version 1.2
	
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

$articlelink = JRoute::_(ContentHelperRoute::getArticleRoute($item->slug, $item->catslug, $item->sectionid));
$categorylink = JRoute::_(ContentHelperRoute::getCategoryRoute($item->catslug, $item->sectionid));
$sectionlink = JRoute::_(ContentHelperRoute::getSectionRoute($item->sectionid));

$comment = jcStripBbCode($item->comment);
$comment = ($maxlength > 0 && strlen($comment) > $maxlength) ? substr($comment,0,$maxlength).'...' : $comment;
$comment = jcTransformDbText($comment);
$comment = jcDecodeSmilies($comment);

//$itemhtml = str_replace( '{categoryname}', $item->categoryname, $itemhtml );
//$itemhtml = str_replace( '{categoryinfo}', $item->categoryinfo, $itemhtml );

$avatarw = $params->get('avatarw');
$avatarh = $params->get('avatarh');
$author_id = $item->author_id;
$commentor_id = $item->commentor_id;
$commentorImg='';
$commentorLink='';

switch ($params->get('compat','none')) {
	case 'none':
	break;
	case 'cb':
		if (!isset($itemid2)) {
			$itemdb->setQuery("SELECT id from #__components WHERE link = 'option=com_comprofiler' and enabled='1'");
			$itemid2 = $itemdb->loadResult();$itemid2 = empty($itemid2) ? '' : '&Itemid='.$itemid2;
		}
		$itemdb->setQuery("SELECT avatar from #__comprofiler WHERE user_id = '$author_id'");
		$avatar = $itemdb->loadResult();
		$authorimg = empty($avatar) ? '' : "<img src=\"".$live_site."components/com_comprofiler/images/$avatar\" border=\"0\" width=\"$avatarw\" height=\"$avatarh\" />";
		$itemdb->setQuery("SELECT id from #__components WHERE link = 'option=com_comprofiler' and enabled='1'");
		$itemid2 = $itemdb->loadResult();if ($itemid2) { $itemid2 = '&Itemid='.$itemid2; }
		$authorlink = JRoute::_($live_site.'index.php?option=com_comprofiler&view=profile&userid='.$author_id.$itemid2);

		$itemdb->setQuery("SELECT avatar from #__comprofiler WHERE user_id = '$commentor_id'");
		$avatar = $itemdb->loadResult();
		$commentorimg = empty($avatar) ? '' : "<img src=\"".$live_site."components/com_comprofiler/images/$avatar\" border=\"0\" width=\"$avatarw\" height=\"$avatarh\" />";
		$commentorlink = JRoute::_($live_site.'index.php?option=com_comprofiler&view=profile&userid='.$commentor_id.$itemid2);
	break;
	case 'jomsoc':
		if (!isset($itemid2)) {
			$itemdb->setQuery("SELECT id from #__components WHERE link = 'option=com_community' and enabled='1'");
			$itemid2 = $itemdb->loadResult();$itemid2 = empty($itemid2) ? '' : '&Itemid='.$itemid2;
		}
		$itemdb->setQuery("SELECT avatar from #__community_users WHERE userid = '$author_id'");
		$avatar = $itemdb->loadResult();
		$authorimg = empty($avatar) ? '' : "<img src=\"$live_site$avatar\" border=\"0\" width=\"$avatarw\" height=\"$avatarh\" />";
		$authorlink = JRoute::_($live_site.'index.php?option=com_community&view=profile&userid='.$author_id.$itemid2);

		$itemdb->setQuery("SELECT avatar from #__community_users WHERE userid = '$commentor_id'");
		$avatar = $itemdb->loadResult();
		$commentorimg = empty($avatar) ? '' : "<img src=\"$live_site$avatar\" border=\"0\" width=\"$avatarw\" height=\"$avatarh\" />";
		$commentorlink = JRoute::_($live_site.'index.php?option=com_community&view=profile&userid='.$commentor_id.$itemid2);
	break;
	case 'fb':
		if (!isset($itemid2)) {
			$itemdb->setQuery("SELECT id from #__components WHERE link = 'option=com_fireboard' and enabled='1'");
			$itemid2 = $itemdb->loadResult();if ($itemid2) { $itemid2 = '&Itemid='.$itemid2; }
		}
		$itemdb->setQuery("SELECT avatar from #__fb_users WHERE userid = '$author_id'");
		$avatar = $itemdb->loadResult();
		$authorimg = empty($avatar) ? '': "<img src=\"".$live_site."images/fbfiles/avatars/$avatar\" border=\"0\" width=\"$avatarw\" height=\"$avatarh\" />";
		$authorlink = JRoute::_($live_site.'index.php?option=com_fireboard&func=fbprofile&task=showprf&userid='.$author_id.$itemid2);

		$itemdb->setQuery("SELECT avatar from #__fb_users WHERE userid = '$commentor_id'");
		$avatar = $itemdb->loadResult();
		$commentorimg = empty($avatar) ? '': "<img src=\"".$live_site."images/fbfiles/avatars/$avatar\" border=\"0\" width=\"$avatarw\" height=\"$avatarh\" />";
		$commentorlink = JRoute::_($live_site.'index.php?option=com_fireboard&func=fbprofile&task=showprf&userid='.$commentor_id.$itemid2);
	break;
	case 'kunea':
		if (!isset($itemid2)) {
			$itemdb->setQuery("SELECT id from #__components WHERE link = 'option=com_kunena' and enabled='1'");
			$itemid2 = $itemdb->loadResult();if ($itemid2) { $itemid2 = '&Itemid='.$itemid2; }
		}
		$itemdb->setQuery("SELECT avatar from #__fb_users WHERE userid = '$author_id'");
		$avatar = $itemdb->loadResult();
		$authorimg = empty($avatar) ? '' : "<img src=\"".$live_site."images/fbfiles/avatars/$avatar\" border=\"0\" width=\"$avatarw\" height=\"$avatarh\" />";
		$authorlink = JRoute::_($live_site.'index.php?option=com_kunena&func=fbprofile&userid='.$author_id.$itemid2);

		$itemdb->setQuery("SELECT avatar from #__fb_users WHERE userid = '$commentor_id'");
		$avatar = $itemdb->loadResult();
		$commentorimg = empty($avatar) ? '' : "<img src=\"".$live_site."images/fbfiles/avatars/$avatar\" border=\"0\" width=\"$avatarw\" height=\"$avatarh\" />";
		$commentorlink = JRoute::_($live_site.'index.php?option=com_kunena&func=fbprofile&userid='.$commentor_id.$itemid2);
	break;
}

$itemhtml = str_replace( '{title}', htmlspecialchars($item->title), $itemhtml );
$itemhtml = str_replace( '{author}', htmlspecialchars($item->name), $itemhtml );
$itemhtml = str_replace( '{comment}', $comment, $itemhtml );
$itemhtml = str_replace( '{date}', date($dateformat,strtotime($item->date)), $itemhtml );
$itemhtml = str_replace( '{articleurl}', $articlelink, $itemhtml );
$itemhtml = str_replace( '{categoryurl}', $categorylink, $itemhtml );
$itemhtml = str_replace( '{sectionurl}', $sectionlink, $itemhtml );
$itemhtml = str_replace( '{index}', $index, $itemhtml );
$itemhtml = str_replace( '{authoravatar}', $authorimg, $itemhtml );
$itemhtml = str_replace( '{authorlink}', $authorlink, $itemhtml );
$itemhtml = str_replace( '{commentoravatar}', $commentorimg, $itemhtml );
$itemhtml = str_replace( '{commentorlink}', $commentorlink, $itemhtml );

while (($ini=strpos($rowhtml,"{date")) !== false) {
	$fin = strpos($rowhtml,"}",$ini);
	$filter=substr($rowhtml,$ini,$fin-$ini+1);
	list($null,$fmt)=explode(' ',substr($filter,1,-1));
	$val=date(trim($fmt),$item->created);
	$rowhtml = str_replace($filter,$val,$rowhtml);
}
?>