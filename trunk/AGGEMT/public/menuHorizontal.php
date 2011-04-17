<?php
$menu = new Menu();
$menu->reset();
if($menu->find())
{
	echo '<ul class="art-menu">';
	echo '<li><a href="index.php" class="active"><span class="l"> </span><span class="r"> </span><span class="t">Página Inicial</span></a></li>';
	while($menu->fetch())
	{
		echo '<li>';
		if($menu->getIdpagina()!= null)
		{
			$link = "pagina.php?idpagina=".$menu->getIdpagina();  
			echo '<a href="javascript:void(0);" class="active" onClick="carregaPagina(\''.$link.'\',\'conteudo\');"><span class="l"> </span><span class="r"> </span><span class="t">'.$menu->getDescricaomenu().'</span></a>';
		}
		elseif($menu->getLinkmenu() != null)
		{
			echo '<a href="'.$menu->getLinkmenu().'" class="active" target="_blank"><span class="l"> </span><span class="r"> </span><span class="t">'.$menu->getDescricaomenu().'</span></a>';
		}
		else 
		{
			echo '<a href="javascript:void(0);" class="active"><span class="l"> </span><span class="r"> </span><span class="t">'.$menu->getDescricaomenu().'</span></a>';
		}
		
		//SubMenu
		$subMenu = new Submenu();
		$subMenu->setIdmenu($menu->getIdmenu());
		if($subMenu->find()>0)
		{
			echo '<ul>';
			while ($subMenu->fetch())
			{
				if($subMenu->getIdpagina()!= null)
				{
					$link = "pagina.php?idpagina=".$subMenu->getIdpagina();  
					echo '<li><a href="javascript:void(0);" class="active" onClick="carregaPagina(\''.$link.'\',\'conteudo\');"><span class="l"> </span><span class="r"> </span><span class="t">'.$subMenu->getDescricaosubmenu().'</span></a></li>';
				}
				elseif($subMenu->getLinksubmenu() != null)
				{
					echo '<li><a href="'.$subMenu->getLinksubmenu().'" class="active" target="_blank"><span class="l"> </span><span class="r"> </span><span class="t">'.$subMenu->getDescricaosubmenu().'</span></a></li>';
				}
				elseif($subMenu->getIdanexo() != null)
				{
					$anexos = new Anexos();
					$anexos->setIdanexo($subMenu->getIdanexo());
					$anexos->find(true);
					echo '<li><a href="images/'.$anexos->getCaminhoanexo().'" class="active" target="_blank"><span class="l"> </span><span class="r"> </span><span class="t">'.$subMenu->getDescricaosubmenu().'</span></a></li>';
				}
				else 
				{
					echo '<li><a href="javascript:void(0);" class="active"><span class="l"> </span><span class="r"> </span><span class="t">'.$subMenu->getDescricaosubmenu().'</span></a></li>';
				}
			}
			echo '</ul>';	
		}
		echo '</li>';
	}
	echo '</ul>';
}
?>
