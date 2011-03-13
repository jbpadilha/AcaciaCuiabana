<?php
/*
  $Id: offline.php 

  Store Offline Modification for osCommerce v3.04
  http://www.oscommerce.com

  For Support and more mods for this release of osCommerce
  Please visit
  
  http://www.box25.net
  
  Copyright (c) 2008 Box 25

  This program is released under the osCommerce License; you can redistribute it 
  and/or modify  it under the terms of the GNU General Public License v2 (1991)
  as published by the Free Software Foundation.
*/
  
  require('includes/application_top.php');
header("Content-Type: text/html; charset=ISO-8859-1",true);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<style type="text/css">

#page1 p {
	font-family: Verdana;
	font-size: small;
	color: #808080;
	text-align: center;
}

#page1 {
	padding-top: 10%;
	
}
</style>

<title><?php echo STORE_NAME; ?></title>

<base href="<?php echo osc_href_link(null, null, 'AUTO', false); ?>" />


<meta name="Generator" content="osCommerce" />

</head>

<body>
<div id="page1">
<?php

  $image_path = osc_href_link(null, null, 'AUTO', false);
  	
  // display the store name and logo
  echo '<p>' . osc_image($image_path .DIR_WS_IMAGES . 'store_logo.png', STORE_NAME) . '</p>';
  echo '<p><br /><font size=18><b>' . STORE_NAME . '</b></font><br/><br/>Nesse momento não é possível efetuar compras. Confira nosso horário de atendimento, ou tente novamente mais tarde.';

?>
</div>
</body>

</html>
<?php

  require('includes/application_bottom.php');

?>
