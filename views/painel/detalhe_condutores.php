<?php
require_once ('../../class/Config.php');

if(!isset($_SESSION['usuarioLogon'])) {
    header("Location:../views/home.php?p=login");
}

$logon = new Logon();
$logon = $_SESSION["usuarioLogon"];
$condutores = new Condutores();
$cnh = new Cnh();

if (isset($_GET['idCondutorAlterar']) && $_GET['idCondutorAlterar'] != '') {
	if(isset($_SESSION['condutoresAtual']))
		unset($_SESSION['condutoresAtual']);
	if(isset($_SESSION['CnhAtual']))
		unset($_SESSION['CnhAtual']);
	$condutores->setIdCondutores($_GET['idCondutorAlterar']);
    $collVoAlterar = $controla->findCondutores($condutores);
    if(!is_null($collVoAlterar)) {
        $condutores = $collVoAlterar[0];
        $cnh->setIdCnh($condutores->getIdCnh());
        $collVoCnh = $controla->findCnh($cnh);
        $cnh = $collVoCnh[0];
    }
}
elseif(isset($_SESSION['condutoresAtual'])) {
    $condutores = $_SESSION['condutoresAtual'];
}
if(isset($_SESSION['CnhAtual'])) {
    $cnh = $_SESSION['CnhAtual'];
}
?>
<form method="POST" action="../../class/RecebePostGet.php">
    <p class="caption">Nome do Condutor</p>
    <fieldset>
        <div class="left">
            <label>Nome:
                <?php
                $pessoas = new Pessoa();
                $pessoas->setIdPessoa($condutores->getIdPessoa());
                $collVoPessoa = $controla->findPessoas($pessoas);
                $pessoas = $collVoPessoa[0];
                ?>
                <input type="text" value="<?php echo $pessoas->getNomePessoa(); ?>" />
            </label>

            <label>Nº CNH:
                <input type="text" name="cnh" value="<?=$cnh->getNumeroCnh()?>" maxlength="12" class="doc" />
            </label>
            <label>UF:
                <select name="cnhuf">
                    <option><?=SELECIONE?></option>
                    <option value="MT" <?=($cnh->getUfCnh()==="MT")? "selected":""?>>MT</option>
                </select>
            </label>
            <label>Categoria CNH:
                <input type="text" name="cnhcat" value="<?=$cnh->getCategoriaCnh()?>" maxlength="2" class="small" />
            </label>
            <label>Vencimento CNH:
                <input type="text" name="cnhvcto" value="<?=$formataData->toViewDate($cnh->getVencCnh())?>" maxlength="10" class="data" />
            </label>
        </div>
    </fieldset>

    <p class="botoes">
        <input type="hidden" name="acao" value="alterarCondutores" />
        <input type="hidden" name="idCliente" value="<?=$logon->getIdClientes()?>" />
        <input type="hidden" name="idCondutor" value="<?=$condutores->getIdCondutores()?>" />
        <input type="hidden" name="idCnh" value="<?=$condutores->getIdCnh()?>" />
        <input type="hidden" name="idPessoa" value="<?=$condutores->getIdPessoa()?>" />
        <input type="submit" name="completo" value="Confirmar" />
        <input type="reset" value="Limpar campos" />
    </p>
</form>