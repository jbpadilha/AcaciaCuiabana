<?php
/*
	JoomlaXTC Virtuemart Drill-down module

	version 2.5.1
	
	Copyright (C) 2008,2009,2010  Monev Software LLC.	All Rights Reserved.
	
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

$select_category 			= $params->get( 'txt_cat', 'Category:' );
$select_manufacturer	= $params->get( 'txt_man', 'Brand:' );
$select_product 			= $params->get( 'txt_pro', 'Product:' );
$error_category 			= $params->get( 'err_cat', '<span class="vmdErr">No categories available!</span>');
$error_manufacturer 	= $params->get( 'err_man', '<span class="vmdErr">No brands available!</span>');
$error_product 				= $params->get( 'err_pro', '<span class="vmdErr">No products available!</span>');
$moduleclass_sfx			= $params->get( 'moduleclass_sfx', '');

$site = JURI::base();

require_once( dirname(__FILE__).'/../../components/com_virtuemart/virtuemart_parser.php' );

$name=array();$xref=array();
function vmdgetCatTree (&$name,&$xref,$id=0,$lvl=0) {
	if (is_array($xref[$id])) {$style='style="font-weight:bold;background-color:#f0f0f0"';}
	else {$style='';}
	if ($id>0) {echo '<option '.$style.' value="'.$id.'">'.str_repeat('&nbsp;',$lvl-1).$name[$id].'</option>';}
	if (is_array($xref[$id])) {foreach($xref[$id] as $newid) {vmdgetCatTree($name,$xref,$newid,$lvl+1);}}
	return;
}
$db	=& JFactory::getDBO();
$q = "SELECT a.category_child_id as id,a.category_parent_id as parent, b.category_name as name FROM #__".VM_TABLEPREFIX."_category_xref AS a, #__".VM_TABLEPREFIX."_category AS b WHERE b.category_publish = 'Y' AND b.category_id = a.category_child_id ORDER BY b.list_order, b.category_name";
$db->setquery($q);
$result=$db->loadObjectList();
foreach ($result as $row) {
	$name[$row->id] = $row->name;	$xref[$row->parent][]=$row->id;
}
$jxtc=uniqid('jxtc');
$doc =&JFactory::getDocument();
$doc->addStyleSheet($site.'modules/mod_jxtc_vmdrill/vmdrill.css');

?>
<div id="vmdDiv">
<form id="vmdForm" name="vmdForm" action="" method="post" >
	<div id="vmdCatDiv">
		<select id="vmdCatSel" onchange="getCat()">
			<?php
				if (!empty($select_category)) {echo '<option value="">'.$select_category.'</option>';}
				vmdgetCatTree($name,$xref,0,0);
			?>
		</select>
	</div>
	<div id="vmdMfDiv"></div>
	<div id="vmdProdDiv"></div>
</form>
</div>
<script type="text/javascript" language="javascript">
<!--
	var spin = '<img style="margin-left:50%" src="<?php echo $site; ?>modules/mod_jxtc_vmdrill/spinner.gif" alt="spinner"/>';
	function getCat() {
		var rnd = Math.floor(Math.random()*1000)	
    var cat = $('vmdCatSel').getValue();
    if (cat == '') {
			$('vmdMfDiv').setHTML('');
			$('vmdProdDiv').setHTML('');
    	return;
   	}
		$('vmdMfDiv').setHTML(spin);
		$('vmdProdDiv').setHTML('');
    new Ajax('<?php echo $site; ?>modules/mod_jxtc_vmdrill/helper.php?rnd='+rnd+'&act=m&cat='+cat+'&msg=<?php echo base64_encode($select_manufacturer); ?>'+'&err=<?php echo base64_encode($error_manufacturer); ?>',{method:'get',update:$('vmdMfDiv')}).request();
	}

	function getMf() {
		var rnd = Math.floor(Math.random()*1000)	
    var cat = $('vmdCatSel').getValue();
    var mf = $('vmdMfSel').getValue();
    if (mf == '') {
			$('vmdProdDiv').setHTML('');
    	return;
   	}
		$('vmdProdDiv').setHTML(spin);
    new Ajax('<?php echo $site; ?>modules/mod_jxtc_vmdrill/helper.php?rnd='+rnd+'&act=p&cat='+cat+'&mf='+mf+'&msg=<?php echo base64_encode($select_product); ?>'+'&err=<?php echo base64_encode($error_product); ?>',{method:'get',update:$('vmdProdDiv')}).request();
	}

	function getProd() {
		var rnd = Math.floor(Math.random()*1000)	
    var cat = $('vmdCatSel').getValue();
    var mf = $('vmdMfSel').getValue();
    var prod = $('vmdProdSel').getValue();
		$('vmdDiv').setHTML(spin);
		new Ajax('<?php echo $site; ?>modules/mod_jxtc_vmdrill/helper.php?rnd='+rnd+'&act=i&cat='+cat+'&mf='+mf+'&prod='+prod,{method:'get',onComplete:showProd}).request();
	}

	function showProd(request){
		window.location = request;
	};
-->
</script>
<div style="display:none"><a href="http://www.joomlaxtc.com">JoomlaXTC Virtuemart Drill-down - Copyright 2008,2009,2010 Monev Software LLC</a></div>