<?php

// JoomlaXTC XMenu plugin

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.plugin.plugin' );

class plgSystemjxtc_xmenu extends JPlugin {

	function plgSystemjxtc_xmenu(&$subject, $config) {
		parent::__construct($subject, $config);
	}

	function onAfterInitialise() {
		$app =& JFactory::getApplication();
		if ($app->isAdmin()) return;		// Not on frontend

		if (file_exists(JPATH_ROOT.DS.'plugins'.DS.'system'.DS.'jxtc_xmenu'.DS.'xmenu.css')) {
			$live_site = JURI::base();
			$doc =&JFactory::getDocument();
			$doc->addStyleSheet($live_site.'plugins/system/jxtc_xmenu/xmenu.css','text/css');
		}
	}

	function onAfterRender() {
		global $mainframe;

		$app =& JFactory::getApplication();
		if ($app->isAdmin()) return;		// Not on frontend

		$plugin =& JPluginHelper::getPlugin('system', 'jxtc_xmenu');
		$pluginParams = new JParameter( $plugin->params );
		$ulclass = $pluginParams->get('ulclass');
		$ulid = $pluginParams->get('ulid');

		$key = '';
		$key = empty($ulclass) ? 'id="'.$ulid.'"' : 'class="'.$ulclass.'"';

		if (empty($key)) return;	// No ID or Class to match

		$buffer = JResponse::getBody();
		
		while (($ini = strpos($buffer,"{xm ")) !== false) {
			$fin = strpos($buffer,"}",$ini);
			$parms=substr($buffer,$ini+4,$fin-$ini-4);
			list($position,$width,$height)=explode(',',$parms);
			if (!empty($position)) {
				settype($width,'integer');
				settype($height,'integer');
				$width = $width==0 ? '' : 'width:'.$width.'px;';
				$height = $height==0 ? '' : 'height:'.$height.'px;';
				$modules =&JModuleHelper::getModules($position);
				$attribs = array('style'=>'xhtml');
				$positionhtml = "<div class=\"xmenu_position\" style=\"$width $height\">";
				foreach ($modules as $module) {
					$positionhtml .= JModuleHelper::renderModule( $module, $attribs );
				}
			}
			else {
				$positionhtml='';
			}
			$buffer = substr_replace($buffer,$positionhtml,$ini,$fin-$ini+1);
		}

		$buffer = str_replace( '{xm}', '<span class="xmenu">', $buffer );
		$buffer = str_replace( '{/xm}', '</span>', $buffer );

//		echo "\n<!--$topini $topfin\n$buffer\n-->\n";

		JResponse::setBody($buffer);
	}
}