<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">

<head>
	<title>SMC - Demonstração</title>

    <link type="text/css" rel="stylesheet" media="screen" href="/_global/_css/form.css" />

	<script type="text/javascript" language="javascript" src="/_global/_js/jquery-1.4.2.js"></script>
	<script type="text/javascript" language="javascript" src="/_global/_js/jquery.maskedinput-1.2.2.js"></script>
	<script type="text/javascript" language="javascript" src="/_global/_js/jquery.price_format.1.2.js"></script>
	<script type="text/javascript" language="javascript" src="/_global/_js/jquery.gt.extensions.js"></script>
	<script type="text/javascript" language="javascript" src="/_global/_js/demo.js"></script>
</head>

<?php
	require '../_global/_php/scripts.php';
?>

<body>

<form method="post" action="" style="width:557px; ">

	<div class="botoes">
		<button type="reset" accesskey="L">Limpar campos</button>
		<button type="submit" accesskey="E">Enviar</button>
	</div>

	<p class="caption">
		Identificação
	</p>
	<fieldset>
		<label>Nome
			<input type="text" name="nome" class="long" value="<?php echo $_POST['nome']; ?>" />
		</label>
		<label>Nº Série
			<input type="text" name="numeroSerie" value="<?php echo $_POST['numeroSerie']; ?>" />
		</label>
		<br />
		<label>Fabricante
			<input type="text" name="fabricante" value="<?php echo $_POST['fabricante']; ?>" />
		</label>
		<label>Origem
			<select name="origem">
				<option></option>
				<option value="nacional">Nacional</option>
				<option value="importado">Importado</option>
			</select>
		</label>
		<label>País
			<select name="origemPais">
				<?php select('paises'); ?>
			</select>
		</label>
		<br />
		<label>Descrição / modelo
			<input type="text" name="modelo" class="long" value="<?php echo $_POST['modelo']; ?>" />
		</label>
		<label>Nº Chassi
			<input type="text" name="numeroChassi" value="<?php echo $_POST['numeroChassi']; ?>" />
		</label>
		<br />
		<label>Ano fabricação
			<input type="text" name="anoFabricacao" class="ano" value="<?php echo $_POST['anoFabricacao']; ?>" />
		</label>
		<label>Ano modelo
			<input type="text" name="anoModelo" class="ano" value="<?php echo $_POST['anoModelo']; ?>" />
		</label>
		<label>Tracionamento
			<select name="tracao">
				<?php select('tracao'); ?>
			</select>
		</label>
		<label>Cor
			<input type="text" name="cor" value="<?php echo $_POST['cor']; ?>" />
		</label>
		<br />
		<label>Tipo combustível
			<select name="tipoCombustivel">
				<?php select ('tipoCombustivel'); ?>
			</select>
		</label>
		<label>Cap. máx. tanque comb.
			<input type="text" name="tanque" class="decimal_1" value="<?php echo $_POST['tanque']; ?>" />
		</label>
		<label>Cód. ident. interno
			<input type="text" name="codIdInterno" class="cod_A1" maxlength="11" value="<?php echo $_POST['codIdInterno']; ?>" />
		</label>
	</fieldset>
	
	<p class="caption">Informações adicionais</p>
	<fieldset>
		<label>
			<textarea name="adicionais" class="long" rows="4"></textarea>
		</label>
	</fieldset>

	<p class="caption">Contador</p>
	<fieldset>
		<label>Tipo contador
			<select name="contadorTipo">
				<?php select('contador'); ?>
			</select>
		</label>
		<label>Variação diária
			<input type="text" name="contadorVariacaoDia" class="decimal" value="<?php echo $_POST['contadorVariacaoDia']; ?>" />
		</label>
	</fieldset>

	<p class="caption">Nota fiscal</p>
	<fieldset>
		<label>Fornecedor
			<input type="text" name="fornecedor" class="long" value="<?php echo $_POST['fornecedor']; ?>" />
		</label>
		<label>Nº nota fiscal
			<input type="text" name="numeroNF" class="docNF" value="<?php echo $_POST['numeroNF']; ?>" />
		</label>
		<br />
		<label>Data da compra
			<input type="text" name="dataCompra" class="data" value="<?php echo $_POST['dataCompra']; ?>" />
		</label>
		<label>Valor da compra
			<input type="text" name="compraValor" class="valor" value="<?php echo $_POST['compraValor']; ?>" />
		</label>
		<label>Nº imobilizado
			<input type="text" name="numeroImobilizado" maxlength="11" class="cod_A1" value="<?php echo $_POST['numeroImobilizado']; ?>" />
		</label>
	</fieldset>
	
	<p class="caption">Entrega técnica</p>
	<fieldset>
		<label>Data
			<input type="text" name="dataEntrega" class="data" value="<?php echo $_POST['dataEntrega']; ?>" />
		</label>
		<label>Posição contador
			<input type="text" name="posicaoContadorEntrega" class="decimal" value="<?php echo $_POST['posicaoContadorEntrega']; ?>" />
		</label>
	</fieldset>

	<p class="caption">Garantia</p>
	<fieldset>
		<label>Período
			<input type="text" name="garantiaDuracao" class="decimal" value="<?php echo $_POST['garantiaDuracao']; ?>" />
		</label>
		<label>Contador
			<select name="garantiaUnidade">
				<?php select('unidade'); ?>
			</select>
		</label>
		<label>Data final
			<input type="text" name="dataFimGarantia" class="data" value="<?php echo $_POST['dataFimGarantia']; ?>" />
		</label>
	</fieldset>

	<p class="caption">Acompanhamento</p>
	<fieldset>
		<label>Intervalo
			<input type="text" name="intervaloAcompanhamento" class="decimal" value="<?php echo $_POST['intervaloAcompanhamento']; ?>" />
		</label>
		<label>Unidade
			<select name="unidadeAcompanhamento">
				<?php select('unidade'); ?>
			</select>
		</label>
		<label>Última leitura
			<input type="text" name="dataUltimaLeitura" class="data" value="<?php echo $_POST['dataUltimaLeitura']; ?>" />
		</label>
		<label>Última posição
			<input type="text" name="contadorUltimaPosicao" class="decimal" value="<?php echo $_POST['contadorUltimaPosicao']; ?>" />
		</label>
	</fieldset>

</form>

	<div id="avisos">
		<img src="/_global/_img/alerta.png" alt="" title="" />
		<span>Mensagens de alerta...</span>
	</div>

</body>

</html>