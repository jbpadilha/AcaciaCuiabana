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

// This program	Builds a CSS style cascade

define('_XTCFRAMEWORK',1);
require 'XTC.php';

$templateParameters = xtcLoadParams(); // Get params for this template

// BUILD CASCADE -->

$params = &$templateParameters; // For non-grouped CSS files

header('Content-type: text/css');

if ($xtc->CSScompression) {
	ob_start();
	ob_implicit_flush(0);
}

// Default CSS
require $xtc->templatePath.DS.'css'.DS.'default.css';

// Get parameter groups CSS
foreach (explode(',',cleanGet('groups')) as $group) {
	xtcGroupCSS($group);
}

// Default System CSS
require JPATH_ROOT.DS.'templates'.DS.'system'.DS.'css'.DS.'system.css';
require JPATH_ROOT.DS.'templates'.DS.'system'.DS.'css'.DS.'general.css';

// Template CSS - Standard Joomla template CSS file, used by user to put overrides
require $xtc->templatePath.DS.'css'.DS.'template.css';

if ($xtc->CSScompression) {
	print_gzipped_page();
}
?>