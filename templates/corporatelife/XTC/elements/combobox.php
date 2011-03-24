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

class JElementCombobox extends JElement {
	var	$_name = 'List';

	function fetchElement($name, $value, &$node, $control_name) {

		$class = ( $node->attributes('class') ? 'class="'.$node->attributes('class').'"' : 'class="inputbox"' );

		$live_site = JURI::root();
		$template = basename(dirname(dirname(dirname(__FILE__))));
		$document =& JFactory::getDocument();
		$document->addScript($live_site."templates/$template/XTC/elements/combobox.js");

		$html = '<div style="position:relative">';
		$html .= '<input type="text" name="'.$control_name.'['.$name.']" id="'.$control_name.$name.'" class="combobox" value="'.$value.'" />';
		$html .= '<ul id="combobox-'.$control_name.$name.'" style="display:none;">';
		foreach ($node->children() as $option) {
			$value	= $option->attributes('value');
			$html .= '<li>'.$value.'</li>';
			$orders .= $jxtc.'['.$idx++.'] = new Array( "'.$value.'","'.$value.'","'.$value.'::'.$value.'" );';
		}
		$html .= '</ul>';
		$html .= '</div>';
		return $html;
	}
}
