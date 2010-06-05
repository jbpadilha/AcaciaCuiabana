<?php

	require_once ('../../class/Config.php');

	if(!isset($_SESSION['usuarioLogon'])) {
		header("Location:../views/home.php?p=login");
	}

	$logon = new Logon();
	$logon = $_SESSION["usuarioLogon"];

	$pessoa = new Pessoa();
	if(isset($_SESSION['pessoaAtual'])) {
		$pessoa = $_SESSION['pessoaAtual'];
	}

?>
<link rel="stylesheet" href="_css/formPadrao.css" type="text/css" media="all" />

<form method="post" action="../../class/RecebePostGet.php">

<fieldset>
	<p class="caption">Dados pessoais</p>
	
	<div class="left">
		<label>Nome:<input type="text" name="nome" value="<?php echo $pessoa->getNomePessoa(); ?>" class="long" /></label>
		<label>Nascimento:<input type="text" name="dataNascimento" value="<?php echo $formataData->toViewDate($pessoa->getDataNascimentoPessoa()); ?>" class="data" /></label>
		<br />
		<label>Sexo:
			<select name="sexo">
				<option selected></option>
				<option value="M" <?php echo ($pessoa->getSexoPessoa()=="M")?"selected":""; ?>>Masculino</option>
				<option value="F" <?php echo ($pessoa->getSexoPessoa()=="F")?"selected":""; ?>>Feminino</option>
			</select>
		</label>		
		<label>Estado Civil:
			<select name="estadoCivil">
				<option selected></option>
				<option value="Casado" <?php echo ($pessoa->getEstadoCivilPessoa()==="Casado")?"selected":""; ?>>Casado(a)</option>
				<option value="Solteiro" <?php echo ($pessoa->getEstadoCivilPessoa()==="Solteiro")?"selected":""; ?>>Solteiro(a)</option>
				<option value="União estável" <?php echo ($pessoa->getEstadoCivilPessoa()==="União estável")?"selected":""; ?>>União estável</option>
			</select>
		</label>
	</div>
	
	<div class="right">
		<label>RG:<input type="text" name="rg" value="<?php echo $pessoa->getRgPessoa(); ?>" class="doc" /></label>
		<label>Órgao Exp.:<input type="text" name="rg_orgao"  value="<?php echo $pessoa->getOrgExpPessoa(); ?>" maxlength="3" class="small" /></label>
		<label>UF:
			<select name="rg_uf">
				<option selected></option>
				<option value="MT" <?php echo ($pessoa->getUfOrgExpPessoa()==="MT")? "selected":""; ?>>MT</option>
			</select>
		</label>
		<br />
		<label>CPF:<input type="text" name="cpf" value="<?php echo $pessoa->getCpfPessoa(); ?>" maxlength="14" class="doc" /></label>
	</div>
</fieldset>
<?php
	$endereco= new Endereco();

	if(isset($_SESSION['enderecoAtual'])) {
		$endereco = $_SESSION['enderecoAtual'];
	}
?>

<fieldset>
	<p class="caption">Dados de Endereço</p>
<div class="left">
	<label>Endereço:<input type="text" name="rua"  value="<?php echo $endereco->getRuaEndereco(); ?>" class="long" /></label>
	<label>Número:<input type="text" name="numero" value="<?=$endereco->getRuaEndereco()?>" class="small" /></label>
	<br />
	<label>Complemento:<input type="text" name="complemento"  value="<?php echo $endereco->getComplementoEndereco(); ?>" class="long" /></label>
	<br />
	<label>Bairro:<input type="text" name="bairro"  value="<?php echo $endereco->getBairroEndereco(); ?>" class="long" /></label>
	<label>CEP:<input type="text" name="cep"  value="<?php echo $endereco->getCepEndereco(); ?>" maxlength="10" class="data" /></label>
	<br />
	<label>Cidade:<input type="text" name="cidade"  value="<?php echo $endereco->getCidadeEndereco(); ?>" class="long" /></label>
	<label>Estado:
		<select name="estado"> 
			<option selected></option>
			<option value="MT" <?php echo ($endereco->getEstadoEndereco()==="MT")? "selected":""; ?>>MT</option>
		</select>
	</label>
</div>
<div class="right">
	<label>DDD - Telefone:<input type="text" name="telefone" value="<?php echo $endereco->getTelefoneEndereco(); ?>" maxlength="15" class="doc" /></label>
	<br />
	<label>DDD - Celular:<input type="text" name="celular" value="<?php echo $endereco->getCelEndereco(); ?>" maxlength="15" class="doc" /></label>
	<br />
	<label>DDD - Fax:<input type="text" name="fax" value="<?php echo $endereco->getFaxEndereco(); ?>" maxlength="15" class="doc" /></label>
	<br />
	<label>E-mail:<input type="text" name="email"  value="<?php echo $endereco->getEmailEndereco(); ?>" class="long" /></label>
</div>
</fieldset>
<?php 
	$pessoaConjugue = new Pessoa();
	
	if(isset($_SESSION['pessoaConjugueAtual'])) {
		$pessoaConjugue = $_SESSION['pessoaConjugueAtual'];
	}
?>
<fieldset>
	<p class="caption">Dados do(a) cônjuge</p>
	<div class="left">
		<label>Nome:<input type="text" name="nomeConjugue" value="<?php echo $pessoaConjugue->getNomePessoa(); ?>" class="long" /></label>
		<label>Nascimento:<input type="text" name="dataNascimentoConjugue" value="<?php echo $formataData->toViewDate($pessoaConjugue->getDataNascimentoPessoa()); ?>" maxlength="10" class="data" /></label>
		<br />
		<label>Sexo:
			<select name="sexoConjugue">
				<option selected></option>
				<option value="M" <?php echo ($pessoaConjugue->getSexoPessoa()=="M")?"selected":""; ?>>Masculino</option>
				<option value="F" <?php echo ($pessoaConjugue->getSexoPessoa()=="F")?"selected":""; ?>>Feminino</option>
			</select>
		</label>
	</div>
	<div class="right">
		<label>RG:<input type="text" name="rgConjugue" value="<?php echo $pessoaConjugue->getRgPessoa(); ?>" class="doc" /></label>
		<label>Órgao Exp.:<input type="text" name="rg_orgaoConjugue"  value="<?php echo $pessoaConjugue->getOrgExpPessoa(); ?>" maxlength="3" class="small" /></label>
		<label>UF:
			<select name="rg_ufConjugue"> 
				<option selected></option>
				<option value="MT" <?php echo ($pessoa->getUfOrgExpPessoa()==="MT")? "selected":""?>>MT</option>
			</select>
		</label>
		<br />
		<label>CPF:<input type="text" name="cpfConjugue" value="<?php echo $pessoaConjugue->getCpfPessoa(); ?>" maxlength="14" class="doc" /></label>
	</div>
</fieldset>
<p class="botoes">
	<input type="hidden" name="acao" value="cadastroPessoa" />
	<input type="hidden" name="idCliente" value="<?php echo $logon->getIdClientes(); ?>" />
	<input type="reset" value="Limpar campos" />
	<input type="submit" name="completo" value="Confirmar" />
</p>

</form>