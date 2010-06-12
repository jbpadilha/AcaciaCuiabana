<?php
	require_once ('../../class/Config.php');
	
	if(!isset($_SESSION['usuarioLogon'])) {
		header("Location:../views/home.php?p=login");
	}
	if(isset($_GET['limpa']))
	{
		unset($_SESSION['valoresAtual']);
		unset($_SESSION['contRevisoes']);
		unset($_SESSION['revisoesAtual']);
	}
	$logon = new Logon();
	$logon = $_SESSION["usuarioLogon"];

	$revisoes = new Revisoes();
	
	if(isset($_SESSION['revisoesAtual'])) {
		$revisoes = $_SESSION['revisoesAtual'];
	}
?>
<link rel="stylesheet" href="_css/formPadrao.css" type="text/css" media="all" />
<script type="text/javascript">
function adicionaCampoRevisao()
{
	document.form1.adicionaRevisao.value = "sim";
	document.form1.submit();
}
</script>
<form method="post" action="../../class/RecebePostGet.php" name="form1" id="form1">
	<p class="caption">Cadastro de Revisões</p>
	<fieldset>
		<label>Placa do Veículo
			<select name="placa">
				<option><?=SELECIONE?></option>
<?php 
	$veiculos = new Veiculos();
	
	if($logon->getNivelAcessoLogin() != Dominio::$ADMINISTRADOR) {
		$veiculos->setIdClientes($logon->getIdClientes());
	}
	
	$collVoVeiculos = $controla->findVeiculos($veiculos);
	
	if(!is_null($collVoVeiculos)) {
		foreach ($collVoVeiculos as $veiculoAtual) {
			$veiculos = $veiculoAtual;
?>
				<option value="<?=$veiculos->getIdVeiculos()?>" <?=($veiculos->getIdVeiculos()==$revisoes->getIdVeiculos()) ? "selected":"" ?>><?=$veiculos->getPlacaVeiculos()?></option>
<?
}
}
?>
			</select>
		</label>
		<label>descrição do Serviço:
			<select name="revisao">
				<option><?=SELECIONE?></option>
<?php 
	$tipoRevisoes = new Tiporevisoes();
	
	$collVoTipos = $controla->findTipoRevisoes($tipoRevisoes);
	
	if(!is_null($collVoTipos)) {
		foreach ($collVoTipos as $tipos) {
			$tipoRevisoes = $tipos;
				echo "<option value=\"{$tipoRevisoes->getIdTipoRevisoes()}\"";
				echo ($tipoRevisoes->getIdTipoRevisoes() == $revisoes->getIdTipoRevisoes()) ? "selected" : "";
				echo ">{$tipoRevisoes->getDescricaoTipoRevisoes()}</option>";
		}
	}
?>
			</select>
		</label>
		<br />
		<br />
		<b>Próximas Revisões</b><br/><br/>
		<?php
		$valores = null;
		if(isset($_SESSION['valoresAtual']))
		{
			$valores = $_SESSION['valoresAtual'];
		}
			  
		$cont = 1;
		if(isset($_SESSION['contRevisoes']))
			$cont = $_SESSION['contRevisoes'];
		
		$_SESSION['contRevisoes'] = $cont;
			
		for($i=0;$i<$cont;$i++)
		{
			?>
			<br/>
			Data da Revisão: <input type="text" name="data<?=$i?>" value="<?=$valores[$i][0]?>"/><br/>
			ou<br/>
			Km da Revisão: <input type="text" name="km<?=$i?>" value="<?=$valores[$i][1]?>"/>
			<br/>
			<?php
		}
		?>
		<input type="button" onclick="adicionaCampoRevisao();" value="Adicionar Revisão">
		<p class="botoes">
			<input type="hidden" name="acao" value="cadastroRevisoes" />
			<input type="hidden" name="adicionaRevisao" value="" />
			<input type="submit" name="revpad" value="Concluir" />
		</p>
		
	</fieldset>
</form>