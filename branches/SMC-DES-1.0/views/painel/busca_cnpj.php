<?php
	require_once ('../../class/Config.php');

	if(!isset($_SESSION['usuarioLogon'])) {
		header("Location:../views/home.php?p=login");
	}

	$logon = new Logon();
	$logon = $_SESSION["usuarioLogon"];
?>
<link rel="stylesheet" href="_css/formPadrao.css" type="text/css" media="all" />

<form method="post" action="../../class/RecebePostGet.php">
	<p class="caption">Consulta de Pessoa Jursãdica</p>

	<label>Nome da empresa:
		<input type="text" name="busca" class="long" />
	</label>

	<p class="botoes">
		<input type="hidden" id="acao" name="acao" value="buscaCnpj">
		<input type="hidden" id="idCliente" name="idCliente" value="<?=$logon->getIdClientes()?>">
		<input type="submit" value="Procurar" >
	</p>
</form>

<div id="resultados">
<?php
	$collEmpresasPesquisadas = null;
	if(isset($_GET['empresasPesquisadas'])) {
		if($_GET['empresasPesquisadas'] != '') {
			$collEmpresasPesquisadas = unserialize(base64_decode($_GET['empresasPesquisadas']));
		} else {
			$collEmpresasPesquisadas = null;
		}
		if(!is_null($collEmpresasPesquisadas) && count($collEmpresasPesquisadas) > 0) {
			if(count($collEmpresasPesquisadas) > 1) {
				echo "<p>".count($collEmpresasPesquisadas)." resultados encontrados</p><br><br>";
			} else {
				echo "<p>".count($collEmpresasPesquisadas)." resultado encontrado</p><br><br>";
			}
		} else {
			echo "<p>Nenhum resultado encontrado.</p>";
		}
	}

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
			<?=$empresaPesquisada->getNomeEmpresa()?>
		</td>
		<td>
			<?=$empresaPesquisada->getCnpjEmpresa()?>
		</td>
		<td>
			<form name="form" method="get" action="index.php">
				<input type="hidden" name="idEmpresaAlterar" value="<?=$empresaPesquisada->getIdEmpresa()?>" />
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