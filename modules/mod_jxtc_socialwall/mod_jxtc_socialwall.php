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

defined('_JEXEC') or die('Restricted access');
require_once (JPATH_SITE.DS.'components'.DS.'com_content'.DS.'helpers'.DS.'route.php');
include_once( JPATH_ROOT . DS . 'components' . DS . 'com_community' . DS . 'defines.community.php' );
require_once( JPATH_ROOT . DS . 'components' . DS . 'com_community' . DS . 'libraries' . DS . 'core.php' );

CFactory::load( 'libraries','error');

$usermodel =& CFactory::getModel('user');	

$live_site = JURI::base();
$live_site .= (substr($live_site,-1) == '/') ? '' : '/';
$db =&JFactory::getDBO();
$user =&JFactory::getUser();
$userid = $user->get('id');
$nullDate	= $db->getNullDate();
$date =&JFactory::getDate();
$now = $date->toMySQL();

$updated_avatar_only	= $params->get('updated_avatar_only', 0);
$onlineonly	= $params->get('onlineonly', 0);
$avatarw 	= $params->get( 'avatarw', '120' );	$avatarw = 	empty($avatarw) ? '' : ' width="'.$avatarw.'"';
$avatarh 	= $params->get( 'avatarh', '90' );	$avatarh = 	empty($avatarh) ? '' : ' height="'.$avatarh.'"';
$columns = $params->get('columns',3);
$rows	= $params->get('rows', 3);
$pages = $params->get('pages', 1);
$sortfield = $params->get('sortfield', 0);
$sortorder = $params->get('sortorder', 1);
$displayshowall = $params->get('displayshowall', 0);
$transmode = $params->get( 'transmode', "hslide" );
$transpause = $params->get( 'transpause', 4000 );
$transspeed = $params->get( 'transspeed', 1500 );
$transflow = $params->get('transflow', 0);
$transtype = $params->get('transtype', 1);
$button	= $params->get('button','gray');
$moduletemplate	= trim( $params->get('moduletemplate','{mainarea}'));
$itemtemplate	= trim( $params->get('itemtemplate','{username}'));
$dateformat	= trim( $params->get('dateformat','Y-m-d' ));
$width = $params->get('width',200);
$height = $params->get('height',200);
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

// Build query
$query	= 'SELECT * FROM #__users AS a INNER JOIN #__community_users AS b ON a.id = b.userid
	WHERE a.block = 0';
if ($onlineonly) {
	$query	.= ' AND a.id in (SELECT DISTINCT(uu.id) FROM #__users AS uu INNER JOIN #__session AS ss ON uu.id=ss.userid WHERE uu.block=0 and ss.client_id != 1)';
}
if ($updated_avatar_only) {
	$query .= ' AND b.avatar != "components/com_community/assets/default.jpg"';
}
$query	.= ' ORDER BY ';

switch ($sortfield) {
	case '0': // Register date
	$query .= 'a.registerDate';
	break;
	case '1': // Last visit
	$query .= 'a.lastvisitDate';
	break;
	case '2': // Last post
	$query .= 'b.posted_on';
	break;
	case '3': // ID
	$query .= 'a.id';
	break;
	case '4': // Name
	$query .= 'a.name';
	break;
	case '5': // User name
	$query .= 'a.username';
	break;
	case '6': // Friend count
	$query .= 'b.friendcount';
	break;
	case '7': //Random
	$query .= 'RAND()';
	break;
	case '8': //Popularity
	$query .= 'b.view';
	break;
}

$query .= ($sortorder == '0') ? ' ASC ' : ' DESC ';
$query .= 'LIMIT '.$columns*$rows*$pages;

$db->setQuery( $query );
$items = $db->loadObjectList();

if (count($items) == 0) {
	echo JText::_('No members yet');
	return;	// Return empty
}

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
$doc->addScript("modules/mod_jxtc_socialwall/js/slidebox.js");
$doc->addScriptDeclaration("window.addEvent('load', function(){var ".$jxtc."slidebox = new slidebox('$jxtc','$sbFX',$sbObj,$sbTran); });");

/* JXTC Pop Up */
$doc->addScript("modules/mod_jxtc_socialwall/js/jxtcpops.js");
$doc->addScriptDeclaration("window.addEvent('load', function(){var ".$jxtc."jxtcpops = new jxtcpops('$jxtc',".$jxtc."jxtcsettings); });");

/* JXTC Tips */
$doc->addScript("modules/mod_jxtc_socialwall/js/jxtctips.js");
$doc->addScriptDeclaration("window.addEvent('load', function(){var ".$jxtc."jxtctips = new jxtctips('$jxtc',".$jxtc."jxtcsettings); });");

/* JXTC Hover */
$doc->addScript("modules/mod_jxtc_socialwall/js/jxtchover.js");
$doc->addScriptDeclaration("window.addEvent('load', function(){var ".$jxtc."jxtchover = new jxtchover('$jxtc','$hoi','$hoo'); });");

/* CSS */
$doc->addStyleSheet('modules/mod_jxtc_socialwall/css/wall.css','text/css');

if ($pages > 1 || $transmode == 'wind' || $transmode == 'winz'  ) {
	JHTML::_('behavior.mootools');
	switch ($transmode) {
		case 'vslide':
			$transflow = ($transflow == 0) ? 'TopBottom' : 'BottomTop';
			$doc->addScript("modules/mod_jxtc_socialwall/js/showcaseFX.js");
			$doc->addScriptDeclaration("window.addEvent('load', function(){var $jxtc = new showcasefx('$jxtc','slideVer','$transflow',$transpause,$transspeed,0,'$transtype');});");
		break;
		case 'hslide':
			$transflow = ($transflow == 0) ? 'LeftRight' : 'RightLeft';
			$doc->addScript("modules/mod_jxtc_socialwall/js/showcaseFX.js");
			$doc->addScriptDeclaration("window.addEvent('load', function(){var $jxtc = new showcasefx('$jxtc','slideHor','$transflow',$transpause,$transspeed,0,'$transtype');});");
		break;
		case 'fade':
			$doc->addScript("modules/mod_jxtc_socialwall/js/showcaseFX.js");
			$doc->addScriptDeclaration("window.addEvent('load', function(){var $jxtc = new showcasefx('$jxtc','fade','none',$transpause,$transspeed,0,'$transtype');});");
		break;
		case 'wind':
			$pages = 1;
			$doc->addScript("modules/mod_jxtc_socialwall/js/wallFX.js");
			$doc->addScriptDeclaration("window.addEvent('load', function(){var $jxtc = new wallfx('$jxtc',$width,$height,0);});");
		break;
		case 'winz':
			$pages = 1;
			$doc->addScript("modules/mod_jxtc_socialwall/js/wallFX.js");
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
	$mainareahtml .= '<table cellpadding="0" cellspacing="0" width="100%" style="margin:0px;padding:0px;border:none">';
	for ($r=1;$r<=$rows;$r++) {
		$mainareahtml .= '<tr>';
		for ($c=1;$c<=$columns;$c++) {
			$item = array_shift($items);
			if (!empty($item)) {
				$mainareahtml .= '<td width="'.$cell_width.'%" class="jnp_content">';
				$itemhtml=$itemtemplate;
				include 'func_parserow.php';
				$mainareahtml .= $itemhtml;
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

$leftbuttonhtml = ($pages == 1) ? '' : '<a href="#" id="'.$jxtc.'_back"><img src="modules/mod_jxtc_socialwall/buttons/'.$button.'/prev.png" style="margin:0"/></a>';
$rightbuttonhtml = ($pages == 1) ? '' : '<a href="#" id="'.$jxtc.'_foward"><img src="modules/mod_jxtc_socialwall/buttons/'.$button.'/next.png" style="margin:0"/></a>';
$displayall = '<a style="float:right" href="'.CRoute::_("index.php?option=com_community&view=search&task=browse&sort=latest").'">'.JText::_("Show All").'</a>';
$pageshtml = '';
if ($pages > 0) {
	for($p=1;$p<=$pages;$p++) {
		$pageshtml .= '<a href="#" class="'.$jxtc.'_pag" id="'.$jxtc.'_p'.$p.'">'.$p.'</a>';
	}
}

$modulehtml = $moduletemplate;
$modulehtml = str_replace( '{leftbutton}', $leftbuttonhtml, $modulehtml );
$modulehtml = str_replace( '{rightbutton}', $rightbuttonhtml, $modulehtml );
$modulehtml = str_replace( '{mainarea}', $mainareahtml, $modulehtml );
$modulehtml = str_replace( '{pages}', $pageshtml, $modulehtml );
$modulehtml = str_replace( '{displayallurl}', $displayall, $modulehtml );

$contentparams =& $mainframe->getParams('com_content');
JPluginHelper::importPlugin('content');
$dispatcher =& JDispatcher::getInstance();
$item = new stdClass();
$item->text = $modulehtml;
$results = $dispatcher->trigger('onPrepareContent', array (&$item, &$contentparams, 0 ));
$modulehtml = $item->text;
echo '<div id="'.$jxtc.'">'.$modulehtml.'</div>';
?>
<div style="display:none"><a href="http://www.joomlaxtc.com">JoomlaXTC Social Wall - Copyright 2009 Monev Software LLC</a></div>