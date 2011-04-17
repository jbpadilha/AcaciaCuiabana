<?php 
include ('../carregamentoInicial.php');
?>
<div class="art-postmetadataheader">
	<h2 class="art-postheader"><img src="../images/postheadericon.png" width="19" height="17" alt="" />Publicações</h2>
</div>
<?php
$anexos = new Anexos();
$anexos->reset();
$anexos->setTipoanexo(1);
if($anexos->find())
{
	echo '<ul>';
	while ($anexos->fetch())
	{
		echo '<li><a href="'.PROJETO_CONTEXT.'public/images/'.$anexos->getCaminhoanexo().'" target="_blank">'.$anexos->getNomeanexo().'</a></li>';
	}
	echo '</ul>';
}
?>