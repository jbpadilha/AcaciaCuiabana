<?php
require_once ('../class/Config.php');

if(!isset($_SESSION['usuarioLogon'])) {
	header("Location:../views/home.php?p=login");
}

$logon = new Logon();
$logon = $_SESSION["usuarioLogon"];

$pessoa = new Pessoa();
if (isset($_GET['idPessoaAlterar']) && $_GET['idPessoaAlterar'] != '') {
	if(isset($_SESSION['pessoaAtual']))unset($_SESSION['pessoaAtual']);
	$pessoa->setIdPessoa(trim($_GET['idPessoaAlterar']));
	$collVoAlterar = $controla->findPessoas($pessoa);
	if(!is_null($collVoAlterar)) {
		$pessoa = $collVoAlterar[0]; 
	}
} elseif(isset($_SESSION['pessoaAtual'])) {
	$pessoa = $_SESSION['pessoaAtual'];
}
?>
<form method="POST" action="/smc/class/RecebePostGet.php">

<div class="botoes">
	<input type="hidden" id="acao" name="acao" value="alterarPessoa">
	<input type="hidden" id="idCliente" name="idCliente" value="<?php echo $logon->getIdClientes(); ?>">
	<input type="hidden" id="idPessoa" name="idPessoa" value="<?php echo $pessoa->getIdPessoa(); ?>">
	<input class="botao" type="reset" value="Limpar campos" >
	<input class="botao" name="completo" type="submit" value="Confirmar" >
</div>

<p class="caption">Dados pessoais</p>
<fieldset>
	
	<div class="left">
		<label>Nome:<input type="text" name="nome" value="<?php echo $pessoa->getNomePessoa(); ?>" class="nome" /></label>
		<label>Nascimento:<input type="text" name="dataNascimento" value="<?php echo $formataData->toViewDate($pessoa->getDataNascimentoPessoa()); ?>" class="data" /></label>
		<br />
		<label>Sexo:
			<select name="sexo">
				<option></option>
				<?php
				foreach ($sexo as $x => $xx) {
					$x = strtoupper($x);
					$xx = strtoupper($xx);
					$attr = $pessoa->getSexoPessoa() == $x ? " selected" : "";
					echo "\n<option value=\"".$x."\"".$attr.">".$xx."</option>";
				}
				?>
			</select>
		</label>		
		<label>Estado Civil:
			<select name="estadoCivil">
				<option></option>
				<?php
				$n = 1;
				foreach ($estadoCivil as $x) {
					$x = strtoupper($x);
					$attr = $pessoa->getEstadoCivilPessoa() == $n ? " selected" : "";
					echo "\n<option value=\"".$n."\"".$attr.">".$x."</option>";
					$n++;
				}
				?>
			</select>
		</label>
	</div>
	
	<div class="right">
		<label>RG:<input type="text" name="rg" value="<?php echo $pessoa->getRgPessoa(); ?>" class="docRG" /></label>
		<label>Órgao Exp.:<input type="text" name="rg_orgao"  value="<?php echo $pessoa->getOrgExpPessoa(); ?>" maxlength="3" class="small" /></label>
		<label>UF:
			<select name="rg_uf">
				<option></option>
				<?php
				foreach ($estados as $uf => $estado) {
					$attr = $pessoa->getUfOrgExpPessoa() == $uf ? " selected" : "";
					echo "\n<option value=\"".$uf."\"".$attr.">".$uf."</option>";
				}
				?>
			</select>
		</label>
		<br />
		<label>CPF:<input type="text" name="cpf" value="<?php echo $pessoa->getCpfPessoa(); ?>" maxlength="14" class="docCPF" /></label>
	</div>
</fieldset>
<?php
	$endereco= new Endereco();

	if (isset($_GET['idPessoaAlterar']) && $_GET['idPessoaAlterar'] != '')
	{
		if(isset($_SESSION['enderecoAtual']))
			unset($_SESSION['enderecoAtual']);
		$endereco->setIdPessoa($_GET['idPessoaAlterar']);
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
<p class="caption">Dados de Endereço</p>
<fieldset>
<div class="left">
	<label>Endereço:<input type="text" name="rua"  value="<?php echo $endereco->getRuaEndereco(); ?>" class="long" /></label>
	<br />
	<label>Complemento:<input type="text" name="complemento"  value="<?php echo $endereco->getComplementoEndereco(); ?>" class="long" /></label>
	<br />
	<label>Bairro:<input type="text" name="bairro"  value="<?php echo $endereco->getBairroEndereco(); ?>" class="long" /></label>
	<label>CEP:<input type="text" name="cep"  value="<?php echo $endereco->getCepEndereco(); ?>" maxlength="10" class="CEP" /></label>
	<br />
	<label>Cidade:<input type="text" name="cidade"  value="<?php echo $endereco->getCidadeEndereco(); ?>" class="long" /></label>
	<label>Estado:
		<select name="estado"> 
			<option></option>
			<?php
			foreach ($estados as $uf => $estado) {
				$attr = $endereco->getEstadoEndereco() == $uf ? "selected":"";
				echo "\n<option value=\"".$uf."\"".$attr.">".$uf."</option>";
			}
			?>
		</select>
	</label>
</div>
<div class="right">
	<label>DDD - Telefone:<input type="text" name="telefone" value="<?php echo $endereco->getTelefoneEndereco(); ?>" maxlength="14" class="fone" /></label>
	<br />
	<label>DDD - Celular:<input type="text" name="celular" value="<?php echo $endereco->getCelEndereco(); ?>" maxlength="14" class="fone" /></label>
	<br />
	<label>DDD - Fax:<input type="text" name="fax" value="<?php echo $endereco->getFaxEndereco(); ?>" maxlength="14" class="fone" /></label>
	<br />
	<label>E-mail:<input type="text" name="email"  value="<?php echo $endereco->getEmailEndereco(); ?>" class="email" /></label>
</div>
</fieldset>
<?php 
	$pessoaConjugue = new Pessoa();
	$enderecoConjugue = new Endereco();
	if (isset($_GET['idPessoaAlterar']) && $_GET['idPessoaAlterar'] != '') {
		if(isset($_SESSION['pessoaConjugueAtual'])) unset($_SESSION['pessoaConjugueAtual']);
		if(!is_null($pessoa->getIdConjuguePessoa())) {
			$pessoaConjugue->setIdPessoa($pessoa->getIdConjuguePessoa());
			$collVoAlterarConj = $controla->findPessoas($pessoaConjugue);
			$pessoaConjugue = $collVoAlterarConj[0];
			$enderecoConjugue = $pessoaConjugue->retornaEndereco();
		}
	} elseif(isset($_SESSION['pessoaConjugueAtual'])) {
		$pessoaConjugue = $_SESSION['pessoaConjugueAtual'];
		$enderecoConjugue = $pessoaConjugue->retornaEndereco();
	}
?>
<input type="hidden" id="idPessoaConjugue" name="idPessoaConjugue" value="<?php echo $pessoaConjugue->getIdPessoa(); ?>">
<input type="hidden" id="idEnderecoConjugue" name="idEnderecoConjugue" value="<?php echo $enderecoConjugue->getIdEndereco(); ?>">

<p class="caption">Dados do(a) cônjuge</p>
<fieldset>
	<div class="left">
		<label>Nome:<input type="text" name="nomeConjugue" value="<?php echo $pessoaConjugue->getNomePessoa(); ?>" class="nome" /></label>
		<label>Nascimento:<input type="text" name="dataNascimentoConjugue" value="<?php echo $formataData->toViewDate($pessoaConjugue->getDataNascimentoPessoa()); ?>" maxlength="10" class="data" /></label>
		<br />
		<label>Sexo:
			<select name="sexoConjugue">
				<option></option>
				<?php
				foreach ($sexo as $x => $xx) {
					$x = strtoupper($x);
					$xx = strtoupper($xx);
					$attr = $pessoaConjugue->getSexoPessoa() == $x ? " selected" : "";
					echo "\n<option value=\"".$x."\"".$attr.">".$xx."</option>";
				}
				?>
			</select>
		</label>
	</div>
	<div class="right">
		<label>CPF:<input type="text" name="cpfConjugue" value="<?php echo $pessoaConjugue->getCpfPessoa(); ?>" maxlength="14" class="docCPF" /></label>
	</div>
</fieldset>

</form>