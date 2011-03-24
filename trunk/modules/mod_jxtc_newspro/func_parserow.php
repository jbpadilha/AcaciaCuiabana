<?php
/*
	JoomlaXTC Newspro Module
	
	version 3.8
	
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
	// Article image
	$ini=strpos(strtolower($item->introtext),'<img');
	if ($ini === false) $img = '';
	else {
		$pos = strpos($item->introtext,'src="',$ini)+5;
		$fin = strpos($item->introtext,'"',$pos);
		$img = substr($item->introtext,$pos,$fin-$pos);
		$fin = strpos($item->introtext,'>',$fin);
	}

	$intronoimage = $item->introtext;
	while (($ini = strpos($intronoimage,'<img')) !== false) {
		if (($fin = strpos($intronoimage,'>',$ini)) === false) { break; }
		$intronoimage = substr_replace($intronoimage,'',$ini,$fin-$ini+1);
	}

	$title = ($rowmaxtitle) ? mb_substr(strip_tags($item->title),0,$rowmaxtitle).$rowmaxtitlesuf : strip_tags($item->title);

	$intro = ($rowmaxintro) ? mb_substr(strip_tags($item->introtext),0,$rowmaxintro).$rowmaxintrosuf : strip_tags($item->introtext);

	$rawfulltext=$item->fulltext;
	$fulltext=strip_tags($item->fulltext);
	if (!empty($rowtextbrk)) {
		$pos = strpos($rawfulltext,$rowtextbrk);
		if ($pos !== false) {
			$rawfulltext=substr($rawfulltext,0,$pos+strlen($rowtextbrk));
		}
		$pos = strpos($fulltext,$rowtextbrk);
		if ($pos !== false) {
			$fulltext=substr($fulltext,0,$pos+strlen($rowtextbrk));
		}
	}

	if (!empty($rowmaxtext)) {
		$fulltext = trim(mb_substr($fulltext,0,$rowmaxtext)).$rowmaxtextsuf;
		$rawfulltext = trim(mb_substr($rawfulltext,0,$rowmaxtext)).$rowmaxtextsuf;
	}
	$avatarw = $params->get('avatarw');
	$avatarh = $params->get('avatarh');
	$userid = $item->created_by;
	$avatarimg='';
	$authorlink='';
	$articlelink = JRoute::_(ContentHelperRoute::getArticleRoute($item->slug, $item->catslug, $item->sectionid));
	$categorylink = JRoute::_(ContentHelperRoute::getCategoryRoute($item->catslug, $item->sectionid));
	$sectionlink = JRoute::_(ContentHelperRoute::getSectionRoute($item->sectionid));

	switch ($params->get('compat','none')) {
		case 'none':
		break;
		case 'cb':
			$itemdb->setQuery("SELECT avatar from #__comprofiler WHERE user_id = '$userid'");
			$avatar = $itemdb->loadResult();
			$avatarimg = empty($avatar) ? '' : "<img src=\"".$live_site."components/com_comprofiler/images/$avatar\" border=\"0\" width=\"$avatarw\" height=\"$avatarh\" />";
			$itemdb->setQuery("SELECT id from #__components WHERE link = 'option=com_comprofiler' and enabled='1'");
			$itemid = $itemdb->loadResult();if ($itemid) { $itemid = '&Itemid='.$itemid; }
			$authorlink = JRoute::_($live_site.'index.php?option=com_comprofiler&view=profile&userid='.$userid.$itemid);
		break;
		case 'jomsoc':
			$itemdb->setQuery("SELECT avatar from #__community_users WHERE userid = '$userid'");
			$avatar = $itemdb->loadResult();
			$avatarimg = empty($avatar) ? '' : "<img src=\"$live_site$avatar\" border=\"0\" width=\"$avatarw\" height=\"$avatarh\" />";
			$itemdb->setQuery("SELECT id from #__components WHERE link = 'option=com_community' and enabled='1'");
			$itemid = $itemdb->loadResult();if ($itemid) { $itemid = '&Itemid='.$itemid; }
			$authorlink = JRoute::_($live_site.'index.php?option=com_community&view=profile&userid='.$userid.$itemid);
		break;
		case 'ido':
			$itemdb->setQuery("SELECT avatar from #__idoblog_users WHERE iduser = '$userid'");
			$avatar = $itemdb->loadResult();
			$avatarimg = empty($avatar) ? '' : "<img src=\"".$live_site."images/idoblog/$avatar\" border=\"0\" width=\"$avatarw\" height=\"$avatarh\" />";
			$itemdb->setQuery("SELECT id from #__components WHERE link = 'option=com_idoblog' and enabled='1'");
			$itemid = $itemdb->loadResult();if ($itemid) { $itemid = '&Itemid='.$itemid; }
			$authorlink = JRoute::_($live_site.'index.php?option=com_idoblog&task=profile&userid='.$userid.$itemid);
		break;
		case 'myblog':
			require_once( JPATH_ROOT.DS.'components'.DS.'com_myblog'.DS.'modules'.DS.'mod_myblog.php' );
			$objModule = new MyblogModule();
			$avatarimg = $objModule->_getAvatar( $userid );
			$itemdb->setQuery("SELECT id from #__components WHERE link = 'option=com_idoblog' and enabled='1'");
			$itemid = $itemdb->loadResult();if ($itemid) { $itemid = '&Itemid='.$itemid; }
			$authorlink = JRoute::_("index.php?option=com_myblog&blogger=".urlencode($item->author)."&Itemid=".$objModule->myGetItemId());
			$articlelink = myGetPermalinkUrl($item->id);
			$categorylink = JRoute::_('index.php?option=com_myblog&task=tag&category='.$item->catid.'&Itemid='.$objModule->myGetItemId() );
		break;
		case 'fb':
			$itemdb->setQuery("SELECT avatar from #__fb_users WHERE userid = '$userid'");
			$avatar = $itemdb->loadResult();
			$avatarimg = empty($avatar) ? '': "<img src=\"".$live_site."images/fbfiles/avatars/$avatar\" border=\"0\" width=\"$avatarw\" height=\"$avatarh\" />";
			$itemdb->setQuery("SELECT id from #__components WHERE link = 'option=com_fireboard' and enabled='1'");
			$itemid = $itemdb->loadResult();if ($itemid) { $itemid = '&Itemid='.$itemid; }
			$authorlink = JRoute::_($live_site.'index.php?option=com_fireboard&func=fbprofile&task=showprf&userid='.$userid.$itemid);
		break;
		case 'kunea':
			$itemdb->setQuery("SELECT avatar from #__fb_users WHERE userid = '$userid'");
			$avatar = $itemdb->loadResult();
			$avatarimg = empty($avatar) ? '' : "<img src=\"".$live_site."images/fbfiles/avatars/$avatar\" border=\"0\" width=\"$avatarw\" height=\"$avatarh\" />";
			$itemdb->setQuery("SELECT id from #__components WHERE link = 'option=com_kunena' and enabled='1'");
			$itemid = $itemdb->loadResult();if ($itemid) { $itemid = '&Itemid='.$itemid; }
			$authorlink = JRoute::_($live_site.'index.php?option=com_kunena&func=fbprofile&userid='.$userid.$itemid);
		break;
	}

	$comments=0;
	switch ($params->get('comcompat','none')) {
		case 'none':
		break;
		case 'jomcom':
			$itemdb->setQuery("SELECT count(*) from #__jomcomment WHERE contentid = '$item->id'");
			$comments = (int) $itemdb->loadResult();
		break;
	}
	
	$rowhtml = str_replace( '{link}', $articlelink, $rowhtml );
	$rowhtml = str_replace( '{title}', $title, $rowhtml );
	$rowhtml = str_replace( '{intro}', $item->introtext, $rowhtml );		
	$rowhtml = str_replace( '{intronoimage}', $intronoimage, $rowhtml );		
	$rowhtml = str_replace( '{rawfulltext}', $rawfulltext, $rowhtml );		
	$rowhtml = str_replace( '{fulltext}', $fulltext, $rowhtml );		
	$rowhtml = str_replace( '{introtext}', $intro, $rowhtml );
	$rowhtml = str_replace( '{introimage}', $img, $rowhtml );
	$rowhtml = str_replace( '{category}', $item->cat_title, $rowhtml );
	$rowhtml = str_replace( '{category_image}', 'images/stories/'.$item->cat_image, $rowhtml );
	$rowhtml = str_replace( '{category_link}', $categorylink, $rowhtml );
	$rowhtml = str_replace( '{section}', $item->sec_title, $rowhtml );
	$rowhtml = str_replace( '{section_image}', 'images/stories/'.$item->sec_image, $rowhtml );
	$rowhtml = str_replace( '{section_link}', $sectionlink, $rowhtml );
	$rowhtml = str_replace( '{date}', date($dateformat,$item->created), $rowhtml );
	$rowhtml = str_replace( '{moddate}', date($dateformat,$item->modified), $rowhtml );
	$rowhtml = str_replace( '{author}', $item->author, $rowhtml );
	$rowhtml = str_replace( '{authorid}', $item->authorid, $rowhtml );
	$rowhtml = str_replace( '{avatar}', $avatarimg, $rowhtml  );
	$rowhtml = str_replace( '{authorprofile}', $authorlink, $rowhtml  );
	$rowhtml = str_replace( '{index}', $index, $rowhtml  );
	$rowhtml = str_replace( '{hits}', $item->hits, $rowhtml );
	$rowhtml = str_replace( '{comments}', $comments, $rowhtml );

	while (($ini=strpos($rowhtml,"{date")) !== false) {
		$fin = strpos($rowhtml,"}",$ini);
		$filter=substr($rowhtml,$ini,$fin-$ini+1);
		list($null,$fmt)=explode(' ',substr($filter,1,-1));
		$val=date(trim($fmt),$item->created);
		$rowhtml = str_replace($filter,$val,$rowhtml);
	}
}
?>