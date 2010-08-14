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
		<input type="hidden" name="acao" value="buscaVeiculos" />
		<input type="hidden" name="idCliente" value="<?php echo $logon->getIdClientes()?>" />
		<input type="submit" value="Procurar" />
	</div>

	<p class="caption">Consulta de Veículos</p>
	<fieldset>
		<label>Placa:
			<input type="text" name="busca" class="placa" />
		</label>
	</fieldset>
<?php
	if(isset($_GET['limpa'])) unset($_SESSION['veiculosPesquisados']);
	$collVeiculosPesquisados = null;

	if(isset($_SESSION['veiculosPesquisados'])) {
		$msg = '<fieldset class="msg">';
		if($_SESSION['veiculosPesquisados'] != '') {
			$collVeiculosPesquisados = $_SESSION['veiculosPesquisados'];
			if(!is_null($collVeiculosPesquisados) && count($collVeiculosPesquisados) > 0) {
				if(count($collVeiculosPesquisados) > 1) $msg .= count($collVeiculosPesquisados)." resultados encontrados.";
				else $msg .= count($collVeiculosPesquisados)." resultado encontrado.";
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
	$veiculoPesquisado = new Veiculos();
	if(!is_null($collVeiculosPesquisados) && count($collVeiculosPesquisados) > 0) {
?>
<table>
	<thead>
		<td width="100">Placa</td>
		<td>Descrição</td>
	</thead>
<?php
		foreach ($collVeiculosPesquisados as $veiculos) {
			$veiculoPesquisado = (object)$veiculos;
?>
	<tr>
		<td>
			<form class="esq" method="get" action="index.php" >
				<input type="hidden" value="<?php echo $veiculoPesquisado->getIdVeiculos()?>" name="idVeiculosAlterar" />
				<input type="hidden" value="detalhe_veiculo" name="p" />
				<input type="image" src="_img/edit.gif" title="Visualizar/Editar" />
			</form>
			<?php echo $veiculoPesquisado->getPlacaVeiculos()?>
		</td>
		<td>
			<?php echo $veiculoPesquisado->getMarcaVeiculos().' '.$veiculoPesquisado->getModeloVeiculos().' - '.$veiculoPesquisado->getAnoFabricacaoVeiculos()?>
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