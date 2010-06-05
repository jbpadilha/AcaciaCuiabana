<?php
require_once ('../../class/Config.php');
if(!isset($_SESSION['usuarioLogon']))
{
	header("Location:../views/home.php?p=login");
}
$logon = new Logon();
$logon = $_SESSION["usuarioLogon"];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd" >
<html xmlns="http://www.w3.org/1999/xhtml" >

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>SMC - Cadastro de clientes (Pessoa fsãsica)</title>
	<meta name="Description" content="SMC - Novo cadastro de Pessoa fsãsica" >
	<meta http-equiv="X-UA-Compatible" content="IE=7" > 
	<link rel="stylesheet" href="../css/default.css" type="text/css" media="all" />
	<script type="text/javascript" language="javascript" src="../scripts/full.js" > </script>
	<script type="text/javascript" language="javascript" src="../scripts/jquery.js" > </script>
	<script type="text/javascript" language="javascript" src="../scripts/jquery.MultiFile.js" > </script>
</head>
<body>
<p class="caption"> Alterar abastecimento </p>
<div id="listagem">
<?php 
$data = "0-".date("m")."-0";
$userLogon = new Logon();
$userLogon = $_SESSION['usuarioLogon'];
$mostraLinkMais = false;

//Aniversariantes - Clientes ou Administrador (todos os cadastros)
$collVoPessoa = $controla->listarAniversariosClientes($userLogon,$data);
if(!is_null($collVoPessoa))
{
	$cont = 0;
	foreach ($collVoPessoa as $pessoas)
	{
		if($cont == 0)
			echo '<label class="ativo">Aniversário do Dia</label><br><br>';
		$pessoaAtual = new Logon();
		$pessoaAtual = $pessoas;
		echo '<label class="ativo" title="'.$formataData->toViewDate($pessoaAtual->getDataNascimentoPessoa()).'">Aniversário de '.$pessoaAtual->getNomePessoa().'</label><br>';
		$cont++;
	}
	echo '<br><br>';
}

//Lista CNH de Clientes
$collVoCnh = $controla->listaCnhVencida($userLogon,$data);
if(!is_null($collVoCnh))
{
	$cont = 0;
	foreach ($collVoCnh as $cnhs)
	{
		if($cont == 0)
			echo '<label class="ativo">CNH vencendo Hoje</label><br><br>';
		$cnhAtual = new Cnh();
		$cnhAtual = $cnhs;
		$pessoaAtual = new Pessoa();
		$pessoaAtual = $cnhAtual->returnaPessoa();
		echo '<label class="ativo" title="">CNH numero '.$cnhAtual->getNumeroCnh().', <b>nome:</b> '.$pessoaAtual->getNomePessoa().'</label><br>';
		$cont++;
	}
	echo '<br><br>';
}

//Lista de IPVA Vencido
$collVoIpva = $controla->listaIpvaVencidos($userLogon,$data);
if(!is_null($collVoIpva))
{
	$cont = 0;
	foreach ($collVoIpva as $ipvas)
	{
		if($cont == 0)
			echo '<label class="ativo">IPVA vencendo Hoje</label><br>';
		$veiculoAtual = new Veiculos(); 
		$veiculoAtual = $ipvas;
		echo '<label class="ativo" title="">'.$veiculoAtual->getPlacaVeiculos().' - IPVA vencendo</label><br>';
		$cont++;
	}
	echo '<br><br>';
}

//Lista Seguros vencidos
$collVoSeguro = $controla->listaSeguroVencidos($userLogon,$data);
if(!is_null($collVoSeguro))
{
	$cont = 0;
	foreach ($collVoSeguro as $seguros)
	{
		if($cont == 0)
			echo '<label class="ativo">Seguro do Carro vencendo Hoje</label><br>';
		$veiculoAtual = new Veiculos(); 
		$veiculoAtual = $seguros;
		echo '<label class="ativo" title="">'.$veiculoAtual->getPlacaVeiculos().' - Seguro vencendo</label><br>';
		$cont++;
	}
	echo '<br><br>';
}

//Lista Vencimento de Garantia
$collVoGarantias = $controla->ListaGarantiasVenc($userLogon,$data);
if(!is_null($collVoGarantias))
{
	$cont = 0;
	foreach ($collVoGarantias as $garantias)
	{
		if($cont == 0)
			echo '<label class="ativo">Garantia vencendo hoje</label><br>';
		$veiculoAtual = new Veiculos(); 
		$veiculoAtual = $garantias;
		echo '<label class="ativo" title="">'.$veiculoAtual->getPlacaVeiculos().' - Garantia vencendo</label><br>';
		$cont++;
	}
	echo '<br><br>';
}

//Lista de RevisÃµes
$collVoRevisoes = $controla->listaRevisoes($userLogon,$data);
if(!is_null($collVoRevisoes))
{
	$cont = 0;
	foreach ($collVoRevisoes as $revisoes)
	{
		if($cont == 0)
			echo '<label class="ativo">Revisão agendanda</label><br>';
		$revisoesAtual = new Revisoes();
		$revisoesAtual = $revisoes;
		$veiculoAtual = new Veiculos();
		$veiculoAtual->setIdVeiculos($revisoesAtual->getIdVeiculos());
		$collVeiculos = $controla->findVeiculos($veiculoAtual);
		$veiculoAtual = $collVeiculos[0]; 
		echo '<label class="ativo" title="">'.$veiculoAtual->getPlacaVeiculos().' - Revisão agendada</label><br>';
		$cont++;
	}
	echo '<br><br>';
}

?>
<span class="borda"> </span>
</div>
</body>
</html>