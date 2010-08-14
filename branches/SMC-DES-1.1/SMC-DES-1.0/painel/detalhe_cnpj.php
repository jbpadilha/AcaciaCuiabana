<?php
	require_once ('../class/Config.php');
	if(!isset($_SESSION['usuarioLogon'])) {
		header("Location:../views/home.php?p=login");
	}

	$logon = new Logon();
	$logon = $_SESSION["usuarioLogon"];

	$empresa = new Empresas();

	if (isset($_GET['idEmpresaAlterar']) && $_GET['idEmpresaAlterar'] != '') {
		if(isset($_SESSION['empresaAtual']))
			unset($_SESSION['empresaAtual']);
		$empresa->setIdEmpresa($_GET['idEmpresaAlterar']);
		$collVoAlterar = $controla->findEmpresas($empresa);
		if(!is_null($collVoAlterar)) {
			$empresa = $collVoAlterar[0];
		}
	} elseif(isset($_SESSION['empresaAtual'])) {
		$empresa = $_SESSION['empresaAtual'];
	}
?>
<form method="post" action="../class/RecebePostGet.php">

<div class="botoes">
	<input type="hidden" id="acao" name="acao" value="alterarEmpresa">
	<input type="hidden" id="idCliente" name="idCliente" value="<?php echo $logon->getIdClientes(); ?>">
	<input type="hidden" id="idEmpresa" name="idEmpresa" value="<?php echo $empresa->getIdEmpresa(); ?>">
	<input type="reset" value="Limpar campos" name="reset">
	<input type="submit" name="completo2" value="Confirmar" id="name">
</div>

<p class="caption">Informações Gerais</p>
<fieldset>
	<div class="left">
		<label>Razão social:<input type="text" name="nome_empresa" value="<?php echo $empresa->getNomeEmpresa(); ?>" class="nome" /></label>
		<label>Data de Fundação:<input type="text" name="data_fundacao" value="<?php echo $formataData->toViewDate($empresa->getDataFundacaoEmpresa())?>" maxlength="10" class="data" /></label>
		<br />
		<label>Nome Fantasia:<input type="text" name="nome_fantasia" value="<?php echo $empresa->getNomeFantasiaEmpresa(); ?>" class="long" /></label>
	</div>
	<div class="right">
		<label>CNPJ:<input type="text" name="cnpj" value="<?php echo $empresa->getCnpjEmpresa(); ?>" maxlength="18" class="docCNPJ" /></label>
		<label>Inscrição Estadual:<input type="text" name="insc" value="<?php echo $empresa->getInscricaoEstadualEmpresa(); ?>" /></label>
		<br />
		<label>Ramo de atividade:<input type="text" name="ramo" class="x3" value="<?php echo $empresa->getRamoEmpresa(); ?>" ></label>
		<label>Origem:
			<select name="origem" class="x3" id="origem">
				<option></option>
				<option value="Nacional" <?php echo ($empresa->getOrigemEmpresa()=="Nacional" ? "selected" : "")?>>Nacional</option>
				<option value="Internacional" <?php echo ($empresa->getOrigemEmpresa()=="Internacional" ? "selected" : "")?>>Internacional</option>
			</select>
		</label>
	</div>
</fieldset>

<?php
$endereco= new Endereco();
if (isset($_GET['idEmpresaAlterar']) && $_GET['idEmpresaAlterar'] != '')
{
	if(isset($_SESSION['enderecoAtual']))
		unset($_SESSION['enderecoAtual']);
	$endereco->setIdEmpresa($_GET['idEmpresaAlterar']);
	$collVoAlterarEnd = $controla->findEndereco($endereco);
	if(!is_null($collVoAlterarEnd))
		$endereco = $collVoAlterarEnd[0];
}
elseif(isset($_SESSION['enderecoAtual']))
{
	$endereco = $_SESSION['enderecoAtual'];
}
?>
<input type="hidden" id="idEndereco" name="idEndereco" value="<?php echo $endereco->getIdEndereco(); ?>">

<p class="caption">Contato</p>
<fieldset>
	<div class="left">
		<label>Rua, avenida, logradouro:<input type="text" name="rua" value="<?php echo $endereco->getRuaEndereco(); ?>" class="long" /></label>
		<br />
		<label>Complemento:<input type="text" name="complemento" value="<?php echo $endereco->getComplementoEndereco(); ?>" class="long" /></label>
		<br />
		<label>Bairro:<input type="text" name="bairro" value="<?php echo $endereco->getBairroEndereco(); ?>" class="long" /></label>
		<label>CEP:<input type="text" name="cep" value="<?php echo $endereco->getCepEndereco(); ?>" maxlength="10" class="CEP" /></label>
		<br />
		<label>Cidade:<input type="text" name="cidade" value="<?php echo $endereco->getCidadeEndereco(); ?>" class="long" /></label>
		<label>Estado:
			<select name="estado" class="x15" >
				<option></option>
				<option value="MT" <?php echo ($endereco->getEstadoEndereco()==="MT")? "selected":""?>>MT</option>
			</select>
		</label>
		<br />
	</div>
	<div class="right">
		<label>DDD - Telefone:<input type="text" name="telefone" value="<?php echo $endereco->getTelefoneEndereco(); ?>" maxlength="14" class="fone" ></label>
		<br />
		<label>DDD - Celular:<input type="text" name="celular" value="<?php echo $endereco->getCelEndereco(); ?>" maxlength="14" class="fone" ></label>
		<br />
		<label>DDD - Fax:<input type="text" name="fax" value="<?php echo $endereco->getFaxEndereco(); ?>" maxlength="14" class="fone" ></label>
		<br />
		<label>E-mail:<input type="text" name="email" value="<?php echo $endereco->getEmailEndereco(); ?>" class="email" /></label>
	</div>
</fieldset>
<?php
$pessoa = new Pessoa();

if (isset($_GET['idEmpresaAlterar']) && $_GET['idEmpresaAlterar'] != '')
{
	if(isset($_SESSION['pessoaDiretorAtual']))
		unset($_SESSION['pessoaDiretorAtual']);
	$pessoa->setIdPessoa($empresa->getIdDiretor());
	$collVoAlterarPessoaConju = $controla->findPessoas($pessoa);
	if(!is_null($collVoAlterarPessoaConju))
		$pessoa = $collVoAlterarPessoaConju[0];
}
elseif(isset($_SESSION['pessoaDiretorAtual']))
{
	$pessoa = $_SESSION['pessoaDiretorAtual'];
}
?>
<input type="hidden" id="idDiretor" name="idDiretor" value="<?php echo $pessoa->getIdPessoa(); ?>">

<p class="caption">Dados do diretor</p>
<fieldset>
	<label>Dados do diretor?</label>
	<select name="preenche">
		<option></option>
		<option value="Não">Não</option>
		<option value="Sim" <?php echo ($pessoa->getIdPessoa() != null)?"selected=\"selected\"":""?>>Sim</option>
	</select>
</fieldset>
<fieldset>
	<div class="left">
		<label>Nome:<input type="text" name="nome" value="<?php echo $pessoa->getNomePessoa(); ?>" class="nome" /></label>
		<label>Nascimento:<input type="text" name="dataNascimento" value="<?php echo $formataData->toViewDate($pessoa->getDataNascimentoPessoa())?>" maxlength="10" class="data" /></label>
		<br />
		<label>Sexo:
			<select name="sexo">
				<option></option>
				<option value="M"<?php echo ($pessoa->getSexoPessoa()=="M")?"selected":""?>>Masculino</option>
				<option value="F"<?php echo ($pessoa->getSexoPessoa()=="F")?"selected":""?>>Feminino</option>
			</select>
		</label>
		<label>Estado Civil:
			<select name="estadoCivil">
				<option></option>
				<option value="Casado" <?php echo ($pessoa->getEstadoCivilPessoa()==="Casado")?"selected":""?>>Casado(a)</option>
				<option value="Solteiro" <?php echo ($pessoa->getEstadoCivilPessoa()==="Solteiro")?"selected":""?>>Solteiro(a)</option>
				<option value="União Estável" <?php echo ($pessoa->getEstadoCivilPessoa()==="União Estável")?"selected":""?>>União Estável</option>
			</select>
		</label>
	</div>
	<div class="right">
	<label>RG:<input type="text" name="rg" value="<?php echo $pessoa->getRgPessoa(); ?>" class="docRG" /></label>
	<label>Órgao Exped.:<input type="text" name="rg_orgao" value="<?php echo $pessoa->getOrgExpPessoa(); ?>" maxlength="3" class="small" /></label>
	<label>Estado
		<select name="rg_uf">
			<option></option>
			<option value="MT" <?php echo ($pessoa->getUfOrgExpPessoa()==="MT")? "selected":""?>>MT</option>
		</select>
	</label>
	<br />
	<label>CPF:<input type="text" name="cpf" value="<?php echo $pessoa->getCpfPessoa(); ?>" maxlength="14" class="docCPF" /></label>
</div>
</fieldset>
<?php

$enderecoDiretor= new Endereco();

if ($pessoa->getIdPessoa() != null)
{
	if(isset($_SESSION['enderecoDiretorAtual']))
		unset($_SESSION['enderecoDiretorAtual']);
	$enderecoDiretor->setIdPessoa($pessoa->getIdPessoa());
	$collVoAlterarEndDir = $controla->findEndereco($enderecoDiretor);
	if(!is_null($collVoAlterarEndDir))
		$enderecoDiretor = $collVoAlterarEndDir[0];
}
elseif(isset($_SESSION['enderecoDiretorAtual']))
{
	$enderecoDiretor = $_SESSION['enderecoDiretorAtual'];
}
?>
<input type="hidden" id="idEnderecoDiretor" name="idEnderecoDiretor" value="<?php echo $enderecoDiretor->getIdEndereco(); ?>">
<fieldset>
	<div class="left">
		<label>Rua, avenida, logradouro:<input type="text" name="ruaDiretor" value="<?php echo $enderecoDiretor->getRuaEndereco(); ?>" class="long" /></label>
		<br />
		<label>Complemento:<input type="text" name="complementoDiretor" value="<?php echo $enderecoDiretor->getComplementoEndereco(); ?>" class="long" /></label>
		<br />
		<label>Bairro:<input type="text" name="bairroDiretor" value="<?php echo $enderecoDiretor->getBairroEndereco(); ?>" class="long" /></label>
		<label>CEP:<input type="text" name="cepDiretor" value="<?php echo $enderecoDiretor->getCepEndereco(); ?>" maxlength="10" class="CEP" /></label>
		<br />
		<label>Cidade:<input type="text" name="cidadeDiretor" value="<?php echo $enderecoDiretor->getCidadeEndereco(); ?>" class="long" /></label>
		<label>Estado:
			<select name="estadoDiretor" class="x15" >
				<option></option>
				<option value="MT" <?php echo ($endereco->getEstadoEndereco()==="MT")? "selected":""?>>MT</option>
			</select>
		</label>
	</div>
	<div class="right">
		<label>DDD - Telefone:<input type="text" name="telefoneDiretor" value="<?php echo $enderecoDiretor->getTelefoneEndereco(); ?>" 	maxlength="14"class="fone" ></label>
		<br />
		<label>DDD - Celular:<input type="text" name="celularDiretor" value="<?php echo $enderecoDiretor->getCelEndereco(); ?>" 	maxlength="14"class="fone" ></label>
		<br />
		<label>DDD - Fax:<input type="text" name="faxDiretor" value="<?php echo $enderecoDiretor->getFaxEndereco(); ?>" 	maxlength="14"class="fone" ></label>
		<br />
		<label>E-mail:<input type="text" name="emailDiretor" value="<?php echo $enderecoDiretor->getEmailEndereco(); ?>" class="email" /></label>
	</div>
</fieldset>
	<?php
	$pessoaConjugue = new Pessoa();
	$enderecoConjugueDiretor = new Endereco();

	if ($pessoa->getIdConjuguePessoa() != null)
	{
		if(isset($_SESSION['pessoaConjugueAtual']))
		{
			unset($_SESSION['pessoaConjugueAtual']);
		}
		$pessoaConjugue->setIdPessoa($pessoa->getIdConjuguePessoa());
		$collVoAlterarConjugueDir = $controla->findPessoas($pessoaConjugue);
		if(!is_null($collVoAlterarConjugueDir))
		{
			$pessoaConjugue = $collVoAlterarConjugueDir[0];
			$enderecoConjugueDiretor = $pessoaConjugue->retornaEndereco();
		}
	}
	elseif(isset($_SESSION['pessoaConjugueAtual']))
	{
		$pessoaConjugue = $_SESSION['pessoaConjugueAtual'];
	}
	?>
	<input type="hidden" id="idConjugueDiretor" name="idConjugueDiretor" value="<?php echo $pessoaConjugue->getIdPessoa(); ?>">
	<input type="hidden" id="idEnderecoConjugueDiretor" name="idEnderecoConjugueDiretor" value="<?php echo $enderecoConjugueDiretor->getIdEndereco(); ?>">

<p class="caption">Dados do(a) cônjuge</p>
<fieldset>
	<div class="left">
		<label>Nome:<input type="text" name="nomeConjugue" value="<?php echo $pessoaConjugue->getNomePessoa(); ?>" class="nome" /></label>
		<label>Nascimento:<input type="text" name="dataNascimentoConjugue" value="<?php echo $formataData->toViewDate($pessoaConjugue->getDataNascimentoPessoa())?>" maxlength="10" class="data" /></label>
		<br />
		<label>Sexo:
			<select name="sexoConjugue">
				<option></option>
				<option value="M"<?php echo ($pessoaConjugue->getSexoPessoa()=="M")?"selected":""?>>Masculino</option>
				<option value="F"<?php echo ($pessoaConjugue->getSexoPessoa()=="F")?"selected":""?>>Feminino</option>
			</select>
		</label>
	</div>
	<div class="right">
		<label>RG:<input type="text" name="rgConjugue" value="<?php echo $pessoaConjugue->getRgPessoa(); ?>" class="docRG" /></label>
		<label>Órgao Exped:<input type="text" name="rg_orgaoConjugue" value="<?php echo $pessoaConjugue->getOrgExpPessoa(); ?>" maxlength="3" class="small" /></label>
		<label>Estado:
			<select name="rg_ufConjugue">
				<option></option>
				<option value="MT" <?php echo ($pessoa->getUfOrgExpPessoa()==="MT")? "selected":""?>>MT</option>
			</select>
		</label>
		<br />
		<label>CPF:<input type="text" name="cpfConjugue" value="<?php echo $pessoaConjugue->getCpfPessoa(); ?>" maxlength="14" class="docCPF" /></label>
	</div>
</fieldset>

</form>