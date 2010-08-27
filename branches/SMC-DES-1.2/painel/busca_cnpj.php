<?php
	require_once ('../class/Config.php');
	if(!isset($_SESSION['usuarioLogon'])) header("Location:../views/home.php?p=login");
	$logon = new Logon();
	$logon = $_SESSION["usuarioLogon"];
?>
<form method="post" action="../class/RecebePostGet.php">

	<div class="botoes">
		<input type="hidden" id="acao" name="acao" value="buscaCnpj">
		<input type="hidden" id="idCliente" name="idCliente" value="<?php echo $logon->getIdClientes(); ?>">
		<button type="submit" accesskey="P">Procurar</button>
	</div>

	<p class="caption">Consulta de Pessoa Jurídica</p>
	<fieldset>
		<label>Nome da empresa:
			<input type="text" name="busca" class="long" />
		</label>
	</fieldset>
<?php
	if(isset($_GET['limpa'])) unset($_SESSION['empresasPesquisadas']);
	$collEmpresasPesquisadas = null;
	if(isset($_SESSION['empresasPesquisadas'])) {
		$msg = '<fieldset class="msg">';
		if($_SESSION['empresasPesquisadas'] != '') {
			$collEmpresasPesquisadas = $_SESSION['empresasPesquisadas'];
		
			if(!is_null($collEmpresasPesquisadas) && count($collEmpresasPesquisadas) > 0) {
				if(count($collEmpresasPesquisadas) > 1) $msg .= count($collEmpresasPesquisadas)." resultados encontrados.";
				else $msg .= count($collEmpresasPesquisadas)." resultado encontrado.";
			} else {
				$msg .= "Nenhum resultado encontrado.";
			}
		} else {
			$msg .= "Nenhum resultado encontrado.";
		}
		$msg = $msg.'</fieldset>';
	}
	if (isset($msg)) echo $msg;
?>
</form>

<div id="resultados">
<?php
	$empresaPesquisada = new Empresas();
	if(!is_null($collEmpresasPesquisadas) && count($collEmpresasPesquisadas) > 0) {
?>
<table>
	<thead>
		<td width="295"><b>Nome</b></td>
		<td width="348" colspan="2"><b>CNPJ</b></td>
	</thead>
<?php
		foreach ($collEmpresasPesquisadas as $empresaAtual) {
			$empresaPesquisada = (object)$empresaAtual;
?>
	<tr>
		<td>
			<?php echo $empresaPesquisada->getNomeEmpresa(); ?>
		</td>
		<td>
			<?php echo $empresaPesquisada->getCnpjEmpresa(); ?>
		</td>
		<td>
			<form name="form" method="get" action="index.php">
				<input type="hidden" name="idEmpresaAlterar" value="<?php echo $empresaPesquisada->getIdEmpresa(); ?>" />
				<input type="hidden" name="p" value="detalhe_cnpj" />
				<input type="submit" value="Detalhar / Alterar"/>
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