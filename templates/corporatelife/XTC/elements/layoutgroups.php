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

class JElementLayoutgroups extends JElement {

	function fetchElement($jxtcname, $jxtcvalue, &$jxtcnode, $jxtccontrol_name)	{

		if (!function_exists('xtcsortfn')) {
				function xtcsortfn($a, $b) {
			   return strnatcmp($a[0],$b[0]);
			}
		}

		jimport( 'joomla.html.parameter' );
		jimport( 'joomla.filesystem.folder' );
		jimport( 'joomla.html.pane' );
		JHTML::_( 'behavior.modal', 'a.modal' );

		$live_site = JURI::root();
		$template = basename(dirname(dirname(dirname(__FILE__))));
		
		$document 	=& JFactory::getDocument();
		$document->addStyleSheet($live_site."templates/$template/XTC/XTC.css",'text/css');

		$path = JPATH_ROOT.DS.'templates'.DS.$template;

		$folders = JFolder::folders($path.DS.'layouts');
		$parameters = array();

		foreach ($folders as $folder) { // Parse parameters
			$xmlFile = $path.DS.'layouts'.DS.$folder.DS.'config.xml';
			if (is_readable($xmlFile)) {
				$xmlData = file_get_contents($xmlFile);
				$xmlData = str_replace('<param name="','<param name="{layout+'.$folder.'}',$xmlData);
				$xml = &JFactory::getXMLParser('Simple');
				$xml->loadString($xmlData);
				$name = $xml->document->getElementByPath('name');
				$description = $xml->document->getElementByPath('description');
				$name = $name ? trim($name->data()) : $folder;
				$description = $description ? trim($description->data()) : '';
			}
			else {
				$xml = '';
				$name = $folder;
				$description = '';
			}
			$thumbnail = '';
			if (file_exists($path.DS.'layouts'.DS.$folder.DS.'thumbnail.gif')) { $thumbnail = 'thumbnail.gif'; }
			elseif (file_exists($path.DS.'layouts'.DS.$folder.DS.'thumbnail.jpg')) {$thumbnail = 'thumbnail.jpg'; }
			elseif (file_exists($path.DS.'layouts'.DS.$folder.DS.'thumbnail.png')) {$thumbnail = 'thumbnail.png'; }

			$fullimage = '';
			if (file_exists($path.DS.'layouts'.DS.$folder.DS.'layout.gif')) { $fullimage = 'layout.gif'; }
			elseif (file_exists($path.DS.'layouts'.DS.$folder.DS.'layout.jpg')) {$fullimage = 'layout.jpg'; }
			elseif (file_exists($path.DS.'layouts'.DS.$folder.DS.'layout.png')) {$fullimage = 'layout.png'; }
			$parameters[] = array($name,$folder,$xml,$description,$thumbnail,$fullimage);
		}

		usort($parameters, "xtcsortfn");

		$pane = &JPane::getInstance('sliders', array('allowAllClose' => true, 'duration' => 200));
		$html = $pane->startPane('layout'.$jxtcnode->attributes('label'));

		foreach ($parameters as $parameter) { // Draw parameters

			list($name,$folder,$xml,$description,$thumbnail,$fullimage) = $parameter;

			$params = new JParameter($this->_parent->_raw);
			$params->addElementPath(JPATH_ROOT.DS.'templates'.DS.$template.DS.'XTC'.DS.'elements');

			$html .= $pane->startPanel($name, 'pane'.$folder);
			$html .= '<div class="xtcPane">';
			$html .= '<div class="paneInfo">';

			if ($thumbnail) {
				$thumbnailURL = $live_site.'templates/'.$template.'/layouts/'.$folder.'/'.$thumbnail;
				if ($fullimage) {
					$fullimageURL = $live_site.'templates/'.$template.'/layouts/'.$folder.'/'.$fullimage;
					$headerimg_size = getimagesize($path.DS.'layouts'.DS.$folder.DS.$fullimage);
					$width = $headerimg_size[0];
					$height = $headerimg_size[1]; 
					$onclick = "onclick=\"MyWindow=window.open('$fullimageURL','_blank','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=$width,height=$height'); return false;\"";
					$html .= '<img class="paneImage" style="cursor:pointer" '.$onclick.' src="'.$thumbnailURL.'" alt="Full image" />';
				}
				else {
					$html .= '<img class="paneImage" src="'.$thumbnailURL.'" alt="" />';
				}
			}
			if ($description) $html .= '<span class="paneDescription">'.$description.'</span>';
			$html .= '<div style="clear:both"></div></div>';
			$params->setXML( $xml->document->params[0] );
			$html .= $params->render();
			$html .= '</div>';
			$html .= $pane->endPanel();
		}
		$html .= $pane->endPane();
		return $html;
	}
}
