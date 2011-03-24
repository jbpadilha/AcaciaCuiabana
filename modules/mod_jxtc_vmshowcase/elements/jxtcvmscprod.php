<?php
defined('JPATH_BASE') or die();

class JElementJxtcvmscprod extends JElement {
	var	$_name = 'Jxtcvmscprod';
	function fetchElement($jxtcname, $jxtcvalue, &$jxtcnode, $jxtccontrol_name)	{
		require_once( JPATH_SITE.'/components/com_virtuemart/virtuemart_parser.php' );
		$db	=& JFactory::getDBO();
		$q = "SELECT product_id as id,CONCAT('(',product_id,') ',product_name) as name FROM #__".VM_TABLEPREFIX."_product WHERE product_publish='Y' ORDER BY product_name";
		$db->setquery($q);
		$result=$db->loadObjectList();
		array_unshift($result,(object)array('id'=>0,'name'=>'ALL PRODUCTS'));
		$size = ceil(count($result)/10);
		if ($size < 5) $size = 5;
		if ($size > 20) $size = 20;
		return JHTML::_('select.genericlist',  $result, $jxtccontrol_name.'['.$jxtcname.'][]', ' MULTIPLE size="'.$size.'" class="inputbox"', 'id', 'name', $jxtcvalue, $jxtccontrol_name.$jxtcname);
	}
}