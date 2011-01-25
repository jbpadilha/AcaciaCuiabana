<?php 
include 'carregamentoInicial.php';
?>
<legend class="subtitulo">Cadastro de Tipo de Ação:</legend>
<br/>
<script type="text/javascript">

function alterar(idTipoAcao)
{
	var formulario = $('#deletaAltera').serialize(true);
	carregaPagina('tipoacao.php?idTipoAcao='+idTipoAcao,'page');
}

function deletar(idTipoAcao)
{
	document.deletaAltera.funcao.value = "deletar";
	document.deletaAltera.idTipoAcao.value = idTipoAcao;
	var formulario = $('#deletaAltera').serialize(true);
	enviaFormulario($('#deletaAltera').attr("action"),'page',formulario);
}
function cadastra()
{
	if ( $('#nome').val() == '' ) {
		alert('O tipo da a��o deve ser informado !');
		return false;
	} else {
		var formulario = $('#tipoacao').serialize(true);
		enviaFormulario($('#tipoacao').attr("action"),'page',formulario);
	}
}
</script>
<form name="tipoacao" id="tipoacao" method="post" action="../application/recebePostGet.php">
	<?php
	$tipoacao = null;
	$tipoacao = new TipoAcao();
	if(isset($_GET['idTipoAcao']))
	{
		$tipoacao->reset();
		$tipoacao->setIdtipoacao($_GET['idTipoAcao']);
		$tipoacao->find(true);
	}
	?>
	<input type="hidden" id="control" name="control" value="TipoAcao"/>
	<input type="hidden" id="funcao" name="funcao" value="<?=(isset($_GET['idTipoAcao']))?"alterar":"cadastrar"?>"/>
	<input type="hidden" id="idTipoAcao" name="idTipoAcao" value="<?=$tipoacao->getIdtipoacao()?>"/>
	<table>
		<tr>
			<td width="120">Tipo da Ação:</td>
			<td width="144"><input type="text" name="nome" value="<?=$tipoacao->getTipoacao()?>" id="nome"/></td>
			<td width="49"><input type="button" onclick="cadastra();" name="submit" id="submit" value="<?=(isset($_GET['idTipoAcao']))?"Alterar":"Cadastrar"?>"/></td>
		</tr>
	</table>
</form>
<?php
$tipoacao = null;
$tipoacao = new TipoAcao();
$tipoacao->reset();
if($tipoacao->find()>0)
{
?>
<form name="deletaAltera" id="deletaAltera" method="post" action="../application/recebePostGet.php" >
	<input type="hidden" id="control" name="control" value="TipoAcao"/>
	<input type="hidden" id="funcao" name="funcao" value=""/>
	<input type="hidden" id="idTipoAcao" name="idTipoAcao" value=""/>
<table>
	<tr>
		<td colspan="4">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="4">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="4"><strong>Tipo de Ação Cadastradas</strong></td>
	</tr>
	<tr>
		<td width="126">&nbsp;</td>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
		<td><strong>ID</strong></td>
		<td colspan="3"><strong>Tipo da Ação</strong></td>
	</tr>
  <?php 
	while($tipoacao->fetch())
	{
  ?>
	<tr>
	  	<td><?=$tipoacao->getIdtipoacao() ?></td>
		  <td width="243"><?=$tipoacao->getTipoacao()?></td>
		  <td width="31"><a href="javascript:void(0);" onclick="alterar(<?=$tipoacao->getIdtipoacao() ?>)"><img src="images/botao_editar.gif" width="16" height="16" border="0" /></a></td>
		  <td width="20"><a href="javascript:void(0);" onclick="deletar(<?=$tipoacao->getIdtipoacao() ?>)"><img src="images/botao_apagar.gif" width="16" height="16" border="0" /></a></td>
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
Não existem tipo de ação cadastradas.
<?php 
}
?>