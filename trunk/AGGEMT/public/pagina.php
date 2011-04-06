<?php 
include ('carregamentoInicial.php');

if(isset($_GET['idpagina']))
{
	$pagina = new Paginas();
	$pagina->setIdpagina($_GET['idpagina']);
	$pagina->find(true);
?>

<div class="art-postcontent">
	<p><?=$pagina->getDescricaopagina()?></p>
</div>
<?php 
}
?>