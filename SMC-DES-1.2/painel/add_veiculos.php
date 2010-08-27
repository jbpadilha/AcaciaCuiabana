<?php
	require_once ('../class/Config.php');

	if(!isset($_SESSION['usuarioLogon'])) header("Location:../home.php?page=login");
	
	$logon = new Logon();
	$logon = $_SESSION["usuarioLogon"];
	
	$veiculos = new Veiculos();
	
	if(isset($_SESSION['veiculoAtual'])) $veiculos = $_SESSION['veiculoAtual'];
?>
<form method="post" action="../class/RecebePostGet.php">

<div class="botoes">
	<input type="hidden" name="idClientes" value="<?php echo $logon->getIdClientes(); ?>"/>
	<input type="hidden" name="acao" value="CadastraVeiculos"/>
	<button type="reset" accesskey="L">Limpar campos</button>
	<button type="submit" name="confveic" accesskey="C">Confirmar</button>
</div>

<p class="caption">Informações gerais do veículo</p>
<fieldset>
	<div class="left">
		<label>Placa
			<input type="text" name="placa" alt="req" value="<?php echo $veiculos->getPlacaVeiculos(); ?>" maxlength="7" class="placa" />
		</label>
		<label>Marca
			<input type="text" name="marca" alt="req" value="<?php echo $veiculos->getMarcaVeiculos(); ?>" class="" />
		</label>
		<label>Modelo
			<input type="text" name="modelo" alt="req" value="<?php echo $veiculos->getModeloVeiculos(); ?>" class="" />
		</label>
		<br />
		<label>Ano fabricação
			<input type="text" name="anofab" alt="req" value="<?php echo $veiculos->getAnoFabricacaoVeiculos(); ?>" maxlength="4" class="ano" />
		</label>
		<br />
		<label>Cor
			<input type="text" name="cor" alt="req" value="<?php echo $veiculos->getCorVeiculos(); ?>" class="" />
		</label>
		<label>Combustível
			<input type="text" name="combustivel" alt="req" value="<?php echo $veiculos->getCombustivelVeiculos(); ?>" class="" />
		</label>
		<label>Capacidade
			<input type="text" name="capacidade" alt="req" value="<?php echo $veiculos->getCapacidadeTanqueVeiculos(); ?>" maxlength="2" class="num" />
		</label>
	</div>
	<div class="right">
		<label>Renavam<input type="text" name="renavam" alt="req" value="<?php echo $veiculos->getRenavamVeiculos(); ?>" maxlength="9" class="docRenavam" /></label>
		<br />
		<label>Chassi<input type="text" name="chassi" alt="req" value="<?php echo $veiculos->getChassiVeiculos(); ?>" maxlength="21" class="docChassi" /></label>
		<br />
		<label>Tipo
			<select name="tipo_veiculo" alt="req">
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
		<label>Código Fipe<input type="text" value="<?php echo $veiculos->getCodFipeVeiculos(); ?>" name="codigo_fipe" maxlength="8" class="codFipe" /></label>
	</div>
</fieldset>

<p class="caption">Dados da Nota Fiscal</p>
<fieldset>
	<div class="left">
		<label>Fornecedor<input type="text" alt="req" value="<?php echo $veiculos->getFornecedorNfVeiculos(); ?>" name="fornecedor_nf" class="nome" /></label>
		<br />
		<label>Cidade<input type="text" alt="req" value="<?php echo $veiculos->getCidadeNfVeiculos(); ?>" name="cidade_nf" class="long" /></label>
		<label>Estado
			<select name="estado_nf" alt="req">
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
		<label>Proprietário
			<select name="proprietario_nf" alt="req">
				<option></option>
				<?php
				$pessoasProprietario = new Pessoa();

				if($logon->getNivelAcessoLogin() == Dominio::$CLIENTE) {
					$pessoasProprietario->setIdCliente($logon->getIdClientes());
				}

				$collPro = $controla->findPessoas($pessoasProprietario);

				if(!is_null($collPro)) {
					for($i = 0; $i<count($collPro);$i++) {
						$pessoasProprietario = $collPro[$i];
						echo "<option value=\"{$pessoasProprietario->getIdPessoa()}\"";
						if($veiculos->getProprietarioNfVeiculos() == $pessoasProprietario->getIdPessoa()) {
							echo "selected=\"selected\"";
						}
						echo ">{$pessoasProprietario->getNomePessoa()}</option>";
					}
				}
				?>
			</select>
		</label>
		<br />
		<label>Arrendatário<input type="text" value="<?php echo $veiculos->getArrendatarioNfVeiculos(); ?>" name="arrendatario_nf" class="nome" /></label>
	</div>
	<div class="right">
		<label>Placa anterior<input type="text" value="<?php echo $veiculos->getPlacaNfVeiculos(); ?>" name="placa_nf" maxlength="7" class="placa" /></label>
		<label>Número da NF<input type="text" value="<?php echo $veiculos->getNumeroNfVeiculos(); ?>" name="numero_nf" class="doc" /></label>
		<br />
		<label>Data de aquisição<input type="text" alt="req" value="<?php echo $formataData->toViewDate($veiculos->getDataNfVeiculos()); ?>" name="data_nf" maxlength="10" class="data" /></label>
		<label>Data da entrega<input type="text" alt="req" value="<?php echo $formataData->toViewDate($veiculos->getDataEntregaNfVeiculos()); ?>" name="data_entrega_nf" maxlength="10" class="data" /></label>
		<br />
		<label>KM Entrega<input type="text" alt="req" value="<?php echo $veiculos->getKmEntregaNfVeiculos(); ?>" name="km_entrega_nf" maxlength="15" class="decimal" /></label>
	</div>
</fieldset>

<p class="caption">Garantia e manutenção</p>
<fieldset>
	<div class="left">
		<label>Tempo garantia<input type="text" name="tempo_garantia" alt="req" value="<?php echo $veiculos->getTempoGarantiaNfVeiculos(); ?>" maxlength="4" class="num" /></label>
		<label>Unidade
			<select name="unidade_garantia" alt="req">
				<option></option>
				<option value="Dias">DIAS</option>
				<option value="Meses">MESES</option>
				<option value="Anos">ANOS</option>
			</select>
		</label>
		<label>Fim garantia<input type="text" name="fim_garantia" alt="req" class="data" /></label>
		<br />
		<label>KM garantia<input type="text" value="<?php echo $veiculos->getKmGarantiaVeiculos(); ?>" name="km_garantia" maxlength="10" class="decimal" /></label>
		<label>KM final<input type="text" name="km_fim_garantia" value="" maxlength="10" class="decimal" /></label>
	</div>
	<div class="right">
		<label>SEGURO<input type="text" name="vencimento_seguro" value="<?php echo $formataData->toViewDate($veiculos->getVencimentoSeguroVeiculos()); ?>" maxlength="10" class="data" /></label>
	</div>
</fieldset>

</form>