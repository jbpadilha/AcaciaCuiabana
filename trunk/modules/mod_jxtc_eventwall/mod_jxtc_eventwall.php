<?php
/*
	JoomlaXTC Event Wall Module
	
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
	
	See COPYRIGHT.php for more information.
	See LICENSE.php for more information.
	
	Monev Software LLC
	www.joomlaxtc.com
*/

defined('_JEXEC') or die('Restricted access');
global $CONFIG_EXT, $EXTCAL_CONFIG, $cal_id, $cat_id, $cat_list, $private_events_mode, $lang_latest_events, $userParams;
$userParams = $params;

$db = &JFactory::getDBO();
$live_site = JURI::root();
$today = date('Y-m-d');

require_once (JPATH_SITE.DS.'components'.DS.'com_content'.DS.'helpers'.DS.'route.php');

$query = "SELECT id FROM #__menu WHERE link like '%index.php?option=com_eventlist%' AND published = '1' LIMIT 1";
$db->setQuery( $query );
$Itemid = $db->loadResult();
$Itemid = empty($Itemid) ? '' : '&Itemid='.$Itemid;

$categories = $params->get('categories',0);
$venues = $params->get('venues',0);
$events = $params->get('events',0);
$startdate = $params->get('startdate',''); if (empty($startdate)) $startdate = $today;
//$enddate = $params->get('enddate','');
$perioddays = (int) $params->get('perioddays',30);
$columns = $params->get('columns',3);
$rows	= $params->get('rows', 3);
$pages = $params->get('pages', 1);
$description_max_length = (int) $params->def('description_max_length',256);
$date_format = $params->get( 'date_format', "Y-m-d" );
$no_upcoming_events_text = $params->def('no_upcoming_events_text','No upcoming events.');
$transmode = $params->get( 'transmode', "hslide" );
$transpause = $params->get( 'transpause', 4000 );
$transspeed = $params->get( 'transspeed', 1500 );
$transflow = $params->get('transflow', 0);
$transtype = $params->get('transtype', 1);
$button	= $params->get('button','gray');
$moduletemplate = $params->get('moduletemplate', '{mainarea}');
$itemtemplate = $params->get('itemtemplate', '{title}');
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

$enddate = date('Y-m-d',strtotime($startdate)+$perioddays*86400);

$query = "SELECT c.id as cid, c.catname, c.catdescription, c.image as catimage,
	v.id as vid, v.alias as valias, v.venue, v.url as venuewebsite, v.street as venuestreet, v.plz as venueplz, v.city as venuecity,
	v.state as venuestate, v.country as venuecountry, v.locdescription as venuedescription, v.locimage as venueimage,
	e.id as eid, e.dates as eventstartdate, e.enddates as eventenddate, e.times as eventstarttime, e.endtimes as eventendtime, 
	e.alias as ealias, e.title as event, e.datdescription as eventdescription, e.datimage as eventimage
	FROM #__eventlist_events as e, #__eventlist_venues as v, #__eventlist_categories as c
WHERE e.locid = v.id and e.catsid = c.id and e.published = 1 and v.published = 1 and c.published = 1
  and e.dates >= '$startdate' and e.dates <= '$enddate'";

if (!empty($categories)) {
	if (!is_array($categories)) $categories=array($categories);
	JArrayHelper::toString( $categories );
	$query .= ' AND (c.id="' . implode( '" OR c.id="', $categories ) . '")';
}

if (!empty($venues)) {
	if (!is_array($venues)) $venues=array($venues);
	JArrayHelper::toString( $venues );
	$query .= ' AND (v.id="' . implode( '" OR v.id="', $venues ) . '")';
}

if (!empty($events)) {
	if (!is_array($events)) $events=array($events);
	JArrayHelper::toString( $events );
	$query .= ' AND (e.id="' . implode( '" OR e.id="', $events ) . '")';
}

$query .= ' ORDER BY ' . $db->nameQuote( 'e.dates') . ' asc';

// query the db

$db->setQuery( $query , 0, $columns*$rows*$pages);
$items = $db->loadObjectList();

if (count($items) == 0) {
   echo '<div class="latest_event">'.$no_upcoming_events_text.'</div>';
   return;
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
$doc->addScript("modules/mod_jxtc_eventwall/js/slidebox.js");
$doc->addScriptDeclaration("window.addEvent('load', function(){var ".$jxtc."slidebox = new slidebox('$jxtc','$sbFX',$sbObj,$sbTran); });");

/* JXTC Pop Up */
$doc->addScript("modules/mod_jxtc_eventwall/js/jxtcpops.js");
$doc->addScriptDeclaration("window.addEvent('load', function(){var ".$jxtc."jxtcpops = new jxtcpops('$jxtc',".$jxtc."jxtcsettings); });");

/* JXTC Tips */
$doc->addScript("modules/mod_jxtc_eventwall/js/jxtctips.js");
$doc->addScriptDeclaration("window.addEvent('load', function(){var ".$jxtc."jxtctips = new jxtctips('$jxtc',".$jxtc."jxtcsettings); });");

/* JXTC Hover */
$doc->addScript("modules/mod_jxtc_eventwall/js/jxtchover.js");
$doc->addScriptDeclaration("window.addEvent('load', function(){var ".$jxtc."jxtchover = new jxtchover('$jxtc','$hoi','$hoo'); });");

/* CSS */
$doc->addStyleSheet('modules/mod_jxtc_eventwall/css/wall.css','text/css');

if ($pages > 1 || $transmode == 'wind' || $transmode == 'winz'  ) {
	JHTML::_('behavior.mootools');
	switch ($transmode) {
		case 'vslide':
			$transflow = ($transflow == 0) ? 'TopBottom' : 'BottomTop';
			$doc->addScript("modules/mod_jxtc_eventwall/js/showcaseFX.js");
			$doc->addScriptDeclaration("window.addEvent('load', function(){var $jxtc = new showcasefx('$jxtc','slideVer','$transflow',$transpause,$transspeed,0,'$transtype');});");
		break;
		case 'hslide':
			$transflow = ($transflow == 0) ? 'LeftRight' : 'RightLeft';
			$doc->addScript("modules/mod_jxtc_eventwall/js/showcaseFX.js");
			$doc->addScriptDeclaration("window.addEvent('load', function(){var $jxtc = new showcasefx('$jxtc','slideHor','$transflow',$transpause,$transspeed,0,'$transtype');});");
		break;
		case 'fade':
			$doc->addScript("modules/mod_jxtc_eventwall/js/showcaseFX.js");
			$doc->addScriptDeclaration("window.addEvent('load', function(){var $jxtc = new showcasefx('$jxtc','fade','none',$transpause,$transspeed,0,'$transtype');});");
		break;
		case 'wind':
			$pages = 1;
			$doc->addScript("modules/mod_jxtc_eventwall/js/wallFX.js");
			$doc->addScriptDeclaration("window.addEvent('load', function(){var $jxtc = new wallfx('$jxtc',$width,$height,0);});");
		break;
		case 'winz':
			$pages = 1;
			$doc->addScript("modules/mod_jxtc_eventwall/js/wallFX.js");
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
			$item = array_shift($items);
			if (!empty($item)) {
				$mainareahtml .= '<td width="'.$cell_width.'%" class="jnp_content">';
				$itemhtml = $itemtemplate;
				require 'func_parserow.php';
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

$leftbuttonhtml = ($pages == 1) ? '' : '<a href="#" id="'.$jxtc.'_back"><img src="modules/mod_jxtc_eventwall/buttons/'.$button.'/prev.png" style="margin:0"/></a>';
$rightbuttonhtml = ($pages == 1) ? '' : '<a href="#" id="'.$jxtc.'_foward"><img src="modules/mod_jxtc_eventwall/buttons/'.$button.'/next.png" style="margin:0"/></a>';
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

$contentparams =& $mainframe->getParams('com_content');
JPluginHelper::importPlugin('content');
$dispatcher =& JDispatcher::getInstance();
$item = new stdClass();
$item->text = $modulehtml;
$results = $dispatcher->trigger('onPrepareContent', array (&$item, &$contentparams, 0 ));
$modulehtml = $item->text;
echo '<div id="'.$jxtc.'">'.$modulehtml.'</div>';
?>
<div style="display:none"><a href="http://www.joomlaxtc.com">JoomlaXTC Event Wall - Copyright 2009 Monev Software LLC</a></div>