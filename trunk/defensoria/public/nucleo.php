<?php 
include 'carregamentoInicial.php';
?>
<legend class="subtitulo">Cadastro de Núcleo da Defensoria:</legend>
<br/>
<script type="text/javascript">

function alterar(idNucleo)
{
	var formulario = $('#deletaAltera').serialize(true);
	carregaPagina('nucleo.php?idNucleo='+idNucleo,'page');
}

function deletar(idNucleo)
{
	document.deletaAltera.function.value = "deletar";
	document.deletaAltera.idNucleo.value = idNucleo;
	var formulario = $('#deletaAltera').serialize(true);
	enviaFormulario($('#deletaAltera').attr("action"),'page',formulario);
}
function cadastra()
{
	$(document).ready(function(){
		$('#nucleo').submit(function() {
			if ( $('#nome').val() == '' ) {
				alert('O nome do núcleo da defensoria deve ser informado.');
				return false;
			} 
			else if ( $('#idComarca').val() == '' ) {
				alert('A comarca do núcleo da defensoria deve ser informado.');
				return false;
			}
			else {
				var formulario = $(this).serialize(true);
				enviaFormulario($(this).attr("action"),'page',formulario);
			}
		});
	});
}
</script>
<form name="nucleo" id="nucleo" method="post" action="../application/recebePostGet.php" onclick="cadastra()" >
	<?php
	$nucleo = null;
	$nucleo = new Nucleo();
	if(isset($_GET['idNucleo']))
	{
		$nucleo->reset();
		$nucleo->setIdnucleo($_GET['idNucleo']);
		$nucleo->find(true);
	}
	?>
	<input type="hidden" id="control" name="control" value="Nucleo"/>
	<input type="hidden" id="function" name="function" value="<?=(isset($_GET['idNucleo']))?"alterar":"cadastrar"?>"/>
	<input type="hidden" id="idNucleo" name="idNucleo" value="<?=$nucleo->getIdnucleo()?>"/>
	<table>
		<tr>
			<td width="120">Nome do Núcleo da Defensoria:</td>
			<td width="144" colspan="2"><input type="text" name="nome" value="<?=$nucleo->getNomenucleo()?>" id="nome"/></td>
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
				<option value="<?=$comarca->getIdcomarca()?>" <?=($nucleo->getIdcomarca() == $comarca->getIdcomarca())?"selected":""?>>
				<?=$comarca->getNomecomarca()?>
				</option>
			<?php 
				}
			?>
			</select>
			</td>
			<td width="49"><input type="submit" name="submit" id="submit" value="<?=(isset($_GET['idNucleo']))?"Alterar":"Cadastrar"?>"/></td>
		</tr>
	</table>
</form>
<?php
$nucleo = null;
$nucleo = new Nucleo();
$nucleo->reset();
if($nucleo->find()>0)
{
?>
<form name="deletaAltera" id="deletaAltera" method="post" action="../application/recebePostGet.php" >
	<input type="hidden" id="control" name="control" value="Nucleo"/>
	<input type="hidden" id="function" name="function" value=""/>
	<input type="hidden" id="idNucleo" name="idNucleo" value=""/>
<table>
	<tr>
		<td colspan="5">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="5">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="5"><strong>Núcleos de Defensoria Cadastradas</strong></td>
	</tr>
	<tr>
		<td width="126">&nbsp;</td>
		<td colspan="4">&nbsp;</td>
	</tr>
	<tr>
		<td><strong>Código</strong></td>
		<td><strong>Núcleo</strong></td>
		<td colspan="3"><strong>Comarca</strong></td>
	</tr>
  <?php 
	while($nucleo->fetch())
	{
  ?>
	<tr>
	  	<td><?=$nucleo->getIdnucleo()?></td>
		<td width="243"><?=$nucleo->getNomenucleo()?></td>
		<td width="243"><?=$nucleo->getNomeComarca()?></td>
		<td width="31"><a href="javascript:void(0);" onclick="alterar(<?=$nucleo->getIdnucleo() ?>)"><img src="images/botao_editar.gif" width="16" height="16" border="0" /></a></td>
		<td width="20"><a href="javascript:void(0);" onclick="deletar(<?=$nucleo->getIdnucleo() ?>)"><img src="images/botao_apagar.gif" width="16" height="16" border="0" /></a></td>
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
Não existem núcleos de defensoria cadastradas.
<?php 
}
?>