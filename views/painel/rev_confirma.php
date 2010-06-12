<?php
require_once ('../../class/Config.php');

if(!isset($_SESSION['usuarioLogon'])) {
    header("Location:../views/home.php?p=login");
}

$logon = new Logon();
$logon = $_SESSION["usuarioLogon"];

if(isset($_GET['limpa']))
{
	unset($_SESSION['revisoes']);
}
?>
<link href="../css/default.css" rel="stylesheet" type="text/css" >
<script type="text/javascript" language="javascript" src="../scripts/busca.js" > </script>
<body>
<div id="form">

	<form name="rev_pesquisa" method="get" id="rev_pesquisa" action="../../class/RecebePostGet.php">
		<input type="hidden" name="acao" value="pesquisaRevisao">
		<p class="caption">CONFIRMA��O DE REVIS�O</p>

	<fieldset>
		<p><label>Ve�culo (placa)</label></p>
		<p>
		<select name="placa">
				<option><?=SELECIONE?></option>
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
								<option value="<?=$veiculos->getIdVeiculos()?>"><?=$veiculos->getPlacaVeiculos()?></option>
				<?
				}
				}
				?>
			</select>
		</p>
		<input type="submit" value="Pesquisar Revis�o">
	</fieldset>
	</form>	
	<?php
	if(isset($_SESSION['revisoes']))
	{
		if($_SESSION['revisoes'] != '')
		{
			$i = 0;
			$arrayRevisoes = $_SESSION['revisoes'];
			foreach ($arrayRevisoes as $revisoes)
			{
				$revisao = new Revisoes();
				$revisao = $revisoes;
				if(is_null($revisao->getDataRevisoes()))
				{
		?>
		<br/><br/><br/>
		<form id="rev_confirma<?=$i?>" name="rev_confirma<?=$i?>" method="post" action="../../class/RecebePostGet.php">
		<input type="hidden" name="acao" value="confirmarRevisao">
		<input type="hidden" name="idRevisao" value="<?=$revisao->getIdRevisoes()?>">
		Data da Previs�o da revis�o: <?=$formataData->toViewDate($revisao->getProxDataRevisoes())?><br/><br/>
		Km da Previs�o da revis�o: <?=$revisao->getProxKmRevisoes()?><br/><br/>
		<br/>
		Data da Revis�o:<input type="text" name="data" value="<?=$formataData->toViewDate($revisao->getDataRevisoes())?>"/><br/>
		e<br/>
		Km da Revis�o:<input type="text" name="km" value="<?=$revisao->getKmRevisoes()?>"/>
		<br/>
		<input type="submit" value="Confirmar essa Revis�o">
		</form>
		<?php
				}
				$i++;
			}
		}
		else
		{
			echo "Nenhuma revis�o a ser confirmada.";
		}
	}
		?>	
</div>
</body>