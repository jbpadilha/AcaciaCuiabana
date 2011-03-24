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
********************************************************************************
***                                                                          ***
***                   START OF USER CUSTOMIZABLE VARIABLES                   ***
***                                                                          ***
*** This variables can be overriden with parameters from the XML_config.xml  ***
***                                                                          ***
*** if a variable is not needed just comment it                              ***
*** (everything is case-sensitive, drive carefully)                          ***
***                                                                          **/

// Public parameters
// These parameters can be overriden by URL and will be preserved in a cookie

$publicParams = array( 'xtcstyle', 'regioncfg', 'columncfg' ); // Allow to override the layout and other parameters on templateDetails.xml and layout config.xml

// Show Components
// If set, only these components will be shown in the site frontpage ( HANDLE WITH CARE! )
$showComponents = array( 'com_community', 'com_user');

// Custom presets
// Depeding on URL var values, a different presets.ini file can be used
// $customPresets = array( 'option=com_newsfeeds'=>'weblinks' ); // use weblinks.ini for weblinks component

/**                                                                          ***
***                    END OF USER CUSTOMIZABLE VARIABLES                    ***
***                                                                          ***
********************************************************************************
********************************************************************************
*******************************************************************************/

// Create XTC Framework object

require 'XTC_library.php';