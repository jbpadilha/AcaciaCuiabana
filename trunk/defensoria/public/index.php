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
<title>DEFENSORIA P�BLICA DO ESTADO DE MATO GROSSO</title>
</head>
<body>
<div id="content">
	<div id="header">
    <span class="titulo">DEFENSORIA PÚBLICA DO ESTADO DE MATO GROSSO - SISTEMA DE PROTOCOLO E ACOMPANHAMENTO DE PROCESSOS</span>
	</div>
	<div id="headerImg">	
  		<div id="headerImg1"></div>
	</div>
    <div id="page">
    	<form name="login" id="login" action="" method="post">
		<fieldset>
			<legend>Logar no Sistema Defensoria:</legend>
			Usuário:<input type="text" name="username" id="username" style="text-transform: lowercase;" />
			Senha:<input type="password" name="password" id="password" />
			<input type="submit" name="submit" id="submit" value="Logar"/>
			<br />
		</fieldset>
		</form>
    </div>
</div>
<div id="footer"></div>
</body>
</html>