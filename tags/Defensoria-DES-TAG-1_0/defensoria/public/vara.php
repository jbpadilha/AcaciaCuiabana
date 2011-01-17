<?php 
include 'carregamentoInicial.php';
?>
<legend class="subtitulo">Cadastro de Varas:</legend>
<br/>
<script type="text/javascript">

function alterar(idVara)
{
	var formulario = $('#deletaAltera').serialize(true);
	carregaPagina('vara.php?idVara='+idVara,'page');
}

function deletar(idVara)
{
	document.deletaAltera.funcao.value = "deletar";
	document.deletaAltera.idVara.value = idVara;
	var formulario = $('#deletaAltera').serialize(true);
	enviaFormulario($('#deletaAltera').attr("action"),'page',formulario);
}
function cadastra()
{
	if ( $('#nome').val() == '' ) {
		alert('O nome da vara deve ser inserido !');
		return false;
	} else {
		var formulario = $('#vara').serialize(true);
		enviaFormulario($('#vara').attr("action"),'page',formulario);
	}
}
</script>
<form name="vara" id="vara" method="post" action="../application/recebePostGet.php">
	<?php
	$vara = null;
	$vara = new Vara();
	if(isset($_GET['idVara']))
	{
		$vara->reset();
		$vara->setIdvara($_GET['idVara']);
		$vara->find(true);
	}
	?>
	<input type="hidden" id="control" name="control" value="Vara"/>
	<input type="hidden" id="funcao" name="funcao" value="<?=(isset($_GET['idVara']))?"alterar":"cadastrar"?>"/>
	<input type="hidden" id="idVara" name="idVara" value="<?=$vara->getIdvara()?>"/>
	<table>
		<tr>
			<td width="120">Código da Vara:</td>
			<td width="144" colspan="2"><input type="text" name="codVara" value="<?=$vara->getCodvara()?>" id="codVara"/></td>
		</tr>
		<tr>
			<td width="120">Nome da Vara:</td>
			<td width="144" colspan="2"><input type="text" name="nome" value="<?=$vara->getNomevara()?>" id="nome"/></td>
		</tr>
		<tr>
			<td width="120">Comarca:</td>
			<td width="144">
			<select id="idComarca" name="idComarca">
				<option value="">Selecione a Comarca</option>
			<?php 
				$comarca = new Comarca();
				$comarca->find();
				while($comarca->fetch())
				{			
			?>
				<option value="<?=$comarca->getIdcomarca()?>" <?=($vara->getIdcomarca() == $comarca->getIdcomarca())?"selected":""?>>
				<?=$comarca->getNomecomarca()?>
				</option>
			<?php 
				}
			?>
			</select>
			</td>
			<td width="49"><input type="button" onclick="cadastra();" name="submit" id="submit" value="<?=(isset($_GET['idVara']))?"Alterar":"Cadastrar"?>"/></td>
		</tr>
	</table>
</form>
<?php
$vara = null;
$vara = new Vara();
$vara->reset();
if($vara->find()>0)
{
?>
<form name="deletaAltera" id="deletaAltera" method="post" action="../application/recebePostGet.php" >
	<input type="hidden" id="control" name="control" value="Vara"/>
	<input type="hidden" id="funcao" name="funcao" value=""/>
	<input type="hidden" id="idVara" name="idVara" value=""/>
<table>
	<tr>
		<td colspan="5">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="5">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="5"><strong>Varas Cadastradas</strong></td>
	</tr>
	<tr>
		<td width="126">&nbsp;</td>
		<td colspan="4">&nbsp;</td>
	</tr>
	<tr>
		<td><strong>Código</strong></td>
		<td><strong>Vara</strong></td>
		<td colspan="3"><strong>Comarca</strong></td>
	</tr>
  <?php 
	while($vara->fetch())
	{
  ?>
	<tr>
	  	<td><?=$vara->getCodvara()?></td>
		<td width="243"><?=$vara->getNomevara()?></td>
		<td width="243"><?=$vara->getNomeComarca()?></td>
		<td width="31"><a href="javascript:void(0);" onclick="alterar(<?=$vara->getIdvara() ?>)"><img src="images/botao_editar.gif" width="16" height="16" border="0" /></a></td>
		<td width="20"><a href="javascript:void(0);" onclick="deletar(<?=$vara->getIdvara() ?>)"><img src="images/botao_apagar.gif" width="16" height="16" border="0" /></a></td>
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
Não existem varas cadastradas.
<?php 
}
?>