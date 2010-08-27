<?php
	require_once ('../class/Config.php');
	
	if (!isset($_SESSION['usuarioLogon'])) header("Location:../views/home.php?p=login");
	
	$logon = new Logon();
	$logon = $_SESSION["usuarioLogon"];
?>
<form method="post" action="../class/RecebePostGet.php">
	
	<div class="botoes">
		<input type="hidden" name="acao" value="buscaCpf" />
		<input type="hidden" name="idCliente" value="<?php echo $logon->getIdClientes(); ?>" />
		<button type="submit" accesskey="P">Procurar</button>
	</div>

	<p class="caption">Consulta de Pessoas</p>
	<fieldset>
		<label>Nome:
			<input type="text" name="busca" class="long" />
		</label>	
	</fieldset>

<?php 
	if (isset($_GET['limpa'])) unset($_SESSION['pessoasPesquisadas']);
	$collPessoasPesquisadas = null;
	
	if (isset($_SESSION['pessoasPesquisadas'])) {
		$msg = '<fieldset class="msg">';
		if ($_SESSION['pessoasPesquisadas'] != '') {
			$collPessoasPesquisadas = $_SESSION['pessoasPesquisadas'];
			if (!is_null($collPessoasPesquisadas) && count($collPessoasPesquisadas) > 0) {
				if (count($collPessoasPesquisadas) > 1) $msg .= count($collPessoasPesquisadas)." resultados encontrados.";
				else $msg .= count($collPessoasPesquisadas)." resultado encontrado.";
			} else {
				$msg .= 'Nenhum resultado encontrado.';
			}
		} else {
			$msg .= 'Nenhum resultado encontrado.';
		}
		$msg = $msg.'</fieldset>';
	}
	if (isset($msg)) echo $msg;
?>

</form>	

<div id="resultados">
<?php
	$pessoaPesquisada = new Pessoa();
	if (!is_null($collPessoasPesquisadas) && count($collPessoasPesquisadas) > 0) {
?>
<table>
	<thead>
		<td width="400"><b>Nome</b></td>
		<td class="docCPF"><b>CPF</b></td>
	</thead>
<?php
	$num = 0;
	foreach ($collPessoasPesquisadas as $pessoas) {
		$pessoaPesquisada = (object)$pessoas;
		$num++;
?>
	<tr>
		<td>
			<form name="form" method="get" action="index.php">
				<input type="hidden" name="idPessoaAlterar" value="<?php echo $pessoaPesquisada->getIdPessoa(); ?>" />
				<input type="hidden" name="p" value="detalhe_cpf" />
				<input type="image" src="/_global/_img/edit.gif" title="Visualizar/Editar" accesskey="<?php echo $num; ?>" />
			</form>
			<?php echo $pessoaPesquisada->getNomePessoa(); ?>
		</td>
		<td>
			<?php echo $pessoaPesquisada->getCpfPessoa(); ?>
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