<?php
/*
	JoomlaXTC VAI Mediacenter module

	version 1.6
	
	Copyright (C) 2009,2010 Monev Software LLC.	All Rights Reserved.
	
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

defined('_JEXEC') or die('Restricted access');

$live_site = JURI::base();
$doc =&JFactory::getDocument();

$media_type = $params->get('media_type','video');
$media_display = $params->get('media_display','v');
$display = $params->get('display','m');
$width = $params->get('width',300);
$height = $params->get('height',300);
$pwidth = $params->get('pwidth',250);
$lhover = $params->get('lhover',1);
$rhover = $params->get('rhover',0);
$pheight = $params->get('pheight',200);
$speed = $params->get('speed',300);
$show_playlist = $params->get('show_playlist',1);
$logo = $params->get('logo','');
$start_image = $params->get('start_image','');
$logo_position = $params->get('logo_position','br');
$button = $params->get('button','');
$autoplay = $params->get('autoplay',1);
$stretch_playlist = $params->get('stretch_playlist',1);
$stretch_content = $params->get('stretch_content',1);
$rounded_corners = $params->get('rounded_corners',1);
$controls_always_show = $params->get('controls_always_show',1);
$transition_effect = $params->get('transition_effect','horizontal');
$text_line_timeout = $params->get('text_line_timeout',5);
$slideshow_timeout = $params->get('slideshow_timeout',8);
$media_xml = $params->get('media_xml','');
$media_list = $params->get('media_list');
$playlist_active_color = substr(trim($params->get('playlist_active_color','666666')),0,6);
$playlist_inactive_color = substr(trim($params->get('playlist_inactive_color','000000')),0,6);
$playlist_hover_color = substr(trim($params->get('playlist_hover_color','333333')),0,6);
 $text_line = $params->get('text_line',1);
$show_playlist_scroller = $params->get('show_playlist_scroller',1);
$rounded_corners_playlist = $params->get('rounded_corners_playlist',1);
$background_color = substr(trim($params->get('background_color','')),0,6);
$effect_direction = $params->get('effect_direction','top');
$link_target = $params->get('link_target','new');
$pol_xml = $params->get('pol_xml',''); //if $pol_xml == -1 $pol_xml = '';
$media_list = str_replace("<br />","",$media_list);
$media_list = str_replace("\r","\n",$media_list);
if ($logo == -1) $logo = '';
if ($start_image == -1) $start_image = '';
if ($button==-1) $button='';
if ($media_xml == -1) $media_xml = '';
 
$rows=explode("\n",$media_list);
$hold=array();
foreach ($rows as $row) {
	$row=trim($row);
	if (substr($row,0,1) == '#') continue;
	if (empty($row)) {
		$lists[]=$hold;
		$hold=array();
	}
	else {
		$hold[]=$row;
	}
}
if (!empty($hold)) $lists[]=$hold;

switch ($media_display) {
	case 'v':
		$mode = 'vertical';
		$default_width = 320;
		$default_height = 430;
	break;
	case 'h':
		$mode = 'horizontal';
		$default_width = 644;
		$default_height = 240;
	break;
}

if (empty($width)) {$width = $default_width;}
if (empty($height)) {$height = $default_height;}

switch ($media_type) {
	case 'video':
	$player = 'jxtc_video.swf';
	$fields=6;
	break;
	case 'audio':
	$player = 'jxtc_audio.swf';
	$fields=6;
	break;
	case 'image':
	$player = 'jxtc_image.swf';
	$fields=5;
	break;
}

$data = '';
foreach ($lists as $list) {
	if (empty($list[0])) continue;
	for($i=0;$i<=$fields;$i++) {
		$ini = strpos(strtolower($list[$i]),'youtube.com/watch?v=');
		if ($ini !== false) {
			$ini += 20;
			$fin = strpos($list[$i],'&',$ini);
			if ($fin === false) $fin=strlen($list[$i]);
			$list[$i]='['.substr($list[$i],$ini,$fin-$ini).']';
		}
		$data .= $list[$i].',';
	}
	$data=substr($data,0,-1);
	$data .= '|';
}
$data=substr($data,0,-1);

$player_url = $live_site.'modules/mod_jxtc_mediacenter/flash/'.$player;
$jxtc=uniqid('jxtc');
$myself=$module->id;
$flashvars = 	(empty($media_xml) ? '&data='.($data) : '&xml='.(urlencode($media_xml))).
							(empty($start_image) ? '' : '&start-image='.urlencode($live_site.'images/'.$start_image)).
							(empty($logo) ? '' : '&logo='.(urlencode($live_site.'images/'.$logo))).
							'&skin='.(urlencode($live_site.'modules/mod_jxtc_mediacenter/flash/xtcPlayerLib.swf')).
							'&logo-position='.$logo_position.
							'&autoplay='.($autoplay).
							'&text-line-timeout='.($text_line_timeout).
							'&show-playlist='.($show_playlist).
							'&rounded-corners-content='.($rounded_corners).
							'&transition-effect='.($transition_effect).
							'&stretch-playlist='.($stretch_playlist).
							'&stretch-content='.($stretch_content).
							'&slideshow-timeout='.($slideshow_timeout).
							'&controls-always-show='.($controls_always_show).
							'&playlist-active-color=#'.($playlist_active_color).
							'&playlist-inactive-color=#'.($playlist_inactive_color).
							'&playlist-hover-color=#'.($playlist_hover_color).
							'&background-color=#'.($background_color).
							'&text-line='.($text_line).
							'&show-playlist-scroller='.($show_playlist_scroller).
							'&rounded-corners-playlist='.($rounded_corners_playlist).
							(empty($pol_xml) ? '' : '&policy-file='.(urlencode($live_site.$pol_xml))).
							'&effect-direction='.($effect_direction).
							'&link-target='.($link_target).
							'&type='.($mode).
							'&php-folder='.(urlencode($live_site.'modules/mod_jxtc_mediacenter/')).
							'&player-width='.($pwidth).
							'&player-height='.($pheight).
							'&left-hover='.($lhover).
							'&right-hover='.($rhover);
							
switch ($display) {
	case 'p':
		$doc->addScript($live_site.'modules/mod_jxtc_mediacenter/js/winOpen-moo.js');
		$play = "<a href=\"#\" onclick=\"winOpen('winOpenForm','modules/mod_jxtc_mediacenter/mediacenter.php',$width,$height);return false\" />";
		if (!empty($button)) {
				$play .= '<img src="images/'.$button.'" />';
		}
		else {
			$play .= 'Click Here';
		}
		$play .= '</a>';

		$play2 = '<form name="winOpenForm" action="modules/mod_jxtc_mediacenter/mediacenter.php" method="POST" TARGET="winOpen">
			<input type="hidden" name="player_url" value="'.$player_url.'" />
			<input type="hidden" name="flashvars" value="'.$flashvars.'" />
			<input type="hidden" name="width" value="'.$width.'" />
			<input type="hidden" name="height" value="'.$height.'" />
			</form>';

		echo $play,$play2;
	break;
	case 'a':
		$doc->addScript($live_site.'modules/mod_jxtc_mediacenter/js/winOpen-moo.js');
		$play = "<a href=\"#\" onclick=\"winOpen('winOpenForm','modules/mod_jxtc_mediacenter/mediacenter.php',$width,$height);return false\" />";
		if (!empty($button)) {
				$play .= '<img src="images/'.$button.'" />';
		}
		else {
			$play .= 'Click Here';
		}
		$play .= '</a>';

		$play2 = '<form name="winOpenForm" action="modules/mod_jxtc_mediacenter/mediacenter.php" method="POST" TARGET="winOpen">
			<input type="hidden" name="player_url" value="'.$player_url.'" />
			<input type="hidden" name="flashvars" value="'.$flashvars.'" />
			<input type="hidden" name="width" value="'.$width.'" />
			<input type="hidden" name="height" value="'.$height.'" />
			</form>';

		echo $play,$play2;
		$doc->addScriptDeclaration("window.addEvent('domready', function() { winOpen('winOpenForm','modules/mod_jxtc_mediacenter/mediacenter.php',$width,$height);return false});");
	break;
	case 's':
	$box_url = "$player_url?$flashvars";
	JHTML::_('behavior.modal',  'a.modal', array('onClose'=>'\function(){this.content.empty();}'));

?>
<a class="modal" href="<?php echo $box_url; ?>" rel="{handler: 'iframe', size: {x: <?php echo $width; ?>, y: <?php echo $height; ?>}}">
<img src="images/<?php echo $button; ?>" />
</a>
<?php	
	break;
	default:
		$doc->addScript($live_site.'modules/mod_jxtc_mediacenter/js/jxtcswfobject.js');
	$play = '<script type="text/javascript">swfobject.embedSWF("'.$player_url.'", "'.$jxtc.'", "'.$width.'", "'.$height.'", "9", null, {"flashvars":"'.$flashvars.'"}, {"wmode":"transparent","allowFullscreen":"true"});</script>
	<div id="'.$jxtc.'">
		<a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" /></a>
	</div>';
	echo $play;
	break;
}
?>
<div style="display:none"><a href="http://www.joomlaxtc.com">JoomlaXTC VAI Mediacenter - Copyright 2009,2010 Monev Software LLC</a></div>
