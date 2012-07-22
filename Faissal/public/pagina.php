<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <title>Benemérita, Augusta e Respeitosa Loja Simbólica Acácia Cuiabana Nº 01</title>
</head>
<body>	
<?php 
include("carregamentoInicial.php");

if(!isset($_GET['frasePrincipal']))
{

$pagina = new Paginas();
$pagina->reset();
if(isset($_GET['id']))
{
	$pagina->setIdPagina($_GET['id']);
	$pagina->find(true);
?>

	<div >
	<div class="art-postmetadataheader">
		<h2 class="art-postheader">
		    <?=$pagina->getNomePagina();?>
		</h2>
    	</div>
	<br/>
	<?=$pagina->getConteudoPagina()?>
	</div>
<?php 
}
}
else {
	$configuracoes->getFraseDestaqueTabelaPrincipal();
}
?>
</body>
</html>
