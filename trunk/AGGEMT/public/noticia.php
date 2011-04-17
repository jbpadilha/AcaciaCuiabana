<?php 
include ('carregamentoInicial.php');
?>
<div class="art-postmetadataheader">
	<h2 class="art-postheader"><img src="./images/postheadericon.png" width="19" height="17" alt="" />Notícias</h2>
</div>
<div>
<?php
if(isset($_GET['idnoticia']))
{
	$noticiasPesquisa = new Noticias();
	$noticiasPesquisa->setIdnoticia($_GET['idnoticia']);
	$noticiasPesquisa->find(true);
	if($noticiasPesquisa->getImagemnoticia() != null)
		echo "<img src=\"images/{$noticiasPesquisa->getImagemnoticia()}\" style=\"float:left\" width=\"300\" height=\"200\" />";
	echo "<p>".$noticiasPesquisa->getDatanoticiaFormatado()." - ".$noticiasPesquisa->getTitulonoticia()."</p>";
	echo $noticiasPesquisa->getDescricaonoticia(); 
}
?>
</div>
<div>
<?php
$noticias = new Noticias();
$noticias->reset();
$noticias->setStatusnoticia(1);
if($noticias->find())
{
	while ($noticias->fetch())
	{
		echo "<p><a href=\"javascript:void(0);\" onClick=\"carregaPagina('noticia.php?idnoticia=".$noticias->getIdnoticia()."','conteudo');\">{$noticias->getDatanoticiaFormatado()} - {$noticias->getTitulonoticia()}</a></p>"; 
	}
}
?>
</div>