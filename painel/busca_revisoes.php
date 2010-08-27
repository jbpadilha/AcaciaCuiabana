<?php
	require_once ('../class/Config.php');

	if(!isset($_SESSION['usuarioLogon'])) {
		header("Location:../views/home.php?p=login");
	}

	$logon = new Logon();
	$logon = $_SESSION["usuarioLogon"];
?>
<form name="busca_revisoes" method="POST" action="../class/RecebePostGet.php" >

	<div class="botoes">
		<input type="hidden" id="acao" name="acao" value="buscaRevisoes">
		<input type="hidden" id="idCliente" name="idCliente" value="<?=$logon->getIdClientes()?>">
		<button type="submit" accesskey="P">Procurar</button>
	</div>

    <p class="caption"> Consulta Revisões</p>

    <fieldset>
        <label>Placa do Veículo:
			<select name="busca">
				<option></option>
				<?php
				$veiculos = new Veiculos();
		
				if ($logon->getNivelAcessoLogin() != 5) $veiculos->setIdClientes($logon->getIdClientes());
		
				$collVoVeiculos = $controla->findVeiculos($veiculos);
				if(!is_null($collVoVeiculos)) {
					foreach($collVoVeiculos as $veiculoAtual) {
						$veiculos = (object)$veiculoAtual;
				?>
				<option value="<?php echo $veiculos->getIdVeiculos(); ?>"><?php echo $veiculos->getPlacaVeiculos(); ?></option>				
				<?php
					}
				}
			?>
			</select>
        </label>
    </fieldset>
<?php
	if(isset($_GET['limpa'])) unset($_SESSION['revisoesPesquisados']);

	$collRevisoesPesquisadas = null;
	if(isset($_SESSION['revisoesPesquisados'])) {
		$msg = '<fieldset class="msg">';
		if($_SESSION['revisoesPesquisados'] != '') {
			$collRevisoesPesquisadas = $_SESSION['revisoesPesquisados'];

			if(!is_null($collRevisoesPesquisadas) && count($collRevisoesPesquisadas) > 0) {
				if(count($collRevisoesPesquisadas) > 1) $msg .= count($collRevisoesPesquisadas)." resultados encontrados.";
				else $msg .= count($collRevisoesPesquisadas)." resultado encontrado.";
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

<?php
	$revisoes = new Revisoes();
	if (!is_null($collRevisoesPesquisadas) && count($collRevisoesPesquisadas) > 0) {
?>

<div id="resultados">
    <table>
        <thead>
            <td colspan="2">Ordem</td>
            <td>Placa</td>
            <td>Ult. data</td>
            <td>Revisão</td>
            <td>Ult. km</td>
            <td>Próx. data</td>
            <td>Próx. KM</td>
        </thead>

            <?php
            $cont = 1;
            foreach ($collRevisoesPesquisadas as $revisaoAtual) {
                $revisoes = (object)$revisaoAtual;
                $veiculos = new Veiculos();
                $veiculos = $_SESSION['veiculosAtual'];
                ?>
        <tr>
            <td>Revisãoo Nº <?=$cont?>	</td>
            <td>
                <form class="center" action="index.php" method="get">
                    <input type="hidden" value="<?=$revisoes->getIdRevisoes()?>" name="idRevisoesAlterar" />
                    <input type="hidden" value="detalhe_revisoes" name="p" />
                    <input type="submit" value="Detalhar / Alterar"/>
                </form>
            </td>
            <td><?=$veiculos->getPlacaVeiculos()?></td>
            <td><?=$formataData->toViewDate($revisoes->getDataRevisoes())?></td>
            <td><?=$revisoes->getTipoRevisoes()?></td>
            <td><?=$revisoes->getKmRevisoes()?></td>
            <td><?=$revisoes->getProxDataRevisoes()?></td>
            <td><?=$revisoes->getProxKmRevisoes()?></td>
        </tr>

                <?php
                $cont++;
            }
        }
        ?>
    </table>
</div>