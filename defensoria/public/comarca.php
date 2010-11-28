<?php 
include 'carregamentoInicial.php';
?>
<legend class="subtitulo">Cadastro de Comarcas:</legend>
<br/>
<script type="text/javascript">

function alterar(idComarca)
{
	var formulario = $('#deletaAltera').serialize(true);
	carregaPagina('comarca.php?idComarca='+idComarca,'page');
}

function deletar(idComarca)
{
	document.deletaAltera.function.value = "deletar";
	document.deletaAltera.idComarca.value = idComarca;
	var formulario = $('#deletaAltera').serialize(true);
	enviaFormulario($('#deletaAltera').attr("action"),'page',formulario);
}
function cadastra()
{
	$(document).ready(function(){
		$('#comarca').submit(function() {
			if ( $('#nome').val() == '' ) {
				alert('O nome da comarca deve ser inserido !');
				return false;
			} else {
				var formulario = $(this).serialize(true);
				enviaFormulario($(this).attr("action"),'page',formulario);
			}
		});
	});
}
</script>
<form name="comarca" id="comarca" method="post" action="../application/recebePostGet.php" onclick="cadastra()" >
	<?php
	$comarca = null;
	$comarca = new Comarca();
	if(isset($_GET['idComarca']))
	{
		$comarca->reset();
		$comarca->setIdcomarca($_GET['idComarca']);
		$comarca->find(true);
	}
	?>
	<input type="hidden" id="control" name="control" value="Comarca"/>
	<input type="hidden" id="function" name="function" value="<?=(isset($_GET['idComarca']))?"alterar":"cadastrar"?>"/>
	<input type="hidden" id="idComarca" name="idComarca" value="<?=$comarca->getIdcomarca()?>"/>
	<table>
		<tr>
			<td width="120">Nome da Comarca:</td>
			<td width="144"><input type="text" name="nome" value="<?=$comarca->getNomecomarca()?>" id="nome"/></td>
			<td width="49"><input type="submit" name="submit" id="submit" value="<?=(isset($_GET['idComarca']))?"Alterar":"Cadastrar"?>"/></td>
		</tr>
	</table>
</form>
<?php
$comarca = null;
$comarca = new Comarca();
$comarca->reset();
if($comarca->find()>0)
{
?>
<form name="deletaAltera" id="deletaAltera" method="post" action="../application/recebePostGet.php" >
	<input type="hidden" id="control" name="control" value="Comarca"/>
	<input type="hidden" id="function" name="function" value=""/>
	<input type="hidden" id="idComarca" name="idComarca" value=""/>
<table>
	<tr>
		<td colspan="4">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="4">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="4"><strong>Comarcas Cadastradas</strong></td>
	</tr>
	<tr>
		<td width="126">&nbsp;</td>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
		<td><strong>ID</strong></td>
		<td colspan="3"><strong>Comarca</strong></td>
	</tr>
  <?php 
	while($comarca->fetch())
	{
  ?>
	<tr>
	  	<td><?=$comarca->getIdcomarca() ?></td>
		  <td width="243"><?=$comarca->getNomecomarca()?></td>
		  <td width="31"><a href="javascript:void(0);" onclick="alterar(<?=$comarca->getIdcomarca() ?>)"><img src="images/botao_editar.gif" width="16" height="16" border="0" /></a></td>
		  <td width="20"><a href="javascript:void(0);" onclick="deletar(<?=$comarca->getIdcomarca() ?>)"><img src="images/botao_apagar.gif" width="16" height="16" border="0" /></a></td>
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
Não existem comarcas cadastradas.
<?php 
}
?>