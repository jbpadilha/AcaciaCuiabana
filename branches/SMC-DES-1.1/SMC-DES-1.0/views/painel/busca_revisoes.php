<?php
require_once ('../../class/Config.php');
if(!isset($_SESSION['usuarioLogon'])) {
    header("Location:../views/home.php?p=login");
}
$logon = new Logon();
$logon = $_SESSION["usuarioLogon"];

?>
<form name="busca_revisoes" method="POST" action="../../class/RecebePostGet.php" >
    <p class="caption"> Consulta Revisï¿½es</p>
    <fieldset>
        <label>Placa do Veï¿½culo:
            <input name="busca" type="text" class="nome" />
        </label>

        <p class="botoes">
            <input type="hidden" id="acao" name="acao" value="buscaRevisoes">
            <input type="hidden" id="idCliente" name="idCliente" value="<?=$logon->getIdClientes()?>">
            <input class="f_right" type="submit" value="Procurar" >
        </p>
    </fieldset>
</form>	

<?php
if(isset($_GET['limpa']))
{
	unset($_SESSION['revisoesPesquisados']);
}
$collRevisoesPesquisadas = null;
if(isset($_SESSION['revisoesPesquisados'])) 
{
    if($_SESSION['revisoesPesquisados'] != '') 
    {
        $collRevisoesPesquisadas = $_SESSION['revisoesPesquisados'];

	    if(!is_null($collRevisoesPesquisadas) && count($collRevisoesPesquisadas) > 0) {
	        if(count($collRevisoesPesquisadas) > 1)
	            echo "<p>".count($collRevisoesPesquisadas)." resultados encontrados</p><br><br>";
	        else
	            echo "<p>".count($collRevisoesPesquisadas)." resultado encontrado</p><br><br>";
	    } else {
	        echo "<p align=\"center\">Nenhum resultado encontrado.</p>";
	    }
    }
	else 
	{
	        echo "<p align=\"center\">Nenhum resultado encontrado.</p>";
	}
} 

$revisoes = new Revisoes();
if(!is_null($collRevisoesPesquisadas) && count($collRevisoesPesquisadas) > 0) {
    ?>

<div id="form_resultados">
    <table>
        <tr class="topo">
            <td>Ordem</td>
            <td>Placa</td>
            <td>Ult. data</td>
            <td>Revisï¿½o</td>
            <td>Ult. km</td>
            <td>Prï¿½x. data</td>
            <td>Prï¿½x. KM</td>
        </tr>
    
            <?php
            $cont = 1;
            foreach ($collRevisoesPesquisadas as $revisaoAtual) {
                $revisoes = (object)$revisaoAtual;
                $veiculos = new Veiculos();
                $veiculos = $_SESSION['veiculosAtual'];
                ?>
        <tr>
            <td>Revisãoo Nº <?=$cont?>	</td>
            <td><?=$veiculos->getPlacaVeiculos()?></td>
            <td><?=$formataData->toViewDate($revisoes->getDataRevisoes())?></td>
            <td><?=$revisoes->getTipoRevisoes()?></td>
            <td><?=$revisoes->getKmRevisoes()?></td>
            <td><?=$revisoes->getProxDataRevisoes()?></td>
            <td><?=$revisoes->getProxKmRevisoes()?></td>
            <td colspan="7">
                <form class="center" action="index.php" method="get">
                    <input type="hidden" value="<?=$revisoes->getIdRevisoes()?>" name="idRevisoesAlterar" />
                    <input type="hidden" value="detalhe_revisoes" name="p" />
                    <input type="submit" value="Detalhar / Alterar"/>
                </form>
            </td>
        </tr>

                <?php
                $cont++;
            }
        }
        ?>
    </table>
</div>