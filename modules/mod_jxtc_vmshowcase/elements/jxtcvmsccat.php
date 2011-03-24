<?php
defined('JPATH_BASE') or die();

class JElementJxtcvmsccat extends JElement {
	var	$_name = 'Jxtcvmsccat';
	function fetchElement($jxtcname, $jxtcvalue, &$jxtcnode, $jxtccontrol_name)	{
		require_once( JPATH_SITE.'/components/com_virtuemart/virtuemart_parser.php' );
		function vmdgetCatTree (&$jxtccat,&$jxtcref,$jxtcid=0,$jxtclvl=0,&$jxtcoptions) {
			if ($jxtcid>0) {$jxtcoptions[] = array('id' => $jxtcid,'name' => str_repeat('&nbsp;',$jxtclvl-1).$jxtccat[$jxtcid]);}
			if (isset($jxtcref[$jxtcid]) && is_array($jxtcref[$jxtcid])) {foreach($jxtcref[$jxtcid] as $jxtcnewid) {vmdgetCatTree($jxtccat,$jxtcref,$jxtcnewid,$jxtclvl+1,$jxtcoptions);}}
		}
		$jxtccat=array();$jxtcref=array();$jxtcoptions=array();
		$db	=& JFactory::getDBO();
		$q = "SELECT a.category_child_id as id, a.category_parent_id as parent, CONCAT('(',a.category_child_id,') ',b.category_name) as name FROM #__".VM_TABLEPREFIX."_category_xref AS a, #__".VM_TABLEPREFIX."_category AS b WHERE b.category_publish = 'Y' AND b.category_id = a.category_child_id ORDER BY b.list_order, b.category_name";
		$db->setquery($q);
		$result=$db->loadObjectList();
		foreach ($result as $row) {
			$jxtccat[$row->id] = $row->name;	$jxtcref[$row->parent][]=$row->id;
		}
		$null=vmdgetCatTree($jxtccat,$jxtcref,0,0,$jxtcoptions);
		array_unshift($jxtcoptions,(object)array('id'=>0,'name'=>'ALL CATEGORIES'));
		$size = ceil(count($jxtcoptions)/10);
		if ($size < 5) $size = 5 ;
		if ($size > 20) $size = 20;
		return JHTML::_('select.genericlist',  $jxtcoptions, $jxtccontrol_name.'['.$jxtcname.'][]', ' MULTIPLE size="'.$size.'" class="inputbox"', 'id', 'name', $jxtcvalue, $jxtccontrol_name.$jxtcname);
	}
}