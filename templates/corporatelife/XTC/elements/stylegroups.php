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

class JElementStylegroups extends JElement {
	function fetchElement($jxtcname, $jxtcvalue, &$jxtcnode, $jxtccontrol_name)	{

		if (!function_exists('xtcsortfn')) {
				function xtcsortfn($a, $b) {
			   return strnatcmp($a[0],$b[0]);
			}
		}

		jimport( 'joomla.html.parameter' );
		jimport( 'joomla.filesystem.folder' );
		jimport('joomla.html.pane');

		$live_site = JURI::root();
		$template = basename(dirname(dirname(dirname(__FILE__))));
		
		$document 	=& JFactory::getDocument();
		$document->addStyleSheet($live_site."templates/$template/XTC/XTC.css",'text/css');

		$path = JPATH_ROOT.DS.'templates'.DS.$template;

		$files = JFolder::files($path.DS.'parameters','xml');

		$parmsfound=false;
		$prefix = trim($jxtcnode->attributes('group'));

		$parameters = array();

		foreach ($files as $file) {
			@list($filename,$extension)=explode('.',$file);
			if ($extension != 'xml') continue; // Not an XML
			if (strpos($filename,$prefix) !== 0) continue; // Not my robot
			$xmlFile = $path.DS.'parameters'.DS.$file;
			if (is_readable($xmlFile)) {
				$xmlData = file_get_contents($xmlFile);
				$xmlData = str_replace('<param name="','<param name="{'.$prefix.'+'.$filename.'}',$xmlData);
				$xml = &JFactory::getXMLParser('Simple');
				$xml->loadString($xmlData);
				$name = &$xml->document->getElementByPath('name');
				$description = &$xml->document->getElementByPath('description');
				$name = $name ? trim($name->data()) : $filename;
				$description = $description ? trim($description->data()) : '';
			}
			else {
				$xml = '';
				$name = $filename;
				$description = '';
			}

			$thumbnail = '';
			if (file_exists($path.DS.'parameters'.DS.$filename.'.gif')) {$thumbnail = $filename.'.gif'; }
			elseif (file_exists($path.DS.'parameters'.DS.$filename.'.jpg')) {$thumbnail = $filename.'.jpg'; }
			elseif (file_exists($path.DS.'parameters'.DS.$filename.'.png')) {$thumbnail = $filename.'.png'; }

			$fullimage = '';
			if (file_exists($path.DS.'parameters'.DS.$filename.'_full.gif')) {$fullimage = $filename.'_full.gif'; }
			elseif (file_exists($path.DS.'parameters'.DS.$filename.'_full.jpg')) {$fullimage = $filename.'_full.jpg'; }
			elseif (file_exists($path.DS.'parameters'.DS.$filename.'_full.png')) {$fullimage = $filename.'_full.png'; }
			$parameters[] = array($name,$filename,$xml,$description,$thumbnail,$fullimage);
		}

		usort($parameters, "xtcsortfn");

		$pane = &JPane::getInstance('sliders', array('allowAllClose' => true, 'duration' => 200));
		$html = $pane->startPane('group'.$prefix);

		foreach ($parameters as $parameter) { // Draw parameters

			list($name,$filename,$xml,$description,$thumbnail,$fullimage) = $parameter;

//if (substr($filename,0,4) != 'menu') continue;
			$params = new JParameter($this->_parent->_raw);
			$params->addElementPath(JPATH_ROOT.DS.'templates'.DS.$template.DS.'XTC'.DS.'elements');
			if (isset($xml->document->params)) {
				foreach ($xml->document->params as $param) {
					$params->setXML( $param );
				}
			}
			$html .= $pane->startPanel($name, 'pane'.$filename);
			$html .= '<div class="xtcPane">';
			$html .= '<div class="paneInfo">';

			if ($thumbnail) {
				$thumbnailURL = $live_site.'templates/'.$template.'/parameters/'.$thumbnail;
				if ($fullimage) {
					$fullimageURL = $live_site.'templates/'.$template.'/parameters/'.$fullimage;
					$headerimg_size = getimagesize($path.DS.'parameters'.DS.$fullimage);
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
			$html .= $params->render();
			$html .= '</div>';
			$html .= $pane->endPanel();
			$parmsfound=true;
		}
		$html .= $pane->endPane();
		return ($parmsfound) ? $html : "No parameters of group \"$prefix\" found.";
	}
}
