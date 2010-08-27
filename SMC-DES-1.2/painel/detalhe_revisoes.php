<?php
	require_once ('../class/Config.php');

	if(!isset($_SESSION['usuarioLogon'])) {
		header("Location:../views/home.php?p=login");
	}

	$logon = new Logon();
	$logon = $_SESSION["usuarioLogon"];
	$revisoes = new Revisoes();
	if (isset($_GET['idRevisoesAlterar']) && $_GET['idRevisoesAlterar'] != '') {
		if(isset($_SESSION['revisoesAtual'])) unset($_SESSION['revisoesAtual']);
		$revisoes->setIdRevisoes($_GET['idRevisoesAlterar']);
		$collVoAlterar = $controla->findRevisoes($revisoes);
		if(!is_null($collVoAlterar)) {
			$revisoes =  $collVoAlterar[0];
		}
	} elseif (isset($_SESSION['revisoesAtual'])) {
		$revisoes = $_SESSION['revisoesAtual'];
	}
?>
<form name="form_get" method="post" action="../class/RecebePostGet.php" >

    <div class="botoes">
		<input type="hidden" name="idRevisoes" value="<?php echo $revisoes->getIdRevisoes(); ?>" />
		<input type="hidden" name="idVeiculos" value="<?php echo $revisoes->getIdVeiculos(); ?>" />
		<input type="hidden" name="idTipoRevisoes" value="<?php echo $revisoes->getIdTipoRevisoes(); ?>" />
		<input type="hidden" name="acao" value="alterarRevisoes" />
        <input type="submit" name="revpad" value="Concluir" />
    </div>

<p class="caption">ALTERAÇÃO DE REVISÕES</p>
<fieldset>
<?php
$veiculos = new Veiculos();
$veiculos->setIdVeiculos($revisoes->getIdVeiculos());
$collVoVeiculos = $controla->findVeiculos($veiculos);
            if(!is_null($collVoVeiculos)) {
                $veiculos = $collVoVeiculos[0];
            }
            ?>
	<label>Veículo (placa):
		<input type="text" value="<?php echo $veiculos->getPlacaVeiculos(); ?>" class="placa" />
	</label>
	<br />
	<label>Descrição do Tipo de Revisão:
		<input type="text" value="<?php echo $revisoes->getTipoRevisoes(); ?>" />
	</label>
	<br/>
	<label>Data da Revisão:
		<input type="text" name="data" value="<?php echo $formataData->toViewDate($revisoes->getProxDataRevisoes())?>" class="data" />
	</label>
	<label>Km da Revisão:
		<input type="text" name="km" value="<?php echo $revisoes->getProxKmRevisoes(); ?>" class="km" />
	</label>
</fieldset>

</form>