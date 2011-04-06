<?php
$menu = new Menu();
$menu->reset();
if($menu->find())
{
	echo '<ul class="art-vmenu">';
	while($menu->fetch())
	{
		if($menu->getIdpagina()!= null)
		{
			$link = "pagina.php?idpagina=".$menu->getIdpagina();  
			echo '<li><a href="javascript:void(0);" class="active" onClick="carregaPagina(\''.$link.'\',\'conteudo\');"><span class="l"> </span><span class="r"> </span><span class="t">'.$menu->getDescricaomenu().'</span></a></li>';
		}
		else
		{
			echo '<li><a href="'.$menu->getLinkmenu().'" class="active" target="_blank"><span class="l"> </span><span class="r"> </span><span class="t">'.$menu->getDescricaomenu().'</span></a></li>';
		}
	}
	echo '</ul>';
}
?>
