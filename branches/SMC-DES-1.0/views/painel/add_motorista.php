<?php
	require_once ('../../class/Config.php');
	
	if(!isset($_SESSION['usuarioLogon'])) {
		header("Location:../views/home.php?p=login");
	}

	$logon = new Logon();
	$logon = $_SESSION["usuarioLogon"];
	$condutores = new Condutores();
	$cnh = new Cnh();
	
	if(isset($_GET['condutores'])) {
		$condutores = unserialize(base64_decode($_GET['condutores']));
	}
	
	if(isset($_GET['cnh'])) {
		$cnh = unserialize(base64_decode($_GET['cnh']));
	}
?>
<form method="post" action="../../class/RecebePostGet.php">
	<p class="caption">Cadastrode condutores</p>
	<div class="left">
		<label>Nome:
			<select name="pessoaCondutor" class="long">
				<option></option>
<?php
	$pessoas = new Pessoa();
	$pessoas->setIdCliente($logon->getIdClientes());
	$collVoPessoaCliente = $controla->findPessoas($pessoas);
	
	if($collVoPessoaCliente!=null) {
		foreach ($collVoPessoaCliente as $pessoaAtual) {
			$pessoas = $pessoaAtual;
?>
				<option value="<?=$pessoas->getIdPessoa()?>"<?=($condutores->getIdPessoa())?"Selected":""?>><?=$pessoas->getNomePessoa()?></option>
<?
		}
	}
?>
			</select>
		</label>
		<br />
	</div>
	<div class="right">
		<label>Nº CNH
			<input type="text" name="cnh" value="<?=$cnh->getNumeroCnh()?>"	maxlength="12" class="doc" />
		</label> 
		<label>UF
			<select name="cnhuf"  class="x15" />
				<option></option>
				<option value="MT" <?=($cnh->getUfCnh()==="MT")? "selected":""?>>MT</option>
			</select>
		</label> 
		<label>Cat. CNH:
			<input type="text" name="cnhcat" maxlength="2" class="small" value="<?=$cnh->getCategoriaCnh()?>" />
		</label>
		<label>Vencimento CNH:
			<input type="text" name="cnhvcto" value="<?=$formataData->toViewDate($cnh->getVencCnh())?>" 	onkeypress="return mascara(event,this,'##/##/####');" maxlength="10" class="x2" />
		</label>
	</div>
	
	<p class="botoes">
		<input type="hidden" name="acao" value="cadastroMotorista" />
		<input type="hidden" name="idCliente" value="<?=$logon->getIdClientes()?>" />
		<input type="reset" value="Limpar campos" />
		<input name="completo" type="submit" value="Confirmar" />
	</p>
</div>
</form>