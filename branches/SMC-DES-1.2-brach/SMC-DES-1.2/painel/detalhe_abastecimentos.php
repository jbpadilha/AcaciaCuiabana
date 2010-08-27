<?php
	require_once ('../class/Config.php');

	if(!isset($_SESSION['usuarioLogon'])) {
		header("Location:../views/home.php?p=login");
	}

	$logon = new Logon();
	$logon = $_SESSION["usuarioLogon"];
	$abastecimentos = new Abastecimentos();

	if (isset($_GET['idAbastecimentos']) && $_GET['idAbastecimentos'] != '') 
	{
		if(isset($_SESSION['abastecimentosAtual']))
			unset($_SESSION['abastecimentosAtual']);
		$abastecimentos->setIdAbastecimentos($_GET['idAbastecimentos']);
		$collVoAlterar = $controla->findAbastecimentos($abastecimentos);
		if(!is_null($collVoAlterar)) {
			$abastecimentos =  $collVoAlterar[0];
		}
	}
	elseif(isset($_SESSION['abastecimentosAtual'])) 
	{
		$abastecimentos = $_SESSION['abastecimentosAtual'];
	}
?>

<form method="post" action="../class/RecebePostGet.php">

	<div class="botoes">
		<input type="hidden" name="acao" value="alterarAbastecimento">
		<input type="hidden" name="idAbastecimentos" value="<?php echo $abastecimentos->getIdAbastecimentos(); ?>">
		<input type="hidden" name="idVeiculos" value="<?php echo $abastecimentos->getIdVeiculos(); ?>">
		<input type="reset" value="Limpar campos" >
		<input type="submit" name="abastece" value="Confirmar">
	</div>

	<p class="caption">Alterar abastecimento</p>
<fieldset>
	<label>Placa do veículo:
<?php 
		$veiculos = new Veiculos();
		$veiculos->setIdClientes($logon->getIdClientes());
		$collVoVeiculos = $controla->findVeiculos($veiculos);
		if(!is_null($collVoVeiculos)) {
			$veiculos = $collVoVeiculos[0];
			echo '<input type="text" value="'.$veiculos->getPlacaVeiculos().'" class="placa" />';
		}
?>
	</label>
	<br />
	<label>Data do abastecimento:
		<input type="text" name="data" value="<?php echo $formataData->toViewDate($abastecimentos->getDataAbastecimentos())?>" maxlength="10" class="data" />
	</label>
	<label>Kilometragem atual:
		<input type="text" name="km" value="<?php echo $abastecimentos->getKmAbastecimentos(); ?>" class="km" />
	</label>
	<br />
	<label>Fornecedor (posto):
		<input type="text" name="posto" value="<?php echo $abastecimentos->getPostoAbastecimentos(); ?>" class="long" />
	</label>
	<br />
	<label>Nº da nota/cupom fiscal:
		<input type="text" name="nf" value="<?php echo $abastecimentos->getNfAbastecimentos(); ?>" class="docNF" />
	</label>
	<label>Tipo de combustível:
		<select name="combustivel">
			<option></option>
			<option value="Gasolina" <?php echo ($abastecimentos->getTipoCombustivelAbastecimentos() == "Gasolina")? "selected" : ""; ?>>Gasolina</option>
			<option value="Álcool" <?php echo ($abastecimentos->getTipoCombustivelAbastecimentos() == "Álcool")? "selected" : ""; ?>>Álcool</option>
			<option value="Flex" <?php echo ($abastecimentos->getTipoCombustivelAbastecimentos() == "Flex")? "selected" : ""; ?>>Flex</option>
			<option value="Diesel" <?php echo ($abastecimentos->getTipoCombustivelAbastecimentos() == "Diesel")? "selected" : ""; ?>>Diesel</option>
		</select>
	</label>
	<br />
	<label>Valor unitário (R$):
		<input type="text" name="valor" value="<?php echo $abastecimentos->getValorAbastecimentos(); ?>" maxlength="6" class="valor" />
	</label>
	<label>Quantidade (litros):
		<input type="text" name="litros" value="<?php echo $abastecimentos->getLitrosAbastecimentos(); ?>" maxlength="3" class="decimal" />
	</label>
</fieldset>

</form>