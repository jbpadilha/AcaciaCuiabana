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

class JElementLayoutlist extends JElement {
	function fetchElement($jxtcname, $jxtcvalue, &$jxtcnode, $jxtccontrol_name)	{

		jimport( 'joomla.filesystem.folder' );

		$live_site = JURI::root();
		$template = basename(dirname(dirname(dirname(__FILE__))));
		
		$document 	=& JFactory::getDocument();
		$document->addStyleSheet($live_site."templates/$template/XTC/XTC.css",'text/css');

		$path = dirname(dirname(dirname(__FILE__))).DS.'layouts';
		$folders = JFolder::folders($path);
		sort($folders);
		$options=array();
		foreach ($folders as $folder) {
			$xmlFile = $path.DS.$folder.DS.'config.xml';
			if (!is_readable($xmlFile)) { continue; }
			$xmlData = file_get_contents($xmlFile);
			$xml =& JFactory::getXMLParser('Simple');
			$xml->loadString($xmlData);
			$name =& $xml->document->getElementByPath('name');
			$description =& $xml->document->getElementByPath('description');
			$name = $name ? $name->data() : $folder;
			$description = $description ? trim($description->data()) : '';
			$options[] = JHTML::_('select.option', $folder, $name);
		}
		return (empty($options)) ? JText::_('No layouts found.') : JHTML::_('select.genericlist',  $options, $jxtccontrol_name.'['.$jxtcname.']', 'class="inputbox"', 'value', 'text', $jxtcvalue, $jxtccontrol_name.$jxtcname);
	}
}