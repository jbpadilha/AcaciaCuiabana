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
?>
<html>
<body style="background-color:#000000;margin:0px;padding:0px">
<?php
$player_url = 'flash/'.basename($_POST['player_url']);
$flashvars = $_POST['flashvars'];
$width = $_POST['width'];
$height = $_POST['height'];
?>
<script src="js/swfobject.js" type="text/javascript"></script>
<center>
<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" width="<?php echo $width; ?>" height="<?php echo $height; ?>" id="<?php echo $jxtc; ?>" align="middle">
    <param name="allowFullScreen" value="true" />
    <param name="movie" value="<?php echo $player_url; ?>" />
    <param name="quality" value="high" />
 	 	<param name="scale" value="noborder" /> 
		<param name="FlashVars" value="<?php echo $flashvars; ?>" />
		<embed	src="<?php echo $player_url; ?>" 
				FlashVars="<?php echo $flashvars; ?>" 
				quality="high" 
				width="<?php echo $width; ?>" 
    	  height="<?php echo $height; ?>" 
    	  align="middle" 
    	  allowscriptaccess="sameDomain" allowFullScreen="true" 
    	  type="application/x-shockwave-flash" 
    	  pluginspage="http://www.macromedia.com/go/getflashplayer" />
</object>
</center>
</body>
</html>