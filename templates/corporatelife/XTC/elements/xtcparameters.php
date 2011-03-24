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

class JElementXtcparameters extends JElement {
	function fetchElement($jxtcname, $jxtcvalue, &$jxtcnode, $jxtccontrol_name)	{

		jimport( 'joomla.html.parameter' );
		jimport('joomla.html.pane');

		$live_site = JURI::root();
		$template = basename(dirname(dirname(dirname(__FILE__))));
		
		$document 	=& JFactory::getDocument();
		$document->addStyleSheet($live_site."templates/$template/XTC/XTC.css",'text/css');

		$xmlFile = JPATH_ROOT.DS.'templates'.DS.$template.DS.'XTC'.DS.'XTC_config.xml';

		if (is_readable($xmlFile)) {
			$xmlData = file_get_contents($xmlFile);
			$xml = &JFactory::getXMLParser('Simple');
			$xml->loadString($xmlData);
			$name = &$xml->document->getElementByPath('name');
			$description = &$xml->document->getElementByPath('description');
			$name = $name ? trim($name->data()) : $filename;
			$description = $description ? trim($description->data()) : '';
		}
		else {
			return "No parameters found.";
		}

		$pane = &JPane::getInstance('sliders', array('allowAllClose' => true, 'duration' => 200));
		$html = $pane->startPane('XTCconfig');

		$params = new JParameter($this->_parent->_raw);
		$params->addElementPath(JPATH_ROOT.DS.'templates'.DS.$template.DS.'XTC'.DS.'elements');
		if (isset($xml->document->params)) {
			foreach ($xml->document->params as $param) {
				$params->setXML( $param );
			}
		}
		$html .= $pane->startPanel($name, 'paneXTCconfig');
		$html .= '<div class="xtcPane">';
		$html .= '<div class="paneInfo">';
		if ($description) $html .= '<div class="paneDescription">'.$description.'</div>';
		$html .= '</div>';
		$html .= $params->render();
		$html .= '</div>';
		$html .= $pane->endPanel();
		$html .= $pane->endPane();
		return $html;
	}
}
