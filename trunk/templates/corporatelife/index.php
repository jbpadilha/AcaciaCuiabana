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

// Call XTC framework
require JPATH_THEMES.DS.$this->template.DS.'XTC'.DS.'XTC.php';

// Load template parameters
$templateParameters = xtcLoadParams();

// Get the selected layout
$layout = $templateParameters->templateLayout;

// Call layout from layouts folder to create HTML

require JPATH_THEMES.DS.$this->template.DS.'layouts'.DS.$layout.DS.'layout.php';
