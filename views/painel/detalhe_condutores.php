<?php
require_once ('../../class/Config.php');
if(!isset($_SESSION['usuarioLogon']))
{
	header("Location:../views/home.php?p=login");
}


$logon = new Logon();
$logon = $_SESSION["usuarioLogon"];

$condutores = new Condutores();
$cnh = new Cnh();
if(isset($_GET['condutores']))
{
	$condutores = unserialize(base64_decode($_GET['condutores']));
}
elseif (isset($_GET['idCondutorAlterar']) && $_GET['idCondutorAlterar'] != '')
{
	$condutores->setIdCondutores($_GET['idCondutorAlterar']);
	$collVoAlterar = $controla->findCondutores($condutores);
	if(!is_null($collVoAlterar))
	{
		$condutores = $collVoAlterar[0];
		$cnh->setIdCnh($condutores->getIdCnh());
		$collVoCnh = $controla->findCnh($cnh);
		$cnh = $collVoCnh[0]; 
	}
}
if(isset($_GET['cnh']))
{
	$cnh = unserialize(base64_decode($_GET['cnh']));
}
?>

<link rel="stylesheet" href="../css/default.css" type="text/css" media="all">

<form method="POST" action="../../class/RecebePostGet.php" onsubmit="return validaForm(this)" >
<input type="hidden" id="acao" name="acao" value="alterarCondutores">
<input type="hidden" id="idCliente" name="idCliente" value="<?=$logon->getIdClientes()?>">
<input type="hidden" id="idCondutor" name="idCondutor" value="<?=$condutores->getIdCondutores()?>">
<input type="hidden" id="idCnh" name="idCnh" value="<?=$condutores->getIdCnh()?>">
<input type="hidden" id="idPessoa" name="idPessoa" value="<?=$condutores->getIdPessoa()?>">
<fieldset> 
<p class="caption">Nome do Condutor <span class="borda"> </span> </p>
<div align="center">
<div id="right" align="left">
	<p>
		<label>Nome: </label>
			<?php 
			$pessoas = new Pessoa();
			$pessoas->setIdPessoa($condutores->getIdPessoa());
			$collVoPessoa = $controla->findPessoas($pessoas);
			$pessoas = $collVoPessoa[0];
			echo $pessoas->getNomePessoa();
			?>
	</p>
    <p> <label>Nº CNH - UF:</label> 
    <input type="text" name="cnh" value="<?=$cnh->getNumeroCnh()?>"	onkeypress="return Onlynumbers(event)" onKeyUp="return autoTab(this, 11, event);" maxlength="12" class="x3" />
	<label class="x0">-						</label> 
	<select name="cnhuf"  class="x15" />
		<option><?=SELECIONE?></option>
		<option value="MT" <?=($cnh->getUfCnh()==="MT")? "selected":""?>>MT</option>
	</select>
	</p><p> <label>Categoria CNH:</label> <input type="text" name="cnhcat" 	maxlength="2" class="x1" value="<?=$cnh->getCategoriaCnh()?>" />
	</p><p> <label>Vencimento CNH:</label> <input type="text" name="cnhvcto" value="<?=$formataData->toViewDate($cnh->getVencCnh())?>" 	onkeypress="return mascara(event,this,'##/##/####');" maxlength="10" class="x2" />
	</p>
</div>
</fieldset>
<span class="borda"> </span>
<p class="tright">
	<input name="completo" type="submit" value="Confirmar" >
	<input type="reset" value="Limpar campos" >
</p>
</div>
</form>