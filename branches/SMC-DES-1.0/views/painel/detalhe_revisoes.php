<?php
require_once ('../../class/Config.php');
if(!isset($_SESSION['usuarioLogon']))
{
	header("Location:../views/home.php?p=login");
}


$logon = new Logon();
$logon = $_SESSION["usuarioLogon"];

$revisoes = new Revisoes();
if(isset($_GET['revisoes']))
{
	$revisoes = unserialize(base64_decode($_GET['revisoes']));
}
elseif (isset($_GET['idRevisoesAlterar']) && $_GET['idRevisoesAlterar'] != '')
{
	$revisoes->setIdRevisoes($_GET['idRevisoesAlterar']);
	$collVoAlterar = $controla->findRevisoes($revisoes);
	if(!is_null($collVoAlterar))
	{
		$revisoes =  $collVoAlterar[0];
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd" >
<html xmlns="http://www.w3.org/1999/xhtml" >

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>SMC - Cadastro de clientes (Pessoa física)</title>
	<meta name="Description" content="SMC - Nova Revisão" >
	<meta http-equiv="X-UA-Compatible" content="IE=7" > 
	<link rel="stylesheet" href="../css/meucpf.css" type="text/css" media="all" >
	<script type="text/javascript" language="javascript" src="../scripts/full.js" > </script>
	<script type="text/javascript" language="javascript" src="../scripts/jquery.js" > </script>
	<script type="text/javascript" language="javascript" src="../scripts/jquery.MultiFile.js" > </script>
</head>
<body onload="getInput();">

<div id="form">
	<form name="form_get" method="post" action="../../class/RecebePostGet.php" >
		<input type="hidden" id="acao" name="acao" value="alterarRevisoes">
		<input type="hidden" id="idRevisoes" name="idRevisoes" value="<?=$revisoes->getIdRevisoes()?>">
		<input type="hidden" id="idTipoRevisoes" name="idTipoRevisoes" value="<?=$revisoes->getIdTipoRevisoes()?>">
		<input type="hidden" id="idVeiculos" name="idVeiculos" value="<?=$revisoes->getIdVeiculos()?>">
		
		<p class="caption"> ALTERAÇÃO DE REVISÕES </p>
		<p><span class="esq">
			<label class="x5 tright" for="get_placa">Veículo (placa):</label>
			<?php 
			$veiculos = new Veiculos();
			$veiculos->setIdVeiculos($revisoes->getIdVeiculos());
			$collVoVeiculos = $controla->findVeiculos($veiculos);
			if(!is_null($collVoVeiculos))
			{
				$veiculos = $collVoVeiculos[0];
				echo $veiculos->getPlacaVeiculos();
			}
			?>
			</span>
		</p>
		<p><span class="box">
		  <label for="tult">		<b>Última revisão</b> - realizada no dia</label>
		  <input type="text" name="tult" id="tult" class="x3 tcenter" onkeypress="return mascara(event,this,'##/##/####');" maxlength="10" value="<?=$formataData->toViewDate($revisoes->getDataRevisoes())?>" >
		  
		  <label for="kult">, marcando</label>
		  <input type="text" name="kult" id="kult" class="x2 km tcenter" onkeypress="return Onlynumbers(event);" value="<?=$revisoes->getKmRevisoes()?>" ><label for="kprox">kilômetros.</label> 
	    </span>
	  </p>

		<p id="add_rev_padrao">
			<span id="linha" class="linha">
		<label class="x5 tright" for="revisao">Descrição do serviço:</label>
				<?=$revisoes->getTipoRevisoes()?><br/><br/>
				<span class="left">
					<label for="tprox"><b>Próximas revisões</b> - a cada</label>
					<input type="text" name="tprox" id="tprox" class="x1 tcenter" maxlength="10" value="<?=$formataData->toViewDate($revisoes->getProxDataRevisoes())?>" />
					
					<label for="tprox">meses ou</label> 
					<input type="text" name="kprox" id="kprox" class="x2 km tcenter" value="<?=$revisoes->getProxKmRevisoes()?>" /><label for="kprox">kilômetros.</label> 
				</span>
			</span>
		</p>

		<span class="borda">
			<p class="tright"> <input type="submit" name="revpad" value="Concluir" > </p>
		</span>
	</form>
	</div>
</div>

</div>

<script>
var target = document.getElementById('add_rev_padrao');
var conteudo = target.innerHTML;

function newRev() { target.innerHTML += conteudo; }

function delRev() {
 var d = document.getElementById('add_rev_padrao');
 var olddiv = document.getElementById('linha');
 d.removeChild(olddiv);
}
</script>

</body>