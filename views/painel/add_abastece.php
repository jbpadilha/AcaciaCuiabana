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
	}
?>
<link rel="stylesheet" href="_css/formPadrao.css" type="text/css" media="all" />

<form method="post" action="../../class/RecebePostGet.php">

<fieldset>
	<p class="caption">Lançar abastecimento</p>
	<fieldset>
		<label>Placa do Vesãculo:
			<select name="placa">
				<option selected></option>
<?php
	$veiculos = new Veiculos();
	$veiculos->setIdClientes($logon->getIdClientes());
	$collVoVeiculos = $controla->findVeiculos($veiculos);
	
	if(!is_null($collVoVeiculos)) {
		foreach ($collVoVeiculos as $veiculoAtual) {
			$veiculos = $veiculoAtual;
?>
				<option value="<?=$veiculos->getIdVeiculos()?>" <?=($veiculos->getIdVeiculos()==$abastecimentos->getIdVeiculos()) ? "selected":"" ?>><?=$veiculos->getPlacaVeiculos()?></option>
<?
		}
	}
?>
			</select>
		</label>
		<br />
		<label>Data do abastecimento:
			<input type="text" name="data" value="<?=$formataData->toViewDate($abastecimentos->getDataAbastecimentos())?>" maxlength="10" class="data" />
		</label>
		<label>Kilometragem atual:
			<input type="text" name="km" value="<?=$abastecimentos->getKmAbastecimentos()?>" />
		</label>
		<br />
		<label>Fornecedor (posto):
			<input type="text" name="posto" value="<?=$abastecimentos->getPostoAbastecimentos()?>" class="long" />
		</label>
		<br />
		<label>Nã da nota/cupom fiscal:
			<input type="text" value="<?=$abastecimentos->getNfAbastecimentos()?>" class="doc" />
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
		<label>Quantidade (litros):
			<input type="text" name="litros" value="<?=$abastecimentos->getLitrosAbastecimentos()?>" maxlength="3" class="small" /> </p>
		</label>
		<label>Valor unitário (R$):
			<input type="text" name="valor" value="<?=$abastecimentos->getValorAbastecimentos()?>" class="small" />
		</label>
	</fieldset>

	<p class="botoes">
		<input type="hidden" id="acao" name="acao" value="cadastroAbastecimento">
		<input type="submit" name="abastece" value="Confirmar">
		<input type="reset" value="Limpar campos" >
	</p>
</form>