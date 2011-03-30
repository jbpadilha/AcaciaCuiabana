<?php 
include '../carregamentoInicial.php';
include_once( '../ckeditor/ckeditor_php5.php' ) ;
?>
<script type="text/javascript">
      Calendar.setup({
        inputField : "datanoticia",
        trigger    : "f_btn1",
        onSelect   : function() { this.hide() },
        dateFormat : "%d-%m-%Y"
      });
      $("#datanoticia").mask("99/99/9999");
      function abaCadastra()
      {
    	  $('#cadastroNoticia').toggle();
      }
      function alterar(idnoticia)
      {
      	var formulario = $('#deletaAltera').serialize(true);
      	carregaPagina('noticiaAdm.php?idnoticia='+idnoticia,'conteudo');
      }

      function deletar(idnoticia)
      {
      	document.deletaAltera.funcao.value = "deletar";
      	document.deletaAltera.idnoticia.value = idnoticia;
      	var formulario = $('#deletaAltera').serialize(true);
      	enviaFormulario($('#deletaAltera').attr("action"),'conteudo',formulario);
      }
      function cadastra()
      {
      	if ( $('#datanoticia').val() == '' && $('#titulonoticia').val() == '' ) {
      		alert('Todos campos obrigatórios devem ser preenchidos!');
      		return false;
      	} else {
      		$('#cadastrar').submit();
      	}
      }
</script>
<table>
	<tr>
		<td class="tituloAdm">Cadastro de Notícias</td>
	</tr>
</table>
<br>
<br>


<form name="deletaAltera" id="deletaAltera" method="post" action="../../application/recebePostGet.php" >
	<input type="hidden" id="control" name="control" value="Noticia"/>
	<input type="hidden" id="funcao" name="funcao" value=""/>
	<input type="hidden" id="idnoticia" name="idnoticia" value=""/>
	<table width="100%">
		<tr>
			<td class="titulo" colspan="5">Notícias Cadastradas</td>
		</tr>
		<tr>
			<td>id</td>
			<td>Titulo</td>
			<td>Data da Notícia</td>
			<td colspan="2">Ações</td>
		</tr>
		<?php  
		$noticia = null;
		$noticia = new Noticias();
		$noticia->reset();
		$noticia->limit();
		if($noticia->find()>0)
		{
			while($noticia->fetch())
			{
			?>
			<tr>
				<td><?=$noticia->getIdnoticia()?></td>
				<td><?=$noticia->getTitulonoticia()?></td>
				<td><?=$noticia->getDatanoticiaFormatado()?></td>
				<td width="31"><a href="javascript:void(0);" onclick="alterar(<?=$noticia->getIdnoticia() ?>)"><img src="../images/botao_editar.gif" width="16" height="16" border="0" /></a></td>
  				<td width="20"><a href="javascript:void(0);" onclick="deletar(<?=$noticia->getIdnoticia() ?>)"><img src="../images/botao_apagar.gif" width="16" height="16" border="0" /></a></td>
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
			<td colspan="5">Não existem notícias cadastradas.</td>
		</tr>
	<?php 
	}
	?>
</table>
</form>
<?php 
?>
<input type="button" id="btCadastra" value="Cadastrar" onclick="abaCadastra();">
<div id="cadastroNoticia" <?php if (!isset($_GET['idnoticia'])) echo "style=\"display:none;\"";?>>
<h3 class="t">Cadastro de Notícias</h3>
<?php 
$noticia = null;
$noticia = new Noticias();
if(isset($_GET['idnoticia']))
{
	$noticia->reset();
	$noticia->setIdnoticia($_GET['idnoticia']);
	$noticia->find(true);
}

?>
<form name="cadastrar" id="cadastrar" method="post" action="../../application/recebePostGet.php" enctype="multipart/form-data" >
	<input type="hidden" id="control" name="control" value="Noticia"/>
	<input type="hidden" id="funcao" name="funcao" value="<?=(isset($_GET['idnoticia']))?"alterar":"cadastrar"?>"/>
	<input type="hidden" id="idnoticia" name="idnoticia" value="<?=$noticia->getIdnoticia()?>"/>
	<table width="100%">
		<tr>
			<td valign="top"><p>Data*:</p></td>
			<td valign="top">
				<input type="text" id="datanoticia" name="datanoticia" value="<?=$noticia->getDatanoticiaFormatado()?>" size="20">
				<a id="f_btn1" href="javascript:void(0);"><img src="../images/bot-calendario.png" border="0"></a>
			</td>
		</tr>
		<tr>
			<td valign="top"><p>Título da Notícia*:</p></td>
			<td valign="top" colspan="2"><input type="text" id="titulonoticia" name="titulonoticia" value="<?=$noticia->getTitulonoticia()?>" size="60"></td>
		</tr>
		<tr>
			<td valign="top"><p>Descrição:</p></td>
			<td valign="top" colspan="2">
				<?php 
				$CKEditor = new CKEditor();
 				$CKEditor->editor("descricaonoticia", $noticia->getDescricaonoticia());
 				?>
			</td>
		</tr>
		<tr>
			<td valign="top"><p>Imagem da Notícia:</p></td>
			<td valign="top">
				<input type="file" name="imagem" id="imagem" class="input">
			</td>
		</tr>
		<?php 
		if($noticia->getImagemnoticia()!=null)
		{
		?>
		<tr>
			<td valign="top">Imagem Cadastradas:</td>
			<td valign="top">
				<img alt="" src="<?=$noticia->getImagemnoticia()?>">
			</td>
		</tr>
		<?php 
		}
		?>
		<tr>
			<td valign="top">Destaque?</td>
			<td valign="top"><input type="checkbox" id="destaque" name="destaque" <?=($noticia->getDestaque())?"checked=\"checked\"":""?>/></td>
		</tr>
		<tr>
			<td colspan="3">
				* Campos Obrigatórios.<br>
				<input type="submit" name="submit" id="submit" value="<?=(isset($_GET['idnoticia']))?"Alterar":"Cadastrar"?>"/>
			</td>
		</tr>
	</table>
</form>
</div>
		