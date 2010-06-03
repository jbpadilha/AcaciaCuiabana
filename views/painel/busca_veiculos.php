<?php
	require_once ('../../class/Config.php');

	if(!isset($_SESSION['usuarioLogon'])) {
		header("Location:../views/home.php?p=login");
	}

	$logon = new Logon();
	$logon = $_SESSION["usuarioLogon"];
?>
<link rel="stylesheet" href="_css/formPadrao.css" type="text/css" media="all" />

<form method="post" action="../../class/RecebePostGet.php">
	<p class="caption">Consulta de veículos</p>
	<label>Placa:
		<input type="text" name="busca" />
	</label>
	<p class="botoes">
		<input type="hidden" name="acao" value="buscaVeiculos" />
		<input type="hidden" name="idCliente" value="<?=$logon->getIdClientes()?>" />
		<input type="submit" value="Procurar" />
	</p>
</form>

<div id="resultados">
<?php
	$collVeiculosPesquisados = null;
	if(isset($_GET['veiculosPesquisados'])) {
		if($_GET['veiculosPesquisados'] != '') {
			$collVeiculosPesquisados = unserialize(urldecode($_GET['veiculosPesquisados']));
		} else {
			$collVeiculosPesquisados = null;
		}
		if(!is_null($collVeiculosPesquisados) && count($collVeiculosPesquisados) > 0) {
			if(count($collVeiculosPesquisados) > 1) {
				echo "<p>".count($collVeiculosPesquisados)." resultados encontrados</p><br><br>";
			} else {
				echo "<p>".count($collVeiculosPesquisados)." resultado encontrado</p><br><br>";
			}
		} else {
			echo "<p align=\"center\">Nenhum resultado encontrado.</p>";
		}
	}

	$veiculoPesquisado = new Veiculos();
	if(!is_null($collVeiculosPesquisados) && count($collVeiculosPesquisados) > 0) {
?>
<table>
	<thead>
		<td width="295"><b>Placa</b></td>
		<td width="348" colspan="2"><b>Modelo</b></td>
	</thead>
<?php
		foreach ($collVeiculosPesquisados as $veiculos) {
			$veiculoPesquisado = (object)$veiculos;
?>
	<tr>
		<td>
			<?=$veiculoPesquisado->getPlacaVeiculos()?>
		</td>
		<td>
			<?=$veiculoPesquisado->getModeloVeiculos()?>
		</td>
		<td>
			<form class="esq" method="get" action="index.php" >
				<input type="hidden" value="<?=$veiculoPesquisado->getIdVeiculos()?>" name="idVeiculosAlterar" />
				<input type="hidden" value="detalhe_veiculo" name="p" />
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