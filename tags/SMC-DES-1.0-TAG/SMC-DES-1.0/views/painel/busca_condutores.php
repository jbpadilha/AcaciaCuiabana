<?php
require_once ('../../class/Config.php');

if(!isset($_SESSION['usuarioLogon'])) {
    header("Location:../views/home.php?p=login");
}

$logon = new Logon();
$logon = $_SESSION["usuarioLogon"];
?>
<form name="busca_veiculo" method="POST" action="../../class/RecebePostGet.php" >
    <p class="caption">Consulta de Condutor</p>
    <fieldset>
        <label>Cnh:
            <input name="busca" type="text" class="placa" >
        </label>
        <p class="botoes">
            <input type="hidden" name="acao" value="buscaCondutores">
            <input type="hidden" name="idCliente" value="<?=$logon->getIdClientes()?>">
            <input type="submit" value="Procurar" >
        </p>
    </fieldset>
</form>

<?php
$collCondutoresPesquisados = null;

if(isset($_GET['condutoresPesquisados'])) {
    if($_GET['condutoresPesquisados'] != '') {
        $collCondutoresPesquisados = unserialize(base64_decode($_GET['condutoresPesquisados']));
    } else {
        $collCondutoresPesquisados = null;
    }

    if(!is_null($collCondutoresPesquisados) && count($collCondutoresPesquisados) > 0) {
        if(count($collCondutoresPesquisados) > 1)
            echo "<p>".count($collCondutoresPesquisados)." resultados encontrados</p><br><br>";
        else
            echo "<p>".count($collCondutoresPesquisados)." resultado encontrado</p><br><br>";
    } else {
        echo "<p align=\"center\">Nenhum resultado encontrado.</p>";
    }
}

$condutorPesquisado = new Condutores();
if(!is_null($collCondutoresPesquisados) && count($collCondutoresPesquisados) > 0) {
    ?>

<div id="form_resultados">
    <table>
        <thead>
        <td>Nome</td>
        <td>Cnh</td>
        </thead>
            <?php
            foreach ($collCondutoresPesquisados as $condutor) {
                $condutorPesquisado = (object)$condutor;
                $pessoaPesquisada = new Pessoa();
                $pessoaPesquisada->setIdPessoa($condutorPesquisado->getIdPessoa());
                $collVoPessoaPesq = $controla->findPessoas($pessoaPesquisada);
                $pessoaPesquisada = $collVoPessoaPesq[0];

                $cnhPesquisado = new Cnh();
                $cnhPesquisado->setIdCnh($condutorPesquisado->getIdCnh());
                $collCnh = $controla->findCnh($cnhPesquisado);
                $cnhPesquisado = $collCnh[0];
                ?>
        <tr>
            <td><?=$pessoaPesquisada->getNomePessoa()?></td>
            <td><?=$cnhPesquisado->getNumeroCnh()?></td>
            <td>
                <form method="get" action="index.php" >
                    <input type="hidden" name="idCondutorAlterar" value="<?=$condutorPesquisado->getIdCondutores()?>" />
                    <input type="hidden" value="detalhe_condutores" name="p" />
                    <input type="submit" value="Detalhar / Alterar" />
                </form>
            </td>
        </tr>
                <?php
            }
            ?>
    </table>
</div>
    <?php
}
?>