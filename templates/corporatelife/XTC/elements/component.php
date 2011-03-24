<?php
/*******************************************************************************
********************************************************************************
***                                                                          ***
***   XTC Template Framework 1.0                                             ***
***                                                                          ***
***   Copyright (c) 2010 Monev Software LLC                                  ***
***                                                                          ***
***   All Rights Reserved                                                    ***
***                                                                          ***
********************************************************************************
*******************************************************************************/

defined( '_JEXEC' ) or die( 'Restricted access' );

class JElementComponent extends JElement {
	function fetchElement($jxtcname, $jxtcvalue, &$jxtcnode, $jxtccontrol_name)	{

		$live_site = JURI::root();
		$template = basename(dirname(dirname(dirname(__FILE__))));
		
		$document 	=& JFactory::getDocument();
		$document->addStyleSheet($live_site."templates/$template/XTC/XTC.css",'text/css');

		$db	=& JFactory::getDBO();
		$q = "SELECT ".$db->nameQuote('option')." as id,".$db->nameQuote('option')." as name FROM #__components WHERE ".$db->nameQuote('option')." <> '' GROUP BY ".$db->nameQuote('option')." ORDER BY ".$db->nameQuote('option');
		$db->setquery($q);
		$result=$db->loadObjectList();
		array_unshift($result,(object)array('id'=>'all','name'=>'ALL COMPONENTS'));
		$size = count($result);
		$size = ceil($size/10);
		if ($size < 10) $size = 10;
		if ($size > 20) $size = 20;
		return JHTML::_('select.genericlist',  $result, $jxtccontrol_name.'['.$jxtcname.'][]', ' MULTIPLE size="'.$size.'" class="inputbox"', 'id', 'name', $jxtcvalue, $jxtccontrol_name.$jxtcname);
	}
}