<?php
require_once ('../../class/Config.php');
if(!isset($_SESSION['usuarioLogon']))
{
	header("Location:../views/home.php?p=login");
}


$logon = new Logon();
$logon = $_SESSION["usuarioLogon"];
if($logon->getNivelAcessoLogin() <= 5)
{
	$mensagem = 'Usuário não autorizado para a funcionalidade';
	header("Location:index.php?pg=home&msg=$mensagem");
} 

$tipoRevisoes = new Tiporevisoes();
if(isset($_GET['tipoRevisoes']))
{
	$tipoRevisoes = unserialize(urldecode($_GET['tipoRevisoes']));
}

?>
<link rel="stylesheet" href="../css/default.css" type="text/css" media="all">
<form name="add_tipo_rev" method="post" action="../../class/RecebePostGet.php" >
	<input type="hidden" id="acao" name="acao" value="cadastroTipoRevisoes">
	<fieldset class="x640">
		<p class="caption"> Novo item de revisão </p>
		<p> <label for="descricao"> Descrição: </label> <input type="text" class="x9" name="descricao" id="descricao" value="<?=$tipoRevisoes->getDescricaoTipoRevisoes()?>" > </p>
		<span class="borda"> </span>
		<p class="tright"> <input type="submit" value="Confirmar" class="f_right" > </p>
	</fieldset>
</form>

<form>
<fieldset class="x640">
	<p class="caption">Lista de revisões já cadastradas.</p>
	<div class="over y300">
		<?php
			$pesquisaTipoRevisoes = new Tiporevisoes();
			$collVoTipoRevisoes = $controla->findTipoRevisoes($pesquisaTipoRevisoes);
			if(!is_null($collVoTipoRevisoes))
			{
				foreach ($collVoTipoRevisoes as $tipoRevisao)
				{
					$tipoRevisoesAtual = new Tiporevisoes();
					$tipoRevisoesAtual = $tipoRevisao;
					echo "<b>{$tipoRevisoesAtual->getDescricaoTipoRevisoes()}</b><br>";
				}
			} 
		?>
	</div>
</fieldset>
</form>
</body>
</html>