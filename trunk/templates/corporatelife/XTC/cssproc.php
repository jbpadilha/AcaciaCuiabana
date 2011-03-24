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

// This program	Builds CSS style cascade

define('_XTCFRAMEWORK',1);
require 'XTC.php';

$templateParameters = xtcLoadParams(); // Get params for this template

$group = cleanGet('group');
$file = basename(cleanGet('file'));
if ($group && isset($templateParameters->group->$group)) {
	$params = $templateParameters->group->$group;
	$file .= '.css';
}
else {
	$params = $templateParameters;
}
$imgpath = $xtc->templateUrl.'images';

header('Content-type: text/css');
if ($xtc->CSScompression) {
	ob_start();
	ob_implicit_flush(0);
}

if (is_readable($xtc->templatePath.DS.'css'.DS.$file)) require $xtc->templatePath.DS.'css'.DS.$file;

if ($xtc->CSScompression) {
	print_gzipped_page();
}

?>