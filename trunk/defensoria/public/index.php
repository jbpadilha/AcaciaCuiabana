<?php 

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="css/screen.css" rel="stylesheet" type="text/css" media="screen, projection, tv" />
<link href="css/html.css" rel="stylesheet" type="text/css" media="screen, projection, tv" />
<script language="javascript" src="js/jquery-1.3.1.min.js"></script>
<script language="javascript" src="js/jquery.dropdownPlain.js"></script>
<title>DEFENSORIA PÚBLICA DO ESTADO DE MATO GROSSO</title>
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
    	<form name="login" id="login" action="../application/recebePostGet.php" method="post">
		<input type="hidden" id="control" name="control" value="ControlaLogin"/>
		<fieldset>
			<?php 
			if(isset($_GET['mensagemErro']))
			{
				$MENSAGEM_ERRO = new ArrayIterator(unserialize(urldecode($_GET['mensagemErro'])));
				echo "<div class=\"erro\">";
				foreach ($MENSAGEM_ERRO as $mensagem)
				{
					echo $mensagem."<br/>";
				}
				echo "</div>";
			}
			?>
			<legend>Logar no Sistema Defensoria:</legend>
			<table>
				<tr>
					<td>Usuário:</td>
					<td colspan="2" align="left"><input type="text" name="usuario" id="usuario" style="text-transform: lowercase;" /></td>
				</tr>
				<tr>
					<td>Senha:</td>
					<td><input type="password" name="senha" id="senha" /></td>
					<td><input type="submit" name="submit" id="submit" value="Logar"/></td>
				</tr>
			</table>
			<br />
		</fieldset>
		</form>
    </div>
</div>
<div id="footer"></div>
</body>
</html>
