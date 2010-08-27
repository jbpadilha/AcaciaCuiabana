<?php
	require_once ('../class/Config.php');

	if(!isset($_SESSION['usuarioLogon'])) {
		header("Location:../views/home.php?p=login");
	}

	$logon = new Logon();
	$logon = $_SESSION["usuarioLogon"];

	if(isset($_GET['limpa'])) {
		unset($_SESSION['revisoes']);
	}
?>
<form name="rev_pesquisa" method="get" id="rev_pesquisa" action="../class/RecebePostGet.php">

	<div class="botoes">
		<input type="hidden" name="acao" value="pesquisaRevisao" />
		<input type="submit" value="Pesquisar Revisão" />
	</div>

	<p class="caption">CONFIRMAÇÃO DE REVISÃO</p>
	<fieldset>
		<label>Veículo (placa)
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
				<option value="<?php echo $veiculos->getIdVeiculos(); ?>"><?php echo $veiculos->getPlacaVeiculos(); ?></option>
				<?php
						}
					}
				?>
			</select>
		</label>
	</fieldset>

</form>

<?php
if(isset($_SESSION['revisoes'])) {
	if($_SESSION['revisoes'] != '') {
		$i = 0;
		$arrayRevisoes = $_SESSION['revisoes'];
		foreach ($arrayRevisoes as $revisoes) {
			$revisao = new Revisoes();
			$revisao = $revisoes;
			if(is_null($revisao->getDataRevisoes())) {
?>
<form id="rev_confirma<?php echo $i?>" name="rev_confirma<?php echo $i?>" method="post" action="../class/RecebePostGet.php">

	<fieldset>
		<label>Data prox. revisão:
			<input type="text" disabled value="<?php echo $formataData->toViewDate($revisao->getProxDataRevisoes())?>" class="data" />
		</label>
		<label>Km prox. revisão:
			<input type="text" disabled value="<?php echo $revisao->getProxKmRevisoes(); ?>" class="km" />
		</label>
		<br/>
		<label>Data da Revisão:
			<input type="text" name="data" value="<?php echo $formataData->toViewDate($revisao->getDataRevisoes())?>" class="data" />
		</label>
		<label>Km da Revisão:
			<input type="text" name="km" value="<?php echo $revisao->getKmRevisoes(); ?>" class="km" />
		</label>
	</fieldset>

	<div class="botoes">
		<input type="hidden" name="acao" value="confirmarRevisao" />
		<input type="hidden" name="idRevisao" value="<?php echo $revisao->getIdRevisoes(); ?>" />
		<input type="submit" value="Confirmar essa Revisão">
	</div>

</form>
<?php
			}
			$i++;
		}
	} else {
		echo "Nenhuma revisão a ser confirmada.";
	}
}
?>