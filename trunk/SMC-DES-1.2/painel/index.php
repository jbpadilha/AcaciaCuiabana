<?php
require_once("../class/Config.php");

if(isset($_GET['destroi'])) {
    $controla->destroiSessao();
    header("Location: /smc/home.php");
} else {
    if(!isset($_SESSION['usuarioLogon'])) header("Location: /smc/home.php?page=login");
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-br" lang="pt-br">

<head>
	<title>SMC - Serviço de Manutenção e Consultoria</title>
	<link rel="SHORTCUT ICON" href="imagens/smc.ico" />
	<meta http-equiv="Content-Language" content="pt-BR" />
	<meta name="author" content="Júnior Mendonça" />
	<meta name="copyright" content="SMC - Serviço de Manutenção e Consultoria">
	<meta name="description" content="SMC - Manutenção como deve ser feita." />
	<meta name="keywords" lang="pt-br" content="smc, serviço despertador, servico despertador, servicodespertador, manutenção, preventiva, gestão, frotas, ativos" />

	<link type="text/css" rel="stylesheet" media="screen" href="/_global/_css/smc/demo.css" />

	<script type="text/javascript" language="javascript" src="/_global/_js/jquery-1.4.2.js"></script>
	<script type="text/javascript" language="javascript" src="/_global/_js/jquery.maskedinput-1.2.2.js"></script>
	<script type="text/javascript" language="javascript" src="/_global/_js/jquery.price_format.1.2.js"></script>
	<script type="text/javascript" language="javascript" src="/_global/_js/jquery.gt.extensions.js"></script>
	<script type="text/javascript" language="javascript" src="/_global/_js/demo.js"></script>
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

	$pessoa = new Pessoa();
	$pessoa->setIdPessoa($userLogon->getIdPessoa());
	$collVoPessoa = $controla->findPessoas($pessoa);
	if (!is_null($collVoPessoa)) $pessoa = $collVoPessoa[0];

	if ($userLogon->getNivelAcessoLogin() > 0) {
		$nome = "Administrador";

		if ($userLogon->getIdClientes() != null) {
			$clientes = new Clientes();
			$clientes->setIdClientes($userLogon->getIdClientes());
			$collVo = $controla->findClientes($clientes);
			$clientes = (object)$collVo[0];
			$nome = $clientes->getNomeCliente();
		}

		$link = $_GET['p'] ? $_GET['p'] : $_GET['page'];
		if (file_exists($link.'.php')) include($link.'.php');
		elseif (!$link || $link == '' || $link == 'home') include('rel_alertas.php');
		else echo "\n<br />\n<br />\nPágina não encontrada. (".$link.".php)";
	} else {
		echo "\n<br />\n<br />\nAcesso não autorizado.";
	}
?>
		</center>
	</div>

<?php
	if(isset($_GET['msg'])) {
?>
	<script>
		alert("<?php echo $_GET['msg']; ?>");
	</script>
<?php
	}
?>
	<table class="statusbar">
		<tr>
			<td class="left">Usuário logado: <?php echo $userLogon->getLogin().' - '.$pessoa->getNomePessoa(); ?></td>
			<td class="divisor"></td>
			<td class="right">Último acesso em <?php echo $formataData->toViewDateTime($userLogon->getDataUltimoLogin()); ?></td>
		</tr>
	</table>

	<div id="avisos">
		<img src="/_global/_img/alerta.png" alt="" title="" />
		<span>Mensagens de alerta...</span>
	</div>

</body>

</html>