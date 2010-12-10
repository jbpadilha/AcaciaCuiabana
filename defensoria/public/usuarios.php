<?php 
include 'carregamentoInicial.php';
?>
<legend class="subtitulo">Cadastro de Usuários:</legend>
<br/>
<script type="text/javascript">

function alterar(idUsuario)
{
	var formulario = $('#deletaAltera').serialize(true);
	carregaPagina('usuarios.php?idUsuario='+idusuario,'page');
}

function deletar(idUsuario)
{
	document.deletaAltera.function.value = "deletar";
	document.deletaAltera.idUsuario.value = idUsuario;
	var formulario = $('#deletaAltera').serialize(true);
	enviaFormulario($('#deletaAltera').attr("action"),'page',formulario);
}
function cadastra()
{
	$(document).ready(function(){
		$('#usuarios').submit(function() {
			if ( $('#nome').val() == '' ) {
				alert('O nome do usuário deve ser inserido !');
				return false;
			} else {
				var formulario = $(this).serialize(true);
				enviaFormulario($(this).attr("action"),'page',formulario);
			}
		});
	});
}
</script>
<form name="usuarios" id="usuarios" method="post" action="../application/recebePostGet.php" onclick="cadastra()" >
	<?php
	$usuarios = null;
	$usuarios = new Usuarios();
	if(isset($_GET['idUsuario']))
	{
		$usuarios->reset();
		$usuarios->setIdusuarios($_GET['idUsuario']);
		$usuarios->find(true);
	}
	?>
	<input type="hidden" id="control" name="control" value="Usuarios"/>
	<input type="hidden" id="function" name="function" value="<?=(isset($_GET['idUsuario']))?"alterar":"cadastrar"?>"/>
	<input type="hidden" id="idUsuario" name="idUsuario" value="<?=$usuarios->getIdusuario()?>"/>
	<table>
		<tr>
			<td width="120">Usuário:</td>
			<td width="144"><input type="text" name="usuario" id="usuario" value="<?=$usuarios->getUsuario()?>"/></td>
			<td width="49"><input type="submit" name="submit" id="submit" value="<?=(isset($_GET['idComarca']))?"Alterar":"Cadastrar"?>"/></td>
		</tr>
		<tr>
			<td width="120">Usuário:</td>
			<td width="144"><input type="text" name="usuario" id="usuario" value="<?=$usuarios->getUsuario()?>"/></td>
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