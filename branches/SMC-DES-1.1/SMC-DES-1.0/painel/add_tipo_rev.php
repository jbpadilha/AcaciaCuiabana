<?php
require_once ('../class/Config.php');

if (!isset($_SESSION['usuarioLogon'])) header("Location:../views/home.php?p=login");

$logon = new Logon();
$logon = $_SESSION["usuarioLogon"];
var_dump($logon);
if ($logon->getNivelAcessoLogin() != Dominio::$ADMINISTRADOR) {
    echo "
    <script type=\"text/javascript\">
		document.location='index.php?pg=home&msg=Usuário não autorizado para a funcionalidade';
	</script>
	";
}

$tipoRevisoes = new Tiporevisoes();

if (isset($_SESSION['tipoRevisoes'])) $tipoRevisoes = $_SESSION['tipoRevisoes'];
?>
<form method="post" action="../class/RecebePostGet.php" >

    <div class="botoes">
        <input type="hidden" name="acao" value="cadastroTipoRevisoes" />
        <input type="submit" value="Confirmar" />
    </div>

    <p class="caption"> Novo item de revisão </p>

    <fieldset>
        <label>Descrição:
            <input type="text" name="descricao" value="<?php echo $tipoRevisoes->getDescricaoTipoRevisoes(); ?>" class="long" />
        </label>
    </fieldset>

</form>

<form method="post" action="../class/RecebePostGet.php" >

    <p class="caption">Lista de revisões já cadastradas</p>

    <fieldset>
        <?php
        $pesquisaTipoRevisoes = new Tiporevisoes();
        $collVoTipoRevisoes = $controla->findTipoRevisoes($pesquisaTipoRevisoes);
        if (!is_null($collVoTipoRevisoes)) {
            foreach ($collVoTipoRevisoes as $tipoRevisao) {
                $tipoRevisoesAtual = new Tiporevisoes();
                $tipoRevisoesAtual = $tipoRevisao;
                echo "<b>{$tipoRevisoesAtual->getDescricaoTipoRevisoes()}</b><br>";
            }
        }
        ?>
    </fieldset>
	
</form>