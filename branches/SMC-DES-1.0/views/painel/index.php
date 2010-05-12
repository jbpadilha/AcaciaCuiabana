<?php
/**
 * Página inicial do Sistema.
 * @author João Batista Padilha e Silva
 * @link index.php
 * @copyright João Batista Padilha e Silva Especialista em TI (http://www.joaopadilha.eti.br) / joao.padilha@globo.com
 * @version 1.0
 */
header("Content-Type: text/html; charset=ISO-8859-1");

require_once("../../class/Config.php");

if(isset($_GET['destroi']))
{
	$controla->destroiSessao();
	header("Location:../home.php");
}
else
{
	if(!isset($_SESSION['usuarioLogon']))
	{
		header("Location:../views/home.php?p=login");
	}
}
if(isset($_GET['msg']))
{
	echo "<script>alert('{$_GET['msg']}');</script>";
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<title>SMC - Gerenciamento de dados</title>
		<meta http-equiv="Content-Type" content="text/html;	charset=iso-8859-1" >
		<link href="imagens/smc.ico" rel="SHORTCUT ICON"/>
	</head>

	<body oncontextmenu="return false;">

		<?php include ('smc_menu.php'); ?>
		
	<div id="corpo">

		<?php
			$userLogon = new Logon();
			$userLogon = $_SESSION['usuarioLogon'];
			if($userLogon->getNivelAcessoLogin() > 0)
			{
				$nome = "Administrador";
				
				if($userLogon->getIdClientes() != null)
				{
					$clientes = new Clientes();
					$clientes->setIdClientes($userLogon->getIdClientes());
					$valueObj = $controla->findClientes($clientes);
					$clientes = $valueObj[0];
					$nome = $clientes->getNomeCliente();
				}
				$link = isset ($_GET['p']) ? $_GET['p']: '';
				$pagina = $link.".php"; 
				if (file_exists($pagina)) 
				{ 
					include("$pagina"); 
				}
				elseif ($link == 'home' OR $link == '') 
				{ 
					include_once ('rel_alertas.php'); 
				}
				else { echo "<br><br>Página não encontrada"; }
			}
			else
			{
				echo "<br><br>Acesso não autorizado.";
			}
			?>

	</div>

	<table class="statusbar">
		<tr> 
			<td class="left"> Usuário logado: <b> <?=$nome?> </b> </td>
			<td class="divisor"> </td>
			<td class="right"> Último acesso: <?=$formataData->toViewDateTime($userLogon->getDataUltimoLogin())?> </td> 
		</tr>
	</table>

	</body>

	<script type="text/javascript" language="javascript" src="../scripts/full.js" > </script>
	<script type="text/javascript" language="javascript" src="../scripts/inputs.js" > </script>

</html>