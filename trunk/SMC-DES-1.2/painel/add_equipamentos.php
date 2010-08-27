<?php
	require_once ('../class/Config.php');

	if (!isset($_SESSION['usuarioLogon'])) header("Location: /smc/home.php?p=login");

	$logon = new Logon();
	$logon = $_SESSION["usuarioLogon"];
	
	$equipamentos = new Equipamentos();
	
	if (isset($_SESSION['equipamentoAtual'])) $equipamentos = $_SESSION['equipamentoAtual'];

	require '../../_global/_php/scripts.php';
?>
<link type="text/css" rel="stylesheet" media="screen" href="/_global/_css/form.css" />

<form method="post" action="../class/RecebePostGet.php" style="width:557px; ">

	<div class="botoes">
		<button type="reset" accesskey="L">Limpar campos</button>
		<button type="submit" accesskey="E">Enviar</button>
		<input type="hidden" id="acao" name="acao" value="cadastroEquipamentos">
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
			<input type="text" name="nome" class="long" alt="req" value="<?=$equipamentos->getNome()?>" />
		</label>
		<label>Nº Série
			<input type="text" name="numeroSerie" alt="req" value="<?=$equipamentos->getNumeroSerie()?>" />
		</label>
		<br />
		<label>Fabricante
			<input type="text" name="fabricante" alt="req" value="<?=$equipamentos->getFabricante()?>" />
		</label>
		<label>Origem
			<select alt="req" name="origem">
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
			<input type="text" name="modelo" class="long" alt="req" value="<?=$equipamentos->getModelo()?>" />
		</label>
		<label>Nº Chassi
			<input type="text" name="numeroChassi" alt="req" value="<?=$equipamentos->getNumeroChassi()?>" />
		</label>
		<br />
		<label>Ano fabricação
			<input type="text" name="anoFabricacao" class="ano" alt="req" value="<?=$equipamentos->getAnoFabricacao()?>" />
		</label>
		<label>Ano modelo
			<input type="text" name="anoModelo" class="ano" alt="req" value="<?=$equipamentos->getAnoModelo()?>" />
		</label>
		<label>Cor
			<input type="text" name="cor" alt="req" value="<?=$equipamentos->getCor()?>" />
		</label>
		<label>Cód. ident. interno
			<input type="text" name="codIdInterno" class="cod_A1" maxlength="11" value="<?=$equipamentos->getColdIdInterno()?>" />
		</label>
		<br />
		<label>Alimentação
			<select alt="req" name="tipoAlimentacao">
				<?php select('tipoAlimentacao'); ?>
			</select>
		</label>
		<label>Tipo
			<select name="tipoAlimentacaoAC">
				<?php select('tipoAlimentacaoAC'); ?>
			</select>
			<select name="tipoAlimentacaoDC">
				<?php select('tipoAlimentacaoDC'); ?>
			</select>
			<input type="text" name="tipoAlimentacaoOutros" />
		</label>
		<br />
		<label>Possui acessórios?
			<select alt="req" name="possuiAcessorios">
				<?php select ('possuiAcessorios'); ?>
			</select>
		</label>
		<label>Relação dos acessorios
			<textarea name="acessorios" class="long" rows="4"><?=$equipamentos->getAcessorios()?></textarea>
		</label>
		<label>Informações adicionais
			<textarea name="adicionais" class="long" rows="4"><?=$equipamentos->getAdicionais()?></textarea>
		</label>
	</fieldset>

	<p class="caption">Nota fiscal</p>
	<fieldset>
		<label>Fornecedor
			<input type="text" name="fornecedor" class="long" alt="req" value="<?=$equipamentos->getNfFornecedor()?>" />
		</label>
		<label>Nº nota fiscal
			<input type="text" name="numeroNF" class="docNF" alt="req" value="<?=$equipamentos->getNfNumero()?>" />
		</label>
		<br />
		<label>Data da compra
			<input type="text" name="dataCompra" class="data" alt="req" value="<?=$formataData->toViewDate($equipamentos->getNfDataCompra())?>" />
		</label>
		<label>Valor da compra
			<input type="text" name="compraValor" class="valor" alt="req" value="<?=$equipamentos->getNfValorCompra()?>" />
		</label>
		<label>Nº imobilizado
			<input type="text" name="numeroImobilizado" maxlength="11" class="cod_A1" value="<?=$equipamentos->getNumeroImobilizado()?>" />
		</label>
	</fieldset>
	
	<p class="caption">Entrega técnica</p>
	<fieldset>
		<label>Data
			<input type="text" name="dataEntrega" class="data" alt="req" value="<?=$formataData->toViewDate($equipamentos->getNfDataEntrega())?>" />
		</label>
	</fieldset>

	<p class="caption">Garantia</p>
	<fieldset>
		<label>Tempo
			<input type="text" name="tempoGarantia" class="num" alt="req" value="<?=$equipamentos->getTempoGarantia()?>" />
		</label>
		<label>Unidade
			<select alt="req" name="unidadeGarantiaTempo">
				<?php select('unidadeGarantiaTempo'); ?>
			</select>
		</label>
		<label>Data final
			<input type="text" name="dataFimGarantia" class="data" alt="req" value="<?=$equipamentos->getDataFimGarantia()?>" />
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
				<input type="text" name="tempoGarantia2" class="num" value="<?=$equipamentos->getTempoGarantia2()?>" />
			</label>
			<label>Unidade
				<select name="unidadeGarantiaTempo2">
					<?php select('unidadeGarantiaTempo2'); ?>
				</select>
			</label>
			<label>Data final
				<input type="text" name="dataFimGarantia2" class="data" value="<?=$formataData->toViewDate($equipamentos->getDatafimGarantia2())?>" />
			</label>
		</span>
	</fieldset>

	<p class="caption">Contrato de manutenção</p>
	<fieldset>
		<label>Possui?
			<select alt="req" name="possuiContratoManutencao">
				<?php select('possuiContratoManutencao'); ?>
			</select>
		</label>
		<span>
			<label>Empresa
				<input type="text" name="empresaContratoManutencao" class="nome2" alt="req" value="<?=$equipamentos->getEmpresaContratoManutencao()?>" />
			</label>
			<label>Data início
				<input type="text" name="dataInicioContratoManutencao" class="data" alt="req" value="<?=$formataData->toViewDate($equipamentos->getDataInicioContratoManutencao())?>" />
			</label>
			<label>Data fim
				<input type="text" name="dataFimContratoManutencao" class="data" alt="req" value="<?=$formataData->toViewDate($equipamentos->getDataFimContratoManutencao())?>" />
			</label>
			<label>Informações do contrato
				<textarea name="infoContratoManutencao" class="long" rows="5"><?=$equipamentos->getInfoContratoManutencao()?></textarea>
			</label>
		</span>
	</fieldset>
	
</form>

	<div id="avisos">
		<img src="/_global/_img/alerta.png" alt="" title="" />
		<span>Mensagens de alerta...</span>
	</div>

</body>

</html>