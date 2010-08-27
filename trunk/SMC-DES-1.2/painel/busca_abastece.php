<?php
	require_once ('../class/Config.php');
	
	if(!isset($_SESSION['usuarioLogon'])) {
		header("Location:../views/home.php?p=login");
	}
	
	$logon = new Logon();
	$logon = $_SESSION["usuarioLogon"];
?>
<form method="post" action="../class/RecebePostGet.php">

	<div class="botoes">
		<input type="hidden" id="acao" name="acao" value="buscaAbastecimentos">
		<input type="hidden" id="idCliente" name="idCliente" value="<?php echo $logon->getIdClientes(); ?>">
		<button type="submit" accesskey="P">Procurar</button>
	</div>

	<p class="caption">Consulta abastecimentos</p>	
	<fieldset>
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
				<option value="<?php echo $veiculos->getIdVeiculos(); ?>"><?php echo $veiculos->getPlacaVeiculos(); ?></option>				
				<?php
					}
				}
			?>
			</select>
		</label>
	</fieldset>
<?php
if(isset($_GET['limpa'])) unset($_SESSION['abastecimentosPesquisados']); 
	$collAbastecimentosPesquisadas = null;	
	if(isset($_SESSION['abastecimentosPesquisados'])) {
		$msg = '<fieldset class="msg">';
		if($_SESSION['abastecimentosPesquisados'] != '') {
			$collAbastecimentosPesquisadas = $_SESSION['abastecimentosPesquisados'];
			if(!is_null($collAbastecimentosPesquisadas) && count($collAbastecimentosPesquisadas) > 0) {
				if(count($collAbastecimentosPesquisadas) > 1) $msg .= count($collAbastecimentosPesquisadas)." resultados encontrados.";
				else $msg .= count($collAbastecimentosPesquisadas)." resultado encontrado.";
			} else {
				$msg .= "Nenhum resultado encontrado.";
			}
		} else {
			$msg .= "Nenhum resultado encontrado.";
		}
		$msg = $msg.'</fieldset>';
	}
	if (isset($msg)) echo $msg;
?>
</form>

<div id="resultados">
<?php
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
			<td><?php echo $formataData->toViewDate($abastecimentos->getDataAbastecimentos())?></td>
			<td><?php echo $abastecimentos->getKmAbastecimentos(); ?></td>
			<td><?php echo $abastecimentos->getPostoAbastecimentos(); ?></td>
			<td><?php echo $abastecimentos->getNfAbastecimentos(); ?></td>
			<td><?php echo $abastecimentos->getTipoCombustivelAbastecimentos(); ?></td>
			<td><?php echo $abastecimentos->getLitrosAbastecimentos(); ?></td>
			<td><?php echo $abastecimentos->getValorAbastecimentos(); ?></td>
			<td>
				<form name="form" method="get" action="index.php" >
					<input type="hidden" name="idAbastecimentos" value="<?php echo $abastecimentos->getIdAbastecimentos(); ?>" />
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