<?php
require_once ('../../class/Config.php');

if(!isset($_SESSION['usuarioLogon'])) {
    header("Location:../views/home.php?p=login");
}

$logon = new Logon();
$logon = $_SESSION["usuarioLogon"];

$abastecimentos = new Abastecimentos();

if(isset($_SESSION['abastecimentosAtual'])) {
    $abastecimentos = $_SESSION['abastecimentosAtual'];
}
?>
<link rel="stylesheet" href="_css/formPadrao.css" type="text/css" media="all" />

<form method="post" action="../../class/RecebePostGet.php">

    <p class="caption">Lan�ar abastecimento</p>
    <fieldset>
        <label>Placa do Ve�culo:
            <select name="placa">
                <option selected="selected"><?=SELECIONE?></option>
                <?php
                $veiculos = new Veiculos();
                if($logon->getNivelAcessoLogin() != Dominio::$ADMINISTRADOR)
                    $veiculos->setIdClientes($logon->getIdClientes());
                $collVoVeiculos = $controla->findVeiculos($veiculos);

                if(!is_null($collVoVeiculos)) {
                    foreach ($collVoVeiculos as $veiculoAtual) {
                        $veiculos = $veiculoAtual;
                        ?>
                <option value="<?=$veiculos->getIdVeiculos()?>" <?=($veiculos->getIdVeiculos()==$abastecimentos->getIdVeiculos()) ? "selected":"" ?>><?=$veiculos->getPlacaVeiculos()?></option>
                        <?
                    }
                }
                ?>
            </select>
        </label>
        <br />
        <label>Data do abastecimento:
            <input type="text" name="data" value="<?=$formataData->toViewDate($abastecimentos->getDataAbastecimentos())?>" maxlength="10" class="data" />
        </label>
        <label>Kilometragem atual:
            <input type="text" name="km" value="<?=$abastecimentos->getKmAbastecimentos()?>" />
        </label>
        <br />
        <label>Fornecedor (posto):
            <input type="text" name="posto" value="<?=$abastecimentos->getPostoAbastecimentos()?>" class="long" />
        </label>
        <br />
        <label>N� da nota/cupom fiscal:
            <input type="text" value="<?=$abastecimentos->getNfAbastecimentos()?>" class="doc" name="nf" />
        </label>
        <label>Tipo de combust�vel:
            <select name="combustivel">
                <option></option>
                <option value="Gasolina" <?=($abastecimentos->getTipoCombustivelAbastecimentos() == "Gasolina")? "selected" : ""?>>Gasolina</option>
                <option value="�lcool" <?=($abastecimentos->getTipoCombustivelAbastecimentos() == "�lcool")? "selected" : ""?>>�lcool</option>
                <option value="Flex" <?=($abastecimentos->getTipoCombustivelAbastecimentos() == "Flex")? "selected" : ""?>>Flex</option>
                <option value="Diesel" <?=($abastecimentos->getTipoCombustivelAbastecimentos() == "Diesel")? "selected" : ""?>>Diesel</option>
            </select>
        </label>
        <br />
        <label>Quantidade (litros):
            <input type="text" name="litros" value="<?=$abastecimentos->getLitrosAbastecimentos()?>" maxlength="3" class="small" />
        </label>
        <label>Valor unit�rio (R$):
            <input type="text" name="valor" value="<?=$abastecimentos->getValorAbastecimentos()?>" class="small" />
        </label>
    </fieldset>

    <p class="botoes">
        <input type="hidden" id="acao" name="acao" value="cadastroAbastecimento">
        <input type="submit" name="abastece" value="Confirmar">
        <input type="reset" value="Limpar campos" >
    </p>
</form>