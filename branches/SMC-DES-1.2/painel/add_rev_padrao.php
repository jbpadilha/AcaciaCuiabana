<?php
	require_once ('../class/Config.php');

	if(!isset($_SESSION['usuarioLogon'])) header("Location:../views/home.php?p=login");

	if(isset($_GET['limpa'])) {
		unset($_SESSION['valoresAtual']);
		unset($_SESSION['contRevisoes']);
		unset($_SESSION['revisoesAtual']);
	}

	$logon = new Logon();
	$logon = $_SESSION["usuarioLogon"];

	$revisoes = new Revisoes();
	if(isset($_SESSION['revisoesAtual'])) $revisoes = $_SESSION['revisoesAtual'];
?>
<script type="text/javascript">
function adicionaCampoRevisao() {
	document.form1.adicionaRevisao.value = "sim";
	document.form1.submit();
}
</script>

<form method="post" action="../class/RecebePostGet.php" name="form1" id="form1">

	<p class="caption">Cadastro de Revisões</p>
	<fieldset>
		<label>Placa do Veículo
			<select name="placa">
				<option></option>
<?php
	$veiculos = new Veiculos();

	if($logon->getNivelAcessoLogin() != Dominio::$ADMINISTRADOR) {
		$veiculos->setIdClientes($logon->getIdClientes());
	}

	$collVoVeiculos = $controla->findVeiculos($veiculos);

	if(!is_null($collVoVeiculos)) {
		foreach ($collVoVeiculos as $veiculoAtual) {
			$veiculos = $veiculoAtual;
?>
				<option value="<?php echo $veiculos->getIdVeiculos(); ?>" <?php echo ($veiculos->getIdVeiculos()==$revisoes->getIdVeiculos()) ? "selected":"" ?>><?php echo $veiculos->getPlacaVeiculos(); ?></option>
<?php
}
}
?>
			</select>
		</label>
		<label>Descrição do Serviço:
			<select name="revisao">
				<option></option>
<?php
	$tipoRevisoes = new Tiporevisoes();

	$collVoTipos = $controla->findTipoRevisoes($tipoRevisoes);

	if(!is_null($collVoTipos)) {
		foreach ($collVoTipos as $tipos) {
			$tipoRevisoes = $tipos;
				echo "<option value=\"{$tipoRevisoes->getIdTipoRevisoes()}\"";
				echo ($tipoRevisoes->getIdTipoRevisoes() == $revisoes->getIdTipoRevisoes()) ? "selected" : "";
				echo ">{$tipoRevisoes->getDescricaoTipoRevisoes()}</option>";
		}
	}
?>
			</select>
		</label>
		<br />
		<br />
		<b>Próximas Revisões</b><br/><br/>
		<?php
		$valores = null;
		if(isset($_SESSION['valoresAtual']))
		{
			$valores = $_SESSION['valoresAtual'];
		}

		$cont = 1;
		if(isset($_SESSION['contRevisoes']))
			$cont = $_SESSION['contRevisoes'];

		$_SESSION['contRevisoes'] = $cont;

		for($i=0;$i<$cont;$i++)
		{
			?>
			<label>Data da Revisão:
				<input type="text" name="data<?php echo $i; ?>" value="<?php echo $valores[$i][0]; ?>" class="data" />
			</label>
			<label>Km da Revisão:
				<input type="text" name="km<?php echo $i; ?>" value="<?php echo $valores[$i][1]; ?>" class="km" />
			</label>
			<label>Nova revisão:
				<button onclick="adicionaCampoRevisao();" />Adicionar Revisão</button>
			</label>
			<br />
			<?php
		}
		?>

	</fieldset>
		<p class="botoes">
			<input type="hidden" name="acao" value="cadastroRevisoes" />
			<input type="hidden" name="adicionaRevisao" value="" />
			<input type="submit" name="revpad" value="Concluir" />
		</p>

</form>