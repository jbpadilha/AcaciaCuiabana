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

defined( '_JEXEC' ) or die;

class JElementparameterlist extends JElement {
	function fetchElement($jxtcname, $jxtcvalue, &$jxtcnode, $jxtccontrol_name)	{

		if (!function_exists('xtcsortoptions')) {
				function xtcsortoptions($a, $b) {
			   return strnatcmp($a->text,$b->text);
			}
		}

		jimport( 'joomla.filesystem.folder' );

		$live_site = JURI::root();
		$template = basename(dirname(dirname(dirname(__FILE__))));
		
		$path = JPATH_ROOT.DS.'templates'.DS.$template;
		$files = JFolder::files($path.DS.'parameters','xml');

		$prefix = trim($jxtcnode->attributes('group'));
		$options=array();
		foreach ($files as $file) {
			@list($filename,$extension)=explode('.',$file);
			if ($extension != 'xml') continue; // Not an XML
			if (strpos($filename,$prefix) !== 0) continue; // Not my robot
			$xmlFile = $path.DS.'parameters'.DS.$file;
			if (!is_readable($xmlFile)) { continue; }

			$xmlData = file_get_contents($xmlFile);
			$xml =& JFactory::getXMLParser('Simple');
			$xml->loadString($xmlData);
			$name =& $xml->document->getElementByPath('name')->data();
			$description =& $xml->document->getElementByPath('description')->data();
			$options[] = JHTML::_('select.option', $filename, $name);
		}

		usort($options, "xtcsortoptions");

		return (empty($options)) ? JText::sprintf('No parameters of group "%s" found.', $prefix) : JHTML::_('select.genericlist',  $options, $jxtccontrol_name.'['.$jxtcname.']', 'class="inputbox"', 'value', 'text', $jxtcvalue, $jxtccontrol_name.$jxtcname);
	}
}
