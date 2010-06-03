<?php
require_once ('../../class/Config.php');
if(!isset($_SESSION['usuarioLogon']))
{
	header("Location:../views/home.php?p=login");
}


$logon = new Logon();
$logon = $_SESSION["usuarioLogon"];

$empresa = new Empresas();

if(isset($_GET['empresas']))
{
	$empresa = (object)unserialize(base64_decode($_GET['empresas']));
}
elseif (isset($_GET['idEmpresaAlterar']) && $_GET['idEmpresaAlterar'] != '')
{
	$empresa->setIdEmpresa($_GET['idEmpresaAlterar']);
	$collVoAlterar = $controla->findEmpresas($empresa);
	if(!is_null($collVoAlterar))
	{
		$empresa = $collVoAlterar[0]; 
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="../css/meucpf.css" type="text/css" media="all" >
<script type="text/javascript" language="javascript" src="../scripts/full.js" > </script>
<script type="text/javascript" language="javascript" src="../cidades.js" > </script>
</head>
<body>
<form method="post" action="../../class/RecebePostGet.php" onsubmit="return validaForm(this)">
<input type="hidden" id="acao" name="acao" value="alterarEmpresa">
<input type="hidden" id="idCliente" name="idCliente" value="<?=$logon->getIdClientes()?>">
<input type="hidden" id="idEmpresa" name="idEmpresa" value="<?=$empresa->getIdEmpresa()?>">
<fieldset> 
<p class="caption" onclick="blocking('geral');" > Informações gerais <span class="borda"> </span> </p>

<div id="geral">
	<div id="left">
		<p> <label>Razão social: </label> <input type="text" name="nome_empresa" class="x9" value="<?=$empresa->getNomeEmpresa()?>" /> </p>
		<p> <label>Nome Fantasia: </label> <input type="text" name="nome_fantasia" class="x9" value="<?=$empresa->getNomeFantasiaEmpresa()?>" /> </p>
		<p> <label>Data de Fundação: </label> <input type="text" name="data_fundacao" value="<?=$formataData->toViewDate($empresa->getDataFundacaoEmpresa())?>" onkeypress="return mascara(event,this,'##/##/####');" onKeyUp="return autoTab(this, 10, event);" maxlength="10" class="x2" /> </p>
	</div>
	<div id="right">
		<p> <label>CNPJ: </label> <input type="text" name="cnpj" value="<?=$empresa->getCnpjEmpresa()?>" onkeypress="return mascara(event,this,'##.###.###/####-##');" onKeyUp="return autoTab(this, 18, event);" maxlength="18" /> </p>
		<p> <label>Inscrição Estadual: </label> <input type="text" name="insc" value="<?=$empresa->getInscricaoEstadualEmpresa()?>" /> </p>
		<p> <label>Ramo de atividade: </label>  <input type="text"  name="ramo" class="x3" value="<?=$empresa->getRamoEmpresa()?>" ></p>
		<p> <label>Origem: </label> 
		<select name="origem" class="x3" id="origem">
			<option><?=SELECIONE?></option>
			<option value="Nacional" <?=($empresa->getOrigemEmpresa()=="Nacional" ? "selected" : "")?>>Nacional</option>
			<option value="Internacional" <?=($empresa->getOrigemEmpresa()=="Internacional" ? "selected" : "")?>>Internacional</option>
		</select> 
		</p>
	</div>
</div>
</fieldset>

<?php
$endereco= new Endereco();
if(isset($_GET['endereco']))
{
	$endereco = (object)unserialize(base64_decode($_GET['endereco']));
}
elseif (isset($_GET['idEmpresaAlterar']) && $_GET['idEmpresaAlterar'] != '')
{
	$endereco->setIdEmpresa($_GET['idEmpresaAlterar']);
	$collVoAlterarEnd = $controla->findEndereco($endereco);
	if(!is_null($collVoAlterarEnd))
		$endereco = $collVoAlterarEnd[0]; 
}
?>
<input type="hidden" id="idEndereco" name="idEndereco" value="<?=$endereco->getIdEndereco()?>">
<fieldset> <p class="caption" onclick="blocking('contato');" > Contato <span class="borda"> </span> </p>
<div id="contato">
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
			<p><label>DDD - Telefone:</label><input type="text" name="telefone" value="<?=$endereco->getTelefoneEndereco()?>" onkeypress="return mascara(event,this,'## ####-####');" onKeyUp="return autoTab(this, 12, event);" maxlength="12" class="x2" ></p>
			<p><label>DDD - Celular:</label><input type="text" name="celular" value="<?=$endereco->getCelEndereco()?>" onkeypress="return mascara(event,this,'## ####-####');" 	onKeyUp="return autoTab(this, 12, event);" maxlength="12" class="x2" ></p>
			<p><label>DDD - Fax:</label><input type="text" name="fax" value="<?=$endereco->getFaxEndereco()?>" onkeypress="return mascara(event,this,'## ####-####');" 	onKeyUp="return autoTab(this, 12, event);" maxlength="12" class="x2" ></p>
	</div>
</div>
</fieldset>
<?php 
$pessoa = new Pessoa();
if(isset($_GET['pessoaDiretor']))
{
	$pessoa = (object)unserialize(base64_decode($_GET['pessoaDiretor']));
}
elseif (isset($_GET['idEmpresaAlterar']) && $_GET['idEmpresaAlterar'] != '')
{
	$pessoa->setIdPessoa($empresa->getIdDiretor());
	$collVoAlterarPessoaConju = $controla->findPessoas($pessoa);
	if(!is_null($collVoAlterarPessoaConju))
		$pessoa = $collVoAlterarPessoaConju[0]; 
}
?>
<input type="hidden" id="idDiretor" name="idDiretor" value="<?=$pessoa->getIdPessoa()?>">
<fieldset> <p class="caption" onclick="blocking('diretor');" > Dados do diretor <span class="borda"> </span> </p>
	<p>
		<label class="x0" >Deseja preencher os dados do diretor? </label>
		<select name="preenche" onchange="sty6 = document.getElementById('layerFrm6'); if (this.value == 'Sim') { sty6.style.display = 'block'; IrPara('nome_diretor'); } else { sty6.style.display = 'none'; sty5.style.display = 'none'; };" >
			<option> </option>
			<option value="Sim">Sim</option>
			<option value="Não">Não</option>
		</select>
	</p>
	<div id="layerFrm6">
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
	<div id="clear"> </div>
<?php 

$enderecoDiretor= new Endereco();
if(isset($_GET['enderecoDiretor']))
{
	$enderecoDiretor = (object)unserialize(base64_decode($_GET['enderecoDiretor']));
}
elseif ($pessoa->getIdPessoa() != null)
{
	$enderecoDiretor->setIdPessoa($pessoa->getIdPessoa());
	$collVoAlterarEndDir = $controla->findEndereco($enderecoDiretor);
	if(!is_null($collVoAlterarEndDir))
		$enderecoDiretor = $collVoAlterarEndDir[0]; 
}
?>		
<input type="hidden" id="idEnderecoDiretor" name="idEnderecoDiretor" value="<?=$enderecoDiretor->getIdEndereco()?>">		
	<p class="caption"> Dados de Endereço <span class="borda"></span></p>
	<div id="left">
		<p><label>Rua, avenida, logradouro:</label><input type="text" name="ruaDiretor"  value="<?=$enderecoDiretor->getRuaEndereco()?>" class="x9" /></p>
		<p><label>Complemento:</label><input type="text" name="complementoDiretor"  value="<?=$enderecoDiretor->getComplementoEndereco()?>" class="x9" /></p> 
		<p><label>Bairro:</label><input type="text" name="bairroDiretor"  value="<?=$enderecoDiretor->getBairroEndereco()?>" class="x5" /></p>
		<p><label class="x15"> CEP:</label><input type="text" name="cepDiretor"  value="<?=$enderecoDiretor->getCepEndereco()?>" onkeypress="return mascara(event,this,'##.###-###');return Onlynumbers(event);" onKeyUp="return autoTab(this, 10, event);" maxlength="10" class="x2" /></p>
		<p><label>Cidade:</label><input type="text" name="cidadeDiretor"  value="<?=$enderecoDiretor->getCidadeEndereco()?>" class="x5" /></p>
		<p><label class="x2">Estado:</label></p>
		<select name="estadoDiretor" class="x15" > 
			<option selected="selected"><?=SELECIONE?></option>
			<option value="MT" <?=($endereco->getEstadoEndereco()==="MT")? "selected":""?>>MT</option>
		</select>
		<p><label>E-mail:</label><input type="text" name="emailDiretor"  value="<?=$enderecoDiretor->getEmailEndereco()?>" class="email" /></p>
	</div>
	<div id="right">
			<p><label>DDD - Telefone:</label><input type="text" name="telefoneDiretor" value="<?=$enderecoDiretor->getTelefoneEndereco()?>" onkeypress="return mascara(event,this,'## ####-####');" 	onKeyUp="return autoTab(this, 12, event);" maxlength="12" class="x2" ></p>
			<p><label>DDD - Celular:</label><input type="text" name="celularDiretor" value="<?=$enderecoDiretor->getCelEndereco()?>" onkeypress="return mascara(event,this,'## ####-####');" 	onKeyUp="return autoTab(this, 12, event);" maxlength="12" class="x2" ></p>
			<p><label>DDD - Fax:</label><input type="text" name="faxDiretor" value="<?=$enderecoDiretor->getFaxEndereco()?>" onkeypress="return mascara(event,this,'## ####-####');" 	onKeyUp="return autoTab(this, 12, event);" maxlength="12" class="x2" ></p>
	</div>

	<div id="clear"> </div>
	<?php 
	$pessoaConjugue = new Pessoa();
	$enderecoConjugueDiretor = new Endereco();
	if(isset($_GET['pessoaConjugue']))
	{
		$pessoaConjugue = (object) unserialize(base64_decode($_GET['pessoaConjugue']));
	}
	elseif ($pessoa->getIdConjuguePessoa() != null)
	{
		$pessoaConjugue->setIdPessoa($pessoa->getIdConjuguePessoa());
		$collVoAlterarConjugueDir = $controla->findPessoas($pessoaConjugue);
		if(!is_null($collVoAlterarConjugueDir))
		{
			$pessoaConjugue = $collVoAlterarConjugueDir[0];
			$enderecoConjugueDiretor->setIdPessoa($pessoaConjugue->getIdPessoa());
		} 
	}
	?>
	<input type="hidden" id="idConjugueDiretor" name="idConjugueDiretor" value="<?=$pessoaConjugue->getIdPessoa()?>">
	<input type="hidden" id="idEnderecoConjugueDiretor" name="idEnderecoConjugueDiretor" value="<?=$enderecoConjugueDiretor->getIdEndereco()?>">
	<div id="layerFrm1" > <p class="caption" onclick="blocking('conjuge');" > Dados do(a) cônjuge <span class="borda"> </span> </p>
		<div id="conjuge">
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
		</div>
	</div>
	</div>
</fieldset>

<span class="borda"> </span>
<p class="tright">
	<input type="reset" value="Limpar campos" name="reset">
	<input type="submit" name="completo2" value="Confirmar" id="name">
</p>
</form>
</body>
</html>