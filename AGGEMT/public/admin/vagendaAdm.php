<?php 
include ('../carregamentoInicial.php');
?>
<div class="art-postmetadataheader">
	<h2 class="art-postheader"><img src="../images/postheadericon.png" width="19" height="17" alt="" />Agenda</h2>
</div>
<?php

if(isset($_GET['idagenda']))
{ 
	$agendaPesquisa = new Agenda();
	$agendaPesquisa->setIdagenda($_GET['idagenda']);
	$agendaPesquisa->find(true);
?>

<div class="art-postcontent">
	<p><?=$agendaPesquisa->getDataAgendaFormatado()?> - <?=$agendaPesquisa->getTituloagenda()?></p>
	<p><?=$agendaPesquisa->getDescricaoagenda()?></p>
</div>
<?php 
}
$agenda = new Agenda();
$agenda->reset();
if($agenda->find())
{
	while ($agenda->fetch())
	{
		echo "<p><a href=\"javascript:void(0);\" onClick=\"carregaPagina('vagendaAdm.php?idagenda=".$agenda->getIdagenda()."','conteudo');\">{$agenda->getDataAgendaFormatado()} - {$agenda->getTituloagenda()}</a></p>"; 
	}
}
?>