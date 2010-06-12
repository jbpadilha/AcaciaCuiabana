<?php
	require_once ('../../class/Config.php');
	
	if(!isset($_SESSION['usuarioLogon'])) {
		header("Location:../views/home.php?p=login");
	}
	
	$logon = new Logon();
	$logon = $_SESSION["usuarioLogon"];
?>
<form method="post" action="../../class/RecebePostGet.php">
	<p class="caption">Consulta abastecimentos</p>
	<label>Veículo:
		<select name="veiculo">
			<option></option>
<?php
	$veiculos = new Veiculos();
	
	if($logon->getNivelAcessoLogin() != 5) {
		$veiculos->setIdClientes($logon->getIdClientes());
	}
	
	$collVoVeiculos = $controla->findVeiculos($veiculos);
	if(!is_null($collVoVeiculos)) {
		foreach($collVoVeiculos as $veiculoAtual) {
			$veiculos = (object)$veiculoAtual;
?>
			<option value="<?=$veiculos->getIdVeiculos()?>"><?=$veiculos->getPlacaVeiculos()?></option>				
<?
		}
	}
?>
		</select>
	</label>
	
	<p class="botoes">
		<input type="hidden" id="acao" name="acao" value="buscaAbastecimentos">
		<input type="hidden" id="idCliente" name="idCliente" value="<?=$logon->getIdClientes()?>">
		<input type="submit" value="Procurar" />
	</p>
</form>

<div id="resultados">
<?php
 if(isset($_GET['limpa']))
	{
		unset($_SESSION['abastecimentosPesquisados']);
	} 
	$collAbastecimentosPesquisadas = null;
	
	if(isset($_SESSION['abastecimentosPesquisados'])) 
	{
		if($_SESSION['abastecimentosPesquisados'] != '') 
		{
			$collAbastecimentosPesquisadas = $_SESSION['abastecimentosPesquisados'];

			if(!is_null($collAbastecimentosPesquisadas) && count($collAbastecimentosPesquisadas) > 0) {
				if(count($collAbastecimentosPesquisadas) > 1) {
					echo "<p>".count($collAbastecimentosPesquisadas)." resultados encontrados</p><br><br>";
				} else {
					echo "<p>".count($collAbastecimentosPesquisadas)." resultado encontrado</p><br><br>";
				}
			} else {
				echo "<p>Nenhum resultado encontrado.</p>";
			}
		}
		else 
		{
				echo "<p>Nenhum resultado encontrado.</p>";
		}
	}

	$abastecimentos = new Abastecimentos();
	
	if(!is_null($collAbastecimentosPesquisadas) && count($collAbastecimentosPesquisadas) > 0) {
?>
	<table>
		<thead>
			<td> Data do abastecimento </td>
			<td> KM marcado </td>
			<td> Posto </td>
			<td> Nota fiscal </td>
			<td> Combustível </td>
			<td> Qtd (litros) </td>
			<td> Valor total </td>
		</thead>
<?php
	foreach ($collAbastecimentosPesquisadas as $abastecimentoAtual) {
			$abastecimentos = (object)$abastecimentoAtual;
?>
		<tr>
			<td><?=$formataData->toViewDate($abastecimentos->getDataAbastecimentos())?></td>
			<td><?=$abastecimentos->getKmAbastecimentos()?></td>
			<td><?=$abastecimentos->getPostoAbastecimentos()?></td>
			<td><?=$abastecimentos->getNfAbastecimentos()?></td>
			<td><?=$abastecimentos->getTipoCombustivelAbastecimentos()?></td>
			<td><?=$abastecimentos->getLitrosAbastecimentos()?></td>
			<td><?=$abastecimentos->getValorAbastecimentos()?></td>
			<td>
				<form name="form" method="get" action="index.php" >
					<input type="hidden" name="idAbastecimentos" value="<?=$abastecimentos->getIdAbastecimentos()?>" />
					<input type="hidden" name="p" value="detalhe_abastecimentos" />
					<input type="submit" value="Detalhar / Alterar"/>
				</form>	
			</td>
		</tr>
<?php
		}
?>
	</table>
<?php
}
?>
</div>