<?php 
include '../carregamentoInicial.php';
?>
<script type="text/javascript">
      Calendar.setup({
        inputField : "datanoticia",
        trigger    : "f_btn1",
        onSelect   : function() { this.hide() },
        dateFormat : "%d-%m-%Y %H:%M:%S",
	    showTime: 24
      });
      $("#datanoticia").mask("99/99/9999 99:99:99");
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
			<td>Destaque</td>
			<td>Status</td>
			<td colspan="2">Ações</td>
		</tr>
		<?php  
		$noticia = null;
		$noticia = new Noticias();
		$noticia->reset();
		if($noticia->find()>0)
		{
			while($noticia->fetch())
			{
			?>
			<tr>
				<td><?=$noticia->getIdnoticia()?></td>
				<td><?=$noticia->getTitulonoticia()?></td>
				<td><?=$noticia->getDatanoticiaFormatado()?></td>
				<td><?=($noticia->getDestaque()) ? "Sim": "Não"?></td>
				<td><?=$noticia->getDescricaoStatusNoticia()?></td>
				<td width="31"><a href="javascript:void(0);" onclick="alterar(<?=$noticia->getIdnoticia() ?>)"><img src="../images/botao_editar.gif" width="16" height="16" border="0" alt="Alterar"/></a></td>
  				<td width="20"><a href="javascript:void(0);" onclick="deletar(<?=$noticia->getIdnoticia() ?>)"><img src="../images/botao_apagar.gif" width="16" height="16" border="0" alt="Deletar"/></a></td>
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
 				<textarea readonly="readonly" name="descricaonoticia" cols="50" rows="6" id="descricaonoticia" onfocus="javascript:document.forms[1].Submit.focus();" title="Para editar o conteúdo da página, precione no botão Editar Campo, ao lado."><?=$noticia->getDescricaonoticia()?></textarea>
				<input name="Submit2" type="button" class="botao" value="Editar Campo" onclick="javascript:abrepagina('editorHtml.php?nomeExibicaoCampo=Conteúdo da Notícia&formulario=cadastrar&campo=descricaonoticia',750,400);"/>
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
				<a href="<?=PROJETO_CONTEXT?>images/<?=$noticia->getImagemnoticia()?>" target="_blank">Download Aqui</a>
			</td>
		</tr>
		<?php 
		}
		?>
		<tr>
			<td valign="top">Destaque? (ao selecionar a notícia em destaque, somente essa será em destaque)</td>
			<td valign="top">
				<select id="destaque" name="destaque">
					<option value="0" <?=($noticia->getDestaque() == 0) ? "selected":""?>>Não</option>
					<option value="1" <?=($noticia->getDestaque() == 1) ? "selected":""?>>Sim</option>
				</select>
			</td>
		</tr>
		<tr>
			<td valign="top">Status</td>
			<td valign="top">
				<select id="statusnoticia" name="statusnoticia">
					<option value="0" <?=($noticia->getStatusnoticia() == 0) ? "selected":""?>>Inativo</option>
					<option value="1" <?=($noticia->getStatusnoticia() == 1) ? "selected":""?>>Ativo</option>
				</select>
			</td>
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
		