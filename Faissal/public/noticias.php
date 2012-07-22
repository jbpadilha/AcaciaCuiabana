<?php 
include ('carregamentoInicial.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <title>Benemérita, Augusta e Respeitosa Loja Simbólica Acácia Cuiabana Nº 01</title>

</head>
<body>
	<div class="art-postmetadataheader">
		<h2 class="art-postheader">
		    Notícias
		</h2>
   	</div>
<div>
<?php
if(isset($_GET['id']))
{
	$noticiasPesquisa = new Noticias();
	$noticiasPesquisa->setIdNoticia($_GET['id']);
	$noticiasPesquisa->find(true);
	if($noticiasPesquisa->getImagemNoticia() != null)
		echo "<img src=\"images/{$noticiasPesquisa->getImagemNoticia()}\" style=\"float:left; margin-right:10px;\" border=\"1\" />";
	echo "<p>".$noticiasPesquisa->getDatanoticiaFormatado()." - <b>".$noticiasPesquisa->getTituloNoticia()."</b></p>";
	echo "<div style=\"text-align:justify;\">".$noticiasPesquisa->decodificaDado($noticiasPesquisa->getDescricaoNoticia())."</div>"; 
}
?>
</div>
<div>
<?php
$noticias = new Noticias();
$noticias->reset();
$noticias->setStatusNoticia(1);
if($noticias->find())
{
	while ($noticias->fetch())
	{
		echo "<p><a href=\"javascript:void(0);\" onClick=\"carregaPagina('noticia.php?idnoticia=".$noticias->getIdNoticia()."','conteudo');\">{$noticias->getDatanoticiaFormatado()} - {$noticias->getTituloNoticia()}</a></p>"; 
	}
}
?>
</div>
   	
   	
</body>
</html>
