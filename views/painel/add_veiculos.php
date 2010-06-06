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

<?php
	$veiculos = new Veiculos();

	if(isset($_SESSION['veiculoAtual'])){
		$veiculos = $_SESSION['veiculoAtual'];
	}
?>

<fieldset>
	<p class="caption">Informações gerais do veículo</p>
	<div class="left">
		<label>Placa:<input type="text" name="placa" value="<?=$veiculos->getPlacaVeiculos()?>" maxlength="7" class="data" /></label>
		<br />
		<label>Marca:<input type="text" name="marca" value="<?=$veiculos->getMarcaVeiculos()?>" class="" /></label>
		<label>Modelo:<input type="text" name="modelo" value="<?=$veiculos->getModeloVeiculos()?>" class="" /></label>
		<label>Cor:<input type="text" name="cor" value="<?=$veiculos->getCorVeiculos()?>" class="" /></label>
		<br />
		<label>Ano fabricação:
		<input type="text" name="anofab" value="<?=$veiculos->getAnoFabricacaoVeiculos()?>" maxlength="4" class="small" /></label>
		<br />
		<label>Combustível:<input type="text" name="combustivel" value="<?=$veiculos->getCombustivelVeiculos()?>" class="" /></label>
		<label>Capacidade:<input type="text" name="capacidade" value="<?=$veiculos->getCapacidadeTanqueVeiculos()?>" maxlength="2" class="small" /></label>
	</div>
	<div class="right">
		<label>Renavam:<input type="text" name="renavam" value="<?=$veiculos->getRenavamVeiculos()?>" maxlength="9" class="doc" /></label>
		<br />
		<label>Chassi:<input type="text" name="chassi" value="<?=$veiculos->getChassiVeiculos()?>" maxlength="21" class="doc" /></label>
		<br />
		<label>Tipo:
			<select name="tipo_veiculo" class="x3">
				<option></option>
				<option value="Van" <?=($veiculos->getTipoVeiculos() == "Van") ? "Selected" : ""?>>Van</option>
				<option value="Combi" <?=($veiculos->getTipoVeiculos() == "Combi") ? "Selected" : ""?>>Combi</option>
				<option value="Carro esportivo" <?=($veiculos->getTipoVeiculos() == "Carro esportivo") ? "Selected" : ""?>>Carro esportivo</option>
				<option value="Trator" <?=($veiculos->getTipoVeiculos() == "Trator") ? "Selected" : ""?>>Trator</option>
				<option value="Bitrem" <?=($veiculos->getTipoVeiculos() == "Bitrem") ? "Selected" : ""?>>Bitrem</option>
				<option value="Pickup" <?=($veiculos->getTipoVeiculos() == "Pickup") ? "Selected" : ""?>>Pickup</option>
				<option value="Moto" <?=($veiculos->getTipoVeiculos() == "Moto") ? "Selected" : ""?>>Moto</option>
				<option value="Caminhão" <?=($veiculos->getTipoVeiculos() == "Caminhão") ? "Selected" : ""?>>Caminhão</option>
				<option value="Carreta" <?=($veiculos->getTipoVeiculos() == "Carreta") ? "Selected" : ""?>>Carreta</option>
			</select>
		</label>
		<br />
		<label>Código Fipe:<input type="text" value="<?=$veiculos->getCodFipeVeiculos()?>" name="codigo_fipe" maxlength="8" class="data" /></label>
	</div>
</fieldset>

<fieldset>
	<p class="caption">Dados da Nota Fiscal</p>
	<div class="left">
		<label>Fornecedor:<input type="text" value="<?=$veiculos->getFornecedorNfVeiculos()?>" name="fornecedor_nf" class="long" /></label>
		<br />
		<label>Cidade:<input type="text" value="<?=$veiculos->getCidadeNfVeiculos()?>" name="cidade_nf" class="long" /></label>
		<label>Estado:
			<select name="estado_nf">
				<option></option>
				<option value="MT" <?=($veiculos->getEstadoNfVeiculos()=="MT")?"selected=\"selected\"":""?>>MT</option>
			</select>
		</label>
		<br />
		<label>Proprietário:
			<select name="proprietario_nf">
				<option value=""><?=SELECIONE?></option>
				<?php
				$pessoasProprietario = new Pessoa();
				if($logon->getNivelAcessoLogin() == Dominio::$CLIENTE)
				{
					$pessoasProprietario->setIdCliente($logon->getIdClientes());
				}
				$collPro = $controla->findPessoas($pessoasProprietario);
				if(!is_null($collPro))
				{
					for($i = 0; $i<count($collPro);$i++) 
					{
						$pessoasProprietario = $collPro[$i];
						echo "<option value=\"{$pessoasProprietario->getIdPessoa()}\"";
						if($veiculos->getProprietarioNfVeiculos() == $pessoasProprietario->getIdPessoa())
							echo "selected=\"selected\"";
						echo ">{$pessoasProprietario->getNomePessoa()}</option>";
					}
				}
				?>
			</select>
		</label>
		<br />
		<label>Arrendatário:<input type="text" value="<?=$veiculos->getArrendatarioNfVeiculos()?>" name="arrendatario_nf" class="long" /></label>
	</div>
	<div class="right">
		<label>Placa anterior:<input type="text" value="<?=$veiculos->getPlacaNfVeiculos()?>" name="placa_nf" maxlength="7" class="data" /></label>
		<label>Número da NF:<input type="text" value="<?=$veiculos->getNumeroNfVeiculos()?>" name="numero_nf" class="doc" /></label>
		<br />
		<label>Data de aquisição:<input type="text" value="<?=$formataData->toViewDate($veiculos->getDataNfVeiculos())?>" name="data_nf" maxlength="10" class="data" /></label>
		<label>Data da entrega:<input type="text" value="<?=$formataData->toViewDate($veiculos->getDataEntregaNfVeiculos())?>" name="data_entrega_nf" maxlength="10" class="data" /></label>
		<br />
		<label>KM Entrega:<input type="text" value="<?=$veiculos->getKmEntregaNfVeiculos()?>" name="km_entrega_nf" maxlength="15" class="data" /></label>
	</div>
</fieldset>

<fieldset>
	<p class="caption">Garantia e manutenção</p>
	<div class="left">
		<label>Tempo de garantia:<input type="text" value="<?=$veiculos->getTempoGarantiaNfVeiculos()?>" name="tempo_garantia" maxlength="4" class="small" /></label>
		<br />
		<label>Quilometragem:<input type="text" value="<?=$veiculos->getKmGarantiaVeiculos()?>" name="km_garantia" maxlength="10" class="data" /></label>
	</div>
	<div class="right">
		<label>SEGURO:<input type="text" name="vencimento_seguro" value="<?=$formataData->toViewDate($veiculos->getVencimentoSeguroVeiculos())?>" maxlength="10" class="data" /></label>
	</div>
</fieldset>

<p class="botoes">
	<input type="hidden" name="idClientes" value="<?=$logon->getIdClientes()?>"/>
	<input type="hidden" name="acao" value="CadastraVeiculos"/>
	<input type="reset" value="Limpar campos">
	<input type="submit" name="confveic" value="Confirmar">
</p>

</form>