	<?php 
require '../../application/GruposUsuarios.php';
session_start();
?>
<ul class="art-menu">
	<?php 
	if(isset($_SESSION['grupoUsuario']) &&  $_SESSION['grupoUsuario'] == GruposUsuarios::$GRUPO_ADMIN)
	{
	?>
	<li><a href="javascript:void(0);" onclick="carregaPagina('agendaAdm.php','conteudo');"><span class="l"> </span><span class="r"> </span><span class="t" >Agenda</span></a></li>
	<li><a href="javascript:void(0);" onclick="carregaPagina('curiosidadesAdm.php','conteudo');"><span class="l"> </span><span class="r"> </span><span class="t" >Curiosidades</span></a></li>
	<li><a href="javascript:void(0);" onclick="carregaPagina('enqueteAdm.php','conteudo');"><span class="l"> </span><span class="r"> </span><span class="t">Enquete</span></a></li>
	<li><a href="javascript:void(0);" onclick="carregaPagina('galeriasAdm.php','conteudo');"><span class="l"> </span><span class="r"> </span><span class="t">Galeria de Foto</span></a></li>
	<li><a href="javascript:void(0);" onclick="carregaPagina('imagensUteisAdm.php','conteudo');"><span class="l"> </span><span class="r"> </span><span class="t">Imagens úteis</span></a></li>
	<li><a href="javascript:void(0);" onclick="carregaPagina('menuAdm.php','conteudo');"><span class="l"> </span><span class="r"> </span><span class="t">Menu</span></a></li>
	<li><a href="javascript:void(0);" onclick="carregaPagina('subMenuAdm.php','conteudo');"><span class="l"> </span><span class="r"> </span><span class="t">Sub-Menu</span></a></li>
	<li><a href="javascript:void(0);" onclick="carregaPagina('noticiaAdm.php','conteudo');"><span class="l" > </span><span class="r"> </span><span class="t">Notícias</span></a></li>
	<li><a href="javascript:void(0);" onclick="carregaPagina('paginaPersonalisadaAdm.php','conteudo');"><span class="l"> </span><span class="r"> </span><span class="t">Páginas Personalisadas</span></a></li>
	<li><a href="javascript:void(0);" onclick="carregaPagina('pessoaAdm.php','conteudo');"><span class="l"> </span><span class="r"> </span><span class="t">Pessoa</span></a></li>
	<li><a href="javascript:void(0);" onclick="carregaPagina('tabelaPrincipalAdm.php','conteudo');"><span class="l"> </span><span class="r"> </span><span class="t">Configurações Gerais</span></a></li>
	
	<?php 
	}
	?>
	<li><a href="javascript:void(0);" onclick="document.location='../../application/recebePostGet.php?sair=sim'"><span class="l"> </span><span class="r"> </span><span class="t">Sair</span></a></li>
</ul>