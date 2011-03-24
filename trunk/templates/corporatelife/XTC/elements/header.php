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

class JElementHeader extends JElement {
	function fetchElement($jxtcname, $jxtcvalue, &$jxtcnode, $jxtccontrol_name)	{
		
		$live_site = JURI::root();
		$template = basename(dirname(dirname(dirname(__FILE__))));
		
		$document 	=& JFactory::getDocument();
		$document->addStyleSheet($live_site."templates/$template/XTC/XTC.css",'text/css');

		$html = '';
//		$html  .= "</td></tr></table>";
		$html .= '<span class="xtcheader">'.$jxtcnode->attributes('text').'</span>';
//		$html .= '<table width="100%" class="paramlist admintable" cellspacing="1">';
		return $html;
	}
}