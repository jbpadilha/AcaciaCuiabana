<?php
require_once ('../../class/Config.php');

if(!isset($_SESSION['usuarioLogon'])) {
    header("Location:../views/home.php?p=login");
}

$logon = new Logon();
$logon = $_SESSION["usuarioLogon"];

//if($logon->getNivelAcessoLogin() <= 5) {
//    $mensagem = 'Usuário não autorizado para a funcionalidade';
//    header("Location:index.php?pg=home&msg=$mensagem");
//}

$tipoRevisoes = new Tiporevisoes();

if(isset($_GET['tipoRevisoes'])) {
    $tipoRevisoes = unserialize(base64_decode($_GET['tipoRevisoes']));
}
?>

<form method="post" action="../../class/RecebePostGet.php" >
    <p class="caption"> Novo item de revisão </p>

    <fieldset>
        <label>Descrição:
            <input type="text" class="x9" name="descricao" id="descricao" value="<?=$tipoRevisoes->getDescricaoTipoRevisoes()?>" />
        </label>
    </fieldset>

    <p class="botoes">
        <input type="hidden" name="acao" value="cadastroTipoRevisoes" />
        <input type="submit" value="Confirmar" />
    </p>
</form>

<form method="post" action="../../class/RecebePostGet.php" >
    <p class="caption">Lista de revisões já cadastradas</p>

    <fieldset>
        <?php
        $pesquisaTipoRevisoes = new Tiporevisoes();
        $collVoTipoRevisoes = $controla->findTipoRevisoes($pesquisaTipoRevisoes);
        if(!is_null($collVoTipoRevisoes)) {
            foreach ($collVoTipoRevisoes as $tipoRevisao) {
                $tipoRevisoesAtual = new Tiporevisoes();
                $tipoRevisoesAtual = $tipoRevisao;
                echo "<b>{$tipoRevisoesAtual->getDescricaoTipoRevisoes()}</b><br>";
            }
        }
        ?>
    </fieldset>
</form>