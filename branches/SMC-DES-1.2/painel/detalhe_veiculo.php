<?php
	require_once ('../class/Config.php');
	if(!isset($_SESSION['usuarioLogon']))
	{
		header("Location:../views/home.php?p=login");
	}
	$logon = new Logon();
	$logon = $_SESSION["usuarioLogon"];

	$veiculos = new Veiculos();

	if (isset($_GET['idVeiculosAlterar']) && $_GET['idVeiculosAlterar'] != '') {
		if(isset($_SESSION['veiculosAtual'])) unset($_SESSION['veiculosAtual']);
		$veiculos->setIdVeiculos($_GET['idVeiculosAlterar']);
		$collVoAlterar = $controla->findVeiculos($veiculos);
		if(!is_null($collVoAlterar)) {
			$veiculos = $collVoAlterar[0]; 
		} 
	} elseif(isset($_SESSION['veiculosAtual'])) {
		$veiculos = $_SESSION['veiculosAtual'];
	}
?>
<form method="post" action="../class/RecebePostGet.php">

<div class="botoes">
	<input type="hidden" name="idClientes" value="<?php echo $logon->getIdClientes(); ?>" />
	<input type="hidden" name="acao" value="alterarVeiculos" />
	<input type="hidden" name="idVeiculos" value="<?php echo $veiculos->getIdVeiculos(); ?>" />
	<input class="botao" type="reset" value="Limpar campos" />
	<input class="botao" type="submit" name="confveic" value="Confirmar" />
</div>

<p class="caption">Informações gerais do Veículo</p>
<fieldset>
	<div class="left">
		<label>Placa:<input type="text" name="placa" value="<?php echo $veiculos->getPlacaVeiculos(); ?>" maxlength="7" class="placa" /></label>
		<br />
		<label>Marca:<input type="text" name="marca" value="<?php echo $veiculos->getMarcaVeiculos(); ?>" class="" /></label>
		<label>Modelo:<input type="text" name="modelo" value="<?php echo $veiculos->getModeloVeiculos(); ?>" class="" /></label>
		<br />
		<label>Cor:<input type="text" name="cor" value="<?php echo $veiculos->getCorVeiculos(); ?>" class="" /></label>
		<label>Ano de Fabricação:<input type="text" name="anofab" value="<?php echo $veiculos->getAnoFabricacaoVeiculos(); ?>" maxlength="4" class="num" /></label>
		<br />
		<label>Combustível:<input type="text" name="combustivel" value="<?php echo $veiculos->getCombustivelVeiculos(); ?>" class="" /></label>
		<label>Capacidade:<input type="text" name="capacidade" value="<?php echo $veiculos->getCapacidadeTanqueVeiculos(); ?>" maxlength="2" class="num" /></label>
	</div>		
	<div class="right">
		<label>Renavam:<input type="text" name="renavam" value="<?php echo $veiculos->getRenavamVeiculos(); ?>" maxlength="9" class="docRenavam" /></label>
		<br />
		<label>Chassi:<input type="text" name="chassi" value="<?php echo $veiculos->getChassiVeiculos(); ?>" maxlength="21" class="docChassi" /></label>
		<br />
		<label>Tipo:
			<select name="tipo_veiculo">
			<option></option>
				<option value="Van" <?php echo ($veiculos->getTipoVeiculos() == "Van") ? "Selected" : ""?>>Van</option>
				<option value="Combi" <?php echo ($veiculos->getTipoVeiculos() == "Combi") ? "Selected" : ""?>>Combi</option>
				<option value="Carro esportivo" <?php echo ($veiculos->getTipoVeiculos() == "Carro esportivo") ? "Selected" : ""?>>Carro esportivo</option>
				<option value="Trator" <?php echo ($veiculos->getTipoVeiculos() == "Trator") ? "Selected" : ""?>>Trator</option>
				<option value="Bitrem" <?php echo ($veiculos->getTipoVeiculos() == "Bitrem") ? "Selected" : ""?>>Bitrem</option>
				<option value="Pickup" <?php echo ($veiculos->getTipoVeiculos() == "Pickup") ? "Selected" : ""?>>Pickup</option>
				<option value="Moto" <?php echo ($veiculos->getTipoVeiculos() == "Moto") ? "Selected" : ""?>>Moto</option>
				<option value="Caminhão" <?php echo ($veiculos->getTipoVeiculos() == "Caminhão") ? "Selected" : ""?>>Caminhão</option>
				<option value="Carreta" <?php echo ($veiculos->getTipoVeiculos() == "Carreta") ? "Selected" : ""?>>Carreta</option>
			</select>
		</label>
		<br />
		<label>Código Fipe:<input type="text" name="codigo_fipe" value="<?php echo $veiculos->getCodFipeVeiculos(); ?>" maxlength="8" /></label>
	</div>
</fieldset>

<p class="caption">Dados da Nota Fiscal</p>
<fieldset> 
	<div class="left">
		<label>Fornecedor:<input type="text" name="fornecedor_nf" value="<?php echo $veiculos->getFornecedorNfVeiculos(); ?>" class="nome" /></label>
		<br />
		<label>Cidade:<input type="text" name="cidade_nf" value="<?php echo $veiculos->getCidadeNfVeiculos(); ?>" class="long" /></label> 
		<label>Estado:
			<select name="estado_nf">
				<option></option>
				<?php
				foreach ($estados as $uf => $estado) {
					$attr = $veiculos->getEstadoNfVeiculos() == $uf ? " selected" : "";
					echo "\n<option value=\"".$uf."\"".$attr.">".$uf."</option>";
				}
				?>				
			</select>
		</label>
		<br />
		<label>Proprietário:
			<select name="proprietario_nf" class="long">
				<option></option>
				<?php
				$pessoasProprietario = new Pessoa();
				if ($logon->getNivelAcessoLogin() == Dominio::$CLIENTE) $pessoasProprietario->setIdCliente($logon->getIdClientes());
				$collPro = $controla->findPessoas($pessoasProprietario);

				if(!is_null($collPro)) {
					for($i = 0; $i<count($collPro);$i++) {
						$pessoasProprietario = $collPro[$i];
						if ($veiculos->getProprietarioNfVeiculos() == $pessoasProprietario->getIdPessoa()) {
							$attr = " selected";
						}
						echo "<option value=\"".$pessoasProprietario->getIdPessoa()."\"".$attr.">".$pessoasProprietario->getNomePessoa()."</option>";
					}
				}
				?>
			</select>
		</label>
		<br />
		<label>Arrendatário:<input type="text" value="<?php echo $veiculos->getArrendatarioNfVeiculos(); ?>" name="arrendatario_nf" class="long" /></label>
	</div>
	<div class="right">
		<label>Placa anterior:<input type="text" value="<?php echo $veiculos->getPlacaNfVeiculos(); ?>" name="placa_nf" maxlength="7" class="placa" /></label>
		<br />
		<label>Data da compra:<input type="text" value="<?php echo $formataData->toViewDate($veiculos->getDataNfVeiculos())?>" name="data_nf" maxlength="10" class="data" /></label>
		<label>número da NF:<input type="text" value="<?php echo $veiculos->getNumeroNfVeiculos(); ?>" name="numero_nf" class="docNF" /></label>
		<br />
		<label>Data da entrega:<input type="text" value="<?php echo $formataData->toViewDate($veiculos->getDataEntregaNfVeiculos())?>" name="data_entrega_nf" maxlength="10" class="data" /></label>
		<label>KM Entrega:<input type="text" value="<?php echo $veiculos->getKmEntregaNfVeiculos(); ?>" name="km_entrega_nf" maxlength="15" class="km" /></label>
	</div>
</fieldset>

<p class="caption">Garantia e manutenção</p>
<fieldset>
	<label>Tempo:<input type="text" value="<?php echo $veiculos->getTempoGarantiaNfVeiculos(); ?>" name="tempo_garantia" maxlength="4" class="num" /></label>
	<label>KM:<input type="text" value="<?php echo $veiculos->getKmGarantiaVeiculos(); ?>" name="km_garantia" maxlength="10" class="km" /></label>
</fieldset>

<p class="caption">Vencimentos</p>
<fieldset>
	<label>IPVA:<input type="text" name="vencimento_ipva" value="<?php echo $veiculos->getVencimentoIpvaVeiculos(); ?>" maxlength="10" class="data" /></label>
	<label>SEGURO:<input type="text" name="vencimento_seguro" value="<?php echo $veiculos->getVencimentoSeguroVeiculos(); ?>" maxlength="10" class="data" /></label>
</fieldset>

</form>