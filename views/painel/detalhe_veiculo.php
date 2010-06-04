<?php
require_once ('../../class/Config.php');
if(!isset($_SESSION['usuarioLogon']))
{
	header("Location:../views/home.php?p=login");
}
$logon = new Logon();
$logon = $_SESSION["usuarioLogon"];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd" >
<html xmlns="http://www.w3.org/1999/xhtml" >

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>SMC - Cadastro de clientes (Pessoa física)</title>
	<meta name="Description" content="SMC - Novo cadastro de Pessoa física" >
	<meta http-equiv="X-UA-Compatible" content="IE=7" > 
	<link rel="stylesheet" href="../css/meucpf.css" type="text/css" media="all" >
	<script type="text/javascript" language="javascript" src="../scripts/full.js" > </script>
	<script type="text/javascript" language="javascript" src="../scripts/jquery.js" > </script>
	<script type="text/javascript" language="javascript" src="../scripts/jquery.MultiFile.js" > </script>
</head>

<body oncontextmenu="return false;" >
<form method="post" action="../../class/RecebePostGet.php" onSubmit="return valida();" >
<input type="hidden" id="idClientes" name="idClientes" value="<?=$logon->getIdClientes()?>"/>
<input type="hidden" id="acao" name="acao" value="alterarVeiculos"/>
<?php 
$veiculos = new Veiculos();
if(isset($_GET['veiculos']))
{
	$veiculos = unserialize(base64_decode($_GET['veiculos']));
}
elseif (isset($_GET['idVeiculosAlterar']) && $_GET['idVeiculosAlterar'] != '')
{
	$veiculos->setIdVeiculos($_GET['idVeiculosAlterar']);
	$collVoAlterar = $controla->findVeiculos($veiculos);
	if(!is_null($collVoAlterar))
	{
		$veiculos = $collVoAlterar[0]; 
	}
}
?>
<input type="hidden" name="idVeiculos" id="idVeiculos" value="<?=$veiculos->getIdVeiculos()?>"/>
<fieldset> <p class="caption" onclick="blocking('geral');" > Informações gerais do Veículo <span class="borda"> </span> </p>
	<div id="geral">
		<div id="left" >
			<p> <label> Placa: </label> <input type="text" name="placa" value="<?=$veiculos->getPlacaVeiculos()?>" onKeyUp="return autoTab(this, 7, event);" maxlength="7" class="placa" /> </p>
			<p> <label> Marca: </label> <input type="text" name="marca" value="<?=$veiculos->getMarcaVeiculos()?>" class="x4 upper" /> </p>
			<p> <label> Modelo: </label> <input type="text" name="modelo" value="<?=$veiculos->getModeloVeiculos()?>" class="x4 upper" /> </p>
			<p> <label> Cor: </label> <input type="text" name="cor" value="<?=$veiculos->getCorVeiculos()?>" class="x4 upper" /> </p>
			<p> <label> Combustível: </label> <input type="text" name="combustivel" value="<?=$veiculos->getCombustivelVeiculos()?>" class="x4 upper" /> </p>
			<p> <label> Capacidade: </label> <input type="text" name="capacidade" value="<?=$veiculos->getCapacidadeTanqueVeiculos()?>" onkeypress="return Onlynumbers(event)" onKeyUp="return autoTab(this, 2, event);" maxlength="2" class="x15" /> </p>
			<p> <label> Ano de Fabricação: </label> <input type="text" name="anofab" value="<?$veiculos->getAnoFabricacaoVeiculos()?>" onkeypress="return mascara(event,this,'####');" onKeyUp="return autoTab(this, 4, event);" maxlength="4" class="x15" /> </p>
		</div>		
		<div id="right" >
			<p> <label> Renavam: </label> <input type="text" name="renavam" value="<?=$veiculos->getRenavamVeiculos()?>" onkeypress="return mascara(event,this,'#########');" onKeyUp="return autoTab(this, 9, event);" maxlength="9" class="x3" /> </p>
			<p> <label> Chassi: </label> <input type="text" name="chassi" value="<?=$veiculos->getChassiVeiculos()?>" onKeyUp="return autoTab(this, 21, event);" maxlength="21" class="x3 upper" /> </p>
			<p> <label> Tipo: </label> <select name="tipo_veiculo" class="x3" >
				<option><?=SELECIONE?> </option>
				<option value="Van" <?=($veiculos->getTipoVeiculos() == "Van") ? "Selected" : ""?>>Van</option>
				<option value="Combi" <?=($veiculos->getTipoVeiculos() == "Combi") ? "Selected" : ""?>>Combi</option>
				<option value="Carro esportivo" <?=($veiculos->getTipoVeiculos() == "Carro esportivo") ? "Selected" : ""?>>Carro esportivo</option>
				<option value="Trator" <?=($veiculos->getTipoVeiculos() == "Trator") ? "Selected" : ""?>>Trator</option>
				<option value="Bitrem" <?=($veiculos->getTipoVeiculos() == "Bitrem") ? "Selected" : ""?>>Bitrem</option>
				<option value="Pickup" <?=($veiculos->getTipoVeiculos() == "Pickup") ? "Selected" : ""?>>Pickup</option>
				<option value="Moto" <?=($veiculos->getTipoVeiculos() == "Moto") ? "Selected" : ""?>>Moto</option>
				<option value="Caminhão" <?=($veiculos->getTipoVeiculos() == "Caminhão") ? "Selected" : ""?>>Caminhão</option>
				<option value="Carreta" <?=($veiculos->getTipoVeiculos() == "Carreta") ? "Selected" : ""?>>Carreta</option>
			</p>
				<p style="height:21px"> </p>
			<p> <label> Código Fipe: </label> <input type="text" value="<?=$veiculos->getCodFipeVeiculos()?>" name="codigo_fipe" onkeypress="return mascara(event,this,'######-#');" onKeyUp="return autoTab(this, 8, event);" maxlength="8" > <label class="obs1">Opcional </label> </p>
		</div>
	</div>
</fieldset>

<fieldset> <p class="caption" onclick="blocking('nf');" > Dados da Nota Fiscal <span class="borda"> </span> </p>
	<div id="nf">
		<div id="left" >
			<p> <label> Fornecedor: </label> <input type="text" value="<?=$veiculos->getFornecedorNfVeiculos()?>" name="fornecedor_nf" class="x9 upper" /> </p>
			<p> <label> Cidade: </label> <input type="text" value="<?=$veiculos->getCidadeNfVeiculos()?>" name="cidade_nf" class="x5 capit" >
				<label class="x0">Estado: </label> 
				<select name="estado_nf" class="x15" >
				<option><?=SELECIONE?></option>
				<option value="MT" <?=($veiculos->getEstadoNfVeiculos()=="MT")?"MT":""?>>MT</option>
				</select>
			</p>
			<p> <label> Proprietário: </label> <input type="text" value="<?=$veiculos->getProprietarioNfVeiculos()?>" name="proprietario_nf" class="x9 nome" /> </p>
			<p> <label> Arrendatário: </label> <input type="text" value="<?=$veiculos->getArrendatarioNfVeiculos()?>" name="arrendatario_nf" class="x9 nome" /> </p>
		</div>
		<div id="right">
			<p> <label> Placa anterior: </label> <input type="text" value="<?=$veiculos->getPlacaNfVeiculos()?>" name="placa_nf" onKeyUp="return autoTab(this, 7, event);" maxlength="7" class="placa" /> </p>
			<p> <label> número da NF: </label> <input type="text" value="<?=$veiculos->getNumeroNfVeiculos()?>" name="numero_nf" class="x3 upper" /> </p>
			<p> <label> Data de aquisição: </label> <input type="text" value="<?=$formataData->toViewDate($veiculos->getDataNfVeiculos())?>" name="data_nf" onkeypress="return mascara(event,this,'##/##/####');return Onlynumbers(event);" onKeyUp="return autoTab(this, 10, event);" maxlength="10" class="x3" /> </p>
			<p> <label> Data da entrega: </label> <input type="text" value="<?=$formataData->toViewDate($veiculos->getDataEntregaNfVeiculos())?>" name="data_entrega_nf" onkeypress="return mascara(event,this,'##/##/####');return Onlynumbers(event);" onKeyUp="return autoTab(this, 10, event);" maxlength="10" class="x3" /> </p>
			<p> <label> KM Entrega: </label> <input type="text" value="<?=$veiculos->getKmEntregaNfVeiculos()?>" name="km_entrega_nf" onkeypress="return mascara(event,this,'###############');" maxlength="15" class="x3" /> </p>
		</div>
	</div>
</fieldset>

<fieldset> <!-- Garantia e Vencimentos -->
	<div id="left" >
		<fieldset> <p class="caption" onclick="blocking('garantia');" > Garantia e manutenção <span class="borda"> </span> </p>
			<div id="garantia">
				<p> <label> Tempo: </label> <input type="text" value="<?=$veiculos->getTempoGarantiaNfVeiculos()?>" name="tempo_garantia" onkeypress="return mascara(event,this,'####');" maxlength="4" class="x2" /> </p>
				<p> <label> KM: </label> <input type="text" value="<?=$veiculos->getKmGarantiaVeiculos()?>" name="km_garantia" maxlength="10" onkeypress="return mascara(event,this,'###############');" class="x2" /> </p>
			</div>
		</fieldset>
	</div>
	<div id="right" >
		<fieldset> <p class="caption" onclick="blocking('vencimentos');" > Vencimentos <span class="borda"> </span> </p>
			<div id="vencimentos">
				<p> <label> IPVA: </label>		<input type="text" name="vencimento_ipva" value="<?=$veiculos->getVencimentoIpvaVeiculos()?>" onkeypress="return mascara(event,this,'##/##/####');return Onlynumbers(event);" onKeyUp="return autoTab(this, 10, event);" maxlength="10" class="x2" /> </p>
				<p> <label> SEGURO: </label>	<input type="text" name="vencimento_seguro" value="<?=$veiculos->getVencimentoSeguroVeiculos()?>" onkeypress="return mascara(event,this,'##/##/####');return Onlynumbers(event);" onKeyUp="return autoTab(this, 10, event);" maxlength="10" class="x2" /> </p>
			</div>
		</fieldset>
	</div>
</fieldset>
<span class="borda"> </span>
<p class="tright">
	<input class="botao" type="reset" value="Limpar campos" >
	<input class="botao" type="submit" name="confveic" value="Confirmar" >
</p>

</form>