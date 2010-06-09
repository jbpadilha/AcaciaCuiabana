<link href="../css/default.css" rel="stylesheet" type="text/css" >
<script type="text/javascript" language="javascript" src="../scripts/busca.js" > </script>

<?php
	include ('includes/config.php');
	
	$id = $_GET['id'];
	$placa = $_GET['placa'];
	
	$query = mysql_query("SELECT * FROM revisoes_tkm WHERE id = '{$id}' AND placa = '{$placa}'");
	$array = mysql_fetch_array($query);
	
	$query2 = mysql_query("SELECT * FROM veiculos WHERE placa = '{$placa}'");
	$array2 = mysql_fetch_array($query2);
	
	$query3 = mysql_query("SELECT * FROM clientes WHERE id_cliente = '{$array2['contratante_nf']}'");
	$array3 = mysql_fetch_array($query3);
?>

<body onload="initDragDrop();">

<div id="form">

	<form name="rev_confirma" method="post">

		<p class="caption">CONFIRMAÇÃO DE REVISÃO</p>

	<fieldset>
		<p><label>Cliente (proprietário do veículo)</label></p>
		<p><input type="text" id="cliente" value="<?=$array3['nome_cliente']?>" class="cli_nome" readonly >
			<img src="../imagens/search.png" class="ico_inside" onclick="ShowDiv('pop_cli'); IrPara('busca_cli');" alt="Procurar" title="Procurar" /></p>

		<p><label>Veículo (placa)</label></p>
		<p><input type="text" id="placa" value="<?=$placa?>" class="placa" maxlength="8" readonly >
			<img src="../imagens/search.png" class="ico_inside" onclick="ShowDiv('pop_placa'); IrPara('busca_placa');" alt="Procurar" title="Procurar" /></p>
		
		<p><label>Descrição do serviço</label></p>
		<p><input type="text" id="revisao" value="<?=$array['revisao']?>" class="rev_nome" readonly >
			<img src="../imagens/search.png" class="ico_inside" onclick="ShowDiv('pop_rev'); IrPara('busca_rev');" alt="Procurar" title="Procurar" /></p>
		
		<p><label>Data da realização do serviço</label></p>
		<p><input type="text" name="ult_data" value="" class="data" maxlength="10" onkeypress="return mascara(event,this,'##/##/####');return Onlynumbers(event);" ></p>
		
		<p><label>KM informado na revisão</label></p>
		<p><input type="text" value="" class="rev_km" name="ult_km" ></p>
	</fieldset>

		<span class="borda">
		<p class="tright">
			<input type="hidden" name="id" value="<?=$array['id']?>" />
			<input type="submit" value="Confirmar" name="confirma">
		</p>
		</span>
	</form>

	<div id="pop_cli" class="popup" >
		<div class="tit_bt drag" onmouseover="__dragId = 'pop_cli'" >
			<img src="../imagens/search.png" alt="ico" title="Consulta de clientes" class="small f_left" />
			<label>Escolha um cliente da lista</label>
			<span class="bt" onclick="CloseDiv('pop_cli');" ></span>
		</div>
		<span class="bar">
			<p> <label> Procurar cliente: </label> </p>
			<p> <input type="text" id="busca_cli" name="nome" class="x100 upper" onKeyUp="carregaAjax('cli_result', 'get_cliente.php?x=' + this.value)" > </p>
		</span>
		<div class="content">
			<div id="cli_result">
				<?php
					$dados = mysql_query("SELECT * FROM clientes WHERE id_cliente != '' ORDER BY nome_cliente ASC");
					while ($get = mysql_fetch_array($dados)) { ?>
						<p class="linha" onclick="getDados('<?= $get['id_cliente'] ?>','cliente'); CloseDiv('pop_cli');">
							<label class="id" > <?= $get['id_cliente'] ?> </label>
							<label id="<?= $get['id_cliente'] ?>" > <?= $get['nome_cliente'] ?> </label>
							<label class="cpf" > <?= $get['cpf_cliente'] ?> </label>
						</p>
					<? }
				?>
			</div>
		</div>
	</div>

	<div id="pop_placa" class="popup">
		<div class="tit_bt drag" onmouseover="__dragId = 'pop_placa'" >
			<img src="../imagens/search.png" alt="ico" title="Consulta de clientes" class="small f_left" />
			<label>Escolha uma placa da lista</label>
			<span class="bt" onclick="CloseDiv('pop_placa');" ></span>
		</div>
		<span class="bar">
			<p> <label> Procurar pela placa: </label> </p>
			<p> <input type="text" id="busca_placa" name="nome" class="x100 upper" onKeyUp="carregaAjax('veic_result', 'get_placa.php?x=' + this.value)" > </p>
		</span>
		<div class="content">
			<div id="veic_result">
				<?php
					$dados = mysql_query("SELECT * FROM veiculos WHERE contratante_nf != '' ORDER BY placa ASC");
					while ($get = mysql_fetch_array($dados)) { ?>
						<p id="<?= $get['placa'] ?>" class="linha" onclick="getDados('<?= $get['placa'] ?>','placa'); CloseDiv('pop_placa');"><?= $get['placa'] ?></p>
					<? }
				?>
			</div>
		</div>
	</div>

	<div id="pop_rev" class="popup">
		<div class="tit_bt drag" onmouseover="__dragId = 'pop_rev'" >
			<img src="../imagens/search.png" alt="ico" title="Consulta de tipos revisões" class="small f_left" />
			<label>Escolha uma revisão da lista</label>
			<span class="bt" onclick="CloseDiv('pop_rev');" ></span>
		</div>
		<span class="bar">
			<p> <label> Procurar revisao: </label> </p>
			<p> <input type="text" id="busca_rev" name="nome" class="x100 upper" onKeyUp="carregaAjax('rev_result', 'get_revisao.php?x=' + this.value)" > </p>
		</span>
		<div class="content">
			<div id="rev_result">
				<?php
					$dados = mysql_query("SELECT * FROM rev_tipos WHERE rev_descricao != '' ORDER BY rev_descricao ASC");
					while ($get = mysql_fetch_array($dados)) { ?>
						<p id="<?= $get['id'] ?>" class="linha" onclick="getDados('<?= $get['id'] ?>','revisao'); CloseDiv('pop_rev');"><?= $get['rev_descricao'] ?></p>
					<? }
				?>
			</div>
		</div>
	</div>

</div>

</body>


<?php
	isset($_POST['confirma']) ? $confirma = $_POST['confirma'] : $confirma = '';
	if ($confirma != '') {
		$ult_data = addslashes($_POST['ult_data']);
		$ult_km	= addslashes($_POST['ult_km']);
		$id	= addslashes($_POST['id']);
		$atualiza = mysql_query("UPDATE revisoes_tkm SET ult_data = '{$ult_data}', ult_km = '{$ult_km}' WHERE (id = '{$id}')");
		if ($atualiza) { echo "Registro atualizado"; }
		else { echo "Falha ao atualizar o registro"; }
	}
?>