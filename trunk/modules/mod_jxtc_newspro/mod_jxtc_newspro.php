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

defined('_JEXEC') or die('Restricted access');
require_once (JPATH_SITE.DS.'components'.DS.'com_content'.DS.'helpers'.DS.'route.php');

$envcatid = JRequest::getInt('catid');
$envid = JRequest::getInt('id');
$envview = JRequest::getVar('view');

$live_site = JURI::base();
$live_site .= (substr($live_site,-1) == '/') ? '' : '/';
$itemdb =&JFactory::getDBO();
$db =&JFactory::getDBO();
$user =&JFactory::getUser();
$aid = $user->get('aid', 0);
$userid = $user->get('id');
$contentconfig = &JComponentHelper::getParams( 'com_content' );
$accesslevel = !$contentconfig->get('show_noauth');
$nullDate	= $db->getNullDate();
$date =&JFactory::getDate();
$now = $date->toMySQL();

$compat = $params->get('compat');
$secid = $params->get('secid');
$catid = $params->get('catid');
$usecurrentcat = $params->get('usecurrentcat',1);
$authorid = $params->get( 'authorid', 0 );
$includefrontpage	= $params->get('includefrontpage', 1);
$group	= $params->get('group', 0);
$sortorder = $params->get( 'sortorder', 0 );
$columns = $params->get('columns',1);
$rows	= $params->get('rows', 1);
$pages = $params->get('pages', 1);
$width = $params->get('width',200);
$height = $params->get('height',200);
$transmode = $params->get( 'transmode', "hslide" );
$transpause = $params->get( 'transpause', 4000 );
$transspeed = $params->get( 'transspeed', 1500 );
$transflow = $params->get('transflow', 0);
$transtype = $params->get('transtype', 1);
$button		= $params->get('button','gray');
$modulehtml = trim( $params->get('modulehtml','{mainarea}'));
$mainhtml			= trim( $params->get('html','{intro}'));
$mainmaxtitle	= $params->get('maxtitle', '');
$mainmaxtitlesuf	= $params->get('maxtitlesuf', '...');
$mainmaxintro	= $params->get('maxintro', '');
$mainmaxintrosuf	= $params->get('maxintrosuf', '...');
$mainmaxtext	= $params->get('maxtext', '');
$mainmaxtextsuf	= $params->get('maxtextsuf', '...');
$maintextbrk	= $params->get('textbrk', '');
$dateformat	= trim( $params->get('dateformat','Y-m-d' ));
$morepos = $params->get('morepos', 'b');
$moreqty = $params->get('moreqty', 0);
$morecols	= trim( $params->get('morecols',1));
$morelegend	= trim($params->get('moretext', ''));
$morelegendcolor	= $params->get('morergb','cccccc');
$morehtml	= $params->get('morehtml', '{title}');
$moremaxtitle	= trim( $params->get('moretitle'));
$moremaxtitlesuf	= $params->get('moretitlesuf','...');
$moremaxintro	= trim( $params->get('moreintro'));
$moremaxintrosuf	= $params->get('moreintrosuf','...');
$moremaxtext	= trim( $params->get('moremaxtext'));
$moremaxtextsuf	= $params->get('moremaxtextsuf','...');
$moretextbrk	= $params->get('moretextbrk', '');

/* SlideBox */
$sbFX = $params->get('npslideitfx','BT');
$sbXi = $params->get('npslixin',0);
$sbXo = $params->get('npslixout',0);
$sbYi = $params->get('npsliyin',0);
$sbYo = $params->get('npsliyout',0);
$sbObj = "{xi:$sbXi,xo:$sbXo,yi:$sbYi,yo:$sbYo}";
$sbAnim = $params->get('npsliAnim','Quad');
$sbEase = $params->get('npsliEase','easeIn');
$sbFps = $params->get('npslidi',50);
$sbDura = $params->get('npslido',800);
$sbTran = "{anim:'$sbAnim',ease:'$sbEase',dura:$sbDura,frames:$sbFps}";

/* Jxtctips */
$nptipoi = $params->get('nptipoi',1);		// Opacity
$nptipoo = $params->get('nptipoo',0);
$nptipvi = $params->get('nptipvi',0);		// Vertical
$nptipvo = $params->get('nptipvo',0);
$nptiphi = $params->get('nptiphi',0);		// Horizontal
$nptipho = $params->get('nptipho',0);
$nptipdi = $params->get('nptipdi',550);	// Duration
$nptipdo = $params->get('nptipdo',550);
$nptipfi = $params->get('nptipfi',0);	// Fade Opacity
$nptipfo = $params->get('nptipfo',0);
$nptpause = $params->get('nptpause',1000); 
$nptipAnim = $params->get('nptipAnim','Quad');
$nptipEase = $params->get('nptipEase','easeIn');
$nptipCenter = $params->get('nptipCenter',1);

/* Jxtc Hover */
$hoi = $params->get('hoifx','#CECECE');// Hover out color
$hoo = $params->get('hoofx','#FFFFFF');// Hover in color

if ($usecurrentcat == 1) {
	if ($envview == 'category' && $envid > 0) {
		$catid = $envid;
		$secid='';
	}
	elseif (!empty($envcatid)) {
		$catid = $envcatid;
		$secid='';
	}
}

// Build query
$query = 'SELECT a.id, a.access,a.introtext,a.fulltext, a.title,UNIX_TIMESTAMP(a.created) as created,UNIX_TIMESTAMP(a.modified) as modified, a.sectionid, a.catid, a.created_by, a.hits,
	s.title as sec_title, s.image as sec_image, 
	cc.title as cat_title, cc.image as cat_image, 
	u.name as author, u.username as authorid,
	CASE WHEN CHAR_LENGTH(a.alias) THEN CONCAT_WS(":", a.id, a.alias) ELSE a.id END as slug,
	CASE WHEN CHAR_LENGTH(cc.alias) THEN CONCAT_WS(":", cc.id, cc.alias) ELSE cc.id END as catslug
	FROM #__content AS a';
if ($includefrontpage == '0') {
	$query .= ' LEFT JOIN #__content_frontpage AS f ON f.content_id = a.id';
}
$query .= ' INNER JOIN #__categories AS cc ON cc.id = a.catid
	INNER JOIN #__sections AS s ON s.id = a.sectionid
	INNER JOIN #__users AS u ON u.id = a.created_by
	WHERE a.state = 1
	AND ( a.publish_up = '.$db->Quote($nullDate).' OR a.publish_up <= '.$db->Quote($now).' )
	AND ( a.publish_down = '.$db->Quote($nullDate).' OR a.publish_down >= '.$db->Quote($now).' )
	AND s.id > 0
	AND s.published = 1 AND cc.published = 1';
if ($accesslevel) {
	$query .= ' AND a.access <= ' .(int) $aid. ' AND cc.access <= ' .(int) $aid. ' AND s.access <= ' .(int) $aid;
}
if ($catid) {
	$ids = explode( ',', $catid );
	JArrayHelper::toInteger( $ids );
	$query .= ' AND (cc.id=' . implode( ' OR cc.id=', $ids ) . ')';
}
if ($secid) {
	$ids = explode( ',', $secid );
	JArrayHelper::toInteger( $ids );
	$query .= ' AND (s.id=' . implode( ' OR s.id=', $ids ) . ')';
}
if ($includefrontpage == '0') {
	$query .= ' AND f.content_id IS NULL ';
}
if ($authorid == 1) {
	$query .= ' AND (created_by = ' . (int) $userid . ' OR modified_by = ' . (int) $userid . ')';
}
elseif ($authorid == 2) {
	$query .= ' AND (created_by <> ' . (int) $userid . ' AND modified_by <> ' . (int) $userid . ')';
}
if ($group == 1) {
	$query .= ' GROUP BY a.created_by';
}
$query .= ' ORDER BY ';

switch ($sortorder) {
	case 0: // creation
		$query .= 'a.created DESC';
	break;
	case 1: // modified
		$query .= 'a.modified DESC';
	break;
	case 1: // modified
		$query .= 'a.hits DESC';
	break;
	case 3: 
		$query .= 'RAND()';
	break;
}

$mainqty = $columns*$rows*$pages;
$db->setQuery($query, 0, $mainqty+$moreqty);
$items = $db->loadObjectList();
if (count($items) == 0) return;	// Return empty

$mainarticles = array_slice($items,0,$mainqty);
$morearticles = array_slice($items,$mainqty);
// Build Main Area
$jxtc = uniqid('jxtc');
$cell_width = intval(100 / $columns);

$doc =&JFactory::getDocument();

/* JXTC Settings */
$jxtcsettings = $jxtc."jxtcsettings = {
  'opacityin':$nptipoi,
  'opacityout':$nptipoo,
  'verticalin':$nptipvi,
  'verticalout':$nptipvo,
  'horizontalin':$nptiphi,
  'horizontalout':$nptipho,
  'durationin':$nptipdi,
  'durationout':$nptipdo,
  'fadein':$nptipfi,
  'fadeout':$nptipfo,
  'pause':$nptpause,
  'transition':'$nptipAnim',
  'subtransition':'$nptipEase',
  'centered':'$nptipCenter'
}";
$doc->addScriptDeclaration($jxtcsettings);

/* JXTC Slidebox */
$doc->addScript("modules/mod_jxtc_newspro/js/slidebox.js");
$doc->addScriptDeclaration("window.addEvent('load', function(){var ".$jxtc."slidebox = new slidebox('$jxtc','$sbFX',$sbObj,$sbTran); });");

/* JXTC Pop Up */
$doc->addScript("modules/mod_jxtc_newspro/js/jxtcpops.js");
$doc->addScriptDeclaration("window.addEvent('load', function(){var ".$jxtc."jxtcpops = new jxtcpops('$jxtc',".$jxtc."jxtcsettings); });");

/* JXTC Tips */
$doc->addScript("modules/mod_jxtc_newspro/js/jxtctips.js");
$doc->addScriptDeclaration("window.addEvent('load', function(){var ".$jxtc."jxtctips = new jxtctips('$jxtc',".$jxtc."jxtcsettings); });");

/* JXTC Hover */
$doc->addScript("modules/mod_jxtc_newspro/js/jxtchover.js");
$doc->addScriptDeclaration("window.addEvent('load', function(){var ".$jxtc."jxtchover = new jxtchover('$jxtc','$hoi','$hoo'); });");

/* Newspro CSS */
$doc->addStyleSheet('modules/mod_jxtc_newspro/css/wall.css','text/css');

if ($pages > 1 || $transmode == 'wind' || $transmode == 'winz' ) {
	JHTML::_('behavior.mootools');
	switch ($transmode) {
		case 'vslide':
			$transflow = ($transflow == 0) ? 'TopBottom' : 'BottomTop';
			$doc->addScript("modules/mod_jxtc_newspro/js/showcaseFX.js");
			$doc->addScriptDeclaration("window.addEvent('load', function(){var $jxtc = new showcasefx('$jxtc','slideVer','$transflow',$transpause,$transspeed,0,'$transtype');});");
		break;
		case 'hslide':
			$transflow = ($transflow == 0) ? 'LeftRight' : 'RightLeft';
			$doc->addScript("modules/mod_jxtc_newspro/js/showcaseFX.js");
			$doc->addScriptDeclaration("window.addEvent('load', function(){var $jxtc = new showcasefx('$jxtc','slideHor','$transflow',$transpause,$transspeed,0,'$transtype');});");
		break;
		case 'fade':
			$doc->addScript("modules/mod_jxtc_newspro/js/showcaseFX.js");
			$doc->addScriptDeclaration("window.addEvent('load', function(){var $jxtc = new showcasefx('$jxtc','fade','none',$transpause,$transspeed,0,'$transtype');});");
		break;
		case 'wind':
			$pages = 1;
			$doc->addScript("modules/mod_jxtc_newspro/js/wallfx.js");
			$doc->addScriptDeclaration("window.addEvent('load', function(){var $jxtc = new wallfx('$jxtc',$width,$height,0);});");
		break;
		case 'winz':
			$pages = 1;
			$doc->addScript("modules/mod_jxtc_newspro/js/wallfx.js");
			$doc->addScriptDeclaration("window.addEvent('load', function(){var $jxtc = new wallfx('$jxtc',$width,$height,1);});");
		break;
	}
}
else {
	$doc->addScriptDeclaration("window.addEvent('load', function(){document.getElementById('".$jxtc."_1').style.display='block';});");
}

$mainareahtml = '<div id="'.$jxtc.'_sc">';
$index=1;
for($p=1;$p<=$pages;$p++) {
	$mainareahtml .= '<div class="'.$jxtc.'shows" id="'.$jxtc.'_'.$p.'" style="display:none;">';
	$mainareahtml .= '<table border="0" cellpadding="0" cellspacing="0" width="100%">';
	for ($r=1;$r<=$rows;$r++) {
		$mainareahtml .= '<tr>';
		for ($c=1;$c<=$columns;$c++) {
			$item = array_shift($mainarticles);
			if (!empty($item)) {
				$mainareahtml .= '<td width="'.$cell_width.'%" class="jnp_content">';
				$rowhtml = $mainhtml;
				$rowmaxintro = $mainmaxintro;
				$rowmaxintrosuf = $mainmaxintrosuf;
				$rowmaxtitle = $mainmaxtitle;
				$rowmaxtitlesuf = $mainmaxtitlesuf;
				$rowmaxtext = $mainmaxtext;
				$rowmaxtextsuf = $mainmaxtextsuf;
				$rowtextbrk = $maintextbrk;
				require 'func_parserow.php';
				$mainareahtml .= $rowhtml;
				$mainareahtml .= '</td>';
				$index++;
			}
		}
		$mainareahtml .='</tr>';
	}
	$mainareahtml .= '</table>';
	$mainareahtml .= '</div>';
}
$mainareahtml .= '</div>';

// Build More Area

$moreareahtml='';
if (count($morearticles) > 0) {
	if ($morelegend) {
		$moreareahtml .= '<a style="color:#'.$morelegendcolor.'">'.$morelegend.'</a><br/>';
	}
	$moreareahtml .= '<table class="jnp_more" border="0" cellpadding="0" cellspacing="0">';
	$c=1;
	foreach ( $morearticles as $item ) {
		if ($c==1) {
			$moreareahtml .= '<tr>';
		}
		$rowhtml = $morehtml;
		$rowmaxintro = $moremaxintro;
		$rowmaxtitle = $moremaxtitle;
		$rowmaxtext = $moremaxtext;
		$rowmaxintrosuf = $moremaxintrosuf;
		$rowmaxtitlesuf = $moremaxtitlesuf;
		$rowmaxtextsuf = $moremaxtextsuf;
		$rowtextbrk = $moretextbrk;
		require 'func_parserow.php';
		$moreareahtml .= '<td>'.$rowhtml.'</td>';
		$c++;
		if ($c > $morecols) {
			$moreareahtml .= '</tr>';
			$c=1;
		}
	}
	if ($c > 1) $moreareahtml .= '</tr>';
	$moreareahtml .= '</table>';
}

$leftbuttonhtml = ($pages == 1) ? '' : '<a href="#" id="'.$jxtc.'_back"><img src="modules/mod_jxtc_newspro/buttons/'.$button.'/prev.png" style="margin:0"/></a>';
$rightbuttonhtml = ($pages == 1) ? '' : '<a href="#" id="'.$jxtc.'_foward"><img src="modules/mod_jxtc_newspro/buttons/'.$button.'/next.png" style="margin:0"/></a>';
$pageshtml = '';
if ($pages > 0) {
	for($p=1;$p<=$pages;$p++) {
		$pageshtml .= '<a href="#" class="'.$jxtc.'_pag" id="'.$jxtc.'_p'.$p.'">'.$p.'</a>';
	}
}

$modulehtml = str_replace( '{leftbutton}', $leftbuttonhtml, $modulehtml );
$modulehtml = str_replace( '{rightbutton}', $rightbuttonhtml, $modulehtml );
$modulehtml = str_replace( '{mainarea}', $mainareahtml, $modulehtml );
$modulehtml = str_replace( '{morearea}', $moreareahtml, $modulehtml );
$modulehtml = str_replace( '{pages}', $pageshtml, $modulehtml );

$contentparams =& $mainframe->getParams('com_content');
JPluginHelper::importPlugin('content');
$dispatcher =& JDispatcher::getInstance();
$item = new stdClass();
$item->text = $modulehtml;
$results = $dispatcher->trigger('onPrepareContent', array (&$item, &$contentparams, 0 ));
$modulehtml = $item->text;

echo '<div id="'.$jxtc.'">'.$modulehtml.'</div>';
?>
<div style="display:none"><a href="http://www.joomlaxtc.com">JoomlaXTC NewsPro - Copyright 2009 Monev Software LLC</a></div>