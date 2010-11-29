<?php 
include 'carregamentoInicial.php';
?>
<legend class="subtitulo">Cadastro de Natureza de Ação:</legend>
<br/>
<script type="text/javascript">

function alterar(idNaturezaAcao)
{
	var formulario = $('#deletaAltera').serialize(true);
	carregaPagina('naturezaAcao.php?idNaturezaAcao='+idNaturezaAcao,'page');
}

function deletar(idNaturezaAcao)
{
	document.deletaAltera.function.value = "deletar";
	document.deletaAltera.idNaturezaAcao.value = idNaturezaAcao;
	var formulario = $('#deletaAltera').serialize(true);
	enviaFormulario($('#deletaAltera').attr("action"),'page',formulario);
}
function cadastra()
{
	$(document).ready(function(){
		$('#naturezaAcao').submit(function() {
			if ( $('#nome').val() == '' ) {
				alert('O nome da natureza da ação deve ser inserido !');
				return false;
			} else {
				var formulario = $(this).serialize(true);
				enviaFormulario($(this).attr("action"),'page',formulario);
			}
		});
	});
}
</script>
<form name="naturezaAcao" id="naturezaAcao" method="post" action="../application/recebePostGet.php" onclick="cadastra()" >
	<?php
	$naturezaAcao = null;
	$naturezaAcao = new NaturezaAcao();
	if(isset($_GET['idNaturezaAcao']))
	{
		$naturezaAcao->reset();
		$naturezaAcao->setIdnaturezaacao($_GET['idNaturezaAcao']);
		$naturezaAcao->find(true);
	}
	?>
	<input type="hidden" id="control" name="control" value="NaturezaAcao"/>
	<input type="hidden" id="function" name="function" value="<?=(isset($_GET['idNaturezaAcao']))?"alterar":"cadastrar"?>"/>
	<input type="hidden" id="idNaturezaAcao" name="idNaturezaAcao" value="<?=$naturezaAcao->getIdnaturezaacao()?>"/>
	<table>
		<tr>
			<td width="120">Nome da Natureza da Ação:</td>
			<td width="144"><input type="text" name="nome" value="<?=$naturezaAcao->getNaturezaacao()?>" id="nome"/></td>
			<td width="49"><input type="submit" name="submit" id="submit" value="<?=(isset($_GET['idNaturezaAcao']))?"Alterar":"Cadastrar"?>"/></td>
		</tr>
	</table>
</form>
<?php
$naturezaAcao = null;
$naturezaAcao = new NaturezaAcao();
$naturezaAcao->reset();
if($naturezaAcao->find()>0)
{
?>
<form name="deletaAltera" id="deletaAltera" method="post" action="../application/recebePostGet.php" >
	<input type="hidden" id="control" name="control" value="NaturezaAcao"/>
	<input type="hidden" id="function" name="function" value=""/>
	<input type="hidden" id="idNaturezaAcao" name="idNaturezaAcao" value=""/>
<table>
	<tr>
		<td colspan="4">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="4">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="4"><strong>Comarcas Natureza da Ação</strong></td>
	</tr>
	<tr>
		<td width="126">&nbsp;</td>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
		<td><strong>ID</strong></td>
		<td colspan="3"><strong>Natureza da Ação</strong></td>
	</tr>
  <?php 
	while($naturezaAcao->fetch())
	{
  ?>
	<tr>
	  	<td><?=$naturezaAcao->getIdnaturezaacao() ?></td>
		  <td width="243"><?=$naturezaAcao->getNaturezaacao()?></td>
		  <td width="31"><a href="javascript:void(0);" onclick="alterar(<?=$naturezaAcao->getIdnaturezaacao()?>)"><img src="images/botao_editar.gif" width="16" height="16" border="0" /></a></td>
		  <td width="20"><a href="javascript:void(0);" onclick="deletar(<?=$naturezaAcao->getIdnaturezaacao()?>)"><img src="images/botao_apagar.gif" width="16" height="16" border="0" /></a></td>
  	</tr>
  <?php 
  	}
  ?>
</table>
</form>
<?php 
}
else
{
?>
Não existem Natureza de Ação cadastradas.
<?php 
}
?>