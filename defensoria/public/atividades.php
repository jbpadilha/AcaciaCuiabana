<?php 
include 'carregamentoInicial.php';
?>
<legend class="subtitulo">Cadastro de Atividades:</legend>
<br/>
<script type="text/javascript">

function alterar(idAtividades)
{
	var formulario = $('#deletaAltera').serialize(true);
	carregaPagina('atividades.php?idAtividades='+idAtividades,'page');
}

function deletar(idAtividades)
{
	document.deletaAltera.function.value = "deletar";
	document.deletaAltera.idAtividades.value = idAtividades;
	var formulario = $('#deletaAltera').serialize(true);
	enviaFormulario($('#deletaAltera').attr("action"),'page',formulario);
}
function cadastra()
{
	$(document).ready(function(){
		$('#atividades').submit(function() {
			if ( $('#nome').val() == '' ) {
				alert('O nome da atividades deve ser inserido !');
				return false;
			} else {
				var formulario = $(this).serialize(true);
				enviaFormulario($(this).attr("action"),'page',formulario);
			}
		});
	});
}
</script>
<form name="atividades" id="atividades" method="post" action="../application/recebePostGet.php" onclick="cadastra()" >
	<?php
	$atividades = null;
	$atividades = new Atividades();
	if(isset($_GET['idAtividades']))
	{
		$atividades->reset();
		$atividades->setIdatividades($_GET['idAtividades']);
		$atividades->find(true);
	}
	?>
	<input type="hidden" id="control" name="control" value="Atividades"/>
	<input type="hidden" id="function" name="function" value="<?=(isset($_GET['idAtividades']))?"alterar":"cadastrar"?>"/>
	<input type="hidden" id="idAtividades" name="idAtividades" value="<?=$atividades->getIdatividades()?>"/>
	<table>
		<tr>
			<td width="120">Nome da Atividades:</td>
			<td width="144"><input type="text" name="nome" value="<?=$atividades->getAtividades()?>" id="nome"/></td>
			<td width="49"><input type="submit" name="submit" id="submit" value="<?=(isset($_GET['idAtividades']))?"Alterar":"Cadastrar"?>"/></td>
		</tr>
	</table>
</form>
<?php
$atividades = null;
$atividades = new Atividades();
$atividades->reset();
if($atividades->find()>0)
{
?>
<form name="deletaAltera" id="deletaAltera" method="post" action="../application/recebePostGet.php" >
	<input type="hidden" id="control" name="control" value="Atividades"/>
	<input type="hidden" id="function" name="function" value=""/>
	<input type="hidden" id="idAtividades" name="idAtividades" value=""/>
<table>
	<tr>
		<td colspan="4">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="4">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="4"><strong>Comarcas Atividades</strong></td>
	</tr>
	<tr>
		<td width="126">&nbsp;</td>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
		<td><strong>ID</strong></td>
		<td colspan="3"><strong>Atividade</strong></td>
	</tr>
  <?php 
	while($atividades->fetch())
	{
  ?>
	<tr>
	  	<td><?=$atividades->getIdatividades() ?></td>
		  <td width="243"><?=$atividades->getAtividades()?></td>
		  <td width="31"><a href="javascript:void(0);" onclick="alterar(<?=$atividades->getIdatividades() ?>)"><img src="images/botao_editar.gif" width="16" height="16" border="0" /></a></td>
		  <td width="20"><a href="javascript:void(0);" onclick="deletar(<?=$atividades->getIdatividades() ?>)"><img src="images/botao_apagar.gif" width="16" height="16" border="0" /></a></td>
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
Não existem atividades cadastradas.
<?php 
}
?>