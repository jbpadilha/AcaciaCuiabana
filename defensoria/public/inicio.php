<?php 
require '../application/DropDownMenu.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/screen.css" rel="stylesheet" type="text/css" media="screen, projection, tv" />
<link href="css/html.css" rel="stylesheet" type="text/css" media="screen, projection, tv" />
<script language="javascript" src="js/jquery-1.3.1.min.js"></script>
<script language="javascript" src="js/jquery.dropdownPlain.js"></script>
<title>DEFENSORIA PÚBLICA DO ESTADO DE MATO GROSSO</title>
</head>
<body>
<div id="content">
	<div id="header">
		<?php 
		$menu = new DropDownMenu();
		$menu->gerarMenu();
		?>
	</div>
	<div id="headerImg">	
  		<div id="headerImg1"></div>
	</div>
    <div id="page">
    	<div id="columns" class="widthPad">
        	 <div class="floatLeft width100">
             </div>
		</div>
    </div>
</div>
<div id="footer"></div>
</body>
</html>