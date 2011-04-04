<?php 
include '../carregamentoInicial.php';
include_once( '../ckeditor/ckeditor_php5.php' ) ;
?>
<script type="text/javascript">

      function abaCadastra()
      {
    	  $('#cadastroClass').toggle();
      }
      function alterar(idanexo)
      {
      	var formulario = $('#deletaAltera').serialize(true);
      	carregaPagina('anexosAdm.php?idanexo='+idanexo,'conteudo');
      }

      function deletar(idnoticia)
      {
      	document.deletaAltera.funcao.value = "deletar";
      	document.deletaAltera.idanexo.value = idanexo;
      	var formulario = $('#deletaAltera').serialize(true);
      	enviaFormulario($('#deletaAltera').attr("action"),'conteudo',formulario);
      }
      function cadastra()
      {
      	if ( $('#nomeanexo').val() == '') {
      		alert('Todos campos obrigatórios devem ser preenchidos!');
      		return false;
      	} else {
      		$('#cadastrar').submit();
      	}
      }
</script>
<table>
	<tr>
		<td class="tituloAdm">Cadastro de Anexos</td>
	</tr>
</table>
<br>
<br>


<form name="deletaAltera" id="deletaAltera" method="post" action="../../application/recebePostGet.php" >
	<input type="hidden" id="control" name="control" value="Anexos"/>
	<input type="hidden" id="funcao" name="funcao" value=""/>
	<input type="hidden" id="idanexo" name="idanexo" value=""/>
	<table width="100%">
		<tr>
			<td class="titulo" colspan="5">Anexos Cadastrados</td>
		</tr>
		<tr>
			<td>id</td>
			<td>Nome do Anexo:</td>
			<td colspan="2">Ações</td>
		</tr>
		<?php  
		$anexos = null;
		$anexos = new Anexos();
		$anexos->reset();
		if($anexos->find()>0)
		{
			while($anexos->fetch())
			{
			?>
			<tr>
				<td><?=$anexos->getIdanexo()?></td>
				<td><?=$anexos->getNomeanexo()?></td>
				<td width="31"><a href="javascript:void(0);" onclick="alterar(<?=$anexos->getIdanexo() ?>)"><img src="../images/botao_editar.gif" width="16" height="16" border="0" /></a></td>
  				<td width="20"><a href="javascript:void(0);" onclick="deletar(<?=$anexos->getIdanexo() ?>)"><img src="../images/botao_apagar.gif" width="16" height="16" border="0" /></a></td>
			</tr>
			<?
			}
		
		}
		else
		{
		?>
		<tr>
			<td colspan="5"></td>
		</tr>
		<tr>
			<td colspan="5">Não existem anexos cadastrados.</td>
		</tr>
	<?php 
	}
	?>
</table>
</form>
<?php 
?>
<input type="button" id="btCadastra" value="Cadastrar" onclick="abaCadastra();">
<div id="cadastroClass" <?php if (!isset($_GET['idanexo'])) echo "style=\"display:none;\"";?>>
<h3 class="t">Cadastro de Anexos</h3>
<?php 
$anexos = null;
$anexos = new Anexos();
if(isset($_GET['idanexo']))
{
	$anexos->setIdanexo($_GET['idanexo']);
	$anexos->find(true);
}

?>
<form name="cadastrar" id="cadastrar" method="post" action="../../application/recebePostGet.php" enctype="multipart/form-data" >
	<input type="hidden" id="control" name="control" value="Anexos"/>
	<input type="hidden" id="funcao" name="funcao" value="<?=(isset($_GET['idanexo']))?"alterar":"cadastrar"?>"/>
	<input type="hidden" id="idanexo" name="idanexo" value="<?=$anexos->getIdanexo()?>"/>
	<table width="100%">
		<tr>
			<td valign="top"><p>Nome do Anexo*:</p></td>
			<td valign="top" colspan="2"><input type="text" id="nomeanexo" name="nomeanexo" value="<?=$anexos->getNomeanexo()?>" size="60"></td>
		</tr>
		<tr>
			<td valign="top"><p>Link Externo:</p></td>
			<td valign="top" colspan="2"><input type="text" id="linkanexo" name="linkanexo" value="<?=$anexos->getLinkanexo()?>" size="60"></td>
		</tr>
		<tr>
			<td valign="top"><p>Arquivo:</p></td>
			<td valign="top">
				<input type="file" name="imagem" id="imagem" class="input">
			</td>
		</tr>
		<?php 
		if($anexos->getCaminhoanexo()!=null)
		{
		?>
		<tr>
			<td valign="top">Arquivo Cadastrado:</td>
			<td valign="top">
				<a href="<?=PROJETO_CONTEXT?>images/<?=$anexos->getCaminhoanexo()?>" target="_blank">Download Aqui</a>
			</td>
		</tr>
		<?php 
		}
		?>
		<tr>
			<td colspan="3">
				* Campos Obrigatórios.<br>
				<input type="submit" name="submit" id="submit" value="<?=(isset($_GET['idanexo']))?"Alterar":"Cadastrar"?>"/>
			</td>
		</tr>
	</table>
</form>
</div>
		