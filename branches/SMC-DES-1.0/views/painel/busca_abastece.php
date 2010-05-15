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
	<title>SMC - Busca Abastecimentos</title>
	<meta name="Description" content="SMC - Busca Abastecimentos" >
	<meta http-equiv="X-UA-Compatible" content="IE=7" > 
	<link rel="stylesheet" href="../css/meucpf.css" type="text/css" media="all" >
</head>
<body>

<div class="busca">

	<form id="f_cli" action="../../class/ControlaFuncionalidades.php" method="post">
		<input type="hidden" id="acao" name="acao" value="buscaAbastecimentos">
		<input type="hidden" id="idCliente" name="idCliente" value="<?=$logon->getIdClientes()?>">
	<label>Veículo:</label>
	<select class="nome" id="veiculo" name="veiculo" onchange="document.getElementById('f_cli').submit();">
		<option><?=SELECIONE?></option>
		<?php
		$veiculos = new Veiculos();
		if($logon->getNivelAcessoLogin() != 5)
		{
			$veiculos->setIdClientes($logon->getIdClientes());
		}
		$collVoVeiculos = $controla->findVeiculos($veiculos);
		if(!is_null($collVoVeiculos))
		{
			foreach($collVoVeiculos as $veiculoAtual)
			{
				$veiculos = (object)$veiculoAtual;
		?>
			<option value="<?=$veiculos->getIdVeiculos()?>"><?=$veiculos->getPlacaVeiculos()?></option>				
		<?
			}
		} 
		?>
	</select>
	
</form>
<style>
	td { border:1px dotted #AAA; padding:0px 4px; }
	td.tcenter { text-align:center; }
	td.tright { text-align:right; }
</style>
<?php 
		$collAbastecimentosPesquisadas = null;
		if(isset($_GET['abastecimentosPesquisados']))
		{
			if($_GET['abastecimentosPesquisados'] != '')
			{
				$collAbastecimentosPesquisadas = unserialize(urldecode($_GET['abastecimentosPesquisados']));
			}
			else 
			{
				$collAbastecimentosPesquisadas = null;
			}
			if(!is_null($collAbastecimentosPesquisadas) && count($collAbastecimentosPesquisadas) > 0)
			{
				if(count($collAbastecimentosPesquisadas) > 1)
					echo "<p>".count($collAbastecimentosPesquisadas)." resultados encontrados</p><br><br>";
				else
					echo "<p>".count($collAbastecimentosPesquisadas)." resultado encontrado</p><br><br>";
			}
			else
			{
				echo "<p align=\"center\">Nenhum resultado encontrado.</p>";
			}
		} 
		
		$abastecimentos = new Abastecimentos();
		if(!is_null($collAbastecimentosPesquisadas) && count($collAbastecimentosPesquisadas) > 0)
		{
			foreach ($collAbastecimentosPesquisadas as $abastecimentoAtual)
			{
				$abastecimentos = (object)$abastecimentoAtual;
?>
			<form class="esq" method="get" action="index.php"  id="form" name="form">
			<input type="hidden" value="<?=$abastecimentos->getIdAbastecimentos()?>" name="idAbastecimentos" />
    		<input type="hidden" value="detalhe_abastecimentos" name="p" />
				<table>
					<tr class="topo">
						<td> Data do abastecimento </td>
						<td> KM marcado </td>
						<td> Posto </td>
						<td> Nota fiscal </td>
						<td> Combustível </td>
						<td> Qtd (litros) </td>
						<td> Valor total </td>
					</tr>
					<tr class="dados">
						<td class="tcenter"><?=$formataData->toViewDate($abastecimentos->getDataAbastecimentos())?></td>
						<td class="tcenter"><?=$abastecimentos->getKmAbastecimentos()?></td>
						<td><?=$abastecimentos->getPostoAbastecimentos()?></td>
						<td class="tcenter"><?=$abastecimentos->getNfAbastecimentos()?></td>
						<td><?=$abastecimentos->getTipoCombustivelAbastecimentos()?></td>
						<td class="tright"><?$abastecimentos->getLitrosAbastecimentos()?></td>
						<td class="upper tright"><?=$abastecimentos->getValorAbastecimentos()?></td>
					</tr>
				</table>
				<input type="submit" value="Detalhar / Alterar"/>
			</form>	
		<?php
			}
		}
		 ?>