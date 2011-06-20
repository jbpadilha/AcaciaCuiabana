<?php 
include ('carregamentoInicial.php');
?>
<div class="art-postmetadataheader">
	<h2 class="art-postheader"><img src="./images/postheadericon.png" width="19" height="17" alt="" />Links</h2>
</div>
<div>
<?php
$linksuteis = new Linksuteis();
$linksuteis->reset();
if($linksuteis->find())
{
	echo '<ul>';
	while ($linksuteis->fetch())
	{
		if($linksuteis->getLink() != null)
		{
			echo '<li><a href="'.$linksuteis->getLink().'" target="_blank">'.$linksuteis->getDescricaolinksuteis().'</a></li>';
		}
		elseif($linksuteis->getIdanexo()!=null){
			$anexosLink = new Anexos();
			$anexosLink->setIdanexo($linksuteis->getIdanexo());
			$anexosLink->find(true);
			echo '<li><a href="imagens/'.$anexosLink->getCaminhoanexo().'" target="_blank">'.$linksuteis->getDescricaolinksuteis().'</a></li>';
		}
	}
	echo '</ul>';
}
?>
</div>