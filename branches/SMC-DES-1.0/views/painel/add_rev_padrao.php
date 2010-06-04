<?php
	require_once ('../../class/Config.php');
	
	if(!isset($_SESSION['usuarioLogon'])) {
		header("Location:../views/home.php?p=login");
	}

	$logon = new Logon();
	$logon = $_SESSION["usuarioLogon"];

	$revisoes = new Revisoes();
	
	if(isset($_GET['revisoes'])) {
		$revisoes = unserialize(base64_decode($_GET['revisoes']));
	}
?>
<link rel="stylesheet" href="_css/formPadrao.css" type="text/css" media="all" />

<form method="post" action="../../class/RecebePostGet.php">
	<p class="caption">Cadastro de Revisões</p>
	<fieldset>
		<label>Placa do Veículo
			<select name="placa">
				<option></option>
<?php 
	$veiculos = new Veiculos();
	
	if($logon->getNivelAcessoLogin() != 5) {
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
				<option></option>
<?php 
	$tipoRevisoes = new Tiporevisoes();
	
	$collVoTipos = $controla->findTipoRevisoes($tipoRevisoes);
	
	if(!is_null($collVoTipos)) {
		foreach ($collVoTipos as $tipos) {
			$tipoRevisoes = $tipos;
?>
				<option value="<?=$tipoRevisoes->getIdTipoRevisoes()?>" <?=($tipoRevisoes->getIdTipoRevisoes() == $revisoes->getIdTipoRevisoes()) ? "selected" : ""?>><?=$tipoRevisoes->getDescricaoTipoRevisoes()?></option>
<?
		}
	}
?>
			</select>
		</label>
		<br />
		<br />
		<label><b>última Revisão</b></label>
		<label>realizada no dia (x),
			<input type="text" name="tult" maxlength="10" value="<?=$formataData->toViewDate($revisoes->getDataRevisoes())?>" class="data" />
		</label>
		<label>marcando (x)
			<input type="text" name="kult" value="<?=$revisoes->getKmRevisoes()?>" class="small" />
		</label>
		<label>quilômetros.</label> 
		<br />
		<br />
		<label><b>Próxima Revisão</b></label>
		<label>em (x) meses
			<input type="text" name="tprox" value="<?=$formataData->toViewDate($revisoes->getProxDataRevisoes())?>" maxlength="10" class="data" />
		</label>
		<label>ou (x) quilometros.
			<input type="text" name="kprox" value="<?=$revisoes->getProxKmRevisoes()?>" class="small" />
		</label> 

		<p class="botoes">
			<input type="hidden" name="acao" value="cadastroRevisoes" />
			<input type="submit" name="revpad" value="Concluir" />
		</p>
		
	</fieldset>
</form>