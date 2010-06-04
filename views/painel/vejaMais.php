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
<script type="text/javascript" language="javascript">
function enviaEmail(idEndereco,tipo,idTipo)
{
	document.location='../../class/RecebePostGet.php?acao=enviaEmail&idEndereco='+idEndereco+'&tipo='+tipo+'&idTipo='+idTipo;
}
</script>
<?php
require ('../../class/Config.php');

$listaAniversarios = unserialize(base64_decode(trim($_GET['listaPessoa'])));

if(!is_null($listaAniversarios) && $listaAniversarios->count() > 0)
{
	$cont = 0;
	foreach ($listaAniversarios as $pessoas)
	{
		if($cont == 0)
			echo '<label class="ativo">Aniversário do Dia</label>';
		$pessoaAtual = new Pessoa();
		$pessoaAtual = (object)$pessoas;
		$endereco = new Endereco();
		$endereco = (object)$pessoaAtual->retornaEndereco(); 
		echo '<label class="ativo" title="'.$formataData->toViewDate($pessoaAtual->getDataNascimentoPessoa()).'">Aniversário de '.$pessoaAtual->getNomePessoa().'&nbsp;&nbsp;<input type="button" value="Enviar E-mail" onclick="enviaEmail('.$endereco->getIdEndereco().',1,'.$pessoaAtual->getIdPessoa().')"/></label>';
		$cont++;
	}
	echo '<br><br>';
}

$listaCnh = unserialize(base64_decode(trim($_GET['listaCnh'])));
if(!is_null($listaCnh)  && $listaCnh->count() > 0)
{
	$cont = 0;
	foreach ($listaCnh as $cnhs)
	{
		if($cont == 0)
			echo '<label class="ativo">Vencimento de CNH</label>';
		$cnhAtual = new Cnh();
		$cnhAtual = $cnhs;		
		$pessoaAtual = new Pessoa();
		$pessoaAtual = $cnhAtual->returnaPessoa();
		$endereco = new Endereco();
		$endereco = (object)$pessoaAtual->retornaEndereco();
		echo '<label class="ativo" title="">CNH numero '.$cnhAtual->getNumeroCnh().', <b>nome:</b> '.$pessoaAtual->getNomePessoa().'&nbsp;&nbsp;<input type="button" value="Enviar E-mail" onclick="enviaEmail('.$endereco->getIdEndereco().',2,'.$cnhAtual->getIdCnh().')"/></label>';
		$cont++;
	}
	echo '<br><br>';
}

$listaIpva = unserialize(base64_decode(trim($_GET['listaIpva'])));
if(!is_null($listaIpva) && $listaIpva->count() > 0)
{
	$cont = 0;
	foreach ($listaIpva as $ipvas)
	{
		if($cont == 0)
			echo '<label class="ativo">Vencimento de IPVA</label>';
		$veiculoAtual = new Veiculos();
		$veiculoAtual = $ipvas;
		$clientes = new Clientes();
		$clientes = $veiculoAtual->retornaClientes();
		$endereco = new Endereco();
		$endereco = $clientes->getEnderecoCliente();
		echo '<label class="ativo" title="">'.$veiculoAtual->getPlacaVeiculos().' - IPVA vencendo&nbsp;&nbsp;<input type="button" value="Enviar E-mail" onclick="enviaEmail('.$endereco->getIdEndereco().',3,'.$veiculoAtual->getIdVeiculos().')"/></label>';
		$cont++;
	}
	echo '<br><br>';
}

$listaSeguro = base64_decode(trim($_GET['listaSeguro']));
if(!is_null($listaSeguro) && $listaSeguro->count() > 0)
{
	$cont = 0;
	foreach ($listaSeguro as $seguros)
	{
		if($cont == 0)
			echo '<label class="ativo">Vencimento de Seguro do Carro</label>';
		$veiculoAtual = new Veiculos(); 
		$veiculoAtual = $seguros;
		$clientes = new Clientes();
		$clientes = $veiculoAtual->retornaClientes();
		$endereco = new Endereco();
		$endereco = $clientes->getEnderecoCliente();
		echo '<label class="ativo" title="">'.$veiculoAtual->getPlacaVeiculos().' - Seguro vencendo&nbsp;&nbsp;<input type="button" value="Enviar E-mail" onclick="enviaEmail('.$endereco->getIdEndereco().',4,'.$veiculoAtual->getIdVeiculos().')"/></label>';
		$cont++;
	}
	echo '<br><br>';
}

$listaGarantia = unserialize(base64_decode(trim($_GET['listaGarantia'])));
if(!is_null($listaGarantia) && $listaGarantia->count() > 0)
{
	$cont = 0;
	foreach ($listaGarantia as $garantias)
	{
		if($cont == 0)
			echo '<label class="ativo">Vencimento de Garantia</label>';
		$veiculoAtual = new Veiculos(); 
		$veiculoAtual = $garantias;
		$clientes = new Clientes();
		$clientes = $veiculoAtual->retornaClientes();
		$endereco = new Endereco();
		$endereco = $clientes->getEnderecoCliente();
		echo '<label class="ativo" title="">'.$veiculoAtual->getPlacaVeiculos().' - Garantia vencendo&nbsp;&nbsp;<input type="button" value="Enviar E-mail" onclick="enviaEmail('.$endereco->getIdEndereco().',5,'.$veiculoAtual->getIdVeiculos().')"/></label>';
		$cont++;
	}
	echo '<br><br>';
}

$listaRevisoes = unserialize(base64_decode(trim($_GET['listaRevisoes'])));
if(!is_null($listaRevisoes) && $listaRevisoes->count() > 0)
{
	$cont = 0;
	foreach ($listaRevisoes as $revisoes)
	{
		if($cont == 0)
			echo '<label class="ativo">Vencimento de Revisão</label>';
		$revisoesAtual = new Revisoes();
		$revisoesAtual = $revisoes;
		$veiculoAtual = new Veiculos();
		$veiculoAtual->setIdVeiculos($revisoesAtual->getIdVeiculos());
		$collVeiculos = $controla->findVeiculos($veiculoAtual);
		$veiculoAtual = $collVeiculos[0];
		$clientes = new Clientes();
		$clientes = $veiculoAtual->retornaClientes();
		$endereco = new Endereco();
		$endereco = $clientes->getEnderecoCliente();
		echo '<label class="ativo" title="">'.$veiculoAtual->getPlacaVeiculos().' - Revisão agendada&nbsp;&nbsp;<input type="button" value="Enviar E-mail" onclick="enviaEmail('.$endereco->getIdEndereco().',6,'.$revisoesAtual->getIdRevisoes().')"/></label>';
		$cont++;
	}
	echo '<br><br>';
}
?>