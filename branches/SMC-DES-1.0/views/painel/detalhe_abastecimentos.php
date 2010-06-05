<?php
	require_once ('../../class/Config.php');

	if(!isset($_SESSION['usuarioLogon'])) {
		header("Location:../views/home.php?p=login");
	}

	$logon = new Logon();
	$logon = $_SESSION["usuarioLogon"];
	$abastecimentos = new Abastecimentos();

	if(isset($_GET['abastecimentos'])) {
		$abastecimentos = unserialize(base64_decode($_GET['abastecimentos']));
	} elseif (isset($_GET['idAbastecimentos']) && $_GET['idAbastecimentos'] != '') {
		$abastecimentos->setIdAbastecimentos($_GET['idAbastecimentos']);
		$collVoAlterar = $controla->findAbastecimentos($abastecimentos);
		if(!is_null($collVoAlterar)) {
			$abastecimentos =  $collVoAlterar[0];
		}
	}
?>
<link rel="stylesheet" href="_css/formPadrao.css" type="text/css" media="all" />

<form method="post" action="../../class/RecebePostGet.php">
	<p class="caption">Alterar abastecimento</p>
	<label>Placa do Vesãculo:
<?php 
		$veiculos = new Veiculos();
		$veiculos->setIdClientes($logon->getIdClientes());
		$collVoVeiculos = $controla->findVeiculos($veiculos);
		if(!is_null($collVoVeiculos)) {
			$veiculos = $collVoVeiculos[0];
			echo '<input type="text" value="'.$veiculos->getPlacaVeiculos().'" class="uppercase" />';
		}
?>
	</label>
	<br />
	<label>Data do abastecimento:
		<input type="text" name="data" value="<?=$formataData->toViewDate($abastecimentos->getDataAbastecimentos())?>" maxlength="10" class="data" />
	</label>
	<label>Kilometragem atual:
		<input type="text" name="km" id="km" value="<?=$abastecimentos->getKmAbastecimentos()?>" />
	</label>
	<br />
	<label>Fornecedor (posto):
		<input type="text" name="posto" value="<?=$abastecimentos->getPostoAbastecimentos()?>" class="long" />
	</label>
	<br />
	<label>NÂº da nota/cupom fiscal:
		<input type="text" name="nf" value="<?=$abastecimentos->getNfAbastecimentos()?>" class="doc" />
	</label>
	<label>Tipo de combustsãvel:
		<select name="combustivel">
			<option></option>
			<option value="Gasolina" <?=($abastecimentos->getTipoCombustivelAbastecimentos() == "Gasolina")? "selected" : ""?>>Gasolina</option>
			<option value="álcool" <?=($abastecimentos->getTipoCombustivelAbastecimentos() == "álcool")? "selected" : ""?>>álcool</option>
			<option value="Flex" <?=($abastecimentos->getTipoCombustivelAbastecimentos() == "Flex")? "selected" : ""?>>Flex</option>
			<option value="Diesel" <?=($abastecimentos->getTipoCombustivelAbastecimentos() == "Diesel")? "selected" : ""?>>Diesel</option>
		</select>
	</label>
	<br />
	<label>Valor unitário (R$):
		<input type="text" name="valor" value="<?=$abastecimentos->getValorAbastecimentos()?>" maxlength="6" class="small" />
	</label>
	<label>Quantidade (litros):
		<input type="text" name="litros" value="<?=$abastecimentos->getLitrosAbastecimentos()?>" maxlength="3" class="small" />
	</label>

	<p class="botoes">
		<input type="hidden" name="acao" value="alterarAbastecimento">
		<input type="hidden" name="idAbastecimentos" value="<?=$abastecimentos->getIdAbastecimentos()?>">
		<input type="hidden" name="idVeiculos" value="<?=$abastecimentos->getIdVeiculos()?>">
		<input type="reset" value="Limpar campos" >
		<input type="submit" name="abastece" value="Confirmar">
	</p>
</form>