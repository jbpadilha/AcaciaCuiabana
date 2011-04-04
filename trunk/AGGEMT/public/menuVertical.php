<?php
$menu = new Menu();
$menu->reset();
if($menu->find())
{
	echo '<ul class="art-vmenu">';
	while($menu->fetch())
	{
		$link = ($menu->getIdpagina()!= null) ? $menu->getIdpagina() : $menu->getLinkmenu();  
		echo '<li><a href="'.$link.'" class="active"><span class="l"> </span><span class="r"> </span><span class="t">'.$menu->getDescricaomenu().'</span></a></li>';
	}
	echo '</ul>';
}
?>
