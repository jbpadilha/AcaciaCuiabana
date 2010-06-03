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
?>
<form method="post" action="../../class/RecebePostGet.php">

<fieldset>
	<p class="caption">Informações gerais</p>

<div id="geral">
	<div class="left">
		<label>Razão social:<input type="text" name="nome_empresa" value="<?=$empresa->getNomeEmpresa()?>" class="long" /></label>
		<br />
		<label>Nome Fantasia:<input type="text" name="nome_fantasia" value="<?=$empresa->getNomeFantasiaEmpresa()?>" class="long" /></label>
		<br />
		<label>Data da fundação:<input type="text" name="data_fundacao" value="<?=$formataData->toViewDate($empresa->getDataFundacaoEmpresa())?>" maxlength="10" class="data" /></label>
	</div>
	<div class="right">
		<label>CNPJ:<input type="text" name="cnpj" value="<?=$empresa->getCnpjEmpresa()?>" maxlength="18" class="doc" /></label>
		<br />
		<label>Inscrição Estadual:<input type="text" name="insc" value="<?=$empresa->getInscricaoEstadualEmpresa()?>" class="doc" /></label>
		<br />
		<label>Ramo de atividade:<input type="text" name="ramo" value="<?=$empresa->getRamoEmpresa()?>" class="long" /></label>
	</div>
</div>
</fieldset>

<?php
$endereco= new Endereco();
if(isset($_GET['endereco']))
{
	$endereco = (object)unserialize(base64_decode($_GET['endereco']));
}
?>
<fieldset>
	<p class="caption"> Contato</p>
	<div class="left">
		<label>Rua, avenida, logradouro:<input type="text" name="rua" value="<?=$endereco->getRuaEndereco()?>" class="long" /></label>
		<label>Número:<input type="text" name="numero" value="<?=$endereco->getRuaEndereco()?>" class="small" /></label>
		<br />
		<label>Complemento:<input type="text" name="complemento" value="<?=$endereco->getComplementoEndereco()?>" class="long" /></label>
		<br />
		<label>Bairro:<input type="text" name="bairro" value="<?=$endereco->getBairroEndereco()?>" class="long" /></label>
		<label>CEP:<input type="text" name="cep" value="<?=$endereco->getCepEndereco()?>" maxlength="10" class="data" /></label>
		<br />
		<label>Cidade:<input type="text" name="cidade" value="<?=$endereco->getCidadeEndereco()?>" class="long" /></label>
		<label>Estado:
			<select name="estado">
				<option selected></option>
				<option value="MT" <?=($endereco->getEstadoEndereco()==="MT")? "selected":""?>>MT</option>
			</select>
		</label>
	</div>
	<div class="right">
		<label>DDD - Telefone:<input type="text" name="telefone" value="<?=$endereco->getTelefoneEndereco()?>" maxlength="12" class="doc" ></label>
		<br />
		<label>DDD - Celular:<input type="text" name="celular" value="<?=$endereco->getCelEndereco()?>" maxlength="12" class="doc" ></label>
		<br />
		<label>DDD - Fax:<input type="text" name="fax" value="<?=$endereco->getFaxEndereco()?>" maxlength="12" class="doc" ></label>
		<br />
		<label>E-mail:<input type="text" name="email" value="<?=$endereco->getEmailEndereco()?>" class="long" /></label>
	</div>
</fieldset>
<?php
	$pessoa = new Pessoa();

	if(isset($_GET['pessoaDiretor'])) {
		$pessoa = (object)unserialize(base64_decode($_GET['pessoaDiretor']));
	}
?>
<fieldset>
	<p class="caption">Dados do diretor</p>
	<label>Deseja preencher os dados do diretor?
	<select name="preenche">
		<option value="Sim" selected="selected">Sim</option>
		<option value="Não">Não</option>
	</select>
	</label>
	<br />
	<div class="left">
		<label>Nome:<input type="text" name="nome" value="<?=$pessoa->getNomePessoa()?>" class="long" /></label>
		<label>Nascimento:<input type="text" name="dataNascimento" value="<?=$formataData->toViewDate($pessoa->getDataNascimentoPessoa())?>" maxlength="10" class="data" /></label>
		<br />
		<label>Sexo:
			<select name="sexo">
				<option selected></option>
				<option value="M"<?=($pessoa->getSexoPessoa()=="M")?"selected":""?>>Masculino</option>
				<option value="F"<?=($pessoa->getSexoPessoa()=="F")?"selected":""?>>Feminino</option>
			</select>
		</label>
		<label>Estado Civil:
			<select name="estadoCivil">
				<option selected></option>
				<option value="Casado" <?=($pessoa->getEstadoCivilPessoa()==="Casado")?"selected":""?>>Casado(a)</option>
				<option value="Solteiro" <?=($pessoa->getEstadoCivilPessoa()==="Solteiro")?"selected":""?>>Solteiro(a)</option>
				<option value="União Estável" <?=($pessoa->getEstadoCivilPessoa()==="União Estável")?"selected":""?>>União Estável</option>
			</select>
		</label>
	</div>
	<div class="right">
		<label>RG:<input type="text" name="rg" value="<?=$pessoa->getRgPessoa()?>" class="doc" /></label>
		<label>Órgao Exp.:<input type="text" name="rg_orgao" value="<?=$pessoa->getOrgExpPessoa()?>" maxlength="3" class="small" /></label>
		<label>UF:
			<select name="rg_uf">
				<option selected></option>
				<option value="MT" <?=($pessoa->getUfOrgExpPessoa()==="MT")? "selected":""?>>MT</option>
			</select>
		</label>
		<br />
		<label>CPF:<input type="text" name="cpf" value="<?=$pessoa->getCpfPessoa()?>" maxlength="14" class="doc" /></label>
	</div>
	
	<div class="clear"></div>

<?php
	$enderecoDiretor= new Endereco();

	if(isset($_GET['enderecoDiretor'])) {
		$enderecoDiretor = (object)unserialize(base64_decode($_GET['enderecoDiretor']));
	}
?>

	<p class="caption"> Dados de Endereço</p>
	<div class="left">
		<label>Rua, avenida, logradouro:<input type="text" name="ruaDiretor" value="<?=$enderecoDiretor->getRuaEndereco()?>" class="long" /></label>
		<label>Número:<input type="text" name="numeroDiretor" value="<?=$enderecoDiretor->getRuaEndereco()?>" class="small" /></label>
		<br />
		<label>Complemento:<input type="text" name="complementoDiretor" value="<?=$enderecoDiretor->getComplementoEndereco()?>" class="long" /></label>
		<br />
		<label>Bairro:<input type="text" name="bairroDiretor" value="<?=$enderecoDiretor->getBairroEndereco()?>" class="long" /></label>
		<label>CEP:<input type="text" name="cepDiretor" value="<?=$enderecoDiretor->getCepEndereco()?>" maxlength="10" class="data" /></label>
		<br />
		<label>Cidade:<input type="text" name="cidadeDiretor" value="<?=$enderecoDiretor->getCidadeEndereco()?>" class="long" /></label>
		<label>Estado:
			<select name="estadoDiretor">
				<option selected></option>
				<option value="MT" <?=($endereco->getEstadoEndereco()==="MT")? "selected":""?>>MT</option>
			</select>
		</label>
	</div>
	<div class="right">
		<label>DDD - Telefone:<input type="text" name="telefoneDiretor" value="<?=$enderecoDiretor->getTelefoneEndereco()?>" maxlength="12" class="doc" ></label>
		<br />
		<label>DDD - Celular:<input type="text" name="celularDiretor" value="<?=$enderecoDiretor->getCelEndereco()?>" maxlength="12" class="doc" ></label>
		<br />
		<label>DDD - Fax:<input type="text" name="faxDiretor" value="<?=$enderecoDiretor->getFaxEndereco()?>" maxlength="12" class="doc" ></label>
		<br />
		<label>E-mail:<input type="text" name="emailDiretor" value="<?=$enderecoDiretor->getEmailEndereco()?>" class="long" /></label>
	</div>

	<div class="clear"></div>
	
<?php
	$pessoaConjugue = new Pessoa();

	if(isset($_GET['pessoaConjugue'])) {
		$pessoaConjugue = (object) unserialize(base64_decode($_GET['pessoaConjugue']));
	}
?>
	<p class="caption">Dados do(a) cônjuge</p>
	<div class="left">
		<label>Nome:<input type="text" name="nomeConjugue" value="<?=$pessoaConjugue->getNomePessoa()?>" class="long" /></label>
		<label>Nascimento:<input type="text" name="dataNascimentoConjugue" value="<?=$formataData->toViewDate($pessoaConjugue->getDataNascimentoPessoa())?>" maxlength="10" class="data" /></label>
		<br />
		<label>Sexo:
			<select name="sexoConjugue">
				<option selected></option>
				<option value="M"<?=($pessoaConjugue->getSexoPessoa()=="M")?"selected":""?>>Masculino</option>
				<option value="F"<?=($pessoaConjugue->getSexoPessoa()=="F")?"selected":""?>>Feminino</option>
			</select>
		</label>
	</div>
	<div class="right">
		<label>RG:<input type="text" name="rgConjugue" value="<?=$pessoaConjugue->getRgPessoa()?>" class="doc" /></label>
		<label>Órgao Exp.:<input type="text" name="rg_orgaoConjugue" value="<?=$pessoaConjugue->getOrgExpPessoa()?>" maxlength="3" class="small" /></label>
		<label>UF:
			<select name="rg_ufConjugue">
				<option selected></option>
				<option value="MT" <?=($pessoa->getUfOrgExpPessoa()==="MT")? "selected":""?>>MT</option>
			</select>
		</label>
		<br />
		<label>CPF:<input type="text" name="cpfConjugue" value="<?=$pessoaConjugue->getCpfPessoa()?>" maxlength="14" class="doc" />
		</label>
	</div>
</fieldset>

<p class="botoes">
	<input type="hidden" id="acao" name="acao" value="cadastroEmpresa">
	<input type="hidden" id="idCliente" name="idCliente" value="<?=$logon->getIdClientes()?>">
	<input type="reset" value="Limpar campos" name="reset">
	<input type="submit" name="completo2" value="Confirmar" id="name">
</p>

</form>