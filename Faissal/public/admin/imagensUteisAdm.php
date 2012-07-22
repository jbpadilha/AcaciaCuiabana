<?php 
include '../carregamentoInicial.php';
?>
<script type="text/javascript">

      function abaCadastra()
      {
    	  $('#cadastroClass').toggle();
      }
      function alterar(idImagensUteis)
      {
      	var formulario = $('#deletaAltera').serialize(true);
      	carregaPagina('imagensUteisAdm.php?idImagensUteis='+idImagensUteis,'conteudo');
      }

      function deletar(idanexo)
      {
      	document.deletaAltera.funcao.value = "deletar";
      	document.deletaAltera.idImagensUteis.value = idImagensUteis;
      	var formulario = $('#deletaAltera').serialize(true);
      	enviaFormulario($('#deletaAltera').attr("action"),'conteudo',formulario);
      }
      function cadastra()
      {
      	if ( $('#nomeImagensUteis').val() == '') {
      		alert('Todos campos obrigatórios devem ser preenchidos!');
      		return false;
      	} else {
      		$('#cadastrar').submit();
      	}
      }
</script>
<table>
	<tr>
		<td class="tituloAdm">Cadastro de Imangens Úteis</td>
	</tr>
</table>
<br>
<br>


<form name="deletaAltera" id="deletaAltera" method="post" action="../../application/recebePostGet.php" >
	<input type="hidden" id="control" name="control" value="ImagensUteis"/>
	<input type="hidden" id="funcao" name="funcao" value=""/>
	<input type="hidden" id="idImagensUteis" name="idImagensUteis" value=""/>
	<table width="100%">
		<tr>
			<td class="titulo" colspan="5">Imagens Cadastradas</td>
		</tr>
		<tr>
			<td>id</td>
			<td>Nome da Imagen:</td>
			<td colspan="2">Ações</td>
		</tr>
		<?php  
		$imagensUteis = null;
		$imagensUteis = new ImagensUteis();
		$imagensUteis->reset();
		if($imagensUteis->find()>0)
		{
			while($imagensUteis->fetch())
			{
			?>
			<tr>
				<td><?=$imagensUteis->getIdImagensUteis()?></td>
				<td><?=$imagensUteis->getNomeImagensUteis()?></td>
				<td width="31"><a href="javascript:void(0);" onclick="alterar(<?=$imagensUteis->getIdImagensUteis() ?>)"><img src="../images/botao_editar.gif" width="16" height="16" border="0" alt="Alterar"/></a></td>
  				<td width="20"><a href="javascript:void(0);" onclick="deletar(<?=$imagensUteis->getIdImagensUteis() ?>)"><img src="../images/botao_apagar.gif" width="16" height="16" border="0" alt="Deletar"/></a></td>
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
			<td colspan="5">Não existem imagens cadastradas.</td>
		</tr>
	<?php 
	}
	?>
</table>
</form>
<?php 
?>
<input type="button" id="btCadastra" value="Cadastrar" onclick="abaCadastra();">
<div id="cadastroClass" <?php if (!isset($_GET['idImagensUteis'])) echo "style=\"display:none;\"";?>>
<h3 class="t">Cadastro de Imagens Úteis</h3>
<?php 
$imagensUteis = null;
$imagensUteis = new ImagensUteis();
$imagensUteis->reset();
if(isset($_GET['idImagensUteis']))
{
	$imagensUteis->setIdImagensUteis($_GET['idImagensUteis']);
	$imagensUteis->find(true);
}

?>
<form name="cadastrar" id="cadastrar" method="post" action="../../application/recebePostGet.php" enctype="multipart/form-data" >
	<input type="hidden" id="control" name="control" value="ImagensUteis"/>
	<input type="hidden" id="funcao" name="funcao" value="<?=(isset($_GET['idImagensUteis']))?"alterar":"cadastrar"?>"/>
	<input type="hidden" id="idImagensUteis" name="idImagensUteis" value="<?=$imagensUteis->getIdImagensUteis()?>"/>
	<table width="100%">
		<tr>
			<td valign="top"><p>Nome da Imagem*:</p></td>
			<td valign="top" colspan="2"><input type="text" id="nomeImagensUteis" name="nomeImagensUteis" value="<?=$imagensUteis->getNomeImagensUteis()?>" size="60"></td>
		</tr>
		<tr>
			<td valign="top"><p>Arquivo:</p></td>
			<td valign="top">
				<input type="file" name="imagem" id="imagem" class="input">
			</td>
		</tr>
		<?php 
		if($imagensUteis->getLocalImagensUteis()!=null)
		{
		?>
		<tr>
			<td valign="top">Imagem Cadastrada:</td>
			<td valign="top">
				<a href="<?=PATH_PROJETO_IMAGEM.$anexos->getCaminhoanexo()?>" target="_blank">Download Aqui</a>
			</td>
		</tr>
		<?php 
		}
		?>
		<tr>
			<td colspan="3">
				* Campos Obrigatórios.<br>
				<input type="submit" name="submit" id="submit" value="<?=(isset($_GET['idImagensUteis']))?"Alterar":"Cadastrar"?>"/>
			</td>
		</tr>
	</table>
</form>
</div>
		