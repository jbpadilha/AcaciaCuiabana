<?php
	require_once ('../class/Config.php');

	if (!isset($_SESSION['usuarioLogon'])) header("Location: /smc/home.php?p=login");

	$logon = new Logon();
	$logon = $_SESSION["usuarioLogon"];
	
	$maquinas = new Maquinas();
	
	if (isset($_SESSION['maquinaAtual'])) $maquinas = $_SESSION['maquinaAtual'];

	require '../../_global/_php/scripts.php';
?>
<link type="text/css" rel="stylesheet" media="screen" href="/_global/_css/form.css" />

<form method="post" action="../class/RecebePostGet.php" style="width:557px; ">

	<div class="botoes">
		<button type="reset" accesskey="L">Limpar campos</button>
		<button type="submit" accesskey="E">Enviar</button>
		<input type="hidden" id="acao" name="acao" value="cadastroMaquinas">
	</div>
	<p class="caption">
		Proprietário
	</p>
	<fieldset>
       	<?php
       	if($logon->getIdClientes() != null)
       	{ 
       	?>
       	<input type="hidden" name="idCliente" value="<?=$logon->getIdClientes(); ?>" />
       	<?php 
       	}
       	else
       	{
       	?>
             <label>Nome
				<select name="idCliente" class="long">
					<option><?=SELECIONE?></option>
                    <?php 
						$clientes = new Clientes();
                    	$listaClientes = $controla->findClientes($clientes);
						if($listaClientes != null)
						{
							$clientes = new Clientes();
							foreach ($listaClientes as $cliente)
							{
								$clientes = $cliente;
								echo "<option value=\"{$clientes->getIdClientes()}\">{$clientes->getNomeCliente()}</option>";
							}
						} 
					?>
                    </select>
             </label>
		<?php 
       	}
		?>
    </fieldset>
	<p class="caption">
		Identificação
	</p>
	<fieldset>
		<label>Nome
			<input type="text" name="nome" class="long" alt="req" value="<?php echo $maquinas->getNomeMaquina(); ?>" />
		</label>
		<label>Nº Série
			<input type="text" name="numeroSerie" alt="req" value="<?php echo $maquinas->getNumeroSerieMaquina(); ?>" />
		</label>
		<br />
		<label>Fabricante
			<input type="text" name="fabricante" alt="req" value="<?php echo $maquinas->getFabricanteMaquinas(); ?>" />
		</label>
		<label>Origem
			<select name="origem" alt="req">
				<?php select('origem'); ?>
			</select>
		</label>
		<label>País
			<select alt="req" name="origemPais">
				<?php select('origemPais'); ?>
			</select>
		</label>
		<br />
		<label>Descrição / modelo
			<input type="text" name="modelo" class="long" alt="req" value="<?php echo $maquinas->getModeloMaquinas(); ?>" />
		</label>
		<label>Nº Chassi
			<input type="text" name="numeroChassi" alt="req" value="<?php echo $maquinas->getNumeroChassiMaquinas(); ?>" />
		</label>
		<br />
		<label>Ano fabricação
			<input type="text" name="anoFabricacao" class="ano" alt="req" maxlength="4" value="<?php echo $formataData->toViewDate($maquinas->getAnoFabricacaoMaquinas())?>" />
		</label>
		<label>Ano modelo
			<input type="text" name="anoModelo" class="ano" alt="req" maxlength="4" value="<?php echo $maquinas->getAnoModeloMaquinas(); ?>" />
		</label>
		<label>Tracionamento
			<select alt="req" name="tracao">
				<?php select('tracao'); ?>
			</select>
		</label>
		<label>Cor
			<input type="text" name="cor" alt="req" value="<?php echo $maquinas->getCorMaquinas(); ?>" />
		</label>
		<br />
		<label>Tipo combustível
			<select alt="req" name="tipoCombustivel">
				<?php select ('tipoCombustivel'); ?>
			</select>
		</label>
		<label>Cap. máx. tanque comb.
			<input type="text" name="tanque" class="decimal_1" alt="req" value="<?php echo $maquinas->getTanqueMaximoMaquinas(); ?>" />
		</label>
		<label>Cód. ident. interno
			<input type="text" name="codIdInterno" class="cod_A1" maxlength="11" value="<?php echo $maquinas->getCodIdInternoMaquinas(); ?>" />
		</label>
		<label>Informações adicionais
			<textarea name="adicionais" class="long" rows="4"><?php echo $maquinas->getAdicionaisMaquinas(); ?></textarea>
		</label>
	</fieldset>

	<p class="caption">Contador</p>
	<fieldset>
		<label>Tipo contador
			<select alt="req" name="contador">
				<?php select('contador'); ?>
			</select>
		</label>
		<label>Variação diária
			<input type="text" name="contadorVariacaoDia" class="decimal" alt="req" value="<?php echo $maquinas->getContadorVariacaoDiaMaquinas(); ?>" />
		</label>
	</fieldset>

	<p class="caption">Nota fiscal</p>
	<fieldset>
		<label>Fornecedor
			<input type="text" name="fornecedor" class="long" alt="req" value="<?php echo $maquinas->getNfFornecedorMaquinas(); ?>" />
		</label>
		<label>Nº nota fiscal
			<input type="text" name="numeroNF" class="docNF" alt="req" value="<?php echo $maquinas->getNfNumeroMaquinas(); ?>" />
		</label>
		<br />
		<label>Data da compra
			<input type="text" name="dataCompra" class="data" alt="req" value="<?$formataData->toViewDate($maquinas->getNfDataCompraMaquinas())?>" />
		</label>
		<label>Valor da compra
			<input type="text" name="compraValor" class="valor" alt="req" value="<?php echo $maquinas->getNfValorCompraMaquinas(); ?>" />
		</label>
		<label>Nº imobilizado
			<input type="text" name="numeroImobilizado" maxlength="11" class="cod_A1" value="<?php echo $maquinas->getNumeroImobilizadoMaquinas(); ?>" />
		</label>
	</fieldset>
	
	<p class="caption">Entrega técnica</p>
	<fieldset>
		<label>Data
			<input type="text" name="dataEntrega" class="data" alt="req" value="<?php echo $formataData->toViewDate($maquinas->getDataEntregaMaquinas())?>" />
		</label>
		<label>Posição contador
			<input type="text" name="posicaoContadorEntrega" class="decimal" alt="req" value="<?php echo $maquinas->getNfContadorEntregaMaquinas(); ?>" />
		</label>
	</fieldset>

	<p class="caption">Garantia</p>
	<fieldset>
		<label>Tempo
			<input type="text" name="tempoGarantia" class="num" alt="req" value="<?php echo $maquinas->getTempogarantiaMaquinas(); ?>" />
		</label>
		<label>Unidade
			<select alt="req" name="unidadeGarantiaTempo">
				<?php select('unidadeGarantiaTempo'); ?>
			</select>
		</label>
		<label>Data final
			<input type="text" name="dataFimGarantia" class="data" alt="req" value="<?php echo $formataData->toViewDate($maquinas->getDataFimGarantiaMaquinas())?>" />
		</label>
		<br />
		<label>Contador
			<input type="text" name="garantiaContador" class="decimal" alt="req" value="<?php echo $maquinas->getGarantiaContadorMaquinas(); ?>" />
		</label>
		<label>Unidade
			<select alt="req" name="unidadeGarantiaContador">
				<?php select('unidadeGarantiaContador'); ?>
			</select>
		</label>
		<label>Valor final
			<input type="text" name="valorFinalGarantia" class="decimal" alt="req" value="<?php echo $maquinas->getValorFinalGarantiaMaquinas(); ?>" />
		</label>
	</fieldset>

	<p class="caption">Garantia extendida</p>
	<fieldset>
		<label>Possui?
			<select alt="req" name="possuiGarantiaExtendida">
				<?php select('possuiGarantiaExtendida'); ?>
			</select>
		</label>
		<span>
			<label>Tempo
				<input type="text" name="tempoGarantia2" class="num" value="<?php echo $maquinas->getTempoGarantia2Maquinas(); ?>" />
			</label>
			<label>Unidade
				<select name="unidadeGarantiaTempo2">
					<?php select('unidadeGarantiaTempo2'); ?>
				</select>
			</label>
			<label>Data final
				<input type="text" name="dataFimGarantia2" class="data" value="<?php echo $formataData->toViewDate($maquinas->getDataFimGarantia2Maquinas())?>" />
			</label>
			<br />
			<label>Contador
				<input type="text" name="garantiaContador2" class="decimal" value="<?php echo $maquinas->getGarantiaContador2Maquinas(); ?>" />
			</label>
			<label>Unidade
				<select name="unidadeGarantiaContador2">
					<?php select('unidadeGarantiaContador2'); ?>
				</select>
			</label>
			<label>Valor final
				<input type="text" name="valorFinalGarantia2" class="decimal" value="<?php echo $maquinas->getValorFinalGarantia2Maquinas(); ?>" />
			</label>
		</span>
	</fieldset>

	<p class="caption">Contrato de manutenção</p>
	<fieldset>
		<label>Possui?
			<select name="possuiContratoManutencao" alt="req">
				<?php select('possuiContratoManutencao'); ?>
			</select>
		</label>
		<span>
			<label>Empresa
				<input type="text" name="empresaContratoManutencao" class="nome2" alt="req" value="<?php echo $maquinas->getEmpresaContratoManutencaoMaquinas(); ?>" />
			</label>
			<label>Data início
				<input type="text" name="dataInicioContratoManutencao" class="data" alt="req" value="<?php echo $formataData->toViewDate($maquinas->getDataInicioContratoManutencaoMaquinas())?>" />
			</label>
			<label>Data fim
				<input type="text" name="dataFimContratoManutencao" class="data" alt="req" value="<?php echo $formataData->toViewDate($maquinas->getDataFimContratoManutencaoMaquinas())?>" />
			</label>
			<label>Informações do contrato
				<textarea name="infoContratoManutencao" class="long" rows="5"><?php echo $maquinas->getInfoContratoManutencaoMaquinas(); ?></textarea>
			</label>
		</span>
	</fieldset>
	
	<p class="caption">Acompanhamento</p>
	<fieldset>
		<label>Data última leitura
			<input type="text" name="dataUltimaLeitura" class="data" alt="req" value="<?php echo $formataData->toViewDate($maquinas->getDataultimaLeituraMaquinas())?>" />
		</label>
		<label>Posição contador
			<input type="text" name="contadorUltimaLeitura" class="decimal" alt="req" value="<?php echo $maquinas->getContadorUltimaLeituraMaquinas(); ?>" />
		</label>
		<br />
		<label>Intervalo (tempo)
			<input type="text" name="acompanhaTempo" class="decimal" alt="req" value="<?php echo $maquinas->getAcompanhaTempoMaquinas(); ?>" />
		</label>
		<label>Unidade
			<select name="unidadeAcompanhaTempo" alt="req">
				<?php select('unidadeAcompanhaTempo'); ?>
			</select>
		</label>
		<br />
		<label>Intervalo (cont.)
			<input type="text" name="acompanhaContador" class="decimal" alt="req" value="<?php echo $maquinas->getAcompanhaContadorMaquinas(); ?>" />
		</label>
		<label>Unidade
			<select name="unidadeAcompanhaContador" alt="req">
				<?php select('unidadeAcompanhaContador'); ?>
			</select>
		</label>
	</fieldset>

</form>