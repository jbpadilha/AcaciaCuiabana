<?php
require_once ('../../class/Config.php');
if(!isset($_SESSION['usuarioLogon']))
{
	header("Location:../views/home.php?p=login");
}
$logon = new Logon();
$logon = $_SESSION["usuarioLogon"];

$pessoa = new Pessoa();
if(!is_null($logon->getIdPessoa()))
{
	$pessoa->setIdPessoa($logon->getIdPessoa());
	
	$collVoPessoa = $controla->findPessoas($pessoa);
	if(!is_null($collVoPessoa))
	{
		$pessoa = $collVoPessoa[0];
	}
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

<form method="POST" action="../../class/ControlaFuncionalidades.php" onsubmit="return validaForm(this)">	
	<input type="hidden" id="idPessoa" name="idPessoa" value="<?=$pessoa->getIdPessoa()?>"/>
	<fieldset> <p class="caption"> Dados pessoais <span class="borda"> </span> </p>
		<div id="left">
				<p> <label>Nome: 					</label> <input type="text" name="nome_cliente" value="<?=$pessoa->getNomePessoa()?>" class="nome" />
			</p><p> <label>Nascimento: 				</label> <input type="text" name="nascimento_cliente" value="<?=$formataData->toViewDate($pessoa->getDataNascimentoPessoa())?>" onkeypress="return mascara(event,this,'##/##/####');return Onlynumbers(event);" onKeyUp="return autoTab(this, 10, event);" maxlength="10" class="data" />
			</p><p> <label>Sexo: 					</label> 
			<select name="sexo_cliente" class="x3" >
				<option selected="selected"><?=SELECIONE?></option>
				<option value="M"<?=($pessoa->getSexoPessoa()=="M")?"selected":""?>>Masculino</option>
				<option value="F"<?=($pessoa->getSexoPessoa()=="F")?"selected":""?>>Feminino</option>
			</select>
			</p><p> <label>Estado Civil: 			</label> 
			<select name="ecivil_cliente" onchange="habilitaConjugue(this);" class="x3" >
				<option selected="selected"><?=SELECIONE?></option>
				<option value="Casado" <?=($pessoa->getEstadoCivilPessoa()==="Casado")?"selected":""?>>Casado(a)</option>
				<option value="Solteiro" <?=($pessoa->getEstadoCivilPessoa()==="Solteiro")?"selected":""?>>Solteiro(a)</option>
				<option value="União Estável" <?=($pessoa->getEstadoCivilPessoa()==="União Estável")?"selected":""?>>União Estável</option>
			</select>
			</p><p> <label>Observações: 			</label> <input type="text" name="nota" class="x9" value="<?=$pessoa->getComplementoPessoa()?>" />
			</p>
		</div>
		<div id="right">
				<p> <label>RG: 						</label> <input type="text" name="rg_cliente" value="<?=$pessoa->getRgPessoa()?>"		onkeypress="return Onlynumbers(event)" class="x3" />
			</p><p> <label>Órgao Exped./UF: 		</label> <input type="text" name="orgexprg_cliente" value="<?=$pessoa->getOrgExpPessoa()?>" onkeypress="return Onlychars(event);" onKeyUp="return autoTab(this, 3, event);" maxlength="3" class="x1" />
			<label class="x0">- 					</label> 
			<select name="ufexprg_cliente" class="x1" >  
				<option selected="selected"><?=SELECIONE?></option>
				<option value="MT" <?=($pessoa->getUfOrgExpPessoa()==="MT")? "selected":""?>>MT</option>
			</select></p>
			<p> <label>CPF: 					</label> <input type="text" name="cpf_cliente" value="<?=$pessoa->getCpfPessoa()?>"	onkeypress="return mascara(event,this,'###.###.###-##');return Onlynumbers(event);" onKeyUp="return autoTab(this, 14, event);" maxlength="14" class="x3" />
			</p>
		</div>
	</fieldset>
<?php
$endereco= new Endereco();
if(!is_null($pessoa->getIdPessoa()))
{
	$endereco->setIdPessoa($pessoa->getIdPessoa());
	$collVoEnd = $controla->findEndereco($endereco);
	if(!is_null($collVoEnd))
	{
		$endereco = $collVoEnd[0]; 
	}
}
?>
	<input type="hidden" id="idEndereco" name="idEndereco" value="<?=$endereco->getIdEndereco()?>"/>
	<fieldset> <p class="caption"> Contato <span class="borda"> </span> </p>
	<div id="left">
			<p> <label>Rua, avenida, logradouro: 	</label> <input type="text" name="rua_contato" class="x9" value="<?=$endereco->getRuaEndereco()?>" /></p>
			<p> <label>Complemento: 				</label> <input type="text" name="complemento_contato" class="x9" value="<?=$endereco->getComplementoEndereco()?>" /></p>
			<p> <label>Bairro: 						</label> <input type="text" name="bairro_contato" class="x9" value""<?=$endereco->getBairroEndereco()?> /></p>
			<p> <label>CEP: 						</label> <input type="text" name="cep_contato" value="<?=$endereco->getCepEndereco()?>" onkeypress="return mascara(event,this,'##.###-###');return Onlynumbers(event);" onKeyUp="return autoTab(this, 10, event);" maxlength="10" class="x2" /></p>
			<p> <label>Cidade: 						</label> <input type="text" name="cidade_contato" class="x5" value="<?=$endereco->getCidadeEndereco()?>"/></label> 
				<select name="estado_contato" class="x1" >
				<option selected="selected"><?=SELECIONE?></option>
				<option value="MT" <?=($endereco->getEstadoEndereco()==="MT")? "selected":""?>>MT</option>
				</select>
			</p>
			<p><label>E-mail: 					</label> <input type="text" name="email_contato" value="<?=$endereco->getEmailEndereco()?>" class="email" /></p>
	</div>
	<div id="right">
			<p> <label>DDD - Telefone: 			</label> <input type="text" name="tel_contato" value="<?=$endereco->getTelefoneEndereco()?>"		onkeypress="return mascara(event,this,'(##) ####-####');" 	onKeyUp="return autoTab(this, 9, event);" maxlength="9" class="x2" ></p>
			<p> <label>DDD - Celular: 			</label> <input type="text" name="cel_contato" 	value="<?=$endereco->getCelEndereco()?>"	onkeypress="return mascara(event,this,'(##) ####-####');" 	onKeyUp="return autoTab(this, 9, event);" maxlength="9" class="x2" ></p>
			<p> <label>DDD - Fax: 				</label> <input type="text" name="fax_contato" value="<?=$endereco->getFaxEndereco()?>"		onkeypress="return mascara(event,this,'(##) ####-####');" 	onKeyUp="return autoTab(this, 9, event);" maxlength="9" class="x2" ></p>
	</div>
	</fieldset>
<?php 
$pessoaConjugue = new Pessoa();
if($pessoa->getIdConjuguePessoa() != null)
{
	$pessoaConjugue->setIdPessoa($pessoa->getIdConjuguePessoa());
	$collVoConjugue = $controla->findPessoas($pessoaConjugue);
	if(!is_null($collVoConjugue))
	{
		$pessoaConjugue = $collVoConjugue[0];
	}
}
?>
	<input type="hidden" id="idConjugue" name="idConjugue" value="<?=$pessoaConjugue->getIdPessoa()?>"/>
	<fieldset id="layerFrm1">  
		<p class="caption"> Dados do(a) cônjuge <span class="borda"> </span> </p>
		<div id="left">
				<p> <label>Nome: 					</label> <input type="text" name="nome_conjuge" class="nome" value="<?=$pessoaConjugue->getNomePessoa()?>" /></p>
		</div>
		<div id="right">
				<p> <label>Nascimento: 				</label> <input type="text" name="nasc_conjuge" onkeypress="return mascara(event,this,'##/##/####');return Onlynumbers(event);" onKeyUp="return autoTab(this, 10, event);" maxlength="10" class="x2" value="<?=$formataData->toViewDate($pessoaConjugue->getDataNascimentoPessoa())?>" /></p>
				<p> <label>Sexo: 					</label> 
				<select name="sexo_conjuge" class="x3" >
					<option selected="selected"><?=SELECIONE?></option>
					<option value="M"<?=($pessoaConjugue->getSexoPessoa()=="M")?"selected":""?>>Masculino</option>
					<option value="F"<?=($pessoaConjugue->getSexoPessoa()=="F")?"selected":""?>>Feminino</option>
				</select>
			</p>
		</div>
	</fieldset>
	<?php 
	if($pessoaConjugue->getIdPessoa() != null)
	{
		echo '<script>document.layerFrm1.style = "display:block"</script>';
	}
	?>
	<span class="borda"> </span>
	<p class="tright">
		<input type="submit" name="completo" value="Confirmar" >
		<input type="reset" value="Limpar campos" >
		<input type="hidden" id="acao" name="acao" value="cadastraMeuCpf" >
	</p>
</form>

</body>
</html>