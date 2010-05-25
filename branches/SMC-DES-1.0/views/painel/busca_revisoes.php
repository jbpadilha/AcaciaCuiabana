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
	<title>SMC - Busca Revisões</title>
	<meta name="Description" content="SMC - Busca Revisões" >
	<meta http-equiv="X-UA-Compatible" content="IE=7" > 
	<link rel="stylesheet" href="../css/meucpf.css" type="text/css" media="all" >
</head>
<body>
<div id="form_busca">
	<form name="busca_revisoes" method="POST" action="../../class/RecebePostGet.php" >
		<input type="hidden" id="acao" name="acao" value="buscaRevisoes">
		<input type="hidden" id="idCliente" name="idCliente" value="<?=$logon->getIdClientes()?>">
		<p class="caption"> Consulta Revisões</p>
		<label>Placa do Veículo:</label>
		<input name="busca" type="text" class="nome" >
		<span class="borda"> </span> 
		<p class="tright"> <input class="f_right" type="submit" value="Procurar" > </p>
	</form>	

</div>
<?php
		$collRevisoesPesquisadas = null;
		if(isset($_GET['revisoesPesquisados']))
		{
			if($_GET['revisoesPesquisados'] != '')
			{
				$collRevisoesPesquisadas = unserialize(urldecode($_GET['revisoesPesquisados']));
			}
			else 
			{
				$collRevisoesPesquisadas = null;
			}
			if(!is_null($collRevisoesPesquisadas) && count($collRevisoesPesquisadas) > 0)
			{
				if(count($collRevisoesPesquisadas) > 1)
					echo "<p>".count($collRevisoesPesquisadas)." resultados encontrados</p><br><br>";
				else
					echo "<p>".count($collRevisoesPesquisadas)." resultado encontrado</p><br><br>";
			}
			else
			{
				echo "<p align=\"center\">Nenhum resultado encontrado.</p>";
			}
		} 
		
		$revisoes = new Revisoes();
		if(!is_null($collRevisoesPesquisadas) && count($collRevisoesPesquisadas) > 0)
		{
?>
<div id="form_resultados">
<div align='center'>

<?php
	$cont = 1;
	foreach ($collRevisoesPesquisadas as $revisaoAtual)
	{
		$revisoes = (object)$revisaoAtual;
		$veiculos = new Veiculos();
		$veiculos = (object)unserialize(urldecode($_GET['veiculos']));
?>
<form class="center" action="index.php" method="get">
	<input type="hidden" value="<?=$revisoes->getIdRevisoes()?>" name="idRevisoesAlterar" />
	<input type="hidden" value="detalhe_revisoes" name="p" />
	<table>
		<tr class="topo">
			<td>Ordem</td>
			<td>Placa</td>
			<td>Ult. data</td>
			<td>Revisão</td>
			<td>Ult. km</td>
			<td>Próx. data</td>
			<td>Próx. KM</td>
		</tr>
		<tr class="dados">
			<td>Revisão Nº <?=$cont?>	</td>
			<td><?=$veiculos->getPlacaVeiculos()?></td>
			<td><?=$formataData->toViewDate($revisoes->getDataRevisoes())?></td>
			<td><?=$revisoes->getTipoRevisoes()?></td>
			<td><?=$revisoes->getKmRevisoes()?></td>
			<td><?=$revisoes->getProxDataRevisoes()?></td>
			<td><?=$revisoes->getProxKmRevisoes()?></td>
		</tr>
		<tr>
			<td colspan="7"><input type="submit" value="Detalhar / Alterar"/></td>
		</tr>
</table>

</form>
<?php
	}
		}
?>
</div>
</div>