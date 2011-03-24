<?php
/*
 JoomlaXTC Virtuemart Product Showcase module (Manufacturer parm)
 version 1.1 (Joomla 1.5)
 copyright (c) 2008 JoomlaXTC   www.joomlaxtc.com
*/
defined('JPATH_BASE') or die();

class JElementJxtcvmscman extends JElement {
	var	$_name = 'Jxtcvmscman';
	function fetchElement($jxtcname, $jxtcvalue, &$jxtcnode, $jxtccontrol_name)	{
		function nice($size) {
			$size = ceil($size/10);
			if ($size < 5) $size = 5 ;
			if ($size > 20) $size = 20;
			return $size;
		}
		require_once( JPATH_SITE.'/components/com_virtuemart/virtuemart_parser.php' );
		$db	=& JFactory::getDBO();
		$q = "SELECT manufacturer_id as id,CONCAT('(',manufacturer_id,') ',mf_name) as name FROM #__".VM_TABLEPREFIX."_manufacturer ORDER BY mf_name";
		$db->setquery($q);
		$result=$db->loadObjectList();
		array_unshift($result,(object)array('id'=>0,'name'=>'ALL MANUFACTURERS'));
		$size = count($result);
		if ($size == 0) {
			return '<i>(No manufacturers found.)</i><input type="hidden" name="'.$jxtccontrol_name.'['.$jxtcname.'][]" id="'.$jxtccontrol_name.$jxtcname.'" />';
		}
		else {
			$size = ceil($size/10);
			if ($size < 5) $size = 5;
			if ($size > 20) $size = 20;
			return JHTML::_('select.genericlist',  $result, $jxtccontrol_name.'['.$jxtcname.'][]', ' MULTIPLE size="'.$size.'" class="inputbox"', 'id', 'name', $jxtcvalue, $jxtccontrol_name.$jxtcname);
		}
	}
}