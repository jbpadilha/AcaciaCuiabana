<?php
/*
	JoomlaXTC VMbanners module

	version 1.2
	
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
	
	THIS LICENSE MIGHT NOT APPLY TO OTHER FILES CONTAINED IN THE SAME PACKAGE.
	
	See COPYRIGHT.php for more information.
	See LICENSE.php for more information.
	
	Monev Software LLC
	www.joomlaxtc.com
*/

if (!defined('_JEXEC')) die('Direct Access to this location is not allowed.');

global $mosConfig_absolute_path,$sess;

$doc =&JFactory::getDocument();
$doc->addStyleSheet('modules/mod_jxtc_vmbanners/vmbanner.css','text/css');

// Load the virtuemart main parse code
if( file_exists(dirname(__FILE__).'/../../components/com_virtuemart/virtuemart_parser.php' )) {
	require_once( dirname(__FILE__).'/../../components/com_virtuemart/virtuemart_parser.php' );
} else {
	require_once( dirname(__FILE__).'/../components/com_virtuemart/virtuemart_parser.php' );
}

$width = $params->get('width',300);
$height = $params->get('height',200);
$speed = $params->get('speed',2000);
$limit = $params->get('limit',5);
$direction = $params->get('direction',"1");
$effect = $params->get('effect',"1");
$position = $params->get('position',"bottom");
$filter = $params->get('filter','_banner');
$desclen = $params->get('desclen',0);

switch ($direction) {
	default: //1 TopBottom
	$orientation = 'TopBottom';
	$slidemode = ($effect == "1") ? 'slideVer' : 'fade';
	break;
	case 2: // BottomTop
	$orientation = 'BottomTop';
	$slidemode = ($effect == "1") ? 'slideVer' : 'fade';
	break;
	case 3: // RightLeft
	$orientation = 'RightLeft';
	$slidemode = ($effect == "1") ? 'slideHor' : 'fade';
	break;
	case 4: // LeftRight
	$orientation = 'LeftRight';
	$slidemode = ($effect == "1") ? 'slideHor' : 'fade';
	break;
}

$live_site = JURI::base();
$db = new ps_DB;

$q  = "SELECT DISTINCT a.*,b.file_name,b.file_title FROM #__{vm}_product a, #__{vm}_product_files b WHERE";
$q .= " (a.product_parent_id='' OR a.product_parent_id='0')";
$q .= " AND a.vendor_id='".$_SESSION['ps_vendor_id']."'";
$q .= " AND a.product_publish='Y'";
$q .= " AND b.file_product_id=a.product_id";
$q .= " AND b.file_is_image=1";
$q .= " AND b.file_name like '%$filter%'";
if( CHECK_STOCK && PSHOP_SHOW_OUT_OF_STOCK_PRODUCTS != "1") {
	$q .= " AND a.product_in_stock > 0 ";
}
$q .= "ORDER BY RAND() LIMIT 0, $limit";
$db->query($q);
if( $db->num_rows() > 0 ) {
	$jxtc=uniqid('jxtc');
	$doc =& JFactory::getDocument();
	$doc->addCustomTag('<script type="text/javascript" src="modules/mod_jxtc_vmbanners/js/vmbanners.js"></script>');
	?>
	<script type="text/javascript">
	window.addEvent('domready', function(){
		var jxtc<?php echo $jxtc; ?> = new vmbanners(<?php echo "'$jxtc','$slidemode','$orientation','$position',200,$width,$height,$speed,1"; ?>);
   	document.getElementById("<?php echo $jxtc; ?>").style.display = "block";
	}); 
	</script>
	<?php
	echo '<div id="'.$jxtc.'" class="vmbanners" style="display:none">';
	while($db->next_record() ){
    $url = $live_site."index.php?option=com_virtuemart&amp;page=shop.product_details&amp;product_id=".$db->f("product_id").'&amp;Itemid='.$sess->getShopItemid();
		$product_s_desc = $db->f('product_s_desc');
		if ($desclen > 0 && strlen($product_s_desc) > $desclen) $product_s_desc = trim(substr($product_s_desc,0,$desclen)).'...';

  	echo '<div class="vmbanner" title="'.htmlentities($db->f("product_name")).'" rev="'.htmlentities($product_s_desc).'">
    <a href="'.$url.'"><img src="'.$live_site.$db->f('file_name').'" alt="'.htmlentities($db->f('file_title')).'"/></a>
	  </div>';
	}
	echo '</div>';
}
?>
<div style="display:none"><a href="http://www.joomlaxtc.com">JoomlaXTC VM Banners - Copyright 2008,2009,2010 Monev Software LLC</a></div>
