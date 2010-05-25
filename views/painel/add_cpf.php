<?php
require_once ('../../class/Config.php');
if(!isset($_SESSION['usuarioLogon']))
{
	header("Location:../views/home.php?p=login");
}


$logon = new Logon();
$logon = $_SESSION["usuarioLogon"];

$pessoa = new Pessoa();
if(isset($_GET['pessoa']))
{
	$pessoa = unserialize(urldecode($_GET['pessoa']));
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd" >
<html xmlns="http://www.w3.org/1999/xhtml" >

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>SMC - Cadastro de clientes (Pessoa física)</title>
	<meta name="Description" content="SMC - Novo cadastro de Pessoa Física" >
	<meta http-equiv="X-UA-Compatible" content="IE=7" > 
	<link rel="stylesheet" href="../css/meucpf.css" type="text/css" media="all" >
	<script type="text/javascript" language="javascript" src="../scripts/full.js" > </script>
	<script type="text/javascript" language="javascript" src="../scripts/jquery.js" > </script>
	<script type="text/javascript" language="javascript" src="../scripts/jquery.MultiFile.js" > </script>
	<script type="text/javascript">
	function habilitaConjugue(selecao)
	{
		sty1 = document.getElementById('layerFrm1');
		if (selecao.value == 'Casado(a)' || selecao.value == 'União Estável')
		{ 
			sty1.style.visibility = 'visible';
			sty1.style.display = 'block';
		}
		else
		{ 
			sty1.style.visibility = 'hidden';
			sty1.style.display = 'none';
		}
	}
	</script>
</head>

<body oncontextmenu="return false;" >
<form method="post" action="../../class/RecebePostGet.php" onSubmit="return valida();" >
<input type="hidden" id="acao" name="acao" value="cadastroPessoa">
<input type="hidden" id="idCliente" name="idCliente" value="<?=$logon->getIdClientes()?>">
<fieldset class="cadastro"><p class="caption"> Dados pessoais <span class="borda"></span></p>
	<div id="left">
		<p><label>Nome:</label><input type="text" id="nome" name="nome" value="<?=$pessoa->getNomePessoa()?>" class="nome" onfocus="foco('nome', 'nome foco_on');" onblur="foco('nome', 'nome foco_off');" /></p>
		<p><label>Nascimento:</label><input type="text" name="dataNascimento" id="dataNascimento" value="<?=$formataData->toViewDate($pessoa->getDataNascimentoPessoa())?>" onfocus="foco('dataNascimento', 'data foco_on');" onblur="foco('dataNascimento', 'data foco_off');" onkeypress="return mascara(event,this,'##/##/####');return Onlynumbers(event);" onKeyUp="return autoTab(this, 10, event);" maxlength="10" class="data" /></p>
		<p><label>Sexo:</label>
		<select name="sexo" class="x3" >
			<option selected="selected"><?=SELECIONE?></option>
			<option value="M"<?=($pessoa->getSexoPessoa()=="M")?"selected":""?>>Masculino</option>
			<option value="F"<?=($pessoa->getSexoPessoa()=="F")?"selected":""?>>Feminino</option>
		</select>
		</p>
		<p><label>Estado Civil:</label><select name="estadoCivil" onchange="sty1 = document.getElementById('layerFrm1');if (this.value == 'Casado(a)' || this.value == 'União Estável'){ sty1.style.visibility = 'visible';sty1.style.display = 'block'}else{ sty1.style.visibility = 'hidden';sty1.style.display = 'none'};" class="x3" >
			<option selected="selected"><?=SELECIONE?></option>
			<option value="Casado" <?=($pessoa->getEstadoCivilPessoa()==="Casado")?"selected":""?>>Casado(a)</option>
			<option value="Solteiro" <?=($pessoa->getEstadoCivilPessoa()==="Solteiro")?"selected":""?>>Solteiro(a)</option>
			<option value="União Estável" <?=($pessoa->getEstadoCivilPessoa()==="União Estável")?"selected":""?>>União Estável</option>
		</select></p>
		<p><label></label></p>
	</div>
	<div id="right">
		<p><label>RG:</label><input type="text" name="rg" value="<?=$pessoa->getRgPessoa()?>"onkeypress="return Onlynumbers(event)" class="x3" /></p>
		<p><label>Órgao Exped./UF:</label><input type="text" name="rg_orgao"  value="<?=$pessoa->getOrgExpPessoa()?>"onkeypress="return Onlychars(event);" onKeyUp="return autoTab(this, 3, event);" maxlength="3" class="x1" />
			<label class="x0">- </label>
			<select name="rg_uf" class="x15"> 
				<option selected="selected"><?=SELECIONE?></option>
				<option value="MT" <?=($pessoa->getUfOrgExpPessoa()==="MT")? "selected":""?>>MT</option>
			</select>
		</p>
		<p><label>CPF:</label><input type="text" name="cpf" id="cpf" value="<?=$pessoa->getCpfPessoa()?>" onkeypress="return mascara(event,this,'###.###.###-##');return Onlynumbers(event);" onKeyUp="return autoTab(this, 14, event);" onblur="VerificaCPF('cpf','x3');" maxlength="14" class="x3" /></p>
	</div>
</fieldset>
<?php
$endereco= new Endereco();

if(isset($_GET['endereco']))
{
	$endereco = unserialize(urldecode($_GET['endereco']));
}
?>

<fieldset><p class="caption"> Dados de Endereço <span class="borda"></span></p>
<div id="left">
		<p><label>Rua, avenida, logradouro:</label><input type="text" name="rua"  value="<?=$endereco->getRuaEndereco()?>" class="x9" /></p>
		<p><label>Complemento:</label><input type="text" name="complemento"  value="<?=$endereco->getComplementoEndereco()?>" class="x9" /></p> 
		<p><label>Bairro:</label><input type="text" name="bairro"  value="<?=$endereco->getBairroEndereco()?>" class="x5" /></p>
		<p><label class="x15"> CEP:</label><input type="text" name="cep"  value="<?=$endereco->getCepEndereco()?>" onkeypress="return mascara(event,this,'##.###-###');return Onlynumbers(event);" onKeyUp="return autoTab(this, 10, event);" maxlength="10" class="x2" /></p>
		<p><label>Cidade:</label><input type="text" name="cidade"  value="<?=$endereco->getCidadeEndereco()?>" class="x5" /></p>
		<p><label class="x2">Estado:</label></p>
		<select name="estado" class="x15" > 
			<option selected="selected"><?=SELECIONE?></option>
			<option value="MT" <?=($endereco->getEstadoEndereco()==="MT")? "selected":""?>>MT</option>
		</select>
		<p><label>E-mail:</label><input type="text" name="email"  value="<?=$endereco->getEmailEndereco()?>" class="email" /></p>
</div>
<div id="right">
		<p><label>DDD - Telefone:</label><input type="text" name="telefone" value="<?=$endereco->getTelefoneEndereco()?>" onkeypress="return mascara(event,this,'## ####-####');" 	onKeyUp="return autoTab(this, 15, event);" maxlength="15" class="x2" ></p>
		<p><label>DDD - Celular:</label><input type="text" name="celular" value="<?=$endereco->getCelEndereco()?>" onkeypress="return mascara(event,this,'## ####-####');" 	onKeyUp="return autoTab(this, 15, event);" maxlength="15" class="x2" ></p>
		<p><label>DDD - Fax:</label><input type="text" name="fax" value="<?=$endereco->getFaxEndereco()?>" onkeypress="return mascara(event,this,'## ####-####');" 	onKeyUp="return autoTab(this, 15, event);" maxlength="15" class="x2" ></p>
</div>
</fieldset>
<?php 
$pessoaConjugue = new Pessoa();
if(isset($_GET['pessoaConjugue']))
{
	$pessoaConjugue = (object) unserialize(urldecode($_GET['pessoaConjugue']));
}
?>
<fieldset id="layerFrm1"><p class="caption"> Dados do(a) cônjuge <span class="borda"></span></p>
	<div id="left">
		<p><label>Nome:</label><input type="text" id="nomeConjugue" name="nomeConjugue" value="<?=$pessoaConjugue->getNomePessoa()?>" class="x3" onfocus="foco('nomeConjugue', 'nome foco_on');" onblur="foco('nomeConjugue', 'nome foco_off');" /></p>
		<p><label>Nascimento:</label><input type="text" name="dataNascimentoConjugue" id="dataNascimentoConjugue" value="<?=$formataData->toViewDate($pessoaConjugue->getDataNascimentoPessoa())?>" onfocus="foco('dataNascimentoConjugue', 'data foco_on');" onblur="foco('dataNascimentoConjugue', 'data foco_off');" onkeypress="return mascara(event,this,'##/##/####');return Onlynumbers(event);" onKeyUp="return autoTab(this, 10, event);" maxlength="10" class="data" /></p>
		<p><label>Sexo:</label>
		<select name="sexoConjugue" class="x3" >
			<option selected="selected"><?=SELECIONE?></option>
			<option value="M"<?=($pessoaConjugue->getSexoPessoa()=="M")?"selected":""?>>Masculino</option>
			<option value="F"<?=($pessoaConjugue->getSexoPessoa()=="F")?"selected":""?>>Feminino</option>
		</select>
		</p>
		<p><label></label></p>
	</div>
	<div id="right">
		<p><label>RG:</label><input type="text" name="rgConjugue" value="<?=$pessoaConjugue->getRgPessoa()?>"onkeypress="return Onlynumbers(event)" class="x3" /></p>
		<p>
			<label>Órgao Exped./UF:</label>
			<input type="text" name="rg_orgaoConjugue"  value="<?=$pessoaConjugue->getOrgExpPessoa()?>"onkeypress="return Onlychars(event);" onKeyUp="return autoTab(this, 3, event);" maxlength="3" class="x1" />
			<label class="x0">- </label>
			<select name="rg_ufConjugue" class="x15"> 
				<option selected="selected"><?=SELECIONE?></option>
				<option value="MT" <?=($pessoa->getUfOrgExpPessoa()==="MT")? "selected":""?>>MT</option>
			</select>
		</p>
		<p><label>CPF:</label><input type="text" name="cpfConjugue" id="cpfConjugue" value="<?=$pessoaConjugue->getCpfPessoa()?>" onkeypress="return mascara(event,this,'###.###.###-##');return Onlynumbers(event);" onKeyUp="return autoTab(this, 14, event);" onblur="VerificaCPF('cpf','x3');" maxlength="14" class="x3" /></p>
	</div>
</fieldset>
<span class="borda"></span>
<p class="tright">
	<input class="botao" type="reset" value="Limpar campos" >
	<input class="botao" name="completo" type="submit" value="Confirmar" >
</p>
</form>
<script type="text/javascript" language="javascript" src="../scripts/full.js" ></script>
</body>
</html>