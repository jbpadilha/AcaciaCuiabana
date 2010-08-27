<?php
	require_once ('../class/Config.php');

	if(!isset($_SESSION['usuarioLogon'])) header("Location:../views/home.php?p=login");
	$logon = new Logon();
	$logon = $_SESSION["usuarioLogon"];

	$abastecimentos = new Abastecimentos();
	if(isset($_SESSION['abastecimentosAtual'])) $abastecimentos = $_SESSION['abastecimentosAtual'];
?>
<form method="post" action="../class/RecebePostGet.php">

    <div class="botoes">
        <input type="hidden" id="acao" name="acao" value="cadastroAbastecimento">
        <input type="submit" name="abastece" value="Confirmar">
        <input type="reset" value="Limpar campos" >
    </div>

    <p class="caption">Lançar abastecimento</p>
    <fieldset>
        <label>Placa do Veículo:
            <select name="placa">
                <option></option>
                <?php
                $veiculos = new Veiculos();
                if($logon->getNivelAcessoLogin() != Dominio::$ADMINISTRADOR)
                    $veiculos->setIdClientes($logon->getIdClientes());
                $collVoVeiculos = $controla->findVeiculos($veiculos);

                if(!is_null($collVoVeiculos)) {
                    foreach ($collVoVeiculos as $veiculoAtual) {
                        $veiculos = $veiculoAtual;
                        ?>
                <option value="<?php echo $veiculos->getIdVeiculos(); ?>" <?php echo ($veiculos->getIdVeiculos()==$abastecimentos->getIdVeiculos()) ? "selected":"" ?>><?php echo $veiculos->getPlacaVeiculos(); ?></option>
                        <?php
                    }
                }
                ?>
            </select>
        </label>
        <br />
        <label>Data do abastecimento:
            <input type="text" name="data" value="<?php echo $formataData->toViewDate($abastecimentos->getDataAbastecimentos())?>" maxlength="10" class="data" />
        </label>
        <label>Kilometragem atual:
            <input type="text" name="km" value="<?php echo $abastecimentos->getKmAbastecimentos(); ?>" maxlength="6" class="km" />
        </label>
        <br />
        <label>Fornecedor (posto):
            <input type="text" name="posto" value="<?php echo $abastecimentos->getPostoAbastecimentos(); ?>" class="nome" />
        </label>
        <br />
        <label>Nº da nota/cupom fiscal:
            <input type="text" name="nf" value="<?php echo $abastecimentos->getNfAbastecimentos(); ?>" maxlength="12" class="docNF" />
        </label>
        <label>Tipo de combustíel:
            <select name="combustivel">
                <option></option>
                <option value="Gasolina" <?php echo ($abastecimentos->getTipoCombustivelAbastecimentos() == "Gasolina")? "selected" : ""?>>Gasolina</option>
                <option value="Álcool" <?php echo ($abastecimentos->getTipoCombustivelAbastecimentos() == "Álcool")? "selected" : ""?>>Álcool</option>
                <option value="Flex" <?php echo ($abastecimentos->getTipoCombustivelAbastecimentos() == "Flex")? "selected" : ""?>>Flex</option>
                <option value="Diesel" <?php echo ($abastecimentos->getTipoCombustivelAbastecimentos() == "Diesel")? "selected" : ""?>>Diesel</option>
            </select>
        </label>
        <br />
        <label>Quantidade (litros):
            <input type="text" name="litros" value="<?php echo $abastecimentos->getLitrosAbastecimentos(); ?>" class="decimal" />
        </label>
        <label>Valor unitário (R$):
            <input type="text" name="valor" value="<?php echo $abastecimentos->getValorAbastecimentos(); ?>" class="valor" />
        </label>
    </fieldset>

</form>