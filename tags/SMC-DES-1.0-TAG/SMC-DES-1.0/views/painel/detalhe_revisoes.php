<?php
require_once ('../../class/Config.php');
if(!isset($_SESSION['usuarioLogon'])) {
    header("Location:../views/home.php?p=login");
}

$logon = new Logon();
$logon = $_SESSION["usuarioLogon"];
$revisoes = new Revisoes();
if (isset($_GET['idRevisoesAlterar']) && $_GET['idRevisoesAlterar'] != '') 
 {
    if(isset($_SESSION['revisoesAtual']))
    	unset($_SESSION['revisoesAtual']);
 	$revisoes->setIdRevisoes($_GET['idRevisoesAlterar']);
    $collVoAlterar = $controla->findRevisoes($revisoes);
    if(!is_null($collVoAlterar)) {
        $revisoes =  $collVoAlterar[0];
    }
   
}
elseif(isset($_SESSION['revisoesAtual'])) 
{
    $revisoes = $_SESSION['revisoesAtual'];
}
?>
<form name="form_get" method="post" action="../../class/RecebePostGet.php" >
	<input name="idRevisoes" value="<?=$revisoes->getIdRevisoes()?>" type="hidden">
	<input name="idVeiculos" value="<?=$revisoes->getIdVeiculos()?>" type="hidden">
	<input name="idTipoRevisoes" value="<?=$revisoes->getIdTipoRevisoes()?>" type="hidden">
	<input type="hidden" name="acao" value="alterarRevisoes" />
    <p class="caption">ALTERAÇÃO DE REVISÕES </p>
    <p><span class="esq">
            <label class="x5 tright" for="get_placa">Veículo (placa):</label>
<?php 
$veiculos = new Veiculos();
$veiculos->setIdVeiculos($revisoes->getIdVeiculos());
$collVoVeiculos = $controla->findVeiculos($veiculos);
            if(!is_null($collVoVeiculos)) {
                $veiculos = $collVoVeiculos[0];
                echo $veiculos->getPlacaVeiculos();
            }
            ?>
        </span>
    </p>
    <p id="add_rev_padrao">
        <span id="linha" class="linha">
            <label class="x5 tright" for="revisao">Descrição do Tipo de Revisão:</label>
		<?=$revisoes->getTipoRevisoes()?><br/><br/>
            <span class="left">
                <br/>
			Data da Revisão: <input type="text" name="data" value="<?=$formataData->toViewDate($revisoes->getProxDataRevisoes())?>"/><br/>
			ou<br/>
			Km da Revisão: <input type="text" name="km" value="<?=$revisoes->getProxKmRevisoes()?>"/>
			<br/>
			</span>
        </span>
    </p>

    <span class="borda">
        <p class="tright"> <input type="submit" name="revpad" value="Concluir" > </p>
    </span>
</form>