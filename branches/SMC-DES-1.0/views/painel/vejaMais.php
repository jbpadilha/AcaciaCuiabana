<style>
	body { margin:0px auto; padding:0px; font:normal 12px "Segoe UI", Verdana, Arial; color:#000; }
	table { width:100%; }
	a { text-decoration:none; color:#000; }
	tr.dias td { border-width:1px; border-style:solid; border-color:#FFF #AAA #AAA #FFF; width:150px; height:60px; vertical-align:top; padding:0px; }
	td.hoje { background:#FFCC00; }
	td.dia { background:#FFAA00; }
	td.dia:hover { background:#FFBB22; }
	td.dia .link, td.hoje .link { font-weight:bold; margin:0px; float:left; width:100%; text-align:left; padding:2px 4px; width:24px; height:20px; background:url('../imagens/bg-topleft.png') no-repeat top left; cursor:default; }

	div.titulo { text-align:center; margin:10px; }
	div.titulo label { font:bold 22px "Segoe UI", Verdana, Arial; width:280px; }
	div.titulo img { cursor:pointer; height:32px; vertical-align:bottom; padding:0px 20px; }

	.tcenter { text-align:center; }
	tr.head { background:#EEE; font:bold 16px "Segoe UI", Verdana; text-align:center; cursor:default; }
	tr.head td { padding:4px; border-color:#AAA #000 #000 #AAA; border-width:1px; border-style:solid; }
	tr.head td:hover { background:#DDD; }

	label.ativo { clear:both; float:left; width:100%; text-align:left; font-family:Consolas, Courier; margin:2px 0px 0px 0px; color:#444; padding:2px 0px; cursor:pointer; }
	label.ativo:hover { color:#FFF; font-weight:bold; background:#FFD800; }
</style>
<?php
require ('../../class/Config.php');

$listaAniversarios = unserialize(urldecode($_GET['listaPessoa']));

if(!is_null($listaAniversarios))
{
	$cont = 0;
	foreach ($listaAniversarios as $pessoas)
	{
		if($cont == 0)
			echo '<label class="ativo">Anivers�rio do Dia</label>';
		$pessoaAtual = new Logon();
		$pessoaAtual = $pessoas;
		echo '<label class="ativo" title="'.$formataData->toViewDate($pessoaAtual->getDataNascimentoPessoa()).'">Anivers�rio de '.$pessoaAtual->getNomePessoa().'</label>';
		$cont++;
	}
	echo '<br><br>';
}

$listaCnh = unserialize(urldecode($_GET['listaCnh']));
if(!is_null($listaCnh))
{
	$cont = 0;
	foreach ($listaCnh as $cnhs)
	{
		if($cont == 0)
			echo '<label class="ativo">CNH vencendo Hoje</label>';
		$cnhAtual = new Cnh();
		$cnhAtual = $cnhs;
		$pessoaAtual = new Pessoa();
		$pessoaAtual = $cnhAtual->returnaPessoa();
		echo '<label class="ativo" title="">CNH numero '.$cnhAtual->getNumeroCnh().', <b>nome:</b> '.$pessoaAtual->getNomePessoa().'</label>';
		$cont++;
	}
	echo '<br><br>';
}

$listaIpva = unserialize(urldecode($_GET['listaIpva']));
if(!is_null($listaIpva))
{
	$cont = 0;
	foreach ($listaIpva as $ipvas)
	{
		if($cont == 0)
			echo '<label class="ativo">IPVA vencendo Hoje</label>';
		$veiculoAtual = new Veiculos(); 
		$veiculoAtual = $ipvas;
		echo '<label class="ativo" title="">'.$veiculoAtual->getPlacaVeiculos().' - IPVA vencendo</label>';
		$cont++;
	}
	echo '<br><br>';
}

$listaSeguro = unserialize(urldecode($_GET['listaSeguro']));
if(!is_null($listaSeguro))
{
	$cont = 0;
	foreach ($listaSeguro as $seguros)
	{
		if($cont == 0)
			echo '<label class="ativo">Seguro do Carro vencendo Hoje</label>';
		$veiculoAtual = new Veiculos(); 
		$veiculoAtual = $seguros;
		echo '<label class="ativo" title="">'.$veiculoAtual->getPlacaVeiculos().' - Seguro vencendo</label>';
		$cont++;
	}
	echo '<br><br>';
}

$listaGarantia = unserialize(urldecode($_GET['listaGarantia']));
if(!is_null($listaGarantia))
{
	$cont = 0;
	foreach ($listaGarantia as $garantias)
	{
		if($cont == 0)
			echo '<label class="ativo">Garantia vencendo hoje</label>';
		$veiculoAtual = new Veiculos(); 
		$veiculoAtual = $garantias;
		echo '<label class="ativo" title="">'.$veiculoAtual->getPlacaVeiculos().' - Garantia vencendo</label>';
		$cont++;
	}
	echo '<br><br>';
}

$listaRevisoes = unserialize(urldecode($_GET['listaRevisoes']));
if(!is_null($listaRevisoes))
{
	$cont = 0;
	foreach ($listaRevisoes as $revisoes)
	{
		if($cont == 0)
			echo '<label class="ativo">Revis�o agendanda</label>';
		$revisoesAtual = new Revisoes();
		$revisoesAtual = $revisoes;
		$veiculoAtual = new Veiculos();
		$veiculoAtual->setIdVeiculos($revisoesAtual->getIdVeiculos());
		$collVeiculos = $controla->findVeiculos($veiculoAtual);
		$veiculoAtual = $collVeiculos[0]; 
		echo '<label class="ativo" title="">'.$veiculoAtual->getPlacaVeiculos().' - Revis�o agendada</label>';
		$cont++;
	}
	echo '<br><br>';
}
?>