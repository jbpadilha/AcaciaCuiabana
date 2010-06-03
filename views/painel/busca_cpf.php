<?php
	require_once ('../../class/Config.php');
	
	if(!isset($_SESSION['usuarioLogon'])) {
		header("Location:../views/home.php?p=login");
	}
	
	$logon = new Logon();
	$logon = $_SESSION["usuarioLogon"];
?>
	<form method="post" action="../../class/RecebePostGet.php">
	<p class="caption">Consulta de Pessoas</p>
	<fieldset>
		<label>Nome:
			<input type="text" name="busca" class="long" />
		</label>	
	</fieldset>
	<p class="botoes">
		<input type="hidden" name="acao" value="buscaCpf">
		<input type="hidden" name="idCliente" value="<?=$logon->getIdClientes()?>">
		<input type="submit" value="Procurar" >
	</p>
</form>	

<div id="resultados">
<?php 
	$collPessoasPesquisadas = null;
	
	if(isset($_GET['pessoasPesquisadas'])) {
		if($_GET['pessoasPesquisadas'] != '') {
			$collPessoasPesquisadas = unserialize(urldecode($_GET['pessoasPesquisadas']));
		} else {
			$collPessoasPesquisadas = null;
		}
		if(!is_null($collPessoasPesquisadas) && count($collPessoasPesquisadas) > 0) {
			if(count($collPessoasPesquisadas) > 1)
			echo "<p>".count($collPessoasPesquisadas)." resultados encontrados</p><br /><br />";
			else
			echo "<p>".count($collPessoasPesquisadas)." resultado encontrado</p><br /><br />";
		} else {
			echo "<p>Nenhum resultado encontrado.</p>";
		}
	}

	$pessoaPesquisada = new Pessoa();
	if(!is_null($collPessoasPesquisadas) && count($collPessoasPesquisadas) > 0) {
?>

<table>
	<thead>
		<td width="295"><b>Nome</b></td>
		<td width="348" colspan="2"><b>CPF</b></td>
	</thead>
<?
	foreach ($collPessoasPesquisadas as $pessoas) {
		$pessoaPesquisada = (object)$pessoas;
?>
	<tr>
		<td width="293">
			<?=$pessoaPesquisada->getNomePessoa()?>
		</td>
		<td width="244">
			<?=$pessoaPesquisada->getCpfPessoa()?>
		</td>
		<td>
			<form name="form" method="get" action="index.php">
				<input type="hidden" name="idPessoaAlterar" value="<?=$pessoaPesquisada->getIdPessoa()?>" />
				<input type="hidden" name="p" value="detalhe_cpf" />
				<input type="submit" value="Detalhar / Alterar" />
			</form>
		</td>
	</tr>
<?php
	}
?>
</table>
<?php
	}
?>
</div>