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

	if(isset($_GET['destroi'])) {
		$controla->destroiSessao();
		header("Location:../home.php");
	} else {
		if(!isset($_SESSION['usuarioLogon'])) {
			header("Location:/views/home.php?page=login");
		}
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-br" lang="pt-br">

<head>

	<title>SMC - Serviço de Manutenção e Consultoria</title>
	<link rel="SHORTCUT ICON" href="imagens/smc.ico" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="Content-Language" content="pt-BR" />
	<meta name="author" content="Júnior Mendonça" />
	<meta name="copyright" content="SMC - Serviço de Manutenção e Consultoria">
	<meta name="description" content="SMC - Manutenção como deve ser feita." />
	<meta name="keywords" lang="pt-br" content="smc, serviço despertador, servico despertador, servicodespertador, manutenção, preventiva, gestÃ£o, frotas, ativos" />

	<link rel="stylesheet" href="_css/formPadrao.css" type="text/css" media="all" />

	<script type="text/javascript" language="javascript" src="../scripts/full.js"></script>
	<script type="text/javascript" language="javascript" src="../scripts/inputs.js"></script>

</head>

<body>

<?php
	include ('smc_menu.php');
?>

	<div id="corpo">
	<center>

<?php
	$userLogon = new Logon();
	$userLogon = $_SESSION['usuarioLogon'];

	if($userLogon->getNivelAcessoLogin() > 0) {

		$nome = "Administrador";

		if($userLogon->getIdClientes() != null) {
			$clientes = new Clientes();
			$clientes->setIdClientes($userLogon->getIdClientes());
			$collVo = $controla->findClientes($clientes);
			$clientes = (object)$collVo[0];
			$nome = $clientes->getNomeCliente();
		}

		$link = isset ($_GET['p']) ? $_GET['p']: '';
		$pagina = $link.".php";

		if (file_exists($pagina)) {
			include("$pagina");
		} elseif ($link == 'home' OR $link == '') {
			include_once ('rel_alertas.php');
		} else {
			echo "<br><br>Página não encontrada";
		}

	} else {
		echo "<br><br>Acesso não autorizado.";
	}
?>
		</center>
	</div>

	<table class="statusbar">
		<tr>
			<td class="left">Usuário logado:<b><?=$nome?></b></td>
			<td class="divisor"></td>
			<td class="right">Último acesso:<?=$formataData->toViewDateTime($userLogon->getDataUltimoLogin())?></td>
		</tr>
	</table>

<?php
	if(isset($_GET['msg'])) {
?>
	<script>
		alert("<?php echo $_GET['msg']; ?>");
	</script>";
<?
	}
?>

</body>

</html>