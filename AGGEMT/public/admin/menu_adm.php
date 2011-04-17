<?php 
require '../../application/GruposUsuarios.php';
?>
<div class="art-nav">
	<div class="art-nav-wrapper">
		<div class="art-nav-inner">
			<ul class="art-menu">
				<?php 
				if($_SESSION['grupo'] == GruposUsuarios::$GRUPO_ADMIN)
				{
				?>
				<li><a href="javascript:void(0);" onclick="carregaPagina('agendaAdm.php','conteudo');"><span class="l"> </span><span class="r"> </span><span class="t">Agenda</span></a></li>
				<li><a href="javascript:void(0);" onclick="carregaPagina('paginaPersonalisadaAdm.php','conteudo');"><span class="l"> </span><span class="r"> </span><span class="t">Páginas Personalisadas</span></a></li>
				<li><a href="javascript:void(0);" onclick="carregaPagina('menuAdm.php','conteudo');"><span class="l"> </span><span class="r"> </span><span class="t">Menu</span></a></li>
				<li><a href="javascript:void(0);" onclick="carregaPagina('subMenuAdm.php','conteudo');"><span class="l"> </span><span class="r"> </span><span class="t">Sub-Menu</span></a></li>
				<li><a href="javascript:void(0);" onclick="carregaPagina('linksuteisAdm.php','conteudo');"><span class="l"> </span><span class="r"> </span><span class="t">Link úteis</span></a></li>
				<li><a href="javascript:void(0);" onclick="carregaPagina('noticiaAdm.php','conteudo');"><span class="l" > </span><span class="r"> </span><span class="t">Notícias</span></a></li>
				<li><a href="javascript:void(0);" onclick="carregaPagina('anexosAdm.php','conteudo');"><span class="l"> </span><span class="r"> </span><span class="t">Anexos/Publicações</span></a></li>
				<li><a href="javascript:void(0);" onclick="carregaPagina('bannersAdm.php','conteudo');"><span class="l"> </span><span class="r"> </span><span class="t">Banners</span></a></li>
				<li><a href="javascript:void(0);" onclick="carregaPagina('enqueteAdm.php','conteudo');"><span class="l"> </span><span class="r"> </span><span class="t">Enquete</span></a></li>
				<li><a href="javascript:void(0);" onclick="carregaPagina('usuariosAdm.php','conteudo');"><span class="l"> </span><span class="r"> </span><span class="t">Usuários</span></a></li>
				<?php 
				}
				?>
				<?php 
				if($_SESSION['grupo'] == GruposUsuarios::$GRUPO_ASSOCIADO)
				{
					$usuarioAdm = null;
					$usuarioAdm = new Usuarios();
					$usuarioAdm->setUsuario($_SESSION['loginusuario']);
					$usuarioAdm->find(true);
				?>
				<li><a href="javascript:void(0);" onclick="carregaPagina('vagendaAdm.php','conteudo');"><span class="l"> </span><span class="r"> </span><span class="t">Agenda</span></a></li>
				<li><a href="javascript:void(0);" onclick="carregaPagina('vanexosAdm.php','conteudo');"><span class="l"> </span><span class="r"> </span><span class="t">Publicações</span></a></li>
				<li><a href="javascript:void(0);" onclick="carregaPagina('vusuariosAdm.php?idusuario=<?=$usuarioAdm->getIdusuario()?>','conteudo');"><span class="l"> </span><span class="r"> </span><span class="t">Meus Dados</span></a></li>
				<?php 
				}
				?>
				<li><a href="javascript:void(0);" onclick="document.location='../../application/recebePostGet.php?sair=sim'"><span class="l"> </span><span class="r"> </span><span class="t">Sair</span></a></li>
			</ul>
		</div>
	</div>
</div>