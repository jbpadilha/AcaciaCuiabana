<?php
require_once ('../../class/Config.php');
if(!isset($_SESSION['usuarioLogon']))
{
	header("Location:../views/home.php?p=login");
}


$logon = new Logon();
$logon = $_SESSION["usuarioLogon"];

$abastecimentos = new Abastecimentos();
if(isset($_GET['abastecimentos']))
{
	$abastecimentos = unserialize(urldecode($_GET['abastecimentos']));
}
elseif (isset($_GET['idAbastecimentos']) && $_GET['idAbastecimentos'] != '')
{
	$abastecimentos->setIdAbastecimentos($_GET['idAbastecimentos']);
	$collVoAlterar = $controla->findAbastecimentos($abastecimentos);
	if(!is_null($collVoAlterar))
	{
		$abastecimentos =  $collVoAlterar[0];
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd" >
<html xmlns="http://www.w3.org/1999/xhtml" >

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>SMC - Cadastro de Abastecimentos</title>
	<meta name="Description" content="SMC - Cadastro de Abastecimentos" >
	<meta http-equiv="X-UA-Compatible" content="IE=7" > 
	<link rel="stylesheet" href="../css/meucpf.css" type="text/css" media="all" >
	<script type="text/javascript" language="javascript" src="../scripts/full.js" > </script>
	<script type="text/javascript" language="javascript" src="../scripts/jquery.js" > </script>
	<script type="text/javascript" language="javascript" src="../scripts/jquery.MultiFile.js" > </script>
	<script>
	var reqFields = 0;
	
	function checkform(a,b) {
		var target = document.getElementById(b);
		if (reqFields = a) { target.enabled = true; }
	}
	</script>
</head>
<body onload="IrPara('placa');">

<div id="abastece">

	<form name="form1" method="post" action="../../class/ControlaFuncionalidades.php" onsubmit="return validaForm(this)" >
	<input type="hidden" id="acao" name="acao" value="alterarAbastecimento">
	<input type="hidden" id="idAbastecimentos" name="idAbastecimentos" value="<?=$abastecimentos->getIdAbastecimentos()?>">
	<input type="hidden" id="idVeiculos" name="idVeiculos" value="<?=$abastecimentos->getIdVeiculos()?>">
	
	<p class="caption"> Alterar abastecimento </p>
	<fieldset>
			<p> <label class="tright" for="placa">Placa do veículo:</label>
				<?php 
				$veiculos = new Veiculos();
				$veiculos->setIdClientes($logon->getIdClientes());
				$collVoVeiculos = $controla->findVeiculos($veiculos);
				if(!is_null($collVoVeiculos))
				{
					$veiculos = $collVoVeiculos[0];
					echo $veiculos->getPlacaVeiculos();
				}
				?>
			</p>
			<p> <label class="tright" for="data">Data do abastecimento:</label> <input type="text" name="data" id="data" value="<?=$formataData->toViewDate($abastecimentos->getDataAbastecimentos())?>" onfocus="foco('data', 'data foco_on'); SetHelp('idata','(ex: <?=date('d/m/Y')?> )');" onblur="SetHelp('idata',''); checkData('data','data erro','data foco_off ok','Data não deve ser superior a hoje.');" onkeypress="return mascara(event,this,'##/##/####');return Onlynumbers(event);" onKeyUp="return autoTab(this, 10, event);" maxlength="10" class="data" /> <label id="idata" class="hint" ></label> </p>
			<p> <label class="tright" for="km">Kilometragem atual:</label> <input type="text" name="km" id="km" value="<?=$abastecimentos->getKmAbastecimentos()?>" onfocus="foco('km', 'x3 foco_on'); SetHelp('ikm','');" onblur="VerificaKM('km','x3 ok','x3 erro','Km atual não deve ser menor que o anterior'); " onkeypress="return Onlynumbers(event)" class="x3" /> <label id="ikm" class="hint"> </label></p>
			<p> <label class="tright" for="posto">Fornecedor (posto):</label> <input type="text" name="posto" id="posto" value="<?=$abastecimentos->getPostoAbastecimentos()?>" onfocus="foco('posto', 'x8 foco_on');" onblur="foco('posto', 'x8 foco_off');" class="x8" /></p>
			<p> <label class="tright" for="cupom">Nº da nota/cupom fiscal:</label> <input type="text" id="cupom" value="<?=$abastecimentos->getNfAbastecimentos()?>" onfocus="foco('cupom', 'x5 foco_on');" onblur="foco('cupom', 'x5 foco_off');" name="nf"onkeypress="return Onlynumbers(event)" class="x5" /></p>
			<p> <label class="tright" for="combust">Tipo de combustível:</label> <select name="combustivel" id="combust">
				<option><?=SELECIONE?></option>
				<option value="Gasolina" <?=($abastecimentos->getTipoCombustivelAbastecimentos() == "Gasolina")? "selected" : ""?>>Gasolina</option>
				<option value="Álcool" <?=($abastecimentos->getTipoCombustivelAbastecimentos() == "Álcool")? "selected" : ""?>>Álcool</option>
				<option value="Flex" <?=($abastecimentos->getTipoCombustivelAbastecimentos() == "Flex")? "selected" : ""?>>Flex</option>
				<option value="Diesel" <?=($abastecimentos->getTipoCombustivelAbastecimentos() == "Diesel")? "selected" : ""?>>Diesel</option>
			</select> </p>
			<p> <label class="tright" for="valor">Valor unitário (R$):</label> <input type="text" name="valor" value="<?=$abastecimentos->getValorAbastecimentos()?>" id="valor" onfocus="foco('valor', 'x2 foco_on'); SetHelp('ivalor','(ex: 2,0453)')" onblur="foco('valor', 'x2 foco_off'); SetHelp('ivalor','')" onkeypress="return mascara(event,this,'#,####');" maxlength="6" class="x2" /> <label id="ivalor" class="hint" ></label> </p>
			<p> <label class="tright" for="qtd">Quantidade (litros):</label> <input type="text" name="litros" id="qtd" onfocus="foco('qtd', 'x2 foco_on');" value="<?=$abastecimentos->getLitrosAbastecimentos()?>" onblur="foco('qtd', 'x2 foco_off');" onkeypress="return mascara(event,this,'###');" maxlength="3" class="x2" /> </p>
	</fieldset>

		<span class="borda">
		<p class="tright">
			<input type="submit" name="abastece" value="Confirmar">
			<input type="reset" value="Limpar campos" >
		</p>
		</span>
	</form>

</div>

	<script type="text/javascript" language="javascript" src="../scripts/full.js" > </script>
</body>
</html>